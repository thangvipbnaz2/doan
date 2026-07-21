<?php
session_start();
require 'db.php';
require 'course_access.php';
require 'dictation_data.php';

try {
    $course = courseAccessRequireEnrollment($conn, (string) ($_GET['slug'] ?? ''));
    $lesson = courseAccessRequireCourseLesson($conn, (int) $course['id'], (int) ($_GET['lesson'] ?? 0));
    $hsk = (int) $course['hsk_level'];
    $levelMap = [
        1 => ['start' => 1, 'count' => 10, 'title' => 'HSK 1 · Nền tảng tiếng Trung từ số 0'],
        2 => ['start' => 11, 'count' => 10, 'title' => 'HSK 2 · Giao tiếp cơ bản'],
        3 => ['start' => 21, 'count' => 10, 'title' => 'HSK 3 · Sơ cấp nâng cao'],
        4 => ['start' => 31, 'count' => 10, 'title' => 'HSK 4 · Trung cấp toàn diện'],
        5 => ['start' => 41, 'count' => 10, 'title' => 'HSK 5 · Nâng cao đọc viết'],
        6 => ['start' => 51, 'count' => 9, 'title' => 'HSK 6 · Chuyên sâu & toàn diện'],
    ];
    $levelInfo = $levelMap[$hsk] ?? $levelMap[1];
    $passageIndex = isset($_GET['passage']) ? min((int) $_GET['passage'], $levelInfo['count'] - 1) : 0;
    $flatKey = $levelInfo['start'] + $passageIndex;
    $exercise = $library[$flatKey] ?? $library[1];
    $totalPassages = $levelInfo['count'];
} catch (Throwable $e) {
    http_response_code($e->getCode() >= 400 ? $e->getCode() : 403);
    $error = $e->getMessage();
}
$hideTranslate = 'style="display:none"';
?>
<!doctype html>
<html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= isset($course) ? htmlspecialchars($exercise['title']) : 'Luyện nghe chép chính tả' ?> | HànNgữ</title><link rel="stylesheet" href="style.css">
<style>
.dictation-page{max-width:1120px;margin:auto;padding:104px 24px 64px}.dictation-hero{padding:32px;border-radius:24px;color:#fff;background:linear-gradient(135deg,#0f766e,#134e4a)}.dictation-hero h1{margin:8px 0;font-size:clamp(1.8rem,4vw,2.7rem)}.dictation-hero p{margin:0;color:#d1fae5;line-height:1.65}.dictation-grid{display:grid;grid-template-columns:minmax(0,1fr) 330px;gap:22px;margin-top:24px}.dict-card{padding:25px;border:1px solid #e2e8f0;border-radius:18px;background:#fff;box-shadow:0 7px 22px #0f172a0b}.dict-card h2{margin:0 0 12px;color:#102a56;font-size:1.3rem}.steps{display:flex;gap:9px;flex-wrap:wrap;margin:17px 0}.step{padding:7px 10px;border-radius:99px;background:#ecfdf5;color:#047857;font-size:.8rem;font-weight:700}.step.pass{background:#dbeafe;color:#1d4ed8}.step.active{background:#fef3c7;color:#b45309}.listen-controls{display:flex;gap:10px;flex-wrap:wrap;margin:17px 0}.listen-controls button{border:0;cursor:pointer}.passage{max-height:420px;overflow:auto;padding:18px;border:1px solid #dbeafe;border-radius:14px;background:#f8fafc}.passage.hidden p{filter:blur(7px);user-select:none}.passage p{margin:0;line-height:1.9;font-size:1.05rem}.writing-box{width:100%;min-height:220px;box-sizing:border-box;padding:15px;border:1px solid #cbd5e1;border-radius:13px;font:1rem/1.8 'Noto Sans SC','Microsoft YaHei',system-ui,sans-serif;resize:vertical}.score-detail{display:flex;gap:16px;flex-wrap:wrap;margin:12px 0 6px}.score-item{padding:6px 14px;border-radius:99px;font-size:.85rem;font-weight:700}.score-item.green{background:#d1fae5;color:#047857}.score-item.yellow{background:#fef3c7;color:#b45309}.score-item.red{background:#fee2e2;color:#b91c1c}.feedback{display:none;margin-top:13px;padding:13px;border-radius:11px;font-weight:700}.feedback.show{display:block}.feedback.perfect{background:#ecfdf5;color:#047857}.feedback.good{background:#dbeafe;color:#1d40af}.feedback.fair{background:#fef3c7;color:#b45309}.feedback.retry{background:#fff7ed;color:#c2410c}.collapsible-header{cursor:pointer;display:flex;justify-content:space-between;align-items:center;padding:12px 0;-webkit-user-select:none;user-select:none}.collapsible-header:hover{opacity:.8}.collapsible-header .arrow{transition:transform .2s}.collapsible-header .arrow.open{transform:rotate(180deg)}.collapsible-body{overflow:hidden;transition:max-height .3s ease}.dialogue-line{display:flex;gap:10px;margin:10px 0;align-items:flex-start}.dialogue-speaker{min-width:70px;padding:4px 10px;border-radius:99px;font-weight:700;font-size:.8rem;text-align:center;color:#fff}.dialogue-speaker.A{background:#0f766e}.dialogue-speaker.B{background:#1d4ed8}.dialogue-speaker.C{background:#b45309}.dialogue-speaker.老师{background:#7c3aed}.dialogue-speaker.学生{background:#0891b2}.dialogue-speaker.爷爷{background:#b91c1c}.dialogue-speaker.服务员{background:#be185d}.dialogue-speaker.阿姨{background:#a21caf}.dialogue-speaker.店员{background:#4f46e5}.dialogue-speaker.售货员{background:#4f46e5}.dialogue-bubble{flex:1;padding:10px 14px;border-radius:14px;background:#f1f5f9;line-height:1.65}.dialogue-bubble .vi{color:#64748b;font-size:.85rem;margin-top:4px;display:none}.dialogue-bubble.show-vi .vi{display:block}.grammar-card{border:1px solid #e2e8f0;border-radius:14px;padding:16px;margin:10px 0;background:#f8fafc}.grammar-card h4{color:#0f766e;margin:0 0 6px}.grammar-card .explain{color:#334155;line-height:1.7;font-size:.9rem}.grammar-examples{margin-top:10px;list-style:none;padding:0}.grammar-examples li{padding:5px 0;color:#1e293b;border-bottom:1px solid #eef2f6}.grammar-examples li:last-child{border:0}.pron-section{background:linear-gradient(135deg,#ecfdf5,#f0fdf4);border-radius:14px;padding:16px;margin:10px 0}.pron-drill{display:flex;flex-wrap:wrap;gap:8px;margin-top:10px}.pron-drill span{padding:6px 14px;border-radius:99px;background:#fff;border:1px solid #bbf7d0;font-size:.9rem;cursor:pointer}.pron-drill span:hover{background:#bbf7d0}.order-words{display:flex;flex-wrap:wrap;gap:8px;min-height:44px;padding:10px;border:1px solid #cbd5e1;border-radius:12px;background:#fff;margin:8px 0}.order-word{padding:6px 14px;border-radius:8px;background:#dbeafe;color:#1d4ed8;cursor:pointer;font-size:.9rem;transition:.15s;border:1px solid #93c5fd}.order-word:hover{background:#bfdbfe;transform:translateY(-1px)}.order-word.selected{background:#bfdbfe;opacity:.5;text-decoration:line-through}.order-result{margin-top:6px;font-size:.85rem}.mc-options{display:flex;flex-direction:column;gap:8px;margin:8px 0}.mc-option{display:flex;align-items:center;gap:10px;padding:10px 14px;border:1px solid #e2e8f0;border-radius:10px;cursor:pointer;transition:.15s;background:#fff}.mc-option:hover{border-color:#93c5fd;background:#f8fafc}.mc-option input[type=radio]{accent-color:#0f766e}.mc-option.correct{border-color:#10b981;background:#ecfdf5}.mc-option.wrong{border-color:#ef4444;background:#fef2f2}.trans-item{margin:12px 0;padding:14px;border:1px solid #e2e8f0;border-radius:12px;background:#f8fafc}.trans-item .vi-sentence{font-weight:600;color:#1e293b}.trans-input{width:100%;padding:8px;border:1px solid #cbd5e1;border-radius:8px;margin-top:6px;font-family:inherit;box-sizing:border-box}.vocab-word{display:flex;align-items:center;gap:8px}.vocab-word .play-btn{width:28px;height:28px;border-radius:50%;border:0;background:#ecfdf5;color:#047857;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;transition:.15s}.vocab-word .play-btn:hover{background:#bbf7d0}.vocab-examples{margin-top:6px;padding-left:36px}.vocab-examples .ex-item{font-size:.82rem;color:#475569;padding:2px 0;display:flex;align-items:center;gap:6px}.vocab-examples .ex-play{background:none;border:0;color:#0f766e;cursor:pointer;font-size:12px;padding:0}.vocab-examples .ex-play:hover{color:#065f46}.passage-tabs{display:flex;gap:8px;overflow-x:auto;padding:16px 0}.passage-tab{padding:8px 18px;border-radius:99px;text-decoration:none;font-size:.85rem;font-weight:600;background:#f1f5f9;color:#334155;transition:.15s;white-space:nowrap}.passage-tab.active{background:#0f766e;color:#fff}.passage-tab:hover{background:#cbd5e1}.btn{border:0;cursor:pointer;padding:8px 18px;border-radius:99px;font-weight:600;transition:.15s;font-size:.85rem}.btn--primary{background:#0f766e;color:#fff}.btn--primary:hover{background:#065f46}.btn--outline{background:transparent;border:1px solid #cbd5e1;color:#334155}.btn--outline:hover{border-color:#0f766e;color:#0f766e}.back{display:inline-flex;align-items:center;gap:6px;color:#0f766e;text-decoration:none;font-weight:600;margin-bottom:12px;font-size:.9rem}.back:hover{color:#065f46}.quiz-answer{display:none;margin-top:8px;padding:8px 12px;background:#f0fdf4;border-radius:8px;font-size:.85rem;color:#065f46}.quiz-answer.show{display:block}.fill-blank{margin:12px 0;padding:12px;border:1px solid #e2e8f0;border-radius:12px;background:#fafafa}.fill-blank .sentence{font-size:.92rem;margin-bottom:8px;color:#1e293b}.blank{display:inline-block;min-width:60px;border-bottom:2px solid #0f766e;padding:0 4px;color:#0f766e;font-weight:700}.fill-input{padding:6px 12px;border:1px solid #cbd5e1;border-radius:8px;font-family:inherit;font-size:.85rem}.fill-input.correct{border-color:#10b981;background:#ecfdf5}.fill-input.wrong{border-color:#ef4444;background:#fef2f2}.fill-btn{padding:5px 12px;border:0;border-radius:99px;font-size:.8rem;font-weight:600;cursor:pointer}.fill-btn.check{background:#0f766e;color:#fff}.fill-btn.reset{background:#e2e8f0;color:#475569}.fill-result{font-size:.85rem;margin-top:6px;font-weight:600}.fill-result.ok{color:#047857}.fill-result.fail{color:#b91c1c}.section-divider{height:1px;background:linear-gradient(90deg,transparent,#e2e8f0,transparent);margin:24px 0}.dialogue-toggle{margin:-8px 0 12px}
</style></head><body>
<?php include 'sidebar.php'; ?>
<main class="dictation-page">
<?php if (isset($error)): ?>
<section class="error"><h1>Chưa thể mở bài học</h1><p><?= htmlspecialchars($error) ?></p><a class="btn btn--primary" href="courses.php">Quay lại khóa học</a></section>
<?php else:
$currentPassage = $passageIndex;
$ex = $exercise;
?>
<a class="back" href="learn_course.php?slug=<?= urlencode($course['slug']) ?>">← Quay lại lộ trình</a>
<header class="dictation-hero">
<span>HSK <?= (int) $course['hsk_level'] ?> · BÀI <?= (int) $lesson['lesson_num'] ?></span>
<h1><?= htmlspecialchars($levelInfo['title']) ?></h1>
<p><?= htmlspecialchars($ex['title']) ?> · Luyện nghe, chép chính tả, điền từ và trả lời câu hỏi</p>
</header>
<div class="passage-tabs">
<?php for ($pi = 0; $pi < $totalPassages; $pi++):
    $pk = $levelInfo['start'] + $pi;
    $p = $library[$pk];
?><a class="passage-tab <?= $pi === $currentPassage ? 'active' : '' ?>" href="?slug=<?= urlencode($course['slug']) ?>&lesson=<?= (int) $_GET['lesson'] ?>&passage=<?= $pi ?>">Bài <?= $pi + 1 ?>: <?= htmlspecialchars($p['title']) ?></a>
<?php endfor; ?>
</div>
<div class="dictation-grid"><div>

<!-- VOCABULARY -->
<section class="dict-card">
<div class="collapsible-header" onclick="toggleSection(this)">
<h2>📖 Từ vựng bài học</h2>
<span class="arrow">▼</span>
</div>
<div class="collapsible-body">
<p><?= count($ex['vocab']) ?> từ mới trong bài:</p>
<?php foreach ($ex['vocab'] as $v): ?>
<div class="vocab-word">
<button class="play-btn" onclick="speak('<?= htmlspecialchars($v['w'], ENT_QUOTES) ?>')" title="Nghe">▶</button>
<span style="font-size:1.05rem;font-weight:700"><?= htmlspecialchars($v['w']) ?></span>
<span style="color:#64748b;font-size:.85rem"><?= htmlspecialchars($v['p']) ?></span>
<span style="background:#f1f5f9;padding:2px 8px;border-radius:99px;font-size:.75rem;color:#475569"><?= htmlspecialchars($v['pos']) ?></span>
<span style="color:#0f766e;font-weight:600;font-size:.9rem"><?= htmlspecialchars($v['m']) ?></span>
</div>
<?php if (!empty($v['ex'])): ?>
<div class="vocab-examples">
<?php foreach ($v['ex'] as $exi): ?>
<div class="ex-item">
<button class="ex-play" onclick="speak('<?= htmlspecialchars(explode('。', $exi)[0] . '。', ENT_QUOTES) ?>')">▶ Nghe</button>
<span><?= htmlspecialchars($exi) ?></span>
</div>
<?php endforeach; ?>
</div>
<?php endif; ?>
<?php endforeach; ?>
</div>
</section>

<div class="section-divider"></div>

<!-- DICTATION -->
<section class="dict-card">
<div class="collapsible-header" onclick="toggleSection(this)">
<h2>🎧 Nghe và chép chính tả</h2>
<span class="arrow">▼</span>
</div>
<div class="collapsible-body">
<p>Nghe đoạn văn, sau đó gõ lại bằng tiếng Trung. Hệ thống AI sẽ phân tích và chấm điểm chính xác từng chữ.</p>
<div class="steps"><span class="step">1. Nghe</span><span class="step">2. Chép</span><span class="step" id="stepGrade">3. So sánh AI</span><span class="step">4. Điền từ</span></div>
<div class="listen-controls">
<button class="btn btn--primary" id="readAll">▶ Đọc toàn bộ</button>
<button class="btn btn--outline" id="stopRead">■ Dừng</button>
<button class="btn btn--outline" id="toggleText">Ẩn văn bản</button>
</div>
<div class="passage" id="passage"><p><?= htmlspecialchars($ex['text']) ?></p></div>
</div>
</section>

<section class="dict-card">
<div class="collapsible-header" onclick="toggleSection(this)">
<h2>✍️ Chép chính tả</h2>
<span class="arrow">▼</span>
</div>
<div class="collapsible-body">
<textarea id="dictation" class="writing-box" placeholder="Gõ lại đoạn văn tiếng Trung bạn đã nghe ở đây…"></textarea>
<div class="listen-controls">
<button class="btn btn--primary" id="checkWriting">🧠 Chấm AI</button>
<button class="btn btn--outline" id="clearWriting">Xóa</button>
</div>
<div class="feedback" id="feedback"></div>
<div id="diffResult" style="display:none;margin-top:14px;padding:16px;border:1px solid #e2e8f0;border-radius:14px;background:#fcfcfc">
<h3 style="margin:0 0 10px;font-size:.95rem;color:#172554">🔍 Phân tích chi tiết</h3>
<p style="font-size:.8rem;color:#64748b;margin:0 0 10px">Xanh = đúng, Đỏ = sai, Vàng = thừa. Di chuột để xem chi tiết.</p>
<div id="diffLines"></div>
</div>
</div>
</section>

<div class="section-divider"></div>

<!-- FILL BLANK -->
<section class="dict-card">
<div class="collapsible-header" onclick="toggleSection(this)">
<h2>✏️ Điền từ vào chỗ trống</h2>
<span class="arrow">▼</span>
</div>
<div class="collapsible-body">
<p>Điền từ thích hợp vào chỗ ____ dựa vào đoạn văn bạn đã nghe.</p>
<?php foreach ($ex['fill_blanks'] as $fi => $fb): ?>
<div class="fill-blank" id="fb<?= $fi ?>">
<div class="sentence"><?= preg_replace('/____/', '<span class="blank">____</span>', htmlspecialchars($fb['s']), 1) ?></div>
<div style="display:flex;align-items:center;flex-wrap:wrap;gap:8px">
<input type="text" class="fill-input" id="fi<?= $fi ?>" placeholder="Nhập đáp án..." autocomplete="off">
<button class="fill-btn check" onclick="checkFill(<?= $fi ?>)">Kiểm tra</button>
<button class="fill-btn reset" onclick="resetFill(<?= $fi ?>)">Làm lại</button>
</div>
<div class="fill-result" id="fr<?= $fi ?>"></div>
</div>
<?php endforeach; ?>
</div>
</section>

<div class="section-divider"></div>

<!-- DIALOGUE -->
<?php if (!empty($ex['dialogues'])): ?>
<section class="dict-card">
<div class="collapsible-header" onclick="toggleSection(this)">
<h2>💬 Hội thoại</h2>
<span class="arrow">▼</span>
</div>
<div class="collapsible-body">
<div class="dialogue-toggle">
<button class="btn btn--outline" onclick="toggleDialogueVi()" id="dialogueToggleBtn">Hiện bản dịch</button>
</div>
<?php foreach ($ex['dialogues'] as $dl): ?>
<div class="dialogue-line">
<div class="dialogue-speaker <?= htmlspecialchars($dl['who']) ?>"><?= htmlspecialchars($dl['who']) ?></div>
<div class="dialogue-bubble" id="db-<?= md5($dl['cn']) ?>">
<div class="cn"><?= htmlspecialchars($dl['cn']) ?></div>
<div class="vi"><?= htmlspecialchars($dl['vi']) ?></div>
</div>
</div>
<?php endforeach; ?>
</div>
</section>
<div class="section-divider"></div>
<?php endif; ?>

<!-- GRAMMAR -->
<?php if (!empty($ex['grammar'])): ?>
<section class="dict-card">
<div class="collapsible-header" onclick="toggleSection(this)">
<h2>📚 Ngữ pháp</h2>
<span class="arrow">▼</span>
</div>
<div class="collapsible-body">
<?php foreach ($ex['grammar'] as $gr): ?>
<div class="grammar-card">
<h4><?= htmlspecialchars($gr['point']) ?></h4>
<div class="explain"><?= htmlspecialchars($gr['explain']) ?></div>
<?php if (!empty($gr['examples'])): ?>
<ul class="grammar-examples">
<?php foreach ($gr['examples'] as $gri): ?>
<li><?= htmlspecialchars($gri) ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
</div>
<?php endforeach; ?>
</div>
</section>
<div class="section-divider"></div>
<?php endif; ?>

<!-- PRONUNCIATION -->
<?php if (!empty($ex['pronunciation'])): ?>
<section class="dict-card">
<div class="collapsible-header" onclick="toggleSection(this)">
<h2>🔊 Phát âm</h2>
<span class="arrow">▼</span>
</div>
<div class="collapsible-body">
<?php $pn = $ex['pronunciation']; ?>
<div class="pron-section">
<p><strong>Trọng tâm:</strong> <?= htmlspecialchars($pn['focus']) ?></p>
<?php if (!empty($pn['drill'])): ?>
<div class="pron-drill">
<?php foreach ($pn['drill'] as $d): ?>
<span onclick="speak('<?= htmlspecialchars($d, ENT_QUOTES) ?>')"><?= htmlspecialchars($d) ?> ▶</span>
<?php endforeach; ?>
</div>
<?php endif; ?>
</div>
</div>
</section>
<div class="section-divider"></div>
<?php endif; ?>

<!-- SENTENCE ORDER -->
<?php if (!empty($ex['exercises']['sentence_order'])): ?>
<section class="dict-card">
<div class="collapsible-header" onclick="toggleSection(this)">
<h2>🔤 Sắp xếp câu</h2>
<span class="arrow">▼</span>
</div>
<div class="collapsible-body">
<p>Nhấp vào các từ để tạo thành câu hoàn chỉnh. Nhấp lại vào từ đã chọn để bỏ chọn.</p>
<?php foreach ($ex['exercises']['sentence_order'] as $soi => $so): ?>
<div class="fill-blank">
<div style="font-size:.85rem;color:#64748b;margin-bottom:4px">Câu <?= $soi + 1 ?></div>
<div class="order-words" id="so-avail-<?= $soi ?>">
<?php shuffle($so['words']); foreach ($so['words'] as $w): ?>
<span class="order-word" onclick="toggleOrderWord(this, <?= $soi ?>)" data-word="<?= htmlspecialchars($w, ENT_QUOTES) ?>"><?= htmlspecialchars($w) ?></span>
<?php endforeach; ?>
</div>
<div class="order-words" id="so-ans-<?= $soi ?>" style="border-style:dashed;min-height:36px"></div>
<div style="display:flex;gap:8px;margin-top:4px">
<button class="fill-btn check" onclick="checkOrder(<?= $soi ?>)">Kiểm tra</button>
<button class="fill-btn reset" onclick="resetOrder(<?= $soi ?>)">Làm lại</button>
</div>
<div class="order-result" id="so-res-<?= $soi ?>"></div>
</div>
<?php endforeach; ?>
</div>
</section>
<div class="section-divider"></div>
<?php endif; ?>

<!-- MULTIPLE CHOICE -->
<?php if (!empty($ex['exercises']['multiple_choice'])): ?>
<section class="dict-card">
<div class="collapsible-header" onclick="toggleSection(this)">
<h2>❓ Trắc nghiệm</h2>
<span class="arrow">▼</span>
</div>
<div class="collapsible-body">
<?php foreach ($ex['exercises']['multiple_choice'] as $mci => $mc): ?>
<div class="fill-blank">
<div style="font-weight:600;margin-bottom:8px"><?= htmlspecialchars($mc['q']) ?></div>
<div class="mc-options" id="mc-opts-<?= $mci ?>">
<?php foreach ($mc['opts'] as $opi => $opt): ?>
<label class="mc-option" id="mc-opt-<?= $mci ?>-<?= $opi ?>">
<input type="radio" name="mc-<?= $mci ?>" value="<?= $opi ?>">
<span><?= htmlspecialchars($opt) ?></span>
</label>
<?php endforeach; ?>
</div>
<div style="display:flex;gap:8px;margin-top:4px">
<button class="fill-btn check" onclick="checkMC(<?= $mci ?>)">Kiểm tra</button>
<button class="fill-btn reset" onclick="resetMC(<?= $mci ?>)">Làm lại</button>
</div>
<div class="order-result" id="mc-res-<?= $mci ?>"></div>
</div>
<?php endforeach; ?>
</div>
</section>
<div class="section-divider"></div>
<?php endif; ?>

<!-- TRANSLATION -->
<?php if (!empty($ex['exercises']['translation'])): ?>
<section class="dict-card">
<div class="collapsible-header" onclick="toggleSection(this)">
<h2>🌐 Dịch Việt → Trung</h2>
<span class="arrow">▼</span>
</div>
<div class="collapsible-body">
<p>Nhập bản dịch tiếng Trung cho câu tiếng Việt bên dưới.</p>
<?php foreach ($ex['exercises']['translation'] as $ti => $tr): ?>
<div class="trans-item">
<div class="vi-sentence"><?= htmlspecialchars($tr['vi']) ?></div>
<input type="text" class="trans-input" id="trans-in-<?= $ti ?>" placeholder="Nhập bản dịch tiếng Trung..." autocomplete="off">
<div style="display:flex;gap:8px;margin-top:6px">
<button class="fill-btn check" onclick="checkTrans(<?= $ti ?>)">Kiểm tra</button>
<button class="fill-btn check" style="background:#dbeafe;color:#1d4ed8" onclick="showTransAnswer(<?= $ti ?>)">Hiện câu trả lời</button>
<button class="fill-btn reset" onclick="resetTrans(<?= $ti ?>)">Làm lại</button>
</div>
<div class="fill-result" id="trans-res-<?= $ti ?>"></div>
</div>
<?php endforeach; ?>
</div>
</section>
<div class="section-divider"></div>
<?php endif; ?>

<!-- COMPREHENSION QUESTIONS -->
<section class="dict-card">
<div class="collapsible-header" onclick="toggleSection(this)">
<h2>📝 Câu hỏi hiểu bài</h2>
<span class="arrow">▼</span>
</div>
<div class="collapsible-body">
<?php foreach ($ex['questions'] as $index => $question): ?>
<div class="quiz-question">
<b><?= $index + 1 ?>. <?= htmlspecialchars($question['q']) ?></b><br>
<div style="margin-top:10px;display:flex;gap:8px;align-items:start;flex-wrap:wrap">
<textarea class="fill-input" id="aq<?= $index ?>" placeholder="Viết câu trả lời của bạn..." rows="2" style="width:100%;max-width:400px;padding:8px;font-family:inherit;font-size:.9rem;resize:vertical" autocomplete="off"></textarea>
</div>
<div style="display:flex;gap:8px;margin-top:6px">
<button class="btn btn--outline" style="font-size:.8rem;padding:4px 12px" onclick="checkAnswer(<?= $index ?>)">So sánh</button>
<button class="btn btn--outline show-answer" data-answer="answer-<?= $index ?>" style="font-size:.8rem;padding:4px 12px">Xem gợi ý</button>
</div>
<div class="fill-result" id="aqr<?= $index ?>"></div>
<p class="quiz-answer" id="answer-<?= $index ?>"><?= htmlspecialchars($question['a']) ?></p>
</div>
<?php endforeach; ?>
</div>
</section>

</div><aside>
<section class="dict-card">
<h2>📌 Cách học hiệu quả</h2>
<div class="side-list">
<div class="side-item"><b>Bước 1:</b> Học từ vựng trước khi nghe.</div>
<div class="side-item"><b>Bước 2:</b> Nghe toàn bộ để nắm nội dung chính.</div>
<div class="side-item"><b>Bước 3:</b> Nghe lại và chép chính tả.</div>
<div class="side-item"><b>Bước 4:</b> Chấm AI, xem phân tích chi tiết.</div>
<div class="side-item"><b>Bước 5:</b> Làm bài tập đầy đủ (điền từ, hội thoại, ngữ pháp, phát âm, sắp xếp câu, trắc nghiệm, dịch).</div>
</div>
</section>
<section class="dict-card">
<h2>🎯 Thang điểm AI</h2>
<div class="side-list">
<div class="side-item" style="border-left-color:#10b981"><b>≥ 90%</b> — Xuất sắc! Bạn đã nghe rất tốt.</div>
<div class="side-item" style="border-left-color:#3b82f6"><b>≥ 75%</b> — Tốt! Còn một vài chỗ cần cải thiện.</div>
<div class="side-item" style="border-left-color:#f59e0b"><b>≥ 60%</b> — Tạm được. Hãy nghe lại đoạn khó.</div>
<div class="side-item" style="border-left-color:#ef4444"><b>&lt; 60%</b> — Cần nghe lại nhiều hơn.</div>
</div>
</section>
<section class="dict-card">
<h2>🔊 Giọng đọc</h2>
<p>Trình duyệt sẽ ưu tiên giọng tiếng Trung có sẵn. Để giọng tự nhiên hơn, hãy cài Chinese (Mandarin) voice trong cài đặt hệ điều hành.</p>
</section>
</aside></div>
<?php endif; ?>
</main>
<?php if (!isset($error)): ?>
<script>
const source=<?= json_encode($ex['text'], JSON_UNESCAPED_UNICODE) ?>;
const passage=document.getElementById('passage');let hidden=false;
function speakText(t){speechSynthesis.cancel();const u=new SpeechSynthesisUtterance(t);u.lang='zh-CN';u.rate=.75;const v=speechSynthesis.getVoices().find(v=>/^zh/i.test(v.lang));if(v)u.voice=v;speechSynthesis.speak(u)}
function speak(t){speakText(t)}
document.getElementById('readAll').onclick=()=>speakText(source);
document.getElementById('stopRead').onclick=()=>speechSynthesis.cancel();
document.getElementById('toggleText').onclick=e=>{hidden=!hidden;passage.classList.toggle('hidden',hidden);e.target.textContent=hidden?'Hiện văn bản':'Ẩn văn bản'};
document.getElementById('clearWriting').onclick=()=>document.getElementById('dictation').value='';

function toggleSection(header){const body=header.nextElementSibling;const arrow=header.querySelector('.arrow');if(body.style.maxHeight&&body.style.maxHeight!=='0px'){body.style.maxHeight='0px';arrow.classList.remove('open')}else{body.style.maxHeight=body.scrollHeight+'px';arrow.classList.add('open')}}

document.querySelectorAll('.collapsible-body').forEach(b=>{b.style.maxHeight='0px';b.style.overflow='hidden'});

function lcsLen(a,b){const m=a.length,n=b.length;const dp=Array.from({length:m+1},()=>new Uint16Array(n+1));for(let i=1;i<=m;i++)for(let j=1;j<=n;j++)dp[i][j]=a[i-1]===b[j-1]?dp[i-1][j-1]+1:Math.max(dp[i-1][j],dp[i][j-1]);return dp[m][n]}

function levenshtein(a,b){const m=a.length,n=b.length;const dp=Array.from({length:m+1},()=>new Uint8Array(n+1));for(let i=0;i<=m;i++)dp[i][0]=i;for(let j=0;j<=n;j++)dp[0][j]=j;for(let i=1;i<=m;i++)for(let j=1;j<=n;j++)dp[i][j]=a[i-1]===b[j-1]?dp[i-1][j-1]:1+Math.min(dp[i-1][j],dp[i][j-1],dp[i-1][j-1]);return dp[m][n]}

function alignChars(target,written){
    const t=[...target],w=[...written];
    const m=t.length,n=w.length;
    const dp=Array.from({length:m+1},()=>Array.from({length:n+1},()=>0));
    for(let i=1;i<=m;i++)for(let j=1;j<=n;j++)dp[i][j]=t[i-1]===w[j-1]?dp[i-1][j-1]+1:Math.max(dp[i-1][j],dp[i][j-1]);
    let i=m,j=n;const result=[];
    while(i>0||j>0){
        if(i>0&&j>0&&t[i-1]===w[j-1]){result.unshift({type:'match',char:t[i-1]});i--;j--;}
        else if(j>0&&(i===0||dp[i][j-1]>=dp[i-1][j])){result.unshift({type:'extra',char:w[j-1]});j--;}
        else{result.unshift({type:'miss',char:t[i-1]});i--;}
    }
    return result;
}

document.getElementById('checkWriting').onclick=()=>{
    const clean=s=>[...s].filter(c=>!'，。、“”！？；：,.!?;:\'"\n\r\t '.includes(c)).join('');
    const target=clean(source),raw=document.getElementById('dictation').value;
    const written=clean(raw);
    const fd=document.getElementById('feedback');const dr=document.getElementById('diffResult');const dl=document.getElementById('diffLines');

    if(!written.length){fd.className='feedback show retry';fd.textContent='Vui lòng nhập nội dung trước khi chấm.';dr.style.display='none';return;}
    const lcs=lcsLen(target,written);
    const maxLen=Math.max(target.length,written.length);
    const precision=lcs/written.length||0;
    const recall=lcs/target.length||0;
    const f1=precision+recall>0?2*precision*recall/(precision+recall):0;
    const levDist=levenshtein(target,written);
    const levSim=1-levDist/maxLen;
    const finalScore=Math.round((f1*0.6+levSim*0.4)*100);

    let grade,cls;
    if(finalScore>=90){grade='Xuất sắc! 🎉';cls='perfect';}
    else if(finalScore>=75){grade='Tốt! 👍';cls='good';}
    else if(finalScore>=60){grade='Tạm được';cls='fair';}
    else{grade='Cần cố gắng hơn';cls='retry';}

    fd.className='feedback show '+cls;
    fd.innerHTML=`<span style="font-size:1.2rem">${grade}</span><br><span>Điểm AI: <strong>${finalScore}%</strong> (Chính xác: ${Math.round(precision*100)}% · Đầy đủ: ${Math.round(recall*100)}% · Cân bằng: ${Math.round(f1*100)}%)</span>`;

    const alignment=alignChars(target,written);
    let html='<div class="diff-line">';
    alignment.forEach(a=>{
        if(a.type==='match')html+=`<span class="char-correct" title="Đúng">${a.char}</span>`;
        else if(a.type==='miss')html+=`<span class="char-wrong" title="Thiếu: ${a.char}">${a.char}</span>`;
        else html+=`<span class="char-extra" title="Thừa: ${a.char}">${a.char}</span>`;
    });
    html+='</div>';
    dl.innerHTML=html;
    dr.style.display='block';
    document.getElementById('stepGrade').classList.add('pass');
};

/* Fill blanks */
const fillAnswers=<?= json_encode(array_map(fn($fb)=>$fb['a'],$ex['fill_blanks']),JSON_UNESCAPED_UNICODE) ?>;
function checkFill(idx){
    const input=document.getElementById('fi'+idx);
    const result=document.getElementById('fr'+idx);
    const answer=fillAnswers[idx];
    const userAns=input.value.trim();
    if(!userAns){result.className='fill-result fail';result.textContent='Vui lòng nhập đáp án.';return;}
    const clean=s=>s.replace(/[\s，。、！？；：,.!?;:'"]/g,'');
    const isCorrect=clean(userAns)===clean(answer);
    input.className='fill-input '+(isCorrect?'correct':'wrong');
    result.className='fill-result '+(isCorrect?'ok':'fail');
    result.textContent=isCorrect?'✅ Chính xác!':'❌ Sai rồi. Đáp án đúng: "'+answer+'"';
}
function resetFill(idx){
    document.getElementById('fi'+idx).value='';
    document.getElementById('fi'+idx).className='fill-input';
    document.getElementById('fr'+idx).className='fill-result';
    document.getElementById('fr'+idx).textContent='';
}

/* Dialogue toggle */
let dialogueShowVi=false;
function toggleDialogueVi(){
    dialogueShowVi=!dialogueShowVi;
    document.querySelectorAll('.dialogue-bubble').forEach(b=>b.classList.toggle('show-vi',dialogueShowVi));
    document.getElementById('dialogueToggleBtn').textContent=dialogueShowVi?'Ẩn bản dịch':'Hiện bản dịch';
}

/* Sentence ordering */
const orderAnswers=<?= json_encode(array_map(fn($so)=>$so['a'],$ex['exercises']['sentence_order']),JSON_UNESCAPED_UNICODE) ?>;
function toggleOrderWord(el,idx){
    if(el.classList.contains('selected')){
        el.classList.remove('selected');
        document.getElementById('so-ans-'+idx).removeChild(el);
        document.getElementById('so-avail-'+idx).appendChild(el);
    } else {
        el.classList.add('selected');
        document.getElementById('so-ans-'+idx).appendChild(el);
    }
}
function getOrderedText(idx){
    return Array.from(document.getElementById('so-ans-'+idx).children).map(s=>s.dataset.word).join('')+
           Array.from(document.getElementById('so-avail-'+idx).children).filter(s=>!s.classList.contains('selected')).map(s=>s.dataset.word).join('');
}
function checkOrder(idx){
    const result=document.getElementById('so-res-'+idx);
    const user=getOrderedText(idx);
    const answer=orderAnswers[idx].replace(/[\s，。？!！]/g,'');
    const clean=s=>s.replace(/[\s，。、！？；：,.!?;:'"]/g,'');
    const isCorrect=clean(user)===clean(answer);
    result.className='order-result';
    result.style.color=isCorrect?'#047857':'#b91c1c';
    result.textContent=isCorrect?'✅ Chính xác!':'❌ Sai. Đáp án: '+orderAnswers[idx];
}
function resetOrder(idx){
    const avail=document.getElementById('so-avail-'+idx);
    const ans=document.getElementById('so-ans-'+idx);
    const words=[...ans.children,...avail.children];
    words.forEach(w=>{w.classList.remove('selected');avail.appendChild(w);});
    document.getElementById('so-res-'+idx).textContent='';
}

/* Multiple choice */
const mcAnswers=<?= json_encode(array_map(fn($mc)=>$mc['a'],$ex['exercises']['multiple_choice'])) ?>;
function checkMC(idx){
    const selected=document.querySelector('input[name="mc-'+idx+'"]:checked');
    const result=document.getElementById('mc-res-'+idx);
    if(!selected){result.className='order-result';result.style.color='#b91c1c';result.textContent='Vui lòng chọn một đáp án.';return;}
    const user=parseInt(selected.value);
    const correct=mcAnswers[idx];
    document.querySelectorAll('#mc-opts-'+idx+' .mc-option').forEach((el,i)=>{
        el.classList.remove('correct','wrong');
        if(i===correct)el.classList.add('correct');
        if(i===user&&user!==correct)el.classList.add('wrong');
    });
    result.className='order-result';
    result.style.color=user===correct?'#047857':'#b91c1c';
    result.textContent=user===correct?'✅ Chính xác!':'❌ Sai. Đáp án đúng: '+(document.querySelector('#mc-opts-'+idx+' .mc-option.correct span')||{}).textContent;
}
function resetMC(idx){
    document.querySelectorAll('input[name="mc-'+idx+'"]').forEach(r=>r.checked=false);
    document.querySelectorAll('#mc-opts-'+idx+' .mc-option').forEach(el=>el.classList.remove('correct','wrong'));
    document.getElementById('mc-res-'+idx).textContent='';
}

/* Translation */
const transAnswers=<?= json_encode(array_map(fn($tr)=>$tr['a'],$ex['exercises']['translation']),JSON_UNESCAPED_UNICODE) ?>;
function checkTrans(idx){
    const input=document.getElementById('trans-in-'+idx);
    const result=document.getElementById('trans-res-'+idx);
    const answer=transAnswers[idx];
    const user=input.value.trim();
    if(!user){result.className='fill-result fail';result.textContent='Vui lòng nhập bản dịch.';return;}
    const clean=s=>s.replace(/[\s，。、！？；：,.!?;:'" ]/g,'');
    const u=clean(user),a=clean(answer);
    const sim=u===a?1:1-levenshtein(u,a)/Math.max(u.length,a.length);
    result.className='fill-result '+(sim>=0.6?'ok':'fail');
    if(sim>=0.9)result.textContent='✅ Chính xác!';
    else if(sim>=0.7)result.textContent='⚠️ Gần đúng. Đáp án: '+answer;
    else result.textContent='❌ Sai. Đáp án: '+answer;
}
function showTransAnswer(idx){
    document.getElementById('trans-res-'+idx).className='fill-result ok';
    document.getElementById('trans-res-'+idx).textContent='Đáp án: '+transAnswers[idx];
}
function resetTrans(idx){
    document.getElementById('trans-in-'+idx).value='';
    document.getElementById('trans-res-'+idx).className='fill-result';
    document.getElementById('trans-res-'+idx).textContent='';
}

/* Comprehension questions */
function checkAnswer(idx){
    const input=document.getElementById('aq'+idx);
    const result=document.getElementById('aqr'+idx);
    const answer=<?= json_encode(array_map(fn($q)=>$q['a'],$ex['questions']),JSON_UNESCAPED_UNICODE) ?>[idx];
    const user=input.value.trim();
    if(!user){result.className='fill-result fail';result.textContent='Vui lòng viết câu trả lời của bạn.';return;}
    const clean=s=>s.replace(/[\s，。、！？；：,.!?;:'"]/g,'').toLowerCase();
    const u=clean(user),a=clean(answer);
    const sim=u===a?1:1-levenshtein(u,a)/Math.max(u.length,a.length);
    result.className='fill-result '+(sim>=0.6?'ok':'fail');
    if(sim>=0.8)result.textContent='✅ Gần đúng! Gợi ý: '+answer;
    else if(sim>=0.6)result.textContent='⚠️ Tương đối. Đáp án tham khảo: '+answer;
    else result.textContent='❌ Hãy xem gợi ý trả lời. Đáp án: '+answer;
}

document.querySelectorAll('.show-answer').forEach(btn=>btn.onclick=()=>document.getElementById(btn.dataset.answer).classList.toggle('show'));
if('speechSynthesis' in window)speechSynthesis.onvoiceschanged=()=>speechSynthesis.getVoices();
</script>
<?php endif; ?>
</body></html>
