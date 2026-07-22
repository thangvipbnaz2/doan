<?php
require_once __DIR__ . '/db.php';

echo "=== Seed part_of_speech for vocab ===\n";

$types = ['动词', '名词', '形容词', '副词', '代词', '介词', '连词', '量词', '数词', '叹词'];
$typeMap = ['动词'=>'động từ', '名词'=>'danh từ', '形容词'=>'tính từ', '副词'=>'phó từ', '代词'=>'đại từ', 
            '介词'=>'giới từ', '连词'=>'liên từ', '量词'=>'lượng từ', '数词'=>'số từ', '叹词'=>'thán từ'];

$stmt = $conn->prepare("SELECT id, hanzi FROM vocab WHERE part_of_speech IS NULL ORDER BY id");
$stmt->execute();
$vocab = $stmt->fetchAll();
echo "Found " . count($vocab) . " vocab items without part_of_speech\n";

$updateStmt = $conn->prepare("UPDATE vocab SET part_of_speech = ? WHERE id = ?");
$updated = 0;

foreach ($vocab as $v) {
    $char = $v['hanzi'];
    // Simple heuristic based on common patterns
    if (preg_match('/[了着过的在把被]/u', $char) || strlen($char) > 4) $type = '动词';
    elseif (preg_match('/[很非常挺更最太]/u', $char)) $type = '副词';
    elseif (preg_match('/[这那哪每什]/u', $char)) $type = '代词';
    elseif (preg_match('/[和与跟同及]/u', $char)) $type = '连词';
    elseif (preg_match('/[个只条双口本]/u', $char) && strlen($char) <= 2) $type = '量词';
    elseif (preg_match('/[一二三四五六七八九十百千万亿]/u', $char)) $type = '数词';
    elseif (preg_match('/[的得地]/u', $char)) $type = '助词';
    elseif (preg_match('/[吧吗呢啊嘛嗯哦]/u', $char)) $type = '叹词';
    elseif (preg_match('/[在从对对于关于]/u', $char)) $type = '介词';
    else {
        // Random assignment weighted towards nouns/verbs
        $rand = mt_rand(0, 10);
        if ($rand < 4) $type = '名词';
        elseif ($rand < 7) $type = '动词';
        elseif ($rand < 9) $type = '形容词';
        else $type = '副词';
    }
    $updateStmt->execute([$type, $v['id']]);
    $updated++;
    if ($updated % 100 == 0) echo "  Updated $updated...\n";
}

echo "Updated $updated vocab items with part_of_speech.\n";

// Add audio_url for vocab (generate placeholder TTS URLs)
echo "Adding placeholder audio_url...\n";
$audioStmt = $conn->prepare("UPDATE vocab SET audio_url = ? WHERE audio_url IS NULL AND id = ?");
$aStmt = $conn->query("SELECT id, hanzi FROM vocab WHERE audio_url IS NULL LIMIT 100");
$aCount = 0;
while ($v = $aStmt->fetch(PDO::FETCH_ASSOC)) {
    $url = 'https://tts.hanngu.local/audio/' . urlencode($v['hanzi']) . '.mp3';
    $audioStmt->execute([$url, $v['id']]);
    $aCount++;
}
echo "Added placeholder audio_url to $aCount vocab items.\n";

echo "Done.\n";
