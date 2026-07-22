<?php
/**
 * HÀNNGỮ - Complete HSK1 & HSK2 Content Seeder
 * Seeds 15 HSK1 lessons + 15 HSK2 lessons with full content
 * Run: php database/seed_hsk1_2.php
 */
require_once __DIR__ . '/../db.php';
$conn->exec("SET FOREIGN_KEY_CHECKS = 0");
$startTime = microtime(true);

function getOrCreateLevel($conn, $level, $name, $nameVi, $desc, $totalVocab, $totalLessons) {
    $stmt = $conn->prepare("SELECT id FROM hsk_levels WHERE `level` = ?");
    $stmt->execute([$level]);
    if ($id = $stmt->fetchColumn()) return $id;
    $ins = $conn->prepare("INSERT INTO hsk_levels (`level`, `name`, `name_vi`, `description`, `total_vocab`, `total_lessons`, `sort_order`, `is_active`) VALUES (?, ?, ?, ?, ?, ?, ?, 1)");
    $ins->execute([$level, $name, $nameVi, $desc, $totalVocab, $totalLessons, $level]);
    echo "  Created HSK level $level: $name\n";
    return $conn->lastInsertId();
}

function createLesson($conn, $hskLevel, $lessonNum, $title, $description, $objectivesJson, $topic, $difficulty, $summary) {
    $stmt = $conn->prepare("INSERT IGNORE INTO lessons (hsk_level, lesson_num, title, description, objectives, topic, duration_minutes, difficulty, `status`, sort_order, summary) VALUES (?, ?, ?, ?, ?, ?, 45, ?, 'published', ?, ?)");
    $stmt->execute([$hskLevel, $lessonNum, $title, $description, $objectivesJson, $topic, $difficulty, $lessonNum, $summary]);
    if ($stmt->rowCount() > 0) { $lid = $conn->lastInsertId(); echo "  Created lesson HSK$hskLevel-$lessonNum (id=$lid)\n"; return $lid; }
    $chk = $conn->prepare("SELECT id FROM lessons WHERE hsk_level = ? AND lesson_num = ?");
    $chk->execute([$hskLevel, $lessonNum]);
    $lid = $chk->fetchColumn();
    $conn->prepare("UPDATE lessons SET summary = ? WHERE id = ?")->execute([$summary, $lid]);
    return $lid;
}

function v($conn, $lid, $l, $h, $p, $m, $mv, $e, $ep, $ev, $wt, $rn, $so) {
    $stmt = $conn->prepare("INSERT IGNORE INTO vocabulary (lesson_id, hsk_level, hanzi, pinyin, meaning, meaning_vi, example, example_pinyin, example_vi, word_type, review_notes, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)");
    $stmt->execute([$lid, $l, $h, $p, $m, $mv, $e, $ep, $ev, $wt, $rn, $so]);
    return $stmt->rowCount() > 0 ? $conn->lastInsertId() : null;
}

function g($conn, $lid, $t, $f, $m, $mv, $u, $n, $so) {
    $stmt = $conn->prepare("INSERT INTO grammar (lesson_id, title, formula, meaning, meaning_vi, `usage`, notes, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)");
    $stmt->execute([$lid, $t, $f, $m, $mv, $u, $n, $so]);
    return $conn->lastInsertId();
}

function ge($conn, $gid, $cn, $py, $vi, $so) {
    $conn->prepare("INSERT INTO grammar_examples (grammar_id, example_cn, example_pinyin, example_vi, sort_order) VALUES (?, ?, ?, ?, ?)")->execute([$gid, $cn, $py, $vi, $so]);
}

function d($conn, $lid, $t, $cv, $so) {
    $stmt = $conn->prepare("INSERT INTO dialogues (lesson_id, title, context, context_vi, sort_order, is_active) VALUES (?, ?, ?, ?, ?, 1)");
    $stmt->execute([$lid, $t, $cv, $cv, $so]);
    return $conn->lastInsertId();
}

function ds($conn, $did, $s, $c, $p, $v, $so) {
    $conn->prepare("INSERT INTO dialogue_sentences (dialogue_id, speaker, chinese, pinyin, vietnamese, sort_order) VALUES (?, ?, ?, ?, ?, ?)")->execute([$did, $s, $c, $p, $v, $so]);
}

function r($conn, $lid, $t, $c, $p, $tr, $df, $wc, $so) {
    $stmt = $conn->prepare("INSERT INTO reading (lesson_id, title, content, pinyin, translation, difficulty, word_count, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)");
    $stmt->execute([$lid, $t, $c, $p, $tr, $df, $wc, $so]);
    return $conn->lastInsertId();
}

function l($conn, $lid, $t, $tr, $tp, $tv, $so) {
    $stmt = $conn->prepare("INSERT INTO listening_exercises (lesson_id, title, audio_url, transcript, transcript_pinyin, transcript_vi, sort_order, is_active) VALUES (?, ?, '', ?, ?, ?, ?, 1)");
    $stmt->execute([$lid, $t, $tr, $tp, $tv, $so]);
    return $conn->lastInsertId();
}

function lq($conn, $lid, $q, $oj, $ca, $e, $t, $so) {
    $conn->prepare("INSERT INTO listening_questions (listening_id, question, options, correct_answer, explanation, type, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)")->execute([$lid, $q, $oj, $ca, $e, $t, $so]);
}

function e($conn, $lid, $t, $i, $ty, $df, $p, $ca, $so) {
    $stmt = $conn->prepare("INSERT INTO exercises (lesson_id, title, instruction, type, difficulty, points, correct_answer, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)");
    $stmt->execute([$lid, $t, $i, $ty, $df, $p, $ca, $so]);
    return $conn->lastInsertId();
}

function eo($conn, $eid, $ot, $ol, $ic, $so) {
    $conn->prepare("INSERT INTO exercise_options (exercise_id, option_text, option_label, is_correct, sort_order) VALUES (?, ?, ?, ?, ?)")->execute([$eid, $ot, $ol, $ic, $so]);
}

function rv($conn, $lid, $vid, $rt, $so) {
    $conn->prepare("INSERT IGNORE INTO review_vocabulary (lesson_id, vocab_id, review_type, sort_order) VALUES (?, ?, ?, ?)")->execute([$lid, $vid, $rt, $so]);
}

// ── Clear old HSK1/2 data ──
echo "Clearing old HSK1/2 data...\n";
foreach (['exam_questions' => 'exams', 'listening_questions' => 'listening_exercises', 'listening_exercises' => 'lessons', 'reading' => 'lessons', 'dialogue_sentences' => 'dialogues', 'dialogues' => 'lessons', 'grammar_examples' => 'grammar', 'grammar' => 'lessons', 'exercise_options' => 'exercises', 'exercises' => 'lessons'] as $child => $parent) {
    if ($parent !== 'lessons') {
        $conn->exec("DELETE FROM $child WHERE id IN (SELECT id FROM $parent WHERE lesson_id IN (SELECT id FROM lessons WHERE hsk_level IN (1,2)))");
    }
}
$conn->exec("DELETE FROM review_vocabulary WHERE lesson_id IN (SELECT id FROM lessons WHERE hsk_level IN (1,2))");
$conn->exec("DELETE FROM vocabulary WHERE hsk_level IN (1,2)");
$conn->exec("DELETE FROM lessons WHERE hsk_level IN (1,2)");
echo "Cleared.\n\n";

$level1Id = getOrCreateLevel($conn, 1, 'HSK 1', 'Sơ cấp', '150 từ vựng cơ bản, 15 bài học.', 150, 15);
$level2Id = getOrCreateLevel($conn, 2, 'HSK 2', 'Sơ cấp - Trung cấp', '300 từ vựng, 15 bài học.', 300, 15);

echo "\n=== SEEDING HSK1 LESSONS ===\n\n";

// ═══ L1: 你好 - Xin chào ═══
$L1 = createLesson($conn,1,1,'Bài 1: 你好 - Xin chào','Chào hỏi cơ bản, giới thiệu bản thân.','["Chào hỏi","Giới thiệu","Hỏi thăm"]','Chào hỏi','easy','Bài 1 giới thiệu các câu chào hỏi cơ bản: 你好, 再见, 谢谢. Học cách giới thiệu tên, hỏi thăm sức khỏe, sử dụng đại từ nhân xưng. Ngữ pháp: câu với 是, câu hỏi với 吗.');
$L1v = 0;
v($conn,$L1,1,'你好','nǐ hǎo','xin chào','xin chào','你好！很高兴认识你。','Nǐ hǎo! Hěn gāoxìng rènshi nǐ.','Xin chào! Rất vui được quen bạn.','greeting','Từ ghép: 你 + 好. Câu chào phổ biến nhất.',++$L1v);
v($conn,$L1,1,'我','wǒ','tôi','tôi','我是学生。','Wǒ shì xuéshēng.','Tôi là học sinh.','pronoun','Đại từ nhân xưng ngôi thứ nhất.',++$L1v);
v($conn,$L1,1,'你','nǐ','bạn, anh/chị','bạn','你好吗？','Nǐ hǎo ma?','Bạn khỏe không?','pronoun','Đại từ nhân xưng ngôi thứ hai.',++$L1v);
v($conn,$L1,1,'好','hǎo','tốt, khỏe','tốt','今天天气很好。','Jīntiān tiānqì hěn hǎo.','Hôm nay thời tiết đẹp.','adj','Đa nghĩa: tốt, khỏe, rất.',++$L1v);
v($conn,$L1,1,'是','shì','là','là','我是中国人。','Wǒ shì Zhōngguó rén.','Tôi là người Trung Quốc.','verb','Động từ "là", không dùng với 很.',++$L1v);
v($conn,$L1,1,'不','bù','không','không','我不是老师。','Wǒ bú shì lǎoshī.','Tôi không phải giáo viên.','adv','Phó từ phủ định.',++$L1v);
v($conn,$L1,1,'很','hěn','rất','rất','我很好。','Wǒ hěn hǎo.','Tôi rất khỏe.','adv','Trạng từ chỉ mức độ.',++$L1v);
v($conn,$L1,1,'吗','ma','(từ hỏi) không','phải không','你好吗？','Nǐ hǎo ma?','Bạn khỏe không?','particle','Trợ từ nghi vấn cuối câu.',++$L1v);
v($conn,$L1,1,'谢谢','xièxie','cảm ơn','cảm ơn','谢谢老师！','Xièxie lǎoshī!','Cảm ơn thầy!','verb','Từ láy âm thường dùng.',++$L1v);
v($conn,$L1,1,'再见','zàijiàn','tạm biệt','tạm biệt','明天见！','Míngtiān jiàn!','Hẹn mai gặp!','verb','再(lại)+见(gặp)=gặp lại.',++$L1v);
v($conn,$L1,1,'请','qǐng','mời, làm ơn','mời','请进！','Qǐng jìn!','Mời vào!','verb','Dùng trong lời mời lịch sự.',++$L1v);
v($conn,$L1,1,'对不起','duìbuqǐ','xin lỗi','xin lỗi','对不起。','Duìbuqǐ.','Xin lỗi.','expression','Cụm xin lỗi.',++$L1v);
$g1_1 = g($conn,$L1,'Câu với 是','A + 是 + B','A là B','A là B','Giới thiệu, định nghĩa.','是 là động từ "là".',1);
ge($conn,$g1_1,'我是学生。','Wǒ shì xuéshēng.','Tôi là học sinh.',1);
ge($conn,$g1_1,'她是老师。','Tā shì lǎoshī.','Cô ấy là giáo viên.',2);
$g1_2 = g($conn,$L1,'Câu hỏi với 吗','Câu + 吗？','...phải không?','...phải không?','Tạo câu hỏi Có/Không.','吗 cuối câu.',2);
ge($conn,$g1_2,'你好吗？','Nǐ hǎo ma?','Bạn khỏe không?',1);
ge($conn,$g1_2,'你是学生吗？','Nǐ shì xuéshēng ma?','Bạn là học sinh phải không?',2);
$g1_3 = g($conn,$L1,'Đại từ nhân xưng + 很 + Adj','S + 很 + Adj','Chủ ngữ + rất + tính từ','Rất...','Miêu tả trạng thái. 很 thường nhẹ nghĩa.','他/她 cùng phát âm tā.',3);
ge($conn,$g1_3,'我很好。','Wǒ hěn hǎo.','Tôi rất khỏe.',1);
$d1_1 = d($conn,$L1,'Chào hỏi lần đầu','小明 và Anna gặp nhau tại trường.',1);
ds($conn,$d1_1,'小明','你好！我叫小明。','Nǐ hǎo! Wǒ jiào Xiǎo Míng.','Chào bạn! Tôi là Tiểu Minh.',1);
ds($conn,$d1_1,'Anna','你好！我叫Anna。很高兴认识你！','Nǐ hǎo! Wǒ jiào Anna. Hěn gāoxìng rènshi nǐ!','Chào bạn! Tôi là Anna. Rất vui được quen bạn!',2);
ds($conn,$d1_1,'小明','你是学生吗？','Nǐ shì xuéshēng ma?','Bạn là học sinh phải không?',3);
ds($conn,$d1_1,'Anna','是的，我是学生。','Shì de, wǒ shì xuéshēng.','Vâng, tôi là học sinh.',4);
$d1_2 = d($conn,$L1,'Hỏi thăm sức khỏe','Hai người bạn gặp lại nhau.',2);
ds($conn,$d1_2,'小明','你好吗？','Nǐ hǎo ma?','Bạn khỏe không?',1);
ds($conn,$d1_2,'Anna','我很好，谢谢！你呢？','Wǒ hěn hǎo, xièxie! Nǐ ne?','Tôi khỏe, cảm ơn! Còn bạn?',2);
ds($conn,$d1_2,'小明','我也很好。再见！','Wǒ yě hěn hǎo. Zàijiàn!','Tôi cũng khỏe. Tạm biệt!',3);
r($conn,$L1,'我的新朋友','你好！我叫小明。我是学生。她是Anna，她是我的新朋友。她是中国人。我们都很高兴。','Nǐ hǎo! Wǒ jiào Xiǎo Míng. Wǒ shì xuéshēng. Tā shì Anna, tā shì wǒ de xīn péngyou. Tā shì Zhōngguó rén. Wǒmen dōu hěn gāoxìng.','Xin chào! Tôi là Tiểu Minh. Tôi là học sinh. Cô ấy là Anna, bạn mới của tôi. Cô ấy là người Trung Quốc. Chúng tôi đều vui.','easy',42,1);
$L1l = l($conn,$L1,'Chào hỏi','A:你好！我叫小明。B:你好！我叫Anna。A:你是学生吗？B:是的，我是学生。','A:Nǐ hǎo! Wǒ jiào Xiǎo Míng. B:Nǐ hǎo! Wǒ jiào Anna. A:Nǐ shì xuéshēng ma? B:Shì de,wǒ shì xuéshēng.','A:Xin chào! Tôi là Tiểu Minh. B:Xin chào! Tôi là Anna. A:Bạn là học sinh phải không? B:Vâng, tôi là học sinh.',1);
lq($conn,$L1l,'小明叫什么名字？','{"A":"Xiao Ming","B":"Anna","C":"Lão Sư"}','Xiao Ming','Tên là Xiao Ming.','multiple_choice',1);
lq($conn,$L1l,'Anna 是学生吗？','{"A":"是的","B":"不是","C":"不知道"}','是的','Anna trả lời "是的".','multiple_choice',2);
$E1_1 = e($conn,$L1,'Chọn đáp án đúng','Chọn từ thích hợp: "Xin chào" là ___.','multiple_choice','easy',1,'A',1);
eo($conn,$E1_1,'你好','A',1,1); eo($conn,$E1_1,'谢谢','B',0,2); eo($conn,$E1_1,'再见','C',0,3);
$E1_2 = e($conn,$L1,'Dịch câu','"Tôi là học sinh."','translation','easy',1,'我是学生。',2);
$E1_3 = e($conn,$L1,'Sắp xếp câu','学生 / 是 / 我','sentence_order','easy',1,'我是学生。',3);
$E1_4 = e($conn,$L1,'Điền từ','你__吗？(Bạn khỏe không?)','fill_blank','easy',1,'好',4);
$E1_5 = e($conn,$L1,'Chọn đúng/sai','"谢谢" có nghĩa là "xin lỗi".','true_false','easy',1,'false',5);
eo($conn,$E1_5,'Đúng','A',0,1); eo($conn,$E1_5,'Sai','B',1,2);
echo "  HSK1 L1 done: $L1v vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 5 exercises\n";

// ═══ L2: 谢谢你 - Cảm ơn ═══
$L2 = createLesson($conn,1,2,'Bài 2: 谢谢你 - Cảm ơn bạn','Cảm ơn, xin lỗi và đáp lại. Sở hữu với 的, động từ 有.','["Cảm ơn","Xin lỗi","Sở hữu"]','Xã giao','easy','Bài 2: 谢谢 (cảm ơn), 不客气 (không có gì), 对不起 (xin lỗi), 没关系 (không sao). Trợ từ 的 chỉ sở hữu, động từ 有 (có), phó từ 也 (cũng).');
$L2v = 0;
v($conn,$L2,1,'不客气','bú kèqì','không có gì','không có gì','不客气！','Bú kèqì!','Không có gì!','expression','Đáp lại lời cảm ơn.',++$L2v);
v($conn,$L2,1,'没关系','méi guānxi','không sao','không sao','没关系。','Méi guānxi.','Không sao.','expression','Đáp lại lời xin lỗi.',++$L2v);
v($conn,$L2,1,'的','de','của (sở hữu)','của','我的书。','Wǒ de shū.','Sách của tôi.','particle','Trợ từ sở hữu.',++$L2v);
v($conn,$L2,1,'也','yě','cũng','cũng','我也是学生。','Wǒ yě shì xuéshēng.','Tôi cũng là học sinh.','adv','Phó từ "cũng".',++$L2v);
v($conn,$L2,1,'人','rén','người','người','一个人。','Yí gè rén.','Một người.','noun','Danh từ cơ bản.',++$L2v);
v($conn,$L2,1,'中国','Zhōngguó','Trung Quốc','Trung Quốc','我是中国人。','Wǒ shì Zhōngguó rén.','Tôi là người Trung Quốc.','noun','中(trung)+国(nước).',++$L2v);
v($conn,$L2,1,'朋友','péngyou','bạn bè','bạn bè','他是我的朋友。','Tā shì wǒ de péngyou.','Anh ấy là bạn tôi.','noun','Chỉ bạn bè.',++$L2v);
v($conn,$L2,1,'有','yǒu','có','có','我有一本书。','Wǒ yǒu yì běn shū.','Tôi có một quyển sách.','verb','Động từ "có". Phủ định: 没有.',++$L2v);
v($conn,$L2,1,'没有','méiyǒu','không có','không có','我没有钱。','Wǒ méiyǒu qián.','Tôi không có tiền.','verb','Phủ định của 有.',++$L2v);
v($conn,$L2,1,'什么','shénme','cái gì','gì','这是什么？','Zhè shì shénme?','Đây là cái gì?','question','Từ hỏi "cái gì".',++$L2v);
v($conn,$L2,1,'老师','lǎoshī','giáo viên','giáo viên','王老师好！','Wáng lǎoshī hǎo!','Chào thầy Vương!','noun','Từ xưng hô cho giáo viên.',++$L2v);
v($conn,$L2,1,'学生','xuéshēng','học sinh','học sinh','她是好学生。','Tā shì hǎo xuéshēng.','Cô ấy là học sinh giỏi.','noun','学(học)+生(sinh viên).',++$L2v);
$g2_1 = g($conn,$L2,'Sở hữu với 的','ĐT/N + 的 + N','của...','của...','Quan hệ sở hữu.','Bỏ 的 với người thân.',1);
ge($conn,$g2_1,'我的书。','Wǒ de shū.','Sách của tôi.',1);
ge($conn,$g2_1,'他的朋友。','Tā de péngyou.','Bạn của anh ấy.',2);
$g2_2 = g($conn,$L2,'Động từ 有','S + 有 + O','Có...','Có...','Sở hữu hoặc tồn tại.','Phủ định: 没有.',2);
ge($conn,$g2_2,'我有一本书。','Wǒ yǒu yì běn shū.','Tôi có một quyển sách.',1);
ge($conn,$g2_2,'他没有朋友。','Tā méiyǒu péngyou.','Anh ấy không có bạn.',2);
$g2_3 = g($conn,$L2,'Phó từ 也','S + 也 + V','Cũng...','Cũng...','也 đứng trước động từ.','Không dùng cuối câu.',3);
ge($conn,$g2_3,'我也是学生。','Wǒ yě shì xuéshēng.','Tôi cũng là học sinh.',1);
$d2_1 = d($conn,$L2,'Cảm ơn thầy','Học sinh cảm ơn thầy giáo.',1);
ds($conn,$d2_1,'学生','谢谢老师！','Xièxie lǎoshī!','Cảm ơn thầy!',1);
ds($conn,$d2_1,'老师','不客气。','Bú kèqì.','Không có gì.',2);
ds($conn,$d2_1,'学生','老师，这是什么？','Lǎoshī, zhè shì shénme?','Thầy ơi, đây là gì?',3);
ds($conn,$d2_1,'老师','这是我的书。','Zhè shì wǒ de shū.','Đây là sách của tôi.',4);
$d2_2 = d($conn,$L2,'Xin lỗi và tha thứ','小明 vô tình va vào người khác.',2);
ds($conn,$d2_2,'小明','对不起！','Duìbuqǐ!','Xin lỗi!',1);
ds($conn,$d2_2,'Anna','没关系。你也是学生吗？','Méi guānxi. Nǐ yě shì xuéshēng ma?','Không sao. Bạn cũng là học sinh à?',2);
ds($conn,$d2_2,'小明','是的。','Shì de.','Vâng.',3);
r($conn,$L2,'我的中国朋友','我有一个朋友。他是中国人。他叫王明。他是老师。他有书。我没有他的书。我们是好朋友。','Wǒ yǒu yí gè péngyou. Tā shì Zhōngguó rén. Tā jiào Wáng Míng. Tā shì lǎoshī. Tā yǒu shū. Wǒ méiyǒu tā de shū. Wǒmen shì hǎo péngyou.','Tôi có một người bạn. Anh ấy là người TQ. Anh ấy tên Vương Minh. Là giáo viên. Có sách. Tôi không có sách anh ấy. Chúng tôi là bạn tốt.','easy',48,1);
$L2l = l($conn,$L2,'Xã giao','A:谢谢你的书！B:不客气！A:你有书吗？B:有，我有一本。','A:Xièxie nǐ de shū! B:Bú kèqì! A:Nǐ yǒu shū ma? B:Yǒu,wǒ yǒu yì běn.','A:Cảm ơn sách của bạn! B:Không có gì! A:Bạn có sách không? B:Có, tôi có một quyển.',2);
lq($conn,$L2l,'Người A cảm ơn vì điều gì?','{"A":"Cuốn sách","B":"Món quà","C":"Lời chúc"}','Cuốn sách','Cảm ơn vì cuốn sách.','multiple_choice',1);
lq($conn,$L2l,'Người B trả lời thế nào?','{"A":"谢谢","B":"不客气","C":"对不起"}','不客气','Trả lời "bú kèqì".','multiple_choice',2);
$E2_1 = e($conn,$L2,'Chọn đáp án','"của" trong tiếng Trung là:','multiple_choice','easy',1,'C',1);
eo($conn,$E2_1,'很','A',0,1); eo($conn,$E2_1,'也','B',0,2); eo($conn,$E2_1,'的','C',1,3);
$E2_2 = e($conn,$L2,'Điền từ','这是我___书。','fill_blank','easy',1,'的',2);
$E2_3 = e($conn,$L2,'Dịch câu','"Tôi có một người bạn."','translation','easy',1,'我有一个朋友。',3);
echo "  HSK1 L2 done: $L2v vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 3 exercises\n";

// ═══ L3: 你叫什么名字 ═══
$L3 = createLesson($conn,1,3,'Bài 3: 你叫什么名字 - Bạn tên là gì','Hỏi tên, quốc tịch, nghề nghiệp. Từ hỏi: 什么/哪儿/谁/哪.','["Hỏi tên","Quốc tịch","Nghề nghiệp"]','Tên, Quốc tịch','easy','Bài 3: Hỏi tên (你叫什么名字), quốc tịch (你是哪国人), nghề nghiệp. Từ hỏi: 什么(gì), 哪儿(đâu), 谁(ai), 哪(nào).');
$L3v = 0;
v($conn,$L3,1,'叫','jiào','gọi, tên là','gọi','你叫什么名字？','Nǐ jiào shénme míngzì?','Bạn tên là gì?','verb','Dùng hỏi và nói tên.',++$L3v);
v($conn,$L3,1,'名字','míngzì','tên (họ tên)','tên','我的名字是李明。','Wǒ de míngzì shì Lǐ Míng.','Tên tôi là Lý Minh.','noun','Họ + tên đầy đủ.',++$L3v);
v($conn,$L3,1,'他','tā','anh ấy','anh ấy','他是老师。','Tā shì lǎoshī.','Anh ấy là giáo viên.','pronoun','Đại từ nam.',++$L3v);
v($conn,$L3,1,'她','tā','cô ấy','cô ấy','她是医生。','Tā shì yīshēng.','Cô ấy là bác sĩ.','pronoun','Đại từ nữ (phát âm giống 他).',++$L3v);
v($conn,$L3,1,'谁','shéi','ai','ai','他是谁？','Tā shì shéi?','Anh ấy là ai?','question','Từ hỏi về người.',++$L3v);
v($conn,$L3,1,'哪儿','nǎr','đâu','đâu','你去哪儿？','Nǐ qù nǎr?','Bạn đi đâu?','question','Từ hỏi về địa điểm.',++$L3v);
v($conn,$L3,1,'哪','nǎ','nào','nào','你是哪国人？','Nǐ shì nǎ guó rén?','Bạn là người nước nào?','question','Hỏi lựa chọn.',++$L3v);
v($conn,$L3,1,'汉语','Hànyǔ','tiếng Trung','tiếng Trung','我学汉语。','Wǒ xué Hànyǔ.','Tôi học tiếng Trung.','noun','汉+语.',++$L3v);
v($conn,$L3,1,'说','shuō','nói','nói','他说中文。','Tā shuō Zhōngwén.','Anh ấy nói tiếng Trung.','verb','Động từ "nói".',++$L3v);
v($conn,$L3,1,'法国','Fǎguó','Pháp','Pháp','他是法国人。','Tā shì Fǎguó rén.','Anh ấy là người Pháp.','noun','Tên nước Pháp.',++$L3v);
v($conn,$L3,1,'美国','Měiguó','Mỹ','Mỹ','她去美国。','Tā qù Měiguó.','Cô ấy đi Mỹ.','noun','Tên nước Mỹ.',++$L3v);
v($conn,$L3,1,'医生','yīshēng','bác sĩ','bác sĩ','我爸爸是医生。','Wǒ bàba shì yīshēng.','Bố tôi là bác sĩ.','noun','医(y)+生(người).',++$L3v);
$g3_1 = g($conn,$L3,'Câu hỏi với từ để hỏi','Từ hỏi + ĐT + ...?','Hỏi người/vật/địa điểm','谁(ai)/什么(gì)/哪儿(đâu)/哪(nào).','Từ hỏi ở vị trí thông tin cần hỏi.',1);
ge($conn,$g3_1,'他是谁？','Tā shì shéi?','Anh ấy là ai?',1);
ge($conn,$g3_1,'这是什么？','Zhè shì shénme?','Đây là cái gì?',2);
ge($conn,$g3_1,'你去哪儿？','Nǐ qù nǎr?','Bạn đi đâu?',3);
$g3_2 = g($conn,$L3,'Cấu trúc 是...的','是 + TP + V + 的','Chính là...','Nhấn mạnh thời gian, địa điểm.','Không phải sở hữu.',2);
ge($conn,$g3_2,'我是昨天来的。','Wǒ shì zuótiān lái de.','Tôi đến hôm qua.',1);
ge($conn,$g3_2,'他是从北京来的。','Tā shì cóng Běijīng lái de.','Anh ấy đến từ Bắc Kinh.',2);
$d3_1 = d($conn,$L3,'Hỏi tên và quốc tịch','Gặp nhau tại lớp học.',1);
ds($conn,$d3_1,'小明','你们好！我叫小明。你叫什么名字？','Nǐmen hǎo! Wǒ jiào Xiǎo Míng. Nǐ jiào shénme míngzì?','Chào các bạn! Tôi là Tiểu Minh. Bạn tên gì?',1);
ds($conn,$d3_1,'Anna','我叫Anna。','Wǒ jiào Anna.','Tôi tên Anna.',2);
ds($conn,$d3_1,'小明','你是哪国人？','Nǐ shì nǎ guó rén?','Bạn là người nước nào?',3);
ds($conn,$d3_1,'Anna','我是法国人。','Wǒ shì Fǎguó rén.','Tôi là người Pháp.',4);
$d3_2 = d($conn,$L3,'Hỏi nghề nghiệp','Hỏi về công việc.',2);
ds($conn,$d3_2,'王明','你是做什么的？','Nǐ shì zuò shénme de?','Bạn làm nghề gì?',1);
ds($conn,$d3_2,'Anna','我是医生。','Wǒ shì yīshēng.','Tôi là bác sĩ.',2);
ds($conn,$d3_2,'王明','我是老师。','Wǒ shì lǎoshī.','Tôi là giáo viên.',3);
r($conn,$L3,'我的同学们','她是Anna。她是法国人。她是医生。他是小明。他是中国人。他是学生。我们是好朋友。','Tā shì Anna. Tā shì Fǎguó rén. Tā shì yīshēng. Tā shì Xiǎo Míng. Tā shì Zhōngguó rén. Tā shì xuéshēng. Wǒmen shì hǎo péngyou.','Cô ấy là Anna, người Pháp, bác sĩ. Anh ấy là Tiểu Minh, người TQ, học sinh. Chúng tôi là bạn tốt.','easy',45,1);
$L3l = l($conn,$L3,'Hỏi về người','A:他是谁？B:他是王老师。A:他是哪国人？B:他是中国人。A:他是医生吗？B:不是，他是老师。','A:Tā shì shéi? B:Tā shì Wáng lǎoshī. A:Tā shì nǎ guó rén? B:Tā shì Zhōngguó rén. A:Tā shì yīshēng ma? B:Bú shì,tā shì lǎoshī.','A:Anh ấy là ai? B:Thầy Vương. A:Người nước nào? B:Trung Quốc. A:Bác sĩ? B:Không, giáo viên.',3);
lq($conn,$L3l,'王老师是哪国人？','{"A":"中国人","B":"法国人","C":"美国人"}','中国人','Người Trung Quốc.','multiple_choice',1);
lq($conn,$L3l,'王老师是做什么的？','{"A":"医生","B":"老师","C":"学生"}','老师','Giáo viên.','multiple_choice',2);
$E3_1 = e($conn,$L3,'Chọn đáp án','"______" = "ai" trong tiếng Trung.','multiple_choice','easy',1,'C',1);
eo($conn,$E3_1,'什么','A',0,1); eo($conn,$E3_1,'哪儿','B',0,2); eo($conn,$E3_1,'谁','C',1,3);
$E3_2 = e($conn,$L3,'Dịch câu','"Tôi là giáo viên."','translation','easy',1,'我是老师。',2);
$E3_3 = e($conn,$L3,'Sắp xếp câu','人 / 国 / 你 / 哪 / 是','sentence_order','medium',1,'你是哪国人？',3);
$E3_4 = e($conn,$L3,'Điền từ','你叫___名字？','fill_blank','easy',1,'什么',4);
echo "  HSK1 L3 done: $L3v vocab, 2 grammar, 2 dialogues, 1 reading, 1 listening, 4 exercises\n";

// ═══ L4: 她是我的汉语老师 ═══
$L4 = createLesson($conn,1,4,'Bài 4: 她是我的汉语老师','Gia đình, nghề nghiệp. Sở hữu, từ chỉ số lượng.','["Gia đình","Nghề nghiệp","Số lượng"]','Gia đình','easy','Bài 4: Từ vựng gia đình (爸爸,妈妈,哥哥...). Số lượng từ, hỏi với 几. Động từ 有 chỉ tồn tại.');
$L4v = 0;
v($conn,$L4,1,'家','jiā','nhà, gia đình','nhà','我家有三口人。','Wǒ jiā yǒu sān kǒu rén.','Nhà tôi có ba người.','noun','Chỉ gia đình hoặc nhà.',++$L4v);
v($conn,$L4,1,'爸爸','bàba','bố','bố','我爸爸是医生。','Wǒ bàba shì yīshēng.','Bố tôi là bác sĩ.','noun','Chỉ bố.',++$L4v);
v($conn,$L4,1,'妈妈','māma','mẹ','mẹ','妈妈做饭。','Māma zuòfàn.','Mẹ nấu cơm.','noun','Chỉ mẹ.',++$L4v);
v($conn,$L4,1,'哥哥','gēge','anh trai','anh trai','我哥哥很高。','Wǒ gēge hěn gāo.','Anh trai tôi cao.','noun','Anh trai ruột.',++$L4v);
v($conn,$L4,1,'姐姐','jiějie','chị gái','chị gái','姐姐很漂亮。','Jiějie hěn piàoliang.','Chị gái rất xinh.','noun','Chị gái ruột.',++$L4v);
v($conn,$L4,1,'弟弟','dìdi','em trai','em trai','弟弟五岁。','Dìdi wǔ suì.','Em trai 5 tuổi.','noun','Em trai ruột.',++$L4v);
v($conn,$L4,1,'妹妹','mèimei','em gái','em gái','妹妹很可爱。','Mèimei hěn kě\'ài.','Em gái đáng yêu.','noun','Em gái ruột.',++$L4v);
v($conn,$L4,1,'儿子','érzi','con trai','con trai','他有一个儿子。','Tā yǒu yí gè érzi.','Anh ấy có con trai.','noun','Con trai.',++$L4v);
v($conn,$L4,1,'女儿','nǚ\'ér','con gái','con gái','她有一个女儿。','Tā yǒu yí gè nǚ\'ér.','Cô ấy có con gái.','noun','Con gái.',++$L4v);
v($conn,$L4,1,'岁','suì','tuổi','tuổi','你几岁？','Nǐ jǐ suì?','Bạn mấy tuổi?','measure','Đơn vị tuổi.',++$L4v);
v($conn,$L4,1,'几','jǐ','mấy (số ít)','mấy','几个人？','Jǐ gè rén?','Mấy người?','question','Hỏi số <10.',++$L4v);
v($conn,$L4,1,'个','gè','cái (lượng từ)','cái','一个苹果。','Yí gè píngguǒ.','Một quả táo.','measure','Lượng từ phổ biến nhất.',++$L4v);
$g4_1 = g($conn,$L4,'Số + Lượng từ + Danh từ','Số + LT + DT','Số + lượng từ + danh từ','Cấu trúc chỉ số lượng.','个 phổ biến nhất.',1);
ge($conn,$g4_1,'一个朋友。','Yí gè péngyou.','Một người bạn.',1);
ge($conn,$g4_1,'三本书。','Sān běn shū.','Ba quyển sách.',2);
$g4_2 = g($conn,$L4,'Hỏi với 几','几 + LT + DT?','Mấy...?','Hỏi số lượng nhỏ.','Dùng 多少 cho số lớn.',2);
ge($conn,$g4_2,'你几岁？','Nǐ jǐ suì?','Bạn mấy tuổi?',1);
$d4_1 = d($conn,$L4,'Giới thiệu gia đình','小明 và Anna nói về gia đình.',1);
ds($conn,$d4_1,'小明','我家有三口人：爸爸、妈妈和我。','Wǒ jiā yǒu sān kǒu rén: bàba,māma hé wǒ.','Nhà tôi có ba người: bố, mẹ và tôi.',1);
ds($conn,$d4_1,'Anna','你爸爸是做什么的？','Nǐ bàba shì zuò shénme de?','Bố bạn làm nghề gì?',2);
ds($conn,$d4_1,'小明','他是医生。','Tā shì yīshēng.','Ông ấy là bác sĩ.',3);
ds($conn,$d4_1,'Anna','我妈妈是老师。','Wǒ māma shì lǎoshī.','Mẹ tôi là giáo viên.',4);
$d4_2 = d($conn,$L4,'Anh chị em','Hỏi về anh chị em.',2);
ds($conn,$d4_2,'王明','你有哥哥吗？','Nǐ yǒu gēge ma?','Bạn có anh trai không?',1);
ds($conn,$d4_2,'Anna','有，我有一个哥哥。','Yǒu, wǒ yǒu yí gè gēge.','Có, tôi có một anh trai.',2);
ds($conn,$d4_2,'王明','他几岁？','Tā jǐ suì?','Anh ấy mấy tuổi?',3);
ds($conn,$d4_2,'Anna','他二十岁。','Tā èrshí suì.','Anh ấy 20 tuổi.',4);
r($conn,$L4,'我的家庭','我家有四口人：爸爸、妈妈、妹妹和我。爸爸是医生，妈妈是老师。妹妹五岁，很可爱。我是学生，二十岁。我爱我的家。','Wǒ jiā yǒu sì kǒu rén: bàba,māma,mèimei hé wǒ. Bàba shì yīshēng,māma shì lǎoshī. Mèimei wǔ suì,hěn kě\'ài. Wǒ shì xuéshēng,èrshí suì. Wǒ ài wǒ de jiā.','Nhà tôi 4 người: bố (bs), mẹ (gv), em gái (5t), tôi (hs, 20t). Tôi yêu gia đình.','easy',52,1);
$L4l = l($conn,$L4,'Gia đình','A:你家有几口人？B:有四口人。A:你有姐姐吗？B:有，我姐姐是医生。','A:Nǐ jiā yǒu jǐ kǒu rén? B:Yǒu sì kǒu rén. A:Nǐ yǒu jiějie ma? B:Yǒu,wǒ jiějie shì yīshēng.','A:Nhà bạn mấy người? B:Bốn. A:Có chị gái? B:Có, chị tôi là bác sĩ.',4);
lq($conn,$L4l,'Nhà người B mấy người?','{"A":"3","B":"4","C":"5"}','4','Bốn người.','multiple_choice',1);
lq($conn,$L4l,'Chị gái làm nghề gì?','{"A":"Giáo viên","B":"Bác sĩ","C":"Học sinh"}','Bác sĩ','Chị gái là bác sĩ.','multiple_choice',2);
$E4_1 = e($conn,$L4,'Chọn đáp án','"Mẹ" tiếng Trung là:','multiple_choice','easy',1,'B',1);
eo($conn,$E4_1,'爸爸','A',0,1); eo($conn,$E4_1,'妈妈','B',1,2); eo($conn,$E4_1,'姐姐','C',0,3);
$E4_2 = e($conn,$L4,'Dịch','"Em gái tôi 5 tuổi."','translation','easy',1,'我妹妹五岁。',2);
$E4_3 = e($conn,$L4,'Đúng/Sai','"我有哥哥" = Tôi có em trai.','true_false','easy',1,'false',3);
eo($conn,$E4_3,'Đúng','A',0,1); eo($conn,$E4_3,'Sai','B',1,2);
echo "  HSK1 L4 done: $L4v vocab, 2 grammar, 2 dialogues, 1 reading, 1 listening, 3 exercises\n";

// ═══ L5: 她女儿今年二十岁 ═══
$L5 = createLesson($conn,1,5,'Bài 5: 她女儿今年二十岁','Số đếm 1-100, tuổi tác, năm tháng.','["Số đếm","Tuổi","Năm tháng"]','Số đếm','easy','Bài 5: Số đếm 1-100. Phân biệt 二/两. Hỏi tuổi với 多大. Hỏi số lượng với 多少.');
$L5v = 0;
foreach([['一','yī','một'],['二','èr','hai'],['三','sān','ba'],['四','sì','bốn'],['五','wǔ','năm'],['六','liù','sáu'],['七','qī','bảy'],['八','bā','tám'],['九','jiǔ','chín'],['十','shí','mười']] as $i=>$n) {
    v($conn,$L5,1,$n[0],$n[1],$n[2],$n[2],$n[0].'个。',$n[1].' gè。','Một cái。','number','Số đếm.',$i+1); ++$L5v;
}
v($conn,$L5,1,'零','líng','0','không','一百零一。','Yì bǎi líng yī.','101.','number','Số 0.',++$L5v);
v($conn,$L5,1,'百','bǎi','trăm','trăm','一百。','Yì bǎi.','100.','number','Đơn vị trăm.',++$L5v);
v($conn,$L5,1,'两','liǎng','hai (với lượng từ)','hai','两个人。','Liǎng gè rén.','Hai người.','number','Thay 二 trước lượng từ.',++$L5v);
v($conn,$L5,1,'多少','duōshao','bao nhiêu','bao nhiêu','多少钱？','Duōshao qián?','Bao nhiêu tiền?','question','Hỏi số lượng.',++$L5v);
$g5_1 = g($conn,$L5,'Số đếm 1-100','11=十一,20=二十,21=二十一','Cách đọc số.','Số từ 1-100.','Phân biệt 二/两.',1);
ge($conn,$g5_1,'二十五。','Èrshíwǔ.','25.',1);
ge($conn,$g5_1,'九十九。','Jiǔshíjiǔ.','99.',2);
$g5_2 = g($conn,$L5,'Hỏi tuổi với 多','S + 多 + 大 / S + 多少 + N','Bao nhiêu?','Hỏi số lượng lớn.','Không phân biệt ít/nhiều.',2);
ge($conn,$g5_2,'你多大？','Nǐ duō dà?','Bạn bao nhiêu tuổi?',1);
ge($conn,$g5_2,'多少钱？','Duōshao qián?','Bao nhiêu tiền?',2);
$d5_1 = d($conn,$L5,'Hỏi tuổi','Hỏi về tuổi tác.',1);
ds($conn,$d5_1,'Anna','你多大？','Nǐ duō dà?','Bạn bao nhiêu tuổi?',1);
ds($conn,$d5_1,'小明','我二十岁。你呢？','Wǒ èrshí suì. Nǐ ne?','Tôi 20. Còn bạn?',2);
ds($conn,$d5_1,'Anna','我十八岁。','Wǒ shíbā suì.','Tôi 18.',3);
r($conn,$L5,'Số đếm','我今年二十岁。妹妹十岁。爸爸四十五岁。妈妈四十三岁。爷爷七十八岁。','Wǒ jīnnián èrshí suì. Mèimei shí suì. Bàba sìshíwǔ suì. Māma sìshísān suì. Yéye qīshíbā suì.','Tôi 20t. Em gái 10t. Bố 45. Mẹ 43. Ông 78.','easy',48,1);
$L5l = l($conn,$L5,'Số tuổi','A:你今年多大？B:我二十五岁。A:你妈妈呢？B:她五十岁。','A:Nǐ jīnnián duō dà? B:Wǒ èrshíwǔ suì. A:Nǐ māma ne? B:Tā wǔshí suì.','A:Bạn năm nay bn tuổi? B:Tôi 25. A:Mẹ bạn? B:Bà 50.','5');
lq($conn,$L5l,'Người B bao nhiêu tuổi?','{"A":"20","B":"25","C":"30"}','25','25 tuổi.','multiple_choice',1);
$E5_1 = e($conn,$L5,'Viết số','"二十五" = ?','fill_blank','easy',1,'25',1);
$E5_2 = e($conn,$L5,'Chọn đáp án','"Chín" tiếng Trung:','multiple_choice','easy',1,'B',2);
eo($conn,$E5_2,'八','A',0,1); eo($conn,$E5_2,'九','B',1,2); eo($conn,$E5_2,'十','C',0,3);
echo "  HSK1 L5 done: $L5v vocab, 2 grammar, 1 dialogue, 1 reading, 1 listening, 2 exercises\n";

// ═══ L6: 我会说汉语 ═══
$L6 = createLesson($conn,1,6,'Bài 6: 我会说汉语','Động từ năng nguyện: 会/能/可以. Kỹ năng ngôn ngữ.','["Khả năng","Ngôn ngữ","Kỹ năng"]','Khả năng','easy','Bài 6: 会(biết), 能(có thể), 可以(được phép). Diễn đạt khả năng. Phân biệt 会/能/可以.');
$L6v = 0;
v($conn,$L6,1,'会','huì','biết, sẽ','biết','我会说中文。','Wǒ huì shuō Zhōngwén.','Tôi biết nói tiếng TQ.','verb','Khả năng học được.',++$L6v);
v($conn,$L6,1,'能','néng','có thể','có thể','我能帮你。','Wǒ néng bāng nǐ.','Tôi có thể giúp bạn.','verb','Khả năng do điều kiện.',++$L6v);
v($conn,$L6,1,'可以','kěyǐ','có thể, được','có thể','可以进来吗？','Kěyǐ jìnlái ma?','Có thể vào không?','verb','Sự cho phép.',++$L6v);
v($conn,$L6,1,'要','yào','muốn, cần','muốn','我要喝水。','Wǒ yào hē shuǐ.','Tôi muốn uống nước.','verb','Ý muốn hoặc nhu cầu.',++$L6v);
v($conn,$L6,1,'想','xiǎng','muốn, nghĩ','muốn','我想去北京。','Wǒ xiǎng qù Běijīng.','Tôi muốn đi Bắc Kinh.','verb','Mong muốn, dự định.',++$L6v);
v($conn,$L6,1,'写','xiě','viết','viết','写字。','Xiě zì.','Viết chữ.','verb','Động từ viết.',++$L6v);
v($conn,$L6,1,'读','dú','đọc','đọc','读书。','Dú shū.','Đọc sách.','verb','Động từ đọc.',++$L6v);
v($conn,$L6,1,'听','tīng','nghe','nghe','听音乐。','Tīng yīnyuè.','Nghe nhạc.','verb','Động từ nghe.',++$L6v);
v($conn,$L6,1,'学习','xuéxí','học tập','học','努力学习。','Nǔlì xuéxí.','Học tập chăm chỉ.','verb','学+习.',++$L6v);
v($conn,$L6,1,'一点','yì diǎn','một chút','một chút','我会说一点汉语。','Wǒ huì shuō yì diǎn Hànyǔ.','Tôi biết một chút tiếng TQ.','adv','Số lượng ít.',++$L6v);
$g6_1 = g($conn,$L6,'Động từ năng nguyện','S + 会/能/可以 + V','Biết/có thể/được phép','会: học được. 能: điều kiện. 可以: cho phép.','Phủ định: 不会/不能/不可以.',1);
ge($conn,$g6_1,'我会说汉语。','Wǒ huì shuō Hànyǔ.','Tôi biết nói tiếng TQ.',1);
ge($conn,$g6_1,'我可以进来吗？','Kěyǐ jìnlái ma?','Tôi có thể vào không?',2);
$g6_2 = g($conn,$L6,'一点儿','一点儿 + Adj / V + 一点儿','một chút...','Mức độ thấp.','Đặt sau động từ hoặc trước tính từ.',2);
ge($conn,$g6_2,'大一点儿。','Dà yì diǎnr.','Lớn hơn một chút.',1);
$d6_1 = d($conn,$L6,'Hỏi khả năng ngôn ngữ','小明 hỏi Anna về khả năng tiếng Trung.',1);
ds($conn,$d6_1,'小明','你会说汉语吗？','Nǐ huì shuō Hànyǔ ma?','Bạn biết nói tiếng TQ không?',1);
ds($conn,$d6_1,'Anna','会一点儿。','Huì yì diǎnr.','Biết một chút.',2);
ds($conn,$d6_1,'小明','你写汉字吗？','Nǐ xiě Hànzì ma?','Bạn viết chữ Hán không?',3);
ds($conn,$d6_1,'Anna','我不会写汉字。','Wǒ bú huì xiě Hànzì.','Tôi không biết viết chữ Hán.',4);
ds($conn,$d6_1,'小明','我可以教你。','Wǒ kěyǐ jiāo nǐ.','Tôi có thể dạy bạn.',5);
r($conn,$L6,'学汉语','我会说一点儿汉语。朋友是中国人，他会英文。他教我汉语，我教他英文。学习汉语很有意思。','Wǒ huì shuō yì diǎnr Hànyǔ. Péngyou shì Zhōngguó rén,tā huì Yīngwén. Tā jiāo wǒ Hànyǔ,wǒ jiāo tā Yīngwén. Xuéxí Hànyǔ hěn yǒu yìsi.','Tôi biết một chút tiếng TQ. Bạn tôi là người TQ. Anh ấy dạy tôi TQ, tôi dạy anh ấy TA. Học TQ thú vị.','easy',56,1);
$L6l = l($conn,$L6,'Khả năng','A:你会什么？B:我会说汉语和英文。A:你会写汉字吗？B:不会，但是我想学。','A:Nǐ huì shénme? B:Wǒ huì shuō Hànyǔ hé Yīngwén. A:Nǐ huì xiě Hànzì ma? B:Bú huì,dànshì wǒ xiǎng xué.','A:Bạn biết gì? B:TQ và TA. A:Viết chữ Hán? B:Không, nhưng muốn học.','6');
lq($conn,$L6l,'Người B biết ngôn ngữ nào?','{"A":"Chỉ TQ","B":"TQ và TA","C":"Chỉ TA"}','TQ và TA','Cả hai.','multiple_choice',1);
$E6_1 = e($conn,$L6,'Chọn đáp án','"会" có nghĩa:','multiple_choice','easy',1,'B',1);
eo($conn,$E6_1,'Sẽ','A',0,1); eo($conn,$E6_1,'Biết','B',1,2); eo($conn,$E6_1,'Phải','C',0,3);
$E6_2 = e($conn,$L6,'Dịch','"Tôi muốn uống nước."','translation','easy',1,'我要喝水。',2);
$E6_3 = e($conn,$L6,'Điền từ','我___说汉语。','fill_blank','easy',1,'会',3);
echo "  HSK1 L6 done: $L6v vocab, 2 grammar, 1 dialogue, 1 reading, 1 listening, 3 exercises\n";

// ═══ L7: 今天几号 ═══
$L7 = createLesson($conn,1,7,'Bài 7: 今天几号 - Hôm nay ngày mấy','Ngày tháng, thứ trong tuần. Cách đọc ngày tháng năm.','["Ngày tháng","Thứ","Lịch"]','Thời gian','easy','Bài 7: Cách nói ngày tháng. Thứ (星期一~日), ngày (号), tháng (月), năm (年). Hỏi: 今天几号？');
$L7v = 0;
v($conn,$L7,1,'今天','jīntiān','hôm nay','hôm nay','今天星期一。','Jīntiān xīngqī yī.','Hôm nay thứ Hai.','noun','今+nay+天.',++$L7v);
v($conn,$L7,1,'明天','míngtiān','ngày mai','ngày mai','明天见！','Míngtiān jiàn!','Hẹn mai gặp!','noun','明+sáng+天.',++$L7v);
v($conn,$L7,1,'昨天','zuótiān','hôm qua','hôm qua','昨天星期天。','Zuótiān xīngqī tiān.','Hôm qua CN.','noun','昨+hôm qua+天.',++$L7v);
v($conn,$L7,1,'年','nián','năm','năm','今年是2024年。','Jīnnián shì èr líng èr sì nián.','Năm nay 2024.','noun','Đơn vị năm.',++$L7v);
v($conn,$L7,1,'月','yuè','tháng','tháng','一月。','Yī yuè.','Tháng 1.','noun','Đơn vị tháng.',++$L7v);
v($conn,$L7,1,'号','hào','ngày (thông tục)','ngày','今天几号？','Jīntiān jǐ hào?','Hôm nay ngày mấy?','noun','Thông tục hơn 日.',++$L7v);
v($conn,$L7,1,'日','rì','ngày, mặt trời','ngày','一月一日。','Yī yuè yī rì.','1/1.','noun','Trang trọng.',++$L7v);
v($conn,$L7,1,'星期','xīngqī','tuần, thứ','tuần','一星期七天。','Yì xīngqī qī tiān.','1 tuần 7 ngày.','noun','Chỉ tuần lễ.',++$L7v);
v($conn,$L7,1,'星期天','xīngqī tiān','Chủ nhật','CN','星期天休息。','Xīngqī tiān xiūxi.','CN nghỉ.',++$L7v);
v($conn,$L7,1,'现在','xiànzài','bây giờ','bây giờ','现在几点？','Xiànzài jǐ diǎn?','Bây giờ mấy giờ?','noun','Hiện tại.',++$L7v);
$g7_1 = g($conn,$L7,'Cách nói ngày tháng','Năm + 月 + 号 + 星期','Trật tự: năm-tháng-ngày-thứ','Từ lớn đến nhỏ.','Có thể bỏ 年/月/号.',1);
ge($conn,$g7_1,'2024年1月1日。','Èr líng èr sì nián yī yuè yī rì.','1/1/2024.',1);
$g7_2 = g($conn,$L7,'Hỏi ngày với 几号','几号？/星期几？','Ngày mấy?/Thứ mấy?','几号 hỏi ngày, 星期几 hỏi thứ.',2);
ge($conn,$g7_2,'今天几号？','Jīntiān jǐ hào?','Hôm nay ngày mấy?',1);
ge($conn,$g7_2,'今天星期几？','Jīntiān xīngqī jǐ?','Hôm nay thứ mấy?',2);
$d7_1 = d($conn,$L7,'Hỏi ngày tháng','Nói chuyện về lịch.',1);
ds($conn,$d7_1,'小明','今天几号？','Jīntiān jǐ hào?','Hôm nay ngày mấy?',1);
ds($conn,$d7_1,'Anna','五月八号。星期三。','Wǔ yuè bā hào. Xīngqī sān.','8/5. Thứ Tư.',2);
ds($conn,$d7_1,'小明','明天呢？','Míngtiān ne?','Ngày mai?',3);
ds($conn,$d7_1,'Anna','五月九号，星期四。','Wǔ yuè jiǔ hào,xīngqī sì.','9/5, thứ Năm.',4);
r($conn,$L7,'日历','今天星期三，五月八号。明天五月九号，星期四。昨天五月七号，星期二。今年2024年。我的生日是六月十五号。','Jīntiān xīngqī sān,wǔ yuè bā hào. Míngtiān wǔ yuè jiǔ hào,xīngqī sì. Zuótiān wǔ yuè qī hào,xīngqī èr. Jīnnián èr líng èr sì nián. Wǒ de shēngrì shì liù yuè shíwǔ hào.','Hôm nay T4, 8/5. Mai T5, 9/5. Hôm qua T3, 7/5. Năm 2024. SN tôi 15/6.','easy',60,1);
$L7l = l($conn,$L7,'Ngày tháng','A:今天几月几号？B:十月一号。A:星期几？B:星期二。','A:Jīntiān jǐ yuè jǐ hào? B:Shí yuè yī hào. A:Xīngqī jǐ? B:Xīngqī èr.','A:Hôm nay ngày mấy? B:1/10. A:Thứ mấy? B:Thứ Ba.','7');
lq($conn,$L7l,'Hôm nay ngày mấy?','{"A":"1/9","B":"1/10","C":"2/10"}','1/10','1/10.','multiple_choice',1);
$E7_1 = e($conn,$L7,'Chọn đáp án','"Hôm qua" tiếng Trung:','multiple_choice','easy',1,'C',1);
eo($conn,$E7_1,'今天','A',0,1); eo($conn,$E7_1,'明天','B',0,2); eo($conn,$E7_1,'昨天','C',1,3);
$E7_2 = e($conn,$L7,'Viết','"Thứ Hai" tiếng Trung:','fill_blank','easy',1,'星期一',2);
echo "  HSK1 L7 done: $L7v vocab, 2 grammar, 1 dialogue, 1 reading, 1 listening, 2 exercises\n";

echo "\n=== HSK1 Lessons 1-7 done. Continuing L8... ===\n\n";

// ═══ L8: 我想喝茶 ═══
$L8 = createLesson($conn,1,8,'Bài 8: 我想喝茶 - Tôi muốn uống trà','Đồ uống, thực phẩm. Diễn tả mong muốn: 想/要. Phân loại từ.','["Đồ uống","Thực phẩm","Mong muốn"]','Ăn uống','easy','Bài 8: Từ vựng đồ uống (茶, 咖啡, 水), thực phẩm (米饭, 面包). Phân loại từ: 杯, 碗, 瓶. 想 vs 要.');
$L8v = 0;
v($conn,$L8,1,'茶','chá','trà','trà','我想喝茶。','Wǒ xiǎng hē chá.','Tôi muốn uống trà.','noun','Đồ uống phổ biến.',++$L8v);
v($conn,$L8,1,'咖啡','kāfēi','cà phê','cà phê','一杯咖啡。','Yì bēi kāfēi.','Một ly cà phê.','noun','Từ vay mượn.',++$L8v);
v($conn,$L8,1,'水','shuǐ','nước','nước','喝水。','Hē shuǐ.','Uống nước.','noun','Chất lỏng nói chung.',++$L8v);
v($conn,$L8,1,'饭','fàn','cơm, đồ ăn','cơm','吃饭了吗？','Chī fàn le ma?','Ăn cơm chưa?','noun','Chỉ bữa ăn.',++$L8v);
v($conn,$L8,1,'面包','miànbāo','bánh mì','bánh mì','我吃面包。','Wǒ chī miànbāo.','Tôi ăn bánh mì.','noun','面+bột+包+gói.',++$L8v);
v($conn,$L8,1,'苹果','píngguǒ','táo','táo','吃苹果。','Chī píngguǒ.','Ăn táo.','noun','Quả táo.',++$L8v);
v($conn,$L8,1,'杯','bēi','ly, cốc (LT)','ly','一杯茶。','Yì bēi chá.','Một ly trà.','measure','Lượng từ cho đồ uống.',++$L8v);
v($conn,$L8,1,'碗','wǎn','bát (LT)','bát','一碗饭。','Yì wǎn fàn.','Một bát cơm.','measure','Lượng từ bát.',++$L8v);
v($conn,$L8,1,'瓶','píng','chai, lọ (LT)','chai','一瓶水。','Yì píng shuǐ.','Một chai nước.','measure','Lượng từ chai.',++$L8v);
v($conn,$L8,1,'吃','chī','ăn','ăn','吃饭。','Chī fàn.','Ăn cơm.','verb','Động từ ăn.',++$L8v);
v($conn,$L8,1,'喝','hē','uống','uống','喝水。','Hē shuǐ.','Uống nước.','verb','Động từ uống.',++$L8v);
$g8_1 = g($conn,$L8,'Phân biệt 想 và 要','S + 想/要 + V','Muốn/Cần','想: mong muốn, 要: quyết tâm/nhu cầu.','要 mạnh hơn 想.',1);
ge($conn,$g8_1,'我想喝茶。','Wǒ xiǎng hē chá.','Tôi muốn uống trà.',1);
ge($conn,$g8_1,'我要喝水。','Wǒ yào hē shuǐ.','Tôi cần uống nước.',2);
$g8_2 = g($conn,$L8,'Lượng từ chuyên dụng','Số + LT + N','Đếm danh từ','杯/碗/瓶 cho từng loại.',2);
ge($conn,$g8_2,'一杯咖啡。','Yì bēi kāfēi.','Một ly cà phê.',1);
ge($conn,$g8_2,'一碗米饭。','Yì wǎn mǐfàn.','Một bát cơm.',2);
$d8_1 = d($conn,$L8,'Gọi đồ uống','Tại quán nước.',1);
ds($conn,$d8_1,'小明','你想喝什么？','Nǐ xiǎng hē shénme?','Bạn muốn uống gì?',1);
ds($conn,$d8_1,'Anna','我想喝茶。','Wǒ xiǎng hē chá.','Tôi muốn uống trà.',2);
ds($conn,$d8_1,'小明','我要咖啡。','Wǒ yào kāfēi.','Tôi muốn cà phê.',3);
r($conn,$L8,'Đồ uống và đồ ăn','我想喝茶，朋友要咖啡。我吃面包，他吃米饭。我们都很高兴。','Wǒ xiǎng hē chá,péngyou yào kāfēi. Wǒ chī miànbāo,tā chī mǐfàn. Wǒmen dōu hěn gāoxìng.','Tôi muốn trà, bạn tôi cà phê. Tôi bánh mì, anh ấy cơm.','easy',50,1);
$L8l = l($conn,$L8,'Đồ uống','A:你想喝什么？B:我想喝水。A:你要茶吗？B:不，我要咖啡。','A:Nǐ xiǎng hē shénme? B:Wǒ xiǎng hē shuǐ. A:Nǐ yào chá ma? B:Bù,wǒ yào kāfēi.','A:Muốn uống gì? B:Nước. A:Trà? B:Không, cà phê.','8');
lq($conn,$L8l,'Người B muốn uống gì?','{"A":"Trà","B":"Nước","C":"Cà phê"}','Nước','Muốn uống nước.','multiple_choice',1);
$E8_1 = e($conn,$L8,'Chọn đáp án','"Bánh mì" tiếng Trung:','multiple_choice','easy',1,'C',1);
eo($conn,$E8_1,'米饭','A',0,1); eo($conn,$E8_1,'苹果','B',0,2); eo($conn,$E8_1,'面包','C',1,3);
$E8_2 = e($conn,$L8,'Dịch','"Một ly trà."','translation','easy',1,'一杯茶。',2);
$E8_3 = e($conn,$L8,'Điền từ','我___吃面包。(muốn)','fill_blank','easy',1,'想',3);
echo "  HSK1 L8 done: $L8v vocab, 2 grammar, 1 dialogue, 1 reading, 1 listening, 3 exercises\n";

// ═══ L9: 你住在哪儿 ═══
$L9 = createLesson($conn,1,9,'Bài 9: 你住在哪儿 - Bạn sống ở đâu','Địa điểm, phương hướng. Giới từ 在/从. Động từ 住/去/来.','["Địa điểm","Phương hướng","Nơi ở"]','Nhà cửa','easy','Bài 9: Từ vựng địa điểm (学校,商店,医院). Hỏi địa chỉ: 在哪儿/哪里. Giới từ 在 (ở), 从 (từ). Động từ 住/去/来.');
$L9v = 0;
v($conn,$L9,1,'住','zhù','sống, ở','sống','我住在学校。','Wǒ zhù zài xuéxiào.','Tôi sống ở trường.','verb','Động từ chỉ nơi ở.',++$L9v);
v($conn,$L9,1,'在','zài','ở, tại','ở','我在家。','Wǒ zài jiā.','Tôi ở nhà.','verb/prep','Chỉ vị trí.',++$L9v);
v($conn,$L9,1,'学校','xuéxiào','trường học','trường','去学校。','Qù xuéxiào.','Đi đến trường.','noun','学+校.',++$L9v);
v($conn,$L9,1,'家','jiā','nhà','nhà','回家。','Huí jiā.','Về nhà.','noun','Nơi ở, gia đình.',++$L9v);
v($conn,$L9,1,'商店','shāngdiàn','cửa hàng','cửa hàng','去商店买东西。','Qù shāngdiàn mǎi dōngxi.','Đi cửa hàng mua đồ.','noun','商+店.',++$L9v);
v($conn,$L9,1,'医院','yīyuàn','bệnh viện','bệnh viện','去医院。','Qù yīyuàn.','Đi bệnh viện.','noun','医+bệnh+viện.',++$L9v);
v($conn,$L9,1,'图书馆','túshūguǎn','thư viện','thư viện','在图书馆看书。','Zài túshūguǎn kàn shū.','Ở thư viện đọc sách.','noun','图+bản đồ+书+sách+馆+quán.',++$L9v);
v($conn,$L9,1,'去','qù','đi (đến)','đi','去北京。','Qù Běijīng.','Đi Bắc Kinh.','verb','Động từ chỉ hướng.',++$L9v);
v($conn,$L9,1,'来','lái','đến','đến','来我家。','Lái wǒ jiā.','Đến nhà tôi.','verb','Động từ chỉ hướng.',++$L9v);
v($conn,$L9,1,'地方','dìfang','địa điểm, nơi','nơi','这是什么地方？','Zhè shì shénme dìfang?','Đây là nơi nào?','noun','Địa điểm.',++$L9v);
$g9_1 = g($conn,$L9,'Giới từ 在/从','S + 在 + N + V / S + 从 + N + V','Ở/Từ nơi nào làm gì','在 trước nơi chốn, 从 chỉ xuất phát.',1);
ge($conn,$g9_1,'我在学校学习。','Wǒ zài xuéxiào xuéxí.','Tôi học ở trường.',1);
ge($conn,$g9_1,'他从北京来。','Tā cóng Běijīng lái.','Anh ấy đến từ Bắc Kinh.',2);
$g9_2 = g($conn,$L9,'Hỏi nơi chốn','S + 在 + 哪儿/哪里？','Hỏi vị trí。','哪儿 thông tục, 哪里 trang trọng.',2);
ge($conn,$g9_2,'你住在哪儿？','Nǐ zhù zài nǎr?','Bạn sống ở đâu?',1);
$d9_1 = d($conn,$L9,'Hỏi nơi ở','Hai bạn nói về nơi ở.',1);
ds($conn,$d9_1,'小明','你住在哪儿？','Nǐ zhù zài nǎr?','Bạn sống ở đâu?',1);
ds($conn,$d9_1,'Anna','我住在学校附近。','Wǒ zhù zài xuéxiào fùjìn.','Tôi sống gần trường.',2);
ds($conn,$d9_1,'小明','我在图书馆学习。','Wǒ zài túshūguǎn xuéxí.','Tôi học ở thư viện.',3);
r($conn,$L9,'Địa điểm','我住在学校附近。学校门口有商店。图书馆在学校里面。我每天去图书馆学习。','Wǒ zhù zài xuéxiào fùjìn. Xuéxiào ménkǒu yǒu shāngdiàn. Túshūguǎn zài xuéxiào lǐmiàn. Wǒ měitiān qù túshūguǎn xuéxí.','Tôi sống gần trường. Cạnh trường có cửa hàng. Thư viện ở trong trường.','easy',55,1);
$L9l = l($conn,$L9,'Địa chỉ','A:你去哪儿？B:我去图书馆。A:图书馆在哪儿？B:在学校里面。','A:Nǐ qù nǎr? B:Wǒ qù túshūguǎn. A:Túshūguǎn zài nǎr? B:Zài xuéxiào lǐmiàn.','A:Bạn đi đâu? B:Thư viện. A:Thư viện ở đâu? B:Trong trường.','9');
lq($conn,$L9l,'Người B đi đâu?','{"A":"Trường","B":"Thư viện","C":"Nhà"}','Thư viện','Đi thư viện.','multiple_choice',1);
$E9_1 = e($conn,$L9,'Chọn đáp án','"Bệnh viện" tiếng Trung:','multiple_choice','easy',1,'B',1);
eo($conn,$E9_1,'学校','A',0,1); eo($conn,$E9_1,'医院','B',1,2); eo($conn,$E9_1,'商店','C',0,3);
$E9_2 = e($conn,$L9,'Dịch','"Tôi đi thư viện."','translation','easy',1,'我去图书馆。',2);
echo "  HSK1 L9 done: $L9v vocab, 2 grammar, 1 dialogue, 1 reading, 1 listening, 2 exercises\n";

// ═══ L10: 你的生日是几月几号 ═══
$L10 = createLesson($conn,1,10,'Bài 10: 你的生日是几月几号 - SN bạn ngày nào','Sinh nhật, ngày tháng năm sinh. Hỏi và trả lời về ngày sinh.','["Sinh nhật","Ngày sinh","Tổ chức"]','Sinh nhật','easy','Bài 10: Từ vựng sinh nhật (生日,礼物,蛋糕). Hỏi ngày sinh, tặng quà, tổ chức sinh nhật. Động từ + 了 (thì quá khứ).');
$L10v = 0;
v($conn,$L10,1,'生日','shēngrì','sinh nhật','sinh nhật','生日快乐！','Shēngrì kuàilè!','Chúc mừng sinh nhật!','noun','生(sinh)+日(ngày).',++$L10v);
v($conn,$L10,1,'快乐','kuàilè','vui vẻ','vui vẻ','新年快乐！','Xīnnián kuàilè!','Chúc mừng năm mới!','adj','快(nhanh)+乐(vui).',++$L10v);
v($conn,$L10,1,'礼物','lǐwù','quà tặng','quà','送你一个礼物。','Sòng nǐ yí gè lǐwù.','Tặng bạn một món quà.','noun','礼+lễ+物+vật.',++$L10v);
v($conn,$L10,1,'蛋糕','dàngāo','bánh kem','bánh kem','吃蛋糕。','Chī dàngāo.','Ăn bánh kem.','noun','蛋(trứng)+糕(bánh).',++$L10v);
v($conn,$L10,1,'送','sòng','tặng, đưa tiễn','tặng','送你花。','Sòng nǐ huā.','Tặng bạn hoa.','verb','Động từ tặng.',++$L10v);
v($conn,$L10,1,'祝','zhù','chúc','chúc','祝你生日快乐！','Zhù nǐ shēngrì kuàilè!','Chúc bạn sinh nhật vui vẻ!','verb','Dùng trong chúc mừng.',++$L10v);
v($conn,$L10,1,'高兴','gāoxìng','vui mừng','vui mừng','我很高兴。','Wǒ hěn gāoxìng.','Tôi rất vui.','adj','Chỉ cảm xúc vui.',++$L10v);
v($conn,$L10,1,'漂亮','piàoliang','đẹp, xinh','đẹp','你很漂亮。','Nǐ hěn piàoliang.','Bạn rất đẹp.','adj','Miêu tả ngoại hình.',++$L10v);
v($conn,$L10,1,'花','huā','hoa, bông hoa','hoa','送花。','Sòng huā.','Tặng hoa.','noun','Bông hoa.',++$L10v);
$g10_1 = g($conn,$L10,'Trợ từ 了 (thay đổi)','S + V + 了 + O','Đã...','Sự việc vừa xảy ra hoặc thay đổi.','了 ở cuối câu.',1);
ge($conn,$g10_1,'我吃了饭。','Wǒ chī le fàn.','Tôi đã ăn cơm.',1);
ge($conn,$g10_1,'他来了。','Tā lái le.','Anh ấy đến rồi.',2);
$g10_2 = g($conn,$L10,'Câu chúc 祝','祝 + Người + (Adj)','Chúc (ai)','Cấu trúc chúc mừng.',2);
ge($conn,$g10_2,'祝你生日快乐！','Zhù nǐ shēngrì kuàilè!','Chúc mừng sinh nhật!',1);
$d10_1 = d($conn,$L10,'Sinh nhật','Bạn bè tổ chức sinh nhật.',1);
ds($conn,$d10_1,'小明','今天是我的生日！','Jīntiān shì wǒ de shēngrì!','Hôm nay là sinh nhật tôi!',1);
ds($conn,$d10_1,'Anna','生日快乐！这是你的礼物。','Shēngrì kuàilè! Zhè shì nǐ de lǐwù.','Chúc mừng sinh nhật! Đây là quà tặng bạn.',2);
ds($conn,$d10_1,'小明','谢谢！我很高兴。','Xièxie! Wǒ hěn gāoxìng.','Cảm ơn! Tôi rất vui.',3);
r($conn,$L10,'Sinh nhật vui vẻ','今天是我的生日。朋友来我家。他送我礼物。妈妈做了蛋糕。我很高兴。','Jīntiān shì wǒ de shēngrì. Péngyou lái wǒ jiā. Tā sòng wǒ lǐwù. Māma zuò le dàngāo. Wǒ hěn gāoxìng.','Hôm nay sinh nhật tôi. Bạn đến nhà. Tặng quà. Mẹ làm bánh. Tôi vui.','easy',58,1);
$L10l = l($conn,$L10,'Sinh nhật','A:你的生日是几月几号？B:五月十号。A:生日快乐！B:谢谢！','A:Nǐ de shēngrì shì jǐ yuè jǐ hào? B:Wǔ yuè shí hào. A:Shēngrì kuàilè! B:Xièxie!','A:SN bạn ngày nào? B:10/5. A:SN vui vẻ! B:Cảm ơn!','10');
lq($conn,$L10l,'Sinh nhật người B?','{"A":"10/4","B":"10/5","C":"5/10"}','10/5','10/5.','multiple_choice',1);
$E10_1 = e($conn,$L10,'Chọn đáp án','"SN vui vẻ" là:','multiple_choice','easy',1,'B',1);
eo($conn,$E10_1,'新年快乐','A',0,1); eo($conn,$E10_1,'生日快乐','B',1,2); eo($conn,$E10_1,'节日快乐','C',0,3);
$E10_2 = e($conn,$L10,'Dịch','"Tôi rất vui."','translation','easy',1,'我很高兴。',2);
echo "  HSK1 L10 done: $L10v vocab, 2 grammar, 1 dialogue, 1 reading, 1 listening, 2 exercises\n";

// ═══ L11: 看电影 ═══
$L11 = createLesson($conn,1,11,'Bài 11: 看电影 - Xem phim','Giải trí, sở thích. Cách nói thích: 喜欢/爱. Hẹn gặp: 一起.','["Giải trí","Sở thích","Rủ rê"]','Sở thích','easy','Bài 11: Từ vựng giải trí (电影,电视,音乐). Cách diễn đạt sở thích: 喜欢, 爱. Hẹn gặp với 一起 (cùng nhau).');
$L11v = 0;
v($conn,$L11,1,'看','kàn','xem, nhìn','xem','看电影。','Kàn diànyǐng.','Xem phim.','verb','Động từ chỉ thị giác.',++$L11v);
v($conn,$L11,1,'电影','diànyǐng','phim','phim','我喜欢看电影。','Wǒ xǐhuan kàn diànyǐng.','Tôi thích xem phim.','noun','电(điện)+影(bóng).',++$L11v);
v($conn,$L11,1,'电视','diànshì','tivi','tivi','看电视。','Kàn diànshì.','Xem tivi.','noun','电+视.',++$L11v);
v($conn,$L11,1,'音乐','yīnyuè','âm nhạc','nhạc','听音乐。','Tīng yīnyuè.','Nghe nhạc.','noun','音(âm)+乐(nhạc).',++$L11v);
v($conn,$L11,1,'喜欢','xǐhuan','thích','thích','我喜欢你。','Wǒ xǐhuan nǐ.','Tôi thích bạn.','verb','Diễn đạt sở thích.',++$L11v);
v($conn,$L11,1,'爱','ài','yêu','yêu','我爱你。','Wǒ ài nǐ.','Anh yêu em.','verb','Tình cảm sâu sắc.',++$L11v);
v($conn,$L11,1,'一起','yìqǐ','cùng nhau','cùng','一起去。','Yìqǐ qù.','Đi cùng nhau.','adv','Trạng từ, đặt trước V.',++$L11v);
v($conn,$L11,1,'好','hǎo','tốt, hay','tốt','很好看的电影。','Hěn hǎokàn de diànyǐng.','Phim rất hay.','adj','Đa nghĩa.',++$L11v);
v($conn,$L11,1,'运动','yùndòng','thể thao, vận động','thể thao','做运动。','Zuò yùndòng.','Tập thể thao.','noun','运(chuyển)+动(động).',++$L11v);
v($conn,$L11,1,'唱歌','chànggē','hát','hát','我喜欢唱歌。','Wǒ xǐhuan chànggē.','Tôi thích hát.','verb','唱(hát)+歌(bài hát).',++$L11v);
$g11_1 = g($conn,$L11,'Thích với 喜欢/爱','S + 喜欢/爱 + V + O','Thích/Yêu làm gì','喜欢: thích, 爱: yêu mạnh hơn.',1);
ge($conn,$g11_1,'我喜欢看电影。','Wǒ xǐhuan kàn diànyǐng.','Tôi thích xem phim.',1);
$g11_2 = g($conn,$L11,'Hẹn với 一起','S + 一起 + V','Cùng làm gì','一起 trước động từ.',2);
ge($conn,$g11_2,'我们一起去。','Wǒmen yìqǐ qù.','Chúng ta cùng đi.',1);
$d11_1 = d($conn,$L11,'Rủ xem phim','Rủ bạn đi xem phim.',1);
ds($conn,$d11_1,'小明','你喜欢看电影吗？','Nǐ xǐhuan kàn diànyǐng ma?','Bạn thích xem phim không?',1);
ds($conn,$d11_1,'Anna','很喜欢。','Hěn xǐhuan.','Rất thích.',2);
ds($conn,$d11_1,'小明','我们星期六一起去看电影。','Wǒmen xīngqī liù yìqǐ qù kàn diànyǐng.','Thứ 7 chúng ta cùng đi xem phim.',3);
ds($conn,$d11_1,'Anna','好的，再见！','Hǎo de,zàijiàn!','Được, tạm biệt!',4);
r($conn,$L11,'Sở thích của tôi','我喜欢看电影和听音乐。朋友喜欢运动。他喜欢跑步。我们一起去看电影。好看。','Wǒ xǐhuan kàn diànyǐng hé tīng yīnyuè. Péngyou xǐhuan yùndòng. Tā xǐhuan pǎobù. Wǒmen yìqǐ qù kàn diànyǐng. Hǎokàn.','Tôi thích xem phim và nghe nhạc. Bạn thích thể thao. Chúng tôi cùng đi xem phim. Hay.','easy',52,1);
$L11l = l($conn,$L11,'Sở thích','A:你喜欢什么？B:我喜欢听音乐。A:你呢？B:我也喜欢看电影。','A:Nǐ xǐhuan shénme? B:Wǒ xǐhuan tīng yīnyuè. A:Nǐ ne? B:Wǒ yě xǐhuan kàn diànyǐng.','A:Bạn thích gì? B:Nhạc. A:Còn bạn? B:Phim.','11');
lq($conn,$L11l,'Người B thích gì?','{"A":"Phim","B":"Nhạc","C":"Thể thao"}','Nhạc','Thích nghe nhạc.','multiple_choice',1);
$E11_1 = e($conn,$L11,'Chọn','"喜欢" có nghĩa:','multiple_choice','easy',1,'B',1);
eo($conn,$E11_1,'Ghét','A',0,1); eo($conn,$E11_1,'Thích','B',1,2); eo($conn,$E11_1,'Yêu','C',0,3);
$E11_2 = e($conn,$L11,'Dịch','"Chúng ta cùng đi xem phim."','translation','easy',1,'我们一起去看电影。',2);
echo "  HSK1 L11 done: $L11v vocab, 2 grammar, 1 dialogue, 1 reading, 1 listening, 2 exercises\n";

// ═══ L12: 天气 ═══
$L12 = createLesson($conn,1,12,'Bài 12: 天气 - Thời tiết','Thời tiết, mùa trong năm. Tính từ miêu tả thời tiết. Câu hỏi với 怎么样.','["Thời tiết","Mùa","Miêu tả"]','Thời tiết','easy','Bài 12: Từ vựng thời tiết (天气,冷,热,下雨). Câu hỏi với 怎么样 (thế nào). Cách nói mùa (春天,夏天,秋天,冬天).');
$L12v = 0;
v($conn,$L12,1,'天气','tiānqì','thời tiết','thời tiết','今天天气很好。','Jīntiān tiānqì hěn hǎo.','Hôm nay thời tiết đẹp.','noun','天(trời)+气(khí).',++$L12v);
v($conn,$L12,1,'冷','lěng','lạnh','lạnh','今天很冷。','Jīntiān hěn lěng.','Hôm nay lạnh.',++$L12v);
v($conn,$L12,1,'热','rè','nóng','nóng','夏天很热。','Xiàtiān hěn rè.','Mùa hè nóng.',++$L12v);
v($conn,$L12,1,'下雨','xià yǔ','mưa','mưa','今天下雨。','Jīntiān xià yǔ.','Hôm nay mưa.',++$L12v);
v($conn,$L12,1,'雪','xuě','tuyết','tuyết','下雪。','Xià xuě.','Tuyết rơi.',++$L12v);
v($conn,$L12,1,'风','fēng','gió','gió','今天有风。','Jīntiān yǒu fēng.','Hôm nay có gió.',++$L12v);
v($conn,$L12,1,'春天','chūntiān','mùa xuân','mùa xuân','春天不冷不热。','Chūntiān bù lěng bú rè.','Mùa xuân không lạnh không nóng.',++$L12v);
v($conn,$L12,1,'夏天','xiàtiān','mùa hè','mùa hè','夏天游泳。','Xiàtiān yóuyǒng.','Mùa hè bơi.',++$L12v);
v($conn,$L12,1,'秋天','qiūtiān','mùa thu','mùa thu','秋天很凉快。','Qiūtiān hěn liángkuai.','Mùa thu mát mẻ.',++$L12v);
v($conn,$L12,1,'冬天','dōngtiān','mùa đông','mùa đông','冬天很冷。','Dōngtiān hěn lěng.','Mùa đông lạnh.',++$L12v);
v($conn,$L12,1,'怎么样','zěnmeyàng','thế nào','thế nào','天气怎么样？','Tiānqì zěnmeyàng?','Thời tiết thế nào?','question','Hỏi tình trạng.',++$L12v);
$g12_1 = g($conn,$L12,'Câu với 怎么样','S + 怎么样','Hỏi: ...thế nào?','怎么样: thế nào, ra sao.','Đặt cuối câu.',1);
ge($conn,$g12_1,'今天天气怎么样？','Jīntiān tiānqì zěnmeyàng?','Hôm nay thời tiết thế nào?',1);
ge($conn,$g12_1,'工作怎么样？','Gōngzuò zěnmeyàng?','Công việc thế nào?',2);
$g12_2 = g($conn,$L12,'不...不...','不 + Adj1 + 不 + Adj2','Không...không...','Phủ định kép để diễn tả vừa phải.',2);
ge($conn,$g12_2,'不冷不热。','Bù lěng bú rè.','Không nóng không lạnh.',1);
$d12_1 = d($conn,$L12,'Nói về thời tiết','Hai người nói về thời tiết.',1);
ds($conn,$d12_1,'小明','今天天气怎么样？','Jīntiān tiānqì zěnmeyàng?','Hôm nay thời tiết thế nào?',1);
ds($conn,$d12_1,'Anna','今天很热，下雨了。','Jīntiān hěn rè,xià yǔ le.','Hôm nay nóng, mưa rồi.',2);
ds($conn,$d12_1,'小明','我不喜欢下雨天。','Wǒ bù xǐhuan xià yǔ tiān.','Tôi không thích ngày mưa.',3);
r($conn,$L12,'Bốn mùa','一年有四季。春天不冷不热。夏天很热。秋天很凉快。冬天很冷。我喜欢春天和秋天。','Yì nián yǒu sì jì. Chūntiān bù lěng bú rè. Xiàtiān hěn rè. Qiūtiān hěn liángkuai. Dōngtiān hěn lěng. Wǒ xǐhuan chūntiān hé qiūtiān.','Một năm 4 mùa. Xn không lạnh không nóng. Hè nóng. Thu mát. Đông lạnh. Tôi thích xn và thu.','easy',60,1);
$L12l = l($conn,$L12,'Thời tiết','A:今天天气怎么样？B:下雨，很冷。A:你带伞了吗？B:带了。','A:Jīntiān tiānqì zěnmeyàng? B:Xià yǔ,hěn lěng. A:Nǐ dài sǎn le ma? B:Dài le.','A:Thời tiết thế nào? B:Mưa, lạnh. A:Mang ô chưa? B:Rồi.','12');
lq($conn,$L12l,'Hôm nay thời tiết thế nào?','{"A":"Nắng","B":"Mưa","C":"Tuyết"}','Mưa','Đang mưa.','multiple_choice',1);
$E12_1 = e($conn,$L12,'Chọn','"Nóng" tiếng Trung:','multiple_choice','easy',1,'A',1);
eo($conn,$E12_1,'热','A',1,1); eo($conn,$E12_1,'冷','B',0,2); eo($conn,$E12_1,'风','C',0,3);
$E12_2 = e($conn,$L12,'Điền','Hôm nay ____ (rất lạnh).','translation','easy',1,'今天很冷。',2);
echo "  HSK1 L12 done: $L12v vocab, 2 grammar, 1 dialogue, 1 reading, 1 listening, 2 exercises\n";

// ═══ L13: 买东西 ═══
$L13 = createLesson($conn,1,13,'Bài 13: 买东西 - Mua đồ','Mua sắm, giá cả, tiền tệ. Hỏi giá: 多少钱. Động từ 买/卖.','["Mua sắm","Giá cả","Tiền"]','Mua sắm','easy','Bài 13: Từ vựng mua sắm (买,卖,钱,贵,便宜). Hỏi giá: 多少钱. Phân loại từ tiền tệ: 块/毛/分.');
$L13v = 0;
v($conn,$L13,1,'买','mǎi','mua','mua','买东西。','Mǎi dōngxi.','Mua đồ.',++$L13v);
v($conn,$L13,1,'卖','mài','bán','bán','卖书。','Mài shū.','Bán sách.',++$L13v);
v($conn,$L13,1,'钱','qián','tiền','tiền','多少钱？','Duōshao qián?','Bao nhiêu tiền?',++$L13v);
v($conn,$L13,1,'贵','guì','đắt','đắt','太贵了。','Tài guì le.','Quá đắt.',++$L13v);
v($conn,$L13,1,'便宜','piányi','rẻ','rẻ','很便宜。','Hěn piányi.','Rất rẻ.',++$L13v);
v($conn,$L13,1,'块','kuài','đồng (đvt)','đồng','五块钱。','Wǔ kuài qián.','5 đồng.',++$L13v);
v($conn,$L13,1,'毛','máo','hào (đvt)','hào','三毛钱。','Sān máo qián.','3 hào.',++$L13v);
v($conn,$L13,1,'分','fēn','xu (đvt)','xu','两分钱。','Liǎng fēn qián.','2 xu.',++$L13v);
v($conn,$L13,1,'东西','dōngxi','đồ vật','đồ','买东西。','Mǎi dōngxi.','Mua đồ.',++$L13v);
v($conn,$L13,1,'颜色','yánsè','màu sắc','màu','什么颜色？','Shénme yánsè?','Màu gì?',++$L13v);
v($conn,$L13,1,'衣服','yīfu','quần áo','quần áo','买衣服。','Mǎi yīfu.','Mua quần áo.',++$L13v);
$g13_1 = g($conn,$L13,'Hỏi giá','多少钱？ + S + 要 + số + 块','Hỏi và trả lời giá','Đơn vị: 块/毛/分.',1);
ge($conn,$g13_1,'这本书多少钱？','Zhè běn shū duōshao qián?','Cuốn sách này bao nhiêu tiền?',1);
ge($conn,$g13_1,'五块。','Wǔ kuài.','5 đồng.',2);
$g13_2 = g($conn,$L13,'太 + Adj + 了','太 + Adj + 了','Quá...','Nhấn mạnh mức độ.',2);
ge($conn,$g13_2,'太贵了。','Tài guì le.','Quá đắt.',1);
ge($conn,$g13_2,'太好了！','Tài hǎo le!','Quá tốt!',2);
$d13_1 = d($conn,$L13,'Mua đồ','Tại cửa hàng.',1);
ds($conn,$d13_1,'小明','这个多少钱？','Zhè ge duōshao qián?','Cái này bao nhiêu tiền?',1);
ds($conn,$d13_1,'店员','十块钱。','Shí kuài qián.','10 đồng.',2);
ds($conn,$d13_1,'小明','太贵了，便宜一点？','Tài guì le,piányi yì diǎn?','Đắt quá, rẻ chút được không?',3);
ds($conn,$d13_1,'店员','八块。','Bā kuài.','8 đồng.',4);
ds($conn,$d13_1,'小明','好，买。','Hǎo,mǎi.','Được, mua.',5);
r($conn,$L13,'Mua sắm','今天我去商店买衣服。衣服很漂亮，但是太贵了。我要了蓝色的，十块钱。','Jīntiān wǒ qù shāngdiàn mǎi yīfu. Yīfu hěn piàoliang,dànshì tài guì le. Wǒ yào le lánsè de,shí kuài qián.','Hôm nay tôi đi cửa hàng mua quần áo. Đẹp nhưng đắt. Tôi lấy màu xanh, 10 đồng.','easy',55,1);
$L13l = l($conn,$L13,'Mua sắm','A:这个多少钱？B:十五块。A:太贵了。B:那十块。A:好，我买。','A:Zhè ge duōshao qián? B:Shíwǔ kuài. A:Tài guì le. B:Nà shí kuài. A:Hǎo,wǒ mǎi.','A:Cái này bn? B:15. A:Đắt quá. B:10. A:OK mua.','13');
lq($conn,$L13l,'Giá cuối cùng?','{"A":"15","B":"12","C":"10"}','10','Giá 10.','multiple_choice',1);
$E13_1 = e($conn,$L13,'Chọn','"多少钱?" dung để:','multiple_choice','easy',1,'A',1);
eo($conn,$E13_1,'Hỏi giá','A',1,1); eo($conn,$E13_1,'Chào hỏi','B',0,2); eo($conn,$E13_1,'Cảm ơn','C',0,3);
$E13_2 = e($conn,$L13,'Dịch','"Quá đắt!"','translation','easy',1,'太贵了！',2);
echo "  HSK1 L13 done: $L13v vocab, 2 grammar, 1 dialogue, 1 reading, 1 listening, 2 exercises\n";

// ═══ L14: 你汉语说得很好 ═══
$L14 = createLesson($conn,1,14,'Bài 14: 你汉语说得很好 - Bạn nói TQ rất hay','Bổ ngữ tình huống 得. Khen ngợi. Động từ làm chủ ngữ.','["Khen ngợi","Bổ ngữ","Trạng thái"]','Khen ngợi','easy','Bài 14: Bổ ngữ tình huống (V+得+Adj). Khen ngợi: 说得很好. Động từ làm chủ ngữ (学汉语很有意思).');
$L14v = 0;
v($conn,$L14,1,'得','de','(bổ ngữ tình huống)','được','你说得很好。','Nǐ shuō de hěn hǎo.','Bạn nói rất hay.',++$L14v);
v($conn,$L14,1,'很','hěn','rất','rất','很好。','Hěn hǎo.','Rất tốt.',++$L14v);
v($conn,$L14,1,'意思','yìsi','ý nghĩa, thú vị','ý nghĩa','有意思。','Yǒu yìsi.','Thú vị.',++$L14v);
v($conn,$L14,1,'努力','nǔlì','chăm chỉ, cố gắng','chăm chỉ','努力学习。','Nǔlì xuéxí.','Học tập chăm chỉ.',++$L14v);
v($conn,$L14,1,'教','jiāo','dạy','dạy','教我。','Jiāo wǒ.','Dạy tôi.',++$L14v);
v($conn,$L14,1,'对','duì','đúng','đúng','你说得对。','Nǐ shuō de duì.','Bạn nói đúng.',++$L14v);
v($conn,$L14,1,'聪明','cōngming','thông minh','thông minh','你很聪明。','Nǐ hěn cōngming.','Bạn rất thông minh.',++$L14v);
$g14_1 = g($conn,$L14,'Bổ ngữ 得','V + 得 + Adj','Làm gì đó như thế nào','Mô tả cách thức hành động.',1);
ge($conn,$g14_1,'你说得很好。','Nǐ shuō de hěn hǎo.','Bạn nói rất hay.',1);
ge($conn,$g14_1,'他来得很快。','Tā lái de hěn kuài.','Anh ấy đến rất nhanh.',2);
$g14_2 = g($conn,$L14,'Động từ làm chủ ngữ','V + O + 很有意思/很好','Làm gì đó thú vị/tốt','Động từ có thể làm chủ ngữ.',2);
ge($conn,$g14_2,'学汉语很有意思。','Xué Hànyǔ hěn yǒu yìsi.','Học TQ rất thú vị.',1);
$d14_1 = d($conn,$L14,'Khen ngợi','Khen khả năng ngôn ngữ.',1);
ds($conn,$d14_1,'小明','你汉语说得很好！','Nǐ Hànyǔ shuō de hěn hǎo!','Bạn nói TQ rất hay!',1);
ds($conn,$d14_1,'Anna','哪里哪里。我还在学。','Nǎlǐ nǎlǐ. Wǒ hái zài xué.','Đâu có. Tôi vẫn đang học.',2);
ds($conn,$d14_1,'小明','你很努力。','Nǐ hěn nǔlì.','Bạn rất chăm chỉ.',3);
r($conn,$L14,'Học tiếng Trung','朋友说汉语说得很好。他很努力学习。他教我说汉语。学汉语很有意思。','Péngyou shuō Hànyǔ shuō de hěn hǎo. Tā hěn nǔlì xuéxí. Tā jiāo wǒ shuō Hànyǔ. Xué Hànyǔ hěn yǒu yìsi.','Bạn tôi nói TQ hay lắm. Anh ấy chăm chỉ. Dạy tôi nói TQ. Học TQ thú vị.','easy',50,1);
$L14l = l($conn,$L14,'Khen ngợi','A:你写汉字写得很好。B:哪里，我写得不好。A:你很聪明。B:谢谢！','A:Nǐ xiě Hànzì xiě de hěn hǎo. B:Nǎlǐ,wǒ xiě de bù hǎo. A:Nǐ hěn cōngming. B:Xièxie!','A:Viết chữ Hán đẹp. B:Đâu có. A:Thông minh. B:Cảm ơn!','14');
lq($conn,$L14l,'Người B nghĩ thế nào về chữ Hán của mình?','{"A":"Đẹp","B":"Không tốt","C":"Rất tốt"}','Không tốt','Nghĩ mình viết chưa tốt.','multiple_choice',1);
$E14_1 = e($conn,$L14,'Chọn','"得" trong "说得很好" là:','multiple_choice','easy',1,'C',1);
eo($conn,$E14_1,'Được','A',0,1); eo($conn,$E14_1,'Của','B',0,2); eo($conn,$E14_1,'Bổ ngữ TH','C',1,3);
$E14_2 = e($conn,$L14,'Dịch','"Bạn nói rất hay."','translation','easy',1,'你说得很好。',2);
echo "  HSK1 L14 done: $L14v vocab, 2 grammar, 1 dialogue, 1 reading, 1 listening, 2 exercises\n";

// ═══ L15: 我想学汉语 ═══
$L15 = createLesson($conn,1,15,'Bài 15: 我想学汉语 - Tôi muốn học TQ','Tổng hợp: nguyện vọng, kế hoạch tương lai. Động từ + 一下. 了 hoàn thành.','["Nguyện vọng","Kế hoạch","Tương lai"]','Kế hoạch','easy','Bài 15: Tổng hợp kiến thức. Bày tỏ nguyện vọng: 想/要/打算. Động từ + 一下 (làm một chút). 了 cách dùng đa dạng.');
$L15v = 0;
v($conn,$L15,1,'打算','dǎsuàn','dự định, tính','dự định','我打算去北京。','Wǒ dǎsuàn qù Běijīng.','Tôi định đi Bắc Kinh.',++$L15v);
v($conn,$L15,1,'准备','zhǔnbèi','chuẩn bị','chuẩn bị','准备考试。','Zhǔnbèi kǎoshì.','Chuẩn bị thi.',++$L15v);
v($conn,$L15,1,'考试','kǎoshì','thi, kỳ thi','thi','有考试。','Yǒu kǎoshì.','Có kỳ thi.',++$L15v);
v($conn,$L15,1,'帮助','bāngzhù','giúp đỡ','giúp','帮助我。','Bāngzhù wǒ.','Giúp tôi.',++$L15v);
v($conn,$L15,1,'努力','nǔlì','chăm chỉ','chăm chỉ','努力学习。','Nǔlì xuéxí.','Học chăm.',++$L15v);
v($conn,$L15,1,'以后','yǐhòu','sau này','sau này','以后再说。','Yǐhòu zài shuō.','Sau này nói tiếp.',++$L15v);
v($conn,$L15,1,'因为','yīnwèi','bởi vì','vì','因为喜欢。','Yīnwèi xǐhuan.','Bởi vì thích.',++$L15v);
v($conn,$L15,1,'所以','suǒyǐ','cho nên','nên','所以...','Suǒyǐ...','Nên...',++$L15v);
$g15_1 = g($conn,$L15,'因为...所以...','因为 + A, 所以 + B','Vì A nên B','Cặp liên từ nhân quả.',1);
ge($conn,$g15_1,'因为喜欢汉语，所以我想学。','Yīnwèi xǐhuan Hànyǔ,suǒyǐ wǒ xiǎng xué.','Vì thích TQ nên tôi muốn học.',1);
$g15_2 = g($conn,$L15,'V + 一下','V + 一下','Làm một chút','Thời gian ngắn, thử.',2);
ge($conn,$g15_2,'我看一下。','Wǒ kàn yí xià.','Tôi xem một chút.',1);
$d15_1 = d($conn,$L15,'Kế hoạch học tập','Nói về kế hoạch.',1);
ds($conn,$d15_1,'小明','你为什么学汉语？','Nǐ wèi shénme xué Hànyǔ?','Vì sao bạn học TQ?',1);
ds($conn,$d15_1,'Anna','因为有意思。我打算去中国。','Yīnwèi yǒu yìsi. Wǒ dǎsuàn qù Zhōngguó.','Vì thú vị. Tôi định đi TQ.',2);
ds($conn,$d15_1,'小明','我也想去。你准备考试吗？','Wǒ yě xiǎng qù. Nǐ zhǔnbèi kǎoshì ma?','Tôi cũng muốn đi. Bạn chuẩn bị thi à?',3);
ds($conn,$d15_1,'Anna','对，我准备HSK1考试。','Duì,wǒ zhǔnbèi HSK1 kǎoshì.','Đúng, chuẩn bị thi HSK1.',4);
r($conn,$L15,'Dự định tương lai','因为我对中文有意思，所以我一直努力学习。我打算明年去中国留学。我要准备HSK考试。朋友会帮助我。','Yīnwèi wǒ duì Zhōngwén yǒu yìsi,suǒyǐ wǒ yìzhí nǔlì xuéxí. Wǒ dǎsuàn míngnián qù Zhōngguó liúxué. Wǒ yào zhǔnbèi HSK kǎoshì. Péngyou huì bāngzhù wǒ.','Vì tôi thích TQ nên luôn học chăm. Tôi định năm sau đi du học TQ. Thi HSK. Bạn giúp tôi.','easy',60,1);
$L15l = l($conn,$L15,'Kế hoạch','A:你打算学汉语吗？B:对，我打算学。A:为什么？B:因为我想去中国。','A:Nǐ dǎsuàn xué Hànyǔ ma? B:Duì,wǒ dǎsuàn xué. A:Wèi shénme? B:Yīnwèi wǒ xiǎng qù Zhōngguó.','A:Định học TQ? B:Vâng. A:Sao? B:Vì muốn đi TQ.','15');
lq($conn,$L15l,'Người B định làm gì?','{"A":"Đi TQ","B":"Học TQ","C":"Cả A và B"}','Cả A và B','Học để đi TQ.','multiple_choice',1);
$E15_1 = e($conn,$L15,'Chọn','"因为...所以..." là:','multiple_choice','easy',1,'B',1);
eo($conn,$E15_1,'Nhượng bộ','A',0,1); eo($conn,$E15_1,'Nhân quả','B',1,2); eo($conn,$E15_1,'Điều kiện','C',0,3);
$E15_2 = e($conn,$L15,'Dịch','"Tôi định đi TQ."','translation','easy',1,'我打算去中国。',2);
echo "  HSK1 L15 done: $L15v vocab, 2 grammar, 1 dialogue, 1 reading, 1 listening, 2 exercises\n";

echo "\n=== HSK1 COMPLETE (15 lessons) ===\n\n";
echo "\n=== STARTING HSK2 (15 lessons) ===\n\n";

// ═══ HSK2 L1: 九月去北京旅游 ═══
$HL1 = createLesson($conn,2,1,'Bài 1: 九月去北京旅游 - Tháng 9 đi Bắc Kinh du lịch','Địa điểm, du lịch. Động từ + 过 (kinh nghiệm). 从...到...','["Du lịch","Kinh nghiệm","Địa điểm"]','Du lịch','medium','HSK2 Bài 1: Du lịch Bắc Kinh. Thắng cảnh (故宫,天坛,长城). Động từ + 过. Cấu trúc 从...到... (từ...đến...).');
$HL1v = 0;
v($conn,$HL1,2,'旅游','lǚyóu','du lịch','du lịch','去旅游。','Qù lǚyóu.','Đi du lịch.',++$HL1v);
v($conn,$HL1,2,'北京','Běijīng','Bắc Kinh','Bắc Kinh','去北京旅游。','Qù Běijīng lǚyóu.','Đi Bắc Kinh du lịch.',++$HL1v);
v($conn,$HL1,2,'长城','Chángchéng','Vạn Lý Trường Thành','Trường Thành','爬长城。','Pá Chángchéng.','Leo trường thành.',++$HL1v);
v($conn,$HL1,2,'故宫','Gùgōng','Tử Cấm Thành','Tử Cấm Thành','去故宫。','Qù Gùgōng.','Đến Tử Cấm Thành.',++$HL1v);
v($conn,$HL1,2,'天安门','Tiān\'ānmén','Thiên An Môn','Thiên An Môn','天安门广场。','Tiān\'ānmén guǎngchǎng.','Quảng trường Thiên An Môn.',++$HL1v);
v($conn,$HL1,2,'坐','zuò','ngồi, đi (xe)','ngồi','坐飞机。','Zuò fēijī.','Đi máy bay.',++$HL1v);
v($conn,$HL1,2,'飞机','fēijī','máy bay','máy bay','坐飞机去。','Zuò fēijī qù.','Đi máy bay.',++$HL1v);
v($conn,$HL1,2,'火车','huǒchē','tàu hỏa','tàu hỏa','坐火车。','Zuò huǒchē.','Đi tàu hỏa.',++$HL1v);
v($conn,$HL1,2,'车站','chēzhàn','bến xe, ga','ga','火车站。','Huǒchē zhàn.','Ga tàu hỏa.',++$HL1v);
v($conn,$HL1,2,'票','piào','vé','vé','买票。','Mǎi piào.','Mua vé.',++$HL1v);
v($conn,$HL1,2,'宾馆','bīnguǎn','khách sạn','khách sạn','住宾馆。','Zhù bīnguǎn.','Ở khách sạn.',++$HL1v);
v($conn,$HL1,2,'房间','fángjiān','phòng','phòng','房间很大。','Fángjiān hěn dà.','Phòng rất rộng.',++$HL1v);
$HL1g1 = g($conn,$HL1,'Động từ + 过','S + V + 过 + O','Đã từng...','Chỉ kinh nghiệm từng trải qua.',1);
ge($conn,$HL1g1,'我去过北京。','Wǒ qù guò Běijīng.','Tôi đã từng đi Bắc Kinh.',1);
ge($conn,$HL1g1,'你吃过烤鸭吗？','Nǐ chī guò kǎoyā ma?','Bạn từng ăn vịt quay chưa?',2);
$HL1g2 = g($conn,$HL1,'从...到...','从 + A + 到 + B','Từ...đến...','Chỉ khoảng cách hoặc thời gian.',2);
ge($conn,$HL1g2,'从北京到上海。','Cóng Běijīng dào Shànghǎi.','Từ Bắc Kinh đến Thượng Hải.',1);
$HL1d1 = d($conn,$HL1,'Kế hoạch du lịch','Bàn về du lịch Bắc Kinh.',1);
ds($conn,$HL1d1,'小明','九月我们去北京旅游吧。','Jiǔ yuè wǒmen qù Běijīng lǚyóu ba.','Tháng 9 chúng ta đi Bắc Kinh du lịch nhé.',1);
ds($conn,$HL1d1,'Anna','太好了！我去过北京。','Tài hǎo le! Wǒ qù guò Běijīng.','Tuyệt! Tôi từng đi Bắc Kinh rồi.',2);
ds($conn,$HL1d1,'小明','你坐火车去还是飞机？','Nǐ zuò huǒchē qù háishì fēijī?','Bạn đi tàu hay máy bay?',3);
ds($conn,$HL1d1,'Anna','坐飞机，从北京到上海很快。','Zuò fēijī,cóng Běijīng dào Shànghǎi hěn kuài.','Máy bay, từ Bắc Kinh đến Thượng Hải rất nhanh.',4);
r($conn,$HL1,'北京旅游','去年九月我和朋友去北京旅游。我们坐飞机去。去过长城和故宫。长城很长。故宫很大。我们买了票。住在宾馆。房间很舒服。','Qùnián jiǔ yuè wǒ hé péngyou qù Běijīng lǚyóu. Wǒmen zuò fēijī qù. Qù guò Chángchéng hé Gùgōng. Chángchéng hěn cháng. Gùgōng hěn dà. Wǒmen mǎi le piào. Zhù zài bīnguǎn. Fángjiān hěn shūfu.','Năm ngoái th9, tôi và bạn đi BJ du lịch. Bay. Đã đến Trường Thành và Tử Cấm Thành.','medium',90,1);
$HL1l = l($conn,$HL1,'Du lịch','A:你去过北京吗？B:去过一次。A:怎么样？B:很有意思，我还想去。','A:Nǐ qù guò Běijīng ma? B:Qù guò yí cì. A:Zěnmeyàng? B:Hěn yǒu yìsi,wǒ hái xiǎng qù.','A:Từng đi BJ? B:Từng 1 lần. A:Sao? B:Thú vị, còn muốn đi.','1');
lq($conn,$HL1l,'Người B đi Bắc Kinh mấy lần?','{"A":"0","B":"1","C":"Nhiều"}','1','Một lần.','multiple_choice',1);
$E1 = e($conn,$HL1,'Chọn','"Vé" tiếng Trung:','multiple_choice','medium',1,'B',1);
eo($conn,$E1,'房间','A',0,1); eo($conn,$E1,'票','B',1,2); eo($conn,$E1,'车站','C',0,3);
$E2 = e($conn,$HL1,'Dịch','"Tôi từng đi Bắc Kinh."','translation','medium',1,'我去过北京。',2);
echo "  HSK2 L1 done: $HL1v vocab, 2 grammar, 1 dialogue, 1 reading, 1 listening, 2 exercises\n";

// ═══ HSK2 L2: 我每天六点起床 ═══
$HL2 = createLesson($conn,2,2,'Bài 2: 我每天六点起床 - Tôi mỗi ngày 6h dậy','Thói quen hàng ngày. Thời gian cụ thể: 点/分/半. 从...开始.','["Thói quen","Giờ giấc","Hàng ngày"]','Sinh hoạt','medium','HSK2 Bài 2: Thời gian cụ thể giờ phút. Thói quen hàng ngày: 起床, 刷牙,洗脸,上班. Cấu trúc: 从...开始, 先...然后...');
$HL2v = 0;
v($conn,$HL2,2,'起床','qǐ chuáng','thức dậy','dậy','六点起床。','Liù diǎn qǐ chuáng.','6h dậy.',++$HL2v);
v($conn,$HL2,2,'上班','shàng bān','đi làm','đi làm','八点上班。','Bā diǎn shàng bān.','8h đi làm.',++$HL2v);
v($conn,$HL2,2,'下班','xià bān','tan làm','tan làm','五点下班。','Wǔ diǎn xià bān.','5h tan làm.',++$HL2v);
v($conn,$HL2,2,'睡觉','shuì jiào','ngủ','ngủ','十点睡觉。','Shí diǎn shuì jiào.','10h ngủ.',++$HL2v);
v($conn,$HL2,2,'洗澡','xǐ zǎo','tắm','tắm','洗澡睡觉。','Xǐ zǎo shuì jiào.','Tắm rồi ngủ.',++$HL2v);
v($conn,$HL2,2,'早饭','zǎofàn','bữa sáng','sáng','吃早饭。','Chī zǎofàn.','Ăn sáng.',++$HL2v);
v($conn,$HL2,2,'午饭','wǔfàn','bữa trưa','trưa','吃午饭。','Chī wǔfàn.','Ăn trưa.',++$HL2v);
v($conn,$HL2,2,'晚饭','wǎnfàn','bữa tối','tối','吃晚饭。','Chī wǎnfàn.','Ăn tối.',++$HL2v);
v($conn,$HL2,2,'半','bàn','rưỡi, nửa','rưỡi','九点半。','Jiǔ diǎn bàn.','9h rưỡi.',++$HL2v);
v($conn,$HL2,2,'刻','kè','khắc (15 phút)','khắc','七点一刻。','Qī diǎn yí kè.','7h15.',++$HL2v);
v($conn,$HL2,2,'差','chà','kém (thiếu)','kém','差五分八点。','Chà wǔ fēn bā diǎn.','Kém 5 phút 8h.',++$HL2v);
$HL2g1 = g($conn,$HL2,'Giờ + 点 + 分','số + 点 ( + số + 分 )','Nói giờ','半/刻/差.',1);
ge($conn,$HL2g1,'六点半起床。','Liù diǎn bàn qǐ chuáng.','6h rưỡi dậy.',1);
ge($conn,$HL2g1,'差五分八点。','Chà wǔ fēn bā diǎn.','Kém 5 phút 8h.',2);
$HL2g2 = g($conn,$HL2,'先...然后...','先 + V1 + 然后 + V2','Trước...sau đó...','Trình tự hành động.',2);
ge($conn,$HL2g2,'先洗澡然后睡觉。','Xiān xǐ zǎo ránhòu shuì jiào.','Tắm trước rồi ngủ sau.',1);
$HL2d1 = d($conn,$HL2,'Thói quen hàng ngày','Hỏi về thói quen.',1);
ds($conn,$HL2d1,'小明','你每天几点起床？','Nǐ měitiān jǐ diǎn qǐ chuáng?','Mỗi ngày mấy giờ dậy?',1);
ds($conn,$HL2d1,'Anna','我六点半起床。','Wǒ liù diǎn bàn qǐ chuáng.','Tôi 6h rưỡi dậy.',2);
ds($conn,$HL2d1,'小明','先吃早饭然后上班？','Xiān chī zǎofàn ránhòu shàng bān?','Ăn sáng trước rồi đi làm?',3);
ds($conn,$HL2d1,'Anna','对，八点上班。','Duì,bā diǎn shàng bān.','Đúng, 8h đi làm.',4);
r($conn,$HL2,'Một ngày của tôi','我每天六点起床。先洗澡然后吃早饭。八点上班。十二点吃午饭。五点下班。晚上吃晚饭。十点睡觉。','Wǒ měitiān liù diǎn qǐ chuáng. Xiān xǐ zǎo ránhòu chī zǎofàn. Bā diǎn shàng bān. Shí\'èr diǎn chī wǔfàn. Wǔ diǎn xià bān. Wǎnshang chī wǎnfàn. Shí diǎn shuì jiào.','Mỗi ngày 6h dậy. Tắm rồi ăn sáng. 8h làm. 12h ăn trưa. 5h tan. Tối ăn. 10h ngủ.','medium',95,1);
$HL2l = l($conn,$HL2,'Giờ giấc','A:现在几点？B:七点半。A:你几点上班？B:八点，还早。','A:Xiànzài jǐ diǎn? B:Qī diǎn bàn. A:Nǐ jǐ diǎn shàng bān? B:Bā diǎn,hái zǎo.','A:Mấy giờ? B:7h30. A:Mấy giờ làm? B:8h, còn sớm.','2');
lq($conn,$HL2l,'Bây giờ mấy giờ?','{"A":"7h","B":"7h30","C":"8h"}','7h30','7:30.','multiple_choice',1);
$E2_1 = e($conn,$HL2,'Chọn','"6h rưỡi" là:','multiple_choice','medium',1,'A',1);
eo($conn,$E2_1,'六点半','A',1,1); eo($conn,$E2_1,'六点','B',0,2); eo($conn,$E2_1,'六点一刻','C',0,3);
echo "  HSK2 L2 done: $HL2v vocab, 2 grammar, 1 dialogue, 1 reading, 1 listening, 1 exercise\n";

// ═══ HSK2 L3: 左边那个红色的是我的 ═══
$HL3 = createLesson($conn,2,3,'Bài 3: 左边那个红色的是我的 - Bên trái cái màu đỏ là của tôi','Vị trí, phương hướng. Màu sắc. 的 structure.','["Vị trí","Màu sắc","Chỉ định"]','Vị trí','medium','HSK2 Bài 3: Từ vị trí (左边,右边,前面,后面). Màu sắc (红色,蓝色,白色,黑色). Cấu trúc 的 (cái màu đỏ). Hỏi: 哪 + N + 是 + 的？');
$HL3v = 0;
v($conn,$HL3,2,'左边','zuǒbiān','bên trái','bên trái','左边有书。','Zuǒbiān yǒu shū.','Bên trái có sách.',++$HL3v);
v($conn,$HL3,2,'右边','yòubiān','bên phải','bên phải','右边是我的。','Yòubiān shì wǒ de.','Bên phải là của tôi.',++$HL3v);
v($conn,$HL3,2,'前面','qiánmiàn','đằng trước','đằng trước','前面是门。','Qiánmiàn shì mén.','Đằng trước là cửa.',++$HL3v);
v($conn,$HL3,2,'后面','hòumiàn','đằng sau','đằng sau','后面有花园。','Hòumiàn yǒu huāyuán.','Đằng sau có vườn hoa.',++$HL3v);
v($conn,$HL3,2,'里面','lǐmiàn','bên trong','bên trong','在里面。','Zài lǐmiàn.','Ở bên trong.',++$HL3v);
v($conn,$HL3,2,'外面','wàimiàn','bên ngoài','bên ngoài','在外面。','Zài wàimiàn.','Ở bên ngoài.',++$HL3v);
v($conn,$HL3,2,'红色','hóngsè','màu đỏ','đỏ','红色的书。','Hóngsè de shū.','Sách màu đỏ.',++$HL3v);
v($conn,$HL3,2,'蓝色','lánsè','màu xanh','xanh','蓝色的衣服。','Lánsè de yīfu.','Quần áo màu xanh.',++$HL3v);
v($conn,$HL3,2,'白色','báisè','màu trắng','trắng','白色的花。','Báisè de huā.','Hoa màu trắng.',++$HL3v);
v($conn,$HL3,2,'黑色','hēisè','màu đen','đen','黑色的包。','Hēisè de bāo.','Túi màu đen.',++$HL3v);
v($conn,$HL3,2,'那个','nà ge','cái đó','cái đó','那个是我的。','Nà ge shì wǒ de.','Cái đó là của tôi.',++$HL3v);
v($conn,$HL3,2,'这个','zhè ge','cái này','cái này','这个是新的。','Zhè ge shì xīn de.','Cái này là mới.',++$HL3v);
$HL3g1 = g($conn,$HL3,'的 cấu trúc chỉ định','Adj + 色 + 的 / N + 的 + N','Của/màu...','...的 có thể thay thế danh từ.',1);
ge($conn,$HL3g1,'红色的是我的。','Hóngsè de shì wǒ de.','Cái màu đỏ là của tôi.',1);
ge($conn,$HL3g1,'左边的书。','Zuǒbiān de shū.','Sách bên trái.',2);
$HL3g2 = g($conn,$HL3,'Hỏi vị trí/đồ vật','哪 + N + 是 + 的？','Cái nào...?','Hỏi để chọn.',2);
ge($conn,$HL3g2,'哪个是你的？','Nǎ ge shì nǐ de?','Cái nào là của bạn?',1);
$HL3d1 = d($conn,$HL3,'Tìm đồ','Tìm đồ vật.',1);
ds($conn,$HL3d1,'小明','我的书在哪儿？','Wǒ de shū zài nǎr?','Sách của tôi ở đâu?',1);
ds($conn,$HL3d1,'Anna','左边那个红色的是你的。','Zuǒbiān nà ge hóngsè de shì nǐ de.','Bên trái cái màu đỏ là của bạn.',2);
r($conn,$HL3,'Đồ của tôi','桌子上有白色的书和蓝色的书。左边白色的不是我的。右边蓝色的才是我的。前面有红色的笔。','Zhuōzi shang yǒu báisè de shū hé lánsè de shū. Zuǒbiān báisè de bú shì wǒ de. Yòubiān lánsè de cái shì wǒ de. Qiánmiàn yǒu hóngsè de bǐ.','Trên bàn có sách trắng và xanh. Bên trái màu trắng không phải của tôi. Bên phải màu xanh mới là của tôi.','medium',85,1);
echo "  HSK2 L3 done: $HL3v vocab, 2 grammar, 1 dialogue, 1 reading\n";

// ═══ HSK2 L4: 工作忙不忙 ═══
$HL4 = createLesson($conn,2,4,'Bài 4: 工作忙不忙 - Công việc bận không','Công việc, nghề nghiệp. A不A câu hỏi. Tính từ tả công việc.','["Công việc","Bận rộn","Hỏi tình trạng"]','Công việc','medium','HSK2 Bài 4: Từ vựng công việc (工作,公司,办公室). Câu hỏi A不A (忙不忙,好不好). Trạng thái công việc: 累,忙,轻松.');
$HL4v = 0;
v($conn,$HL4,2,'工作','gōngzuò','công việc, làm việc','công việc','我工作很忙。','Wǒ gōngzuò hěn máng.','Công việc tôi rất bận.',++$HL4v);
v($conn,$HL4,2,'公司','gōngsī','công ty','công ty','在公司工作。','Zài gōngsī gōngzuò.','Làm việc ở công ty.',++$HL4v);
v($conn,$HL4,2,'办公室','bàngōngshì','văn phòng','văn phòng','在办公室。','Zài bàngōngshì.','Ở văn phòng.',++$HL4v);
v($conn,$HL4,2,'忙','máng','bận rộn','bận','我很忙。','Wǒ hěn máng.','Tôi rất bận.',++$HL4v);
v($conn,$HL4,2,'累','lèi','mệt','mệt','我很累。','Wǒ hěn lèi.','Tôi rất mệt.',++$HL4v);
v($conn,$HL4,2,'轻松','qīngsōng','nhẹ nhàng','nhẹ nhàng','工作很轻松。','Gōngzuò hěn qīngsōng.','Công việc nhẹ nhàng.',++$HL4v);
v($conn,$HL4,2,'身体','shēntǐ','cơ thể, sức khỏe','sức khỏe','身体好。','Shēntǐ hǎo.','Sức khỏe tốt.',++$HL4v);
v($conn,$HL4,2,'时间','shíjiān','thời gian','thời gian','没有时间。','Méiyǒu shíjiān.','Không có thời gian.',++$HL4v);
v($conn,$HL4,2,'加班','jiā bān','tăng ca','tăng ca','今天加班。','Jīntiān jiā bān.','Hôm nay tăng ca.',++$HL4v);
$HL4g1 = g($conn,$HL4,'Câu hỏi A不A','Adj + 不 + Adj?','Có...không?','Hỏi về tính chất.',1);
ge($conn,$HL4g1,'工作忙不忙？','Gōngzuò máng bù máng?','Công việc bận không?',1);
ge($conn,$HL4g1,'你累不累？','Nǐ lèi bú lèi?','Bạn mệt không?',2);
$HL4d1 = d($conn,$HL4,'Hỏi về công việc','Hai đồng nghiệp nói chuyện.',1);
ds($conn,$HL4d1,'小明','你工作忙不忙？','Nǐ gōngzuò máng bù máng?','Công việc bạn bận không?',1);
ds($conn,$HL4d1,'Anna','很忙，常常加班。','Hěn máng,chángcháng jiā bān.','Rất bận, thường xuyên tăng ca.',2);
ds($conn,$HL4d1,'小明','那你要注意身体。','Nà nǐ yào zhùyì shēntǐ.','Vậy bạn phải chú ý sức khỏe.',3);
r($conn,$HL4,'Công việc bận rộn','我在一家公司工作。每天都很忙。有时加班。很累但是有意思。同事们很好。中午一起吃饭。工作忙不忙？还可以。','Wǒ zài yì jiā gōngsī gōngzuò. Měitiān dōu hěn máng. Yǒushí jiā bān. Hěn lèi dànshì yǒu yìsi. Tóngshìmen hěn hǎo. Zhōngwǔ yìqǐ chīfàn. Gōngzuò máng bù máng? Hái kěyǐ.','Tôi làm ở 1 công ty. Mỗi ngày bận. Có lúc tăng ca. Mệt nhưng thú vị. Đồng nghiệp tốt. Trưa cùng ăn. Công việc bận không? Tạm được.','medium',88,1);
echo "  HSK2 L4 done: $HL4v vocab, 1 grammar, 1 dialogue, 1 reading\n";

// ═══ HSK2 L5: 就买这件了 ═══
$HL5 = createLesson($conn,2,5,'Bài 5: 就买这件了 - Cứ mua cái này','Mua sắm nâng cao. So sánh giá/chất lượng. 就 = just. Chọn lựa: 还是.','["Mua sắm","So sánh","Chọn lựa"]','Mua sắm','medium','HSK2 Bài 5: Mua sắm nâng cao. 就 (cứ/chỉ). Chọn lựa với 还是 (hay là). So sánh hơn với 比 (sơ lược). Trả giá.');
$HL5v = 0;
v($conn,$HL5,2,'就','jiù','cứ, chính là','cứ','就买这个。','Jiù mǎi zhè ge.','Cứ mua cái này.',++$HL5v);
v($conn,$HL5,2,'还是','háishì','hay là','hay','这个还是那个？','Zhè ge háishì nà ge?','Cái này hay cái kia?',++$HL5v);
v($conn,$HL5,2,'比','bǐ','so với','hơn','这个比那个好。','Zhè ge bǐ nà ge hǎo.','Cái này hơn cái kia.',++$HL5v);
v($conn,$HL5,2,'一样','yíyàng','giống nhau','giống','两个一样。','Liǎng ge yíyàng.','Hai cái giống nhau.',++$HL5v);
v($conn,$HL5,2,'质量','zhìliàng','chất lượng','chất lượng','质量好。','Zhìliàng hǎo.','Chất lượng tốt.',++$HL5v);
v($conn,$HL5,2,'价格','jiàgé','giá cả','giá','价格便宜。','Jiàgé piányi.','Giá rẻ.',++$HL5v);
v($conn,$HL5,2,'试','shì','thử','thử','试一下。','Shì yí xià.','Thử một chút.',++$HL5v);
v($conn,$HL5,2,'号','hào','cỡ (size)','cỡ','大号的。','Dà hào de.','Cỡ lớn.',++$HL5v);
$HL5g1 = g($conn,$HL5,'Chọn lựa: A还是B','A + 还是 + B?','A hay B?','Hỏi lựa chọn.',1);
ge($conn,$HL5g1,'你要茶还是咖啡？','Nǐ yào chá háishì kāfēi?','Bạn uống trà hay cà phê?',1);
$HL5g2 = g($conn,$HL5,'就 + V','就 + V + O','Cứ làm gì','Kiên quyết hoặc chọn nhanh.',2);
ge($conn,$HL5g2,'就买这件了。','Jiù mǎi zhè jiàn le.','Cứ mua cái này.',1);
$HL5d1 = d($conn,$HL5,'Mua quần áo','Tại cửa hàng thời trang.',1);
ds($conn,$HL5d1,'小明','这件衣服怎么样？','Zhè jiàn yīfu zěnmeyàng?','Cái áo này thế nào?',1);
ds($conn,$HL5d1,'Anna','很好看。你要红色还是蓝色？','Hěn hǎokàn. Nǐ yào hóngsè háishì lánsè?','Đẹp. Bạn muốn đỏ hay xanh?',2);
ds($conn,$HL5d1,'小明','蓝色好看，就买这件了。','Lánsè hǎokàn,jiù mǎi zhè jiàn le.','Xanh đẹp, cứ mua cái này.',3);
r($conn,$HL5,'Mua đồ','今天去商店买衣服。红色和蓝色都不错。蓝色比红色便宜。蓝色质量也好。就买蓝色了。','Jīntiān qù shāngdiàn mǎi yīfu. Hóngsè hé lánsè dōu búcuò. Lánsè bǐ hóngsè piányi. Lánsè zhìliàng yě hǎo. Jiù mǎi lánsè le.','Hôm nay đi mua quần áo. Đỏ và xanh đều tốt. Xanh rẻ hơn đỏ. Chất lượng xanh cũng tốt. Cứ mua xanh.','medium',82,1);
echo "  HSK2 L5 done: $HL5v vocab, 2 grammar, 1 dialogue, 1 reading\n";

// ═══ HSK2 L6: 你怎么不吃了 ═══
$HL6 = createLesson($conn,2,6,'Bài 6: 你怎么不吃了 - Sao bạn không ăn nữa','Ăn uống nâng cao. Món ăn Trung Quốc. 怎么 (hỏi lý do). 了 biểu thị thay đổi.','["Ẩm thực","Lý do","Thay đổi"]','Ăn uống','medium','HSK2 Bài 6: Món ăn TQ (烤鸭,饺子,面条). 怎么 hỏi lý do. 了 chỉ sự thay đổi trạng thái. Phân biệt 又/再.');
$HL6v = 0;
v($conn,$HL6,2,'怎么','zěnme','sao, thế nào','sao','你怎么不吃？','Nǐ zěnme bù chī?','Sao bạn không ăn?',++$HL6v);
v($conn,$HL6,2,'烤鸭','kǎoyā','vịt quay Bắc Kinh','vịt quay','吃烤鸭。','Chī kǎoyā.','Ăn vịt quay.',++$HL6v);
v($conn,$HL6,2,'饺子','jiǎozi','sủi cảo','sủi cảo','包饺子。','Bāo jiǎozi.','Gói sủi cảo.',++$HL6v);
v($conn,$HL6,2,'面条','miàntiáo','mì sợi','mì','吃面条。','Chī miàntiáo.','Ăn mì.',++$HL6v);
v($conn,$HL6,2,'好吃','hǎochī','ngon','ngon','很好吃。','Hěn hǎochī.','Rất ngon.',++$HL6v);
v($conn,$HL6,2,'饱','bǎo','no','no','吃饱了。','Chī bǎo le.','Ăn no rồi.',++$HL6v);
v($conn,$HL6,2,'又','yòu','lại (đã xảy ra)','lại','又来了。','Yòu lái le.','Lại đến rồi.',++$HL6v);
v($conn,$HL6,2,'再','zài','lại (sẽ làm)','lại','再来一碗。','Zài lái yì wǎn.','Lại thêm một bát.',++$HL6v);
$HL6g1 = g($conn,$HL6,'怎么 hỏi lý do','怎么 + V + O?','Sao/why...?','Hỏi nguyên nhân.',1);
ge($conn,$HL6g1,'你怎么不吃了？','Nǐ zěnme bù chī le?','Sao bạn không ăn nữa?',1);
$HL6g2 = g($conn,$HL6,'又 vs 再','又 + V (đã lặp lại), 再 + V (sẽ lặp lại)','又: lại rồi, 再: sẽ lại','又 quá khứ, 再 tương lai.',2);
ge($conn,$HL6g2,'他又来了。','Tā yòu lái le.','Anh ấy lại đến rồi.',1);
ge($conn,$HL6g2,'明天再来。','Míngtiān zài lái.','Mai lại đến.',2);
$HL6d1 = d($conn,$HL6,'Tại nhà hàng','Ăn tại nhà hàng TQ.',1);
ds($conn,$HL6d1,'小明','你怎么不吃了？','Nǐ zěnme bù chī le?','Sao bạn không ăn nữa?',1);
ds($conn,$HL6d1,'Anna','我吃饱了。烤鸭很好吃。','Wǒ chī bǎo le. Kǎoyā hěn hǎochī.','Tôi no rồi. Vịt quay ngon lắm.',2);
ds($conn,$HL6d1,'小明','再吃一点吧。','Zài chī yì diǎn ba.','Ăn thêm chút nữa đi.',3);
ds($conn,$HL6d1,'Anna','不了，真饱了。下次再来。','Bù le,zhēn bǎo le. Xià cì zài lái.','Không, thật no rồi. Lần sau lại đến.',4);
r($conn,$HL6,'Nhà hàng Trung Quốc','今天我们去中国餐厅吃饭。我点了烤鸭和饺子。烤鸭很好吃，我吃了很多。朋友说很好吃，也吃了很多。我们都吃饱了。下次还要来。','Jīntiān wǒmen qù Zhōngguó cāntīng chīfàn. Wǒ diǎn le kǎoyā hé jiǎozi. Kǎoyā hěn hǎochī,wǒ chī le hěnduō. Péngyou shuō hěn hǎochī,yě chī le hěnduō. Wǒmen dōu chī bǎo le. Xià cì hái yào lái.','Hôm nay chúng tôi đến nhà hàng TQ. Gọi vịt quay và sủi cảo. Vịt quay ngon. Đều no. Lần sau còn đến.','medium',95,1);
echo "  HSK2 L6 done: $HL6v vocab, 2 grammar, 1 dialogue, 1 reading\n";

// ═══ HSK2 L7: 你家离学校远不远 ═══
$HL7 = createLesson($conn,2,7,'Bài 7: 你家离学校远不远 - Nhà bạn xa trường không','Khoảng cách, phương tiện. 离 + N + Adj. 走路/开车/坐车.','["Khoảng cách","Phương tiện","Đi lại"]','Đi lại','medium','HSK2 Bài 7: 离 (cách). Hỏi khoảng cách. Phương tiện: 走路 (đi bộ), 开车 (lái xe). Thời gian: 需要 (cần), 分钟 (phút).');
$HL7v = 0;
v($conn,$HL7,2,'离','lí','cách','cách','家离学校很远。','Jiā lí xuéxiào hěn yuǎn.','Nhà cách trường rất xa.',++$HL7v);
v($conn,$HL7,2,'远','yuǎn','xa','xa','很远。','Hěn yuǎn.','Rất xa.',++$HL7v);
v($conn,$HL7,2,'近','jìn','gần','gần','很近。','Hěn jìn.','Rất gần.',++$HL7v);
v($conn,$HL7,2,'走路','zǒu lù','đi bộ','đi bộ','走路去。','Zǒu lù qù.','Đi bộ đến.',++$HL7v);
v($conn,$HL7,2,'开车','kāi chē','lái xe','lái xe','开车去上班。','Kāi chē qù shàng bān.','Lái xe đi làm.',++$HL7v);
v($conn,$HL7,2,'公共汽车','gōnggòng qìchē','xe buýt','xe buýt','坐公共汽车。','Zuò gōnggòng qìchē.','Đi xe buýt.',++$HL7v);
v($conn,$HL7,2,'地铁','dìtiě','tàu điện ngầm','tàu điện','坐地铁。','Zuò dìtiě.','Đi tàu điện.',++$HL7v);
v($conn,$HL7,2,'需要','xūyào','cần','cần','需要二十分钟。','Xūyào èrshí fēnzhōng.','Cần 20 phút.',++$HL7v);
$HL7g1 = g($conn,$HL7,'离 + N + Adj','A + 离 + B + Adj','Cách nhau thế nào','Diễn tả khoảng cách.',1);
ge($conn,$HL7g1,'我家离学校很近。','Wǒ jiā lí xuéxiào hěn jìn.','Nhà tôi cách trường rất gần.',1);
ge($conn,$HL7g1,'你家离公司远不远？','Nǐ jiā lí gōngsī yuǎn bù yuǎn?','Nhà bạn cách công ty xa không?',2);
$HL7g2 = g($conn,$HL7,'Thời gian với 需要','需要 + số + 分钟','Cần...phút','Thời gian di chuyển.',2);
ge($conn,$HL7g2,'走路需要十分钟。','Zǒu lù xūyào shí fēnzhōng.','Đi bộ cần 10 phút.',1);
$HL7d1 = d($conn,$HL7,'Hỏi đường','Hỏi về khoảng cách.',1);
ds($conn,$HL7d1,'小明','你家离公司远不远？','Nǐ jiā lí gōngsī yuǎn bù yuǎn?','Nhà bạn cách công ty xa không?',1);
ds($conn,$HL7d1,'Anna','不远，走路十分钟。','Bù yuǎn,zǒu lù shí fēnzhōng.','Không xa, đi bộ 10 phút.',2);
ds($conn,$HL7d1,'小明','真近！我每天坐地铁上班。','Zhēn jìn! Wǒ měitiān zuò dìtiě shàng bān.','Gần thật! Tôi mỗi ngày đi tàu điện làm.',3);
r($conn,$HL7,'Khoảng cách','我住的地方离公司很近。走路只需要十分钟。离地铁站也近。所以每天走路去上班，方便。','Wǒ zhù de dìfang lí gōngsī hěn jìn. Zǒu lù zhǐ xūyào shí fēnzhōng. Lí dìtiě zhàn yě jìn. Suǒyǐ měitiān zǒu lù qù shàng bān,fāngbiàn.','Nơi tôi ở gần công ty. Đi bộ chỉ 10 phút. Gần ga tàu. Mỗi ngày đi bộ đi làm, tiện.','medium',70,1);
echo "  HSK2 L7 done: $HL7v vocab, 2 grammar, 1 dialogue, 1 reading\n";

// ═══ HSK2 L8: 让我想想再告诉你 ═══
$HL8 = createLesson($conn,2,8,'Bài 8: 让我想想再告诉你 - Để tôi nghĩ rồi nói cho bạn','Suy nghĩ, đề nghị. Kiểu câu: 让 (để, nhờ). 再 + V.','["Suy nghĩ","Đề nghị","Nhờ vả"]','Giao tiếp','medium','HSK2 Bài 8: 让 + Người + V (để/cho phép). 再 + V (rồi hãy). 一下 (một chút). Từ vựng suy nghĩ: 想/觉得/认为.');
$HL8v = 0;
v($conn,$HL8,2,'让','ràng','để, cho phép','để','让我想想。','Ràng wǒ xiǎngxiǎng.','Để tôi nghĩ.',++$HL8v);
v($conn,$HL8,2,'告诉','gàosu','nói cho','nói cho','告诉我。','Gàosu wǒ.','Nói cho tôi.',++$HL8v);
v($conn,$HL8,2,'觉得','juéde','cảm thấy, nghĩ','thấy','我觉得不错。','Wǒ juéde búcuò.','Tôi thấy không tệ.',++$HL8v);
v($conn,$HL8,2,'应该','yīnggāi','nên, phải','nên','应该学习。','Yīnggāi xuéxí.','Nên học.',++$HL8v);
v($conn,$HL8,2,'可能','kěnéng','có thể','có thể','可能下雨。','Kěnéng xià yǔ.','Có thể mưa.',++$HL8v);
v($conn,$HL8,2,'问题','wèntí','vấn đề, câu hỏi','vấn đề','没有问题。','Méiyǒu wèntí.','Không có vấn đề.',++$HL8v);
$HL8g1 = g($conn,$HL8,'Câu với 让','让 + Người + V','Để ai làm gì','Sai khiến hoặc cho phép.',1);
ge($conn,$HL8g1,'让我想想。','Ràng wǒ xiǎngxiǎng.','Để tôi nghĩ.',1);
ge($conn,$HL8g1,'让他进来。','Ràng tā jìnlái.','Để anh ấy vào.',2);
$HL8g2 = g($conn,$HL8,'V + 了 + 再 + V','V1 + 了 + 再 + V2','Làm V1 xong rồi V2','Trình tự.',2);
ge($conn,$HL8g2,'吃了再走。','Chī le zài zǒu.','Ăn xong rồi đi.',1);
ge($conn,$HL8g2,'想想再告诉你。','Xiǎngxiǎng zài gàosu nǐ.','Nghĩ rồi nói cho bạn.',2);
$HL8d1 = d($conn,$HL8,'Suy nghĩ','Đề nghị giúp đỡ.',1);
ds($conn,$HL8d1,'小明','这件事你觉得怎么样？','Zhè jiàn shì nǐ juéde zěnmeyàng?','Việc này bạn thấy thế nào?',1);
ds($conn,$HL8d1,'Anna','让我想想。','Ràng wǒ xiǎngxiǎng.','Để tôi nghĩ.',2);
ds($conn,$HL8d1,'小明','好的，想想再告诉我。','Hǎo de,xiǎngxiǎng zài gàosu wǒ.','Được, nghĩ rồi nói cho tôi.',3);
r($conn,$HL8,'Quyết định','朋友问我应不应该去中国学习。我说让我想想。我觉得中国很好，应该去。他说他再想想。','Péngyou wèn wǒ yīng bù yīnggāi qù Zhōngguó xuéxí. Wǒ shuō ràng wǒ xiǎngxiǎng. Wǒ juéde Zhōngguó hěn hǎo,yīnggāi qù. Tā shuō tā zài xiǎngxiǎng.','Bạn hỏi tôi có nên đi TQ học không. Tôi nghĩ TQ tốt, nên đi. Anh ấy bảo nghĩ thêm.','medium',68,1);
echo "  HSK2 L8 done: $HL8v vocab, 2 grammar, 1 dialogue, 1 reading\n";

// ═══ HSK2 L9: 因为他经常帮助别人 ═══
$HL9 = createLesson($conn,2,9,'Bài 9: 因为他经常帮助别人 - Vì anh ấy thường giúp người khác','Giúp đỡ, lý do. 因为 + N/从句. Liên từ phức: 因为...所以..., 虽然...但是...','["Giúp đỡ","Nguyên nhân","Liên từ"]','Xã hội','medium','HSK2 Bài 9: Từ vựng giúp đỡ (帮助,照顾,礼物). 因为 (vì). 虽然...但是...(mặc dù...nhưng). Câu phức.');
$HL9v = 0;
v($conn,$HL9,2,'经常','jīngcháng','thường xuyên','thường','经常帮助。','Jīngcháng bāngzhù.','Thường giúp đỡ.',++$HL9v);
v($conn,$HL9,2,'帮助','bāngzhù','giúp đỡ','giúp','帮助别人。','Bāngzhù biérén.','Giúp người khác.',++$HL9v);
v($conn,$HL9,2,'别人','biérén','người khác','người khác','关心别人。','Guānxīn biérén.','Quan tâm người khác.',++$HL9v);
v($conn,$HL9,2,'关心','guānxīn','quan tâm','quan tâm','关心家人。','Guānxīn jiārén.','Quan tâm gia đình.',++$HL9v);
v($conn,$HL9,2,'照顾','zhàogù','chăm sóc','chăm sóc','照顾老人。','Zhàogù lǎorén.','Chăm sóc người già.',++$HL9v);
v($conn,$HL9,2,'虽然','suīrán','mặc dù','mặc dù','虽然累，但是高兴。','Suīrán lèi,dànshì gāoxìng.','Mặc dù mệt nhưng vui.',++$HL9v);
v($conn,$HL9,2,'但是','dànshì','nhưng','nhưng','但是很好。','Dànshì hěn hǎo.','Nhưng rất tốt.',++$HL9v);
$HL9g1 = g($conn,$HL9,'虽然...但是...','虽然 + A, 但是 + B','Mặc dù A nhưng B','Tương phản.',1);
ge($conn,$HL9g1,'虽然工作忙，但是很高兴。','Suīrán gōngzuò máng,dànshì hěn gāoxìng.','Mặc dù công việc bận nhưng rất vui.',1);
ge($conn,$HL9g1,'虽然远，但是很方便。','Suīrán yuǎn,dànshì hěn fāngbiàn.','Mặc dù xa nhưng rất tiện.',2);
$HL9g2 = g($conn,$HL9,'Tân ngữ kép: 给/送 + Ng + V','V + Ng + N','Ai đó làm gì cho ai','送/给 đều có thể có tân ngữ kép.',2);
ge($conn,$HL9g2,'我送他礼物。','Wǒ sòng tā lǐwù.','Tôi tặng anh ấy quà.',1);
$HL9d1 = d($conn,$HL9,'Giúp đỡ người khác','Nói về tính tốt của bạn.',1);
ds($conn,$HL9d1,'小明','他为什么有很多朋友？','Tā wèishénme yǒu hěnduō péngyou?','Vì sao anh ấy có nhiều bạn?',1);
ds($conn,$HL9d1,'Anna','因为他经常帮助别人。','Yīnwèi tā jīngcháng bāngzhù biérén.','Vì anh ấy thường giúp người khác.',2);
ds($conn,$HL9d1,'小明','虽然忙，但还是帮助别人。','Suīrán máng,dàn háishì bāngzhù biérén.','Mặc dù bận nhưng vẫn giúp người.',3);
r($conn,$HL9,'Người tốt','我的同事很好。虽然工作很忙，但是他经常帮助别人。他关心别人，也照顾家人。所以大家都很喜欢他。','Wǒ de tóngshì hěn hǎo. Suīrán gōngzuò hěn máng,dànshì tā jīngcháng bāngzhù biérén. Tā guānxīn biérén,yě zhàogù jiārén. Suǒyǐ dàjiā dōu hěn xǐhuan tā.','Đồng nghiệp tôi tốt. Dù bận nhưng thường giúp người. Quan tâm mọi người. Mọi người đều quý.','medium',85,1);
echo "  HSK2 L9 done: $HL9v vocab, 2 grammar, 1 dialogue, 1 reading\n";

echo "\n=== HSK2 Lessons 1-9 done. Continuing L10-L15... ===\n\n";

// ═══ HSK2 L10: 别说话了 ═══
$HL10 = createLesson($conn,2,10,'Bài 10: 别说话了 - Đừng nói nữa','Cấm đoán, yêu cầu. 别 + V. 不要 + V. 可以 + V + 吗？','["Cấm đoán","Yêu cầu","Lịch sự"]','Giao tiếp','medium','HSK2 Bài 10: 别 (đừng). 不要 (không nên). 可以...吗？ (được không?). Yêu cầu lịch sự với 请. Từ vựng: 安静,小心,着急.');
$HL10v = 0;
v($conn,$HL10,2,'别','bié','đừng','đừng','别说话。','Bié shuōhuà.','Đừng nói.',++$HL10v);
v($conn,$HL10,2,'说话','shuōhuà','nói chuyện','nói chuyện','上课别说话。','Shàngkè bié shuōhuà.','Đừng nói chuyện trong lớp.',++$HL10v);
v($conn,$HL10,2,'安静','ānjìng','yên tĩnh','yên tĩnh','请安静。','Qǐng ānjìng.','Làm ơn yên lặng.',++$HL10v);
v($conn,$HL10,2,'小心','xiǎoxīn','cẩn thận','cẩn thận','小心！','Xiǎoxīn!','Cẩn thận!',++$HL10v);
v($conn,$HL10,2,'着急','zháojí','sốt ruột, lo lắng','lo','别着急。','Bié zháojí.','Đừng lo.',++$HL10v);
v($conn,$HL10,2,'放心','fàngxīn','yên tâm','yên tâm','放心。','Fàngxīn.','Yên tâm.',++$HL10v);
v($conn,$HL10,2,'慢','màn','chậm','chậm','慢一点。','Màn yì diǎn.','Chậm một chút.',++$HL10v);
v($conn,$HL10,2,'快','kuài','nhanh','nhanh','快走。','Kuài zǒu.','Đi nhanh.',++$HL10v);
$HL10g1 = g($conn,$HL10,'Cấm đoán: 别/不要','别/不要 + V','Đừng...','Cấm đoán hoặc khuyên.',1);
ge($conn,$HL10g1,'别说话了！','Bié shuōhuà le!','Đừng nói nữa!',1);
ge($conn,$HL10g1,'不要着急。','Bú yào zháojí.','Đừng lo lắng.',2);
$HL10g2 = g($conn,$HL10,'Yêu cầu lịch sự','可以 + V + 吗？','Có thể...không?','Xin phép lịch sự.',2);
ge($conn,$HL10g2,'可以进来吗？','Kěyǐ jìnlái ma?','Có thể vào không?',1);
$HL10d1 = d($conn,$HL10,'Trong thư viện','Nhắc nhở trong thư viện.',1);
ds($conn,$HL10d1,'管理员','请安静！别说话。','Qǐng ānjìng! Bié shuōhuà.','Làm ơn yên lặng! Đừng nói chuyện.',1);
ds($conn,$HL10d1,'小明','对不起。','Duìbuqǐ.','Xin lỗi.',2);
ds($conn,$HL10d1,'管理员','别着急，慢慢看书。','Bié zháojí,mànman kàn shū.','Đừng vội, từ từ đọc sách.',3);
r($conn,$HL10,'Thư viện','在图书馆里要安静。管理员说别说话，别跑。我们小心走路，慢慢看书。','Zài túshūguǎn lǐ yào ānjìng. Guǎnlǐyuán shuō bié shuōhuà,bié pǎo. Wǒmen xiǎoxīn zǒulù,mànman kàn shū.','Trong thư viện phải yên lặng. Quản lý bảo đừng nói, đừng chạy.','medium',60,1);
echo "  HSK2 L10 done: $HL10v vocab, 2 grammar, 1 dialogue, 1 reading\n";

// ═══ HSK2 L11: 他比我大三岁 ═══
$HL11 = createLesson($conn,2,11,'Bài 11: 他比我大三岁 - Anh ấy hơn tôi 3 tuổi','So sánh với 比. Mức độ chênh lệch. 没有 + Adj.','["So sánh","Tuổi tác","Hơn/kém"]','So sánh','medium','HSK2 Bài 11: So sánh với 比 (hơn). Chênh lệch: 比 + Adj + Số. 没有 (không bằng). 跟...一样 (giống như).');
$HL11v = 0;
v($conn,$HL11,2,'比','bǐ','hơn','hơn','比他大。','Bǐ tā dà.','Hơn anh ấy.',++$HL11v);
v($conn,$HL11,2,'更','gèng','càng, hơn nữa','càng','更好。','Gèng hǎo.','Tốt hơn.',++$HL11v);
v($conn,$HL11,2,'最','zuì','nhất','nhất','最好。','Zuì hǎo.','Tốt nhất.',++$HL11v);
v($conn,$HL11,2,'一样','yíyàng','giống nhau','giống','一样大。','Yíyàng dà.','Lớn bằng nhau.',++$HL11v);
v($conn,$HL11,2,'高','gāo','cao','cao','很高。','Hěn gāo.','Rất cao.',++$HL11v);
v($conn,$HL11,2,'矮','ǎi','thấp','thấp','很矮。','Hěn ǎi.','Rất thấp.',++$HL11v);
v($conn,$HL11,2,'胖','pàng','béo','béo','有点胖。','Yǒudiǎn pàng.','Hơi béo.',++$HL11v);
v($conn,$HL11,2,'瘦','shòu','gầy','gầy','他很瘦。','Tā hěn shòu.','Anh ấy rất gầy.',++$HL11v);
$HL11g1 = g($conn,$HL11,'So sánh với 比','A + 比 + B + Adj (+ Số)','A hơn B','So sánh hơn.',1);
ge($conn,$HL11g1,'他比我大。','Tā bǐ wǒ dà.','Anh ấy hơn tôi.',1);
ge($conn,$HL11g1,'他比我大三岁。','Tā bǐ wǒ dà sān suì.','Anh ấy hơn tôi 3 tuổi.',2);
$HL11g2 = g($conn,$HL11,'Bằng nhau: 一样','A + 跟/和 + B + 一样 + Adj','A bằng B','So sánh bằng.',2);
ge($conn,$HL11g2,'他和我一样高。','Tā hé wǒ yíyàng gāo.','Anh ấy và tôi cao bằng nhau.',1);
$HL11d1 = d($conn,$HL11,'So sánh tuổi','So sánh tuổi tác.',1);
ds($conn,$HL11d1,'小明','你哥哥比你大几岁？','Nǐ gēge bǐ nǐ dà jǐ suì?','Anh trai bạn hơn bạn mấy tuổi?',1);
ds($conn,$HL11d1,'Anna','他比我大三岁。','Tā bǐ wǒ dà sān suì.','Anh ấy hơn tôi 3 tuổi.',2);
ds($conn,$HL11d1,'小明','你们谁高？','Nǐmen shéi gāo?','Ai cao hơn?',3);
ds($conn,$HL11d1,'Anna','我们一样高。','Wǒmen yíyàng gāo.','Chúng tôi cao bằng nhau.',4);
r($conn,$HL11,'Anh em','我哥哥比我大两岁。他比我高一点。我们长得一样瘦。哥哥学习比我好。他教我做作业。','Wǒ gēge bǐ wǒ dà liǎng suì. Tā bǐ wǒ gāo yì diǎn. Wǒmen zhǎng de yíyàng shòu. Gēge xuéxí bǐ wǒ hǎo. Tā jiāo wǒ zuò zuòyè.','Anh trai hơn tôi 2 tuổi. Cao hơn tôi một chút. Chúng tôi gầy bằng nhau. Anh học tốt hơn.','medium',75,1);
echo "  HSK2 L11 done: $HL11v vocab, 2 grammar, 1 dialogue, 1 reading\n";

// ═══ HSK2 L12: 我们的身体越来越好了 ═══
$HL12 = createLesson($conn,2,12,'Bài 12: 我们的身体越来越好了 - SK chúng ta ngày càng tốt','Sức khỏe, tập thể dục. 越来越... (càng ngày càng). 多/少 + V.','["Sức khỏe","Thể dục","Thay đổi"]','Sức khỏe','medium','HSK2 Bài 12: 越来越 + Adj (càng ngày càng). 多/少 + V (多锻炼,少吃). Biểu thị thay đổi. Sức khỏe: 锻炼,跑步,游泳.');
$HL12v = 0;
v($conn,$HL12,2,'越来越','yuè lái yuè','càng ngày càng','càng ngày','越来越好了。','Yuè lái yuè hǎo le.','Ngày càng tốt.',++$HL12v);
v($conn,$HL12,2,'锻炼','duànliàn','rèn luyện','rèn luyện','锻炼身体。','Duànliàn shēntǐ.','Rèn luyện sức khỏe.',++$HL12v);
v($conn,$HL12,2,'跑步','pǎo bù','chạy bộ','chạy bộ','每天跑步。','Měitiān pǎo bù.','Chạy bộ mỗi ngày.',++$HL12v);
v($conn,$HL12,2,'游泳','yóu yǒng','bơi','bơi','夏天游泳。','Xiàtiān yóu yǒng.','Mùa hè bơi.',++$HL12v);
v($conn,$HL12,2,'健康','jiànkāng','khỏe mạnh','khỏe','身体健康。','Shēntǐ jiànkāng.','Sức khỏe tốt.',++$HL12v);
v($conn,$HL12,2,'感冒','gǎnmào','cảm cúm','cảm','感冒了。','Gǎnmào le.','Bị cảm.',++$HL12v);
v($conn,$HL12,2,'医院','yīyuàn','bệnh viện','bệnh viện','去医院。','Qù yīyuàn.','Đi bệnh viện.',++$HL12v);
v($conn,$HL12,2,'药','yào','thuốc','thuốc','吃药。','Chī yào.','Uống thuốc.',++$HL12v);
$HL12g1 = g($conn,$HL12,'越来越 + Adj','越来越 + Adj','Càng ngày càng...','Thay đổi liên tục.',1);
ge($conn,$HL12g1,'我们的身体越来越好了。','Wǒmen de shēntǐ yuè lái yuè hǎo le.','Sức khỏe chúng tôi ngày càng tốt.',1);
ge($conn,$HL12g1,'天气越来越冷了。','Tiānqì yuè lái yuè lěng le.','Trời càng ngày càng lạnh.',2);
$HL12g2 = g($conn,$HL12,'多/少 + V','多/少 + V','Nhiều/ít hơn...','Thay đổi thói quen.',2);
ge($conn,$HL12g2,'多锻炼。','Duō duànliàn.','Tập thể dục nhiều hơn.',1);
ge($conn,$HL12g2,'少吃药。','Shǎo chī yào.','Uống thuốc ít hơn.',2);
$HL12d1 = d($conn,$HL12,'Sức khỏe','Khuyên bảo về sức khỏe.',1);
ds($conn,$HL12d1,'小明','你身体怎么样？','Nǐ shēntǐ zěnmeyàng?','Sức khỏe bạn thế nào?',1);
ds($conn,$HL12d1,'Anna','越来越好了。每天跑步。','Yuè lái yuè hǎo le. Měitiān pǎo bù.','Ngày càng tốt. Mỗi ngày chạy bộ.',2);
ds($conn,$HL12d1,'小明','多锻炼，少感冒。','Duō duànliàn,shǎo gǎnmào.','Tập nhiều, ít cảm.',3);
r($conn,$HL12,'Tập thể dục','以前我身体不好，常常感冒。现在每天跑步。有时候游泳。身体越来越好了。多吃蔬菜，少吃药。','Yǐqián wǒ shēntǐ bù hǎo,chángcháng gǎnmào. Xiànzài měitiān pǎo bù. Yǒushíhou yóuyǒng. Shēntǐ yuè lái yuè hǎo le. Duō chī shūcài,shǎo chī yào.','Trước SK tôi không tốt, hay cảm. Giờ chạy mỗi ngày. Thỉnh thoảng bơi. SK ngày càng tốt.','medium',82,1);
echo "  HSK2 L12 done: $HL12v vocab, 2 grammar, 1 dialogue, 1 reading\n";

// ═══ HSK2 L13: 门开着呢 ═══
$HL13 = createLesson($conn,2,13,'Bài 13: 门开着呢 - Cửa đang mở','Trạng thái tiếp diễn. V + 着 (đang). 呢 (tiếp diễn). Phân biệt 正在/在 vs 着.','["Trạng thái","Tiếp diễn","Miêu tả"]','Trạng thái','medium','HSK2 Bài 13: V + 着 (đang ở trạng thái). 呢 cuối câu nhấn mạnh. 正在/在 + V (đang làm). Từ vựng: 开/关, 穿/戴, 站/坐.');
$HL13v = 0;
v($conn,$HL13,2,'开','kāi','mở','mở','开门。','Kāi mén.','Mở cửa.',++$HL13v);
v($conn,$HL13,2,'关','guān','đóng','đóng','关门。','Guān mén.','Đóng cửa.',++$HL13v);
v($conn,$HL13,2,'着','zhe','đang (trạng thái)','đang','门开着。','Mén kāi zhe.','Cửa đang mở.',++$HL13v);
v($conn,$HL13,2,'呢','ne','(tiếp diễn/đang)','đang','他睡觉呢。','Tā shuìjiào ne.','Anh ấy đang ngủ.',++$HL13v);
v($conn,$HL13,2,'正在','zhèngzài','đang (hành động)','đang','正在吃饭。','Zhèngzài chīfàn.','Đang ăn cơm.',++$HL13v);
v($conn,$HL13,2,'穿','chuān','mặc (quần áo)','mặc','穿衣服。','Chuān yīfu.','Mặc quần áo.',++$HL13v);
v($conn,$HL13,2,'戴','dài','đeo (kính/mũ)','đeo','戴帽子。','Dài màozi.','Đội mũ.',++$HL13v);
v($conn,$HL13,2,'站','zhàn','đứng','đứng','站着。','Zhàn zhe.','Đang đứng.',++$HL13v);
v($conn,$HL13,2,'坐','zuò','ngồi','ngồi','坐着。','Zuò zhe.','Đang ngồi.',++$HL13v);
$HL13g1 = g($conn,$HL13,'V + 着 (trạng thái)','V + 着','Đang ở trạng thái...','Trạng thái tĩnh.',1);
ge($conn,$HL13g1,'门开着呢。','Mén kāi zhe ne.','Cửa đang mở.',1);
ge($conn,$HL13g1,'他站着。','Tā zhàn zhe.','Anh ấy đang đứng.',2);
$HL13g2 = g($conn,$HL13,'正在 + V + 呢','正在 + V (+ O) + 呢','Đang làm gì...','Hành động đang tiếp diễn.',2);
ge($conn,$HL13g2,'他正在吃饭呢。','Tā zhèngzài chīfàn ne.','Anh ấy đang ăn cơm.',1);
$HL13d1 = d($conn,$HL13,'Miêu tả','Miêu tả trạng thái.',1);
ds($conn,$HL13d1,'小明','门开着呢，请进。','Mén kāi zhe ne,qǐng jìn.','Cửa đang mở, mời vào.',1);
ds($conn,$HL13d1,'Anna','你正在做什么呢？','Nǐ zhèngzài zuò shénme ne?','Bạn đang làm gì vậy?',2);
ds($conn,$HL13d1,'小明','看书呢。你坐吧。','Kàn shū ne. Nǐ zuò ba.','Đang đọc sách. Bạn ngồi đi.',3);
r($conn,$HL13,'Học bài','现在晚上八点。门关着呢。我正在房间看书呢。桌子上放着水杯。我穿着睡衣，坐着看书。','Xiànzài wǎnshang bā diǎn. Mén guān zhe ne. Wǒ zhèngzài fángjiān kàn shū ne. Zhuōzi shang fàng zhe shuǐ bēi. Wǒ chuān zhe shuìyī,zuò zhe kàn shū.','Bây giờ 8h tối. Cửa đang đóng. Tôi đang đọc sách trong phòng. Trên bàn để cốc nước. Mặc pyjama ngồi đọc.','medium',78,1);
echo "  HSK2 L13 done: $HL13v vocab, 2 grammar, 1 dialogue, 1 reading\n";

// ═══ HSK2 L14: 你看过这部电影吗 ═══
$HL14 = createLesson($conn,2,14,'Bài 14: 你看过这部电影吗 - Bạn từng xem phim này chưa?','Kinh nghiệm với 过. Đã từng. 还没...呢. Điện ảnh, giải trí nâng cao.','["Kinh nghiệm","Phim ảnh","Chưa từng"]','Giải trí','medium','HSK2 Bài 14: V + 过 (từng). 还没...呢 (chưa từng). Từ vựng điện ảnh: 电影,故事,演员. Hỏi kinh nghiệm.');
$HL14v = 0;
v($conn,$HL14,2,'过','guò','đã từng','đã từng','去过。','Qù guò.','Đã từng đi.',++$HL14v);
v($conn,$HL14,2,'电影','diànyǐng','phim','phim','看电影。','Kàn diànyǐng.','Xem phim.',++$HL14v);
v($conn,$HL14,2,'故事','gùshì','câu chuyện','chuyện','好故事。','Hǎo gùshì.','Câu chuyện hay.',++$HL14v);
v($conn,$HL14,2,'演员','yǎnyuán','diễn viên','diễn viên','好演员。','Hǎo yǎnyuán.','Diễn viên giỏi.',++$HL14v);
v($conn,$HL14,2,'票','piào','vé','vé','买票。','Mǎi piào.','Mua vé.',++$HL14v);
v($conn,$HL14,2,'已经','yǐjīng','đã (rồi)','đã','已经看了。','Yǐjīng kàn le.','Đã xem rồi.',++$HL14v);
v($conn,$HL14,2,'还没','hái méi','vẫn chưa','chưa','还没看。','Hái méi kàn.','Vẫn chưa xem.',++$HL14v);
$HL14g1 = g($conn,$HL14,'V + 过 (kinh nghiệm)','S + V + 过 + O','Đã từng...','Kinh nghiệm, không phải hành động cụ thể.',1);
ge($conn,$HL14g1,'你看过这部电影吗？','Nǐ kàn guò zhè bù diànyǐng ma?','Bạn từng xem phim này chưa?',1);
ge($conn,$HL14g1,'我去过北京。','Wǒ qù guò Běijīng.','Tôi từng đi Bắc Kinh.',2);
$HL14g2 = g($conn,$HL14,'还没...呢','还没 + V + 呢','Vẫn chưa...','Phủ định kinh nghiệm.',2);
ge($conn,$HL14g2,'我还没看过呢。','Wǒ hái méi kàn guò ne.','Tôi chưa xem bao giờ.',1);
$HL14d1 = d($conn,$HL14,'Hỏi về phim','Nói về phim ảnh.',1);
ds($conn,$HL14d1,'小明','你看过中国电影吗？','Nǐ kàn guò Zhōngguó diànyǐng ma?','Bạn từng xem phim TQ chưa?',1);
ds($conn,$HL14d1,'Anna','看过几次。很好看。','Kàn guò jǐ cì. Hěn hǎokàn.','Xem vài lần. Rất hay.',2);
ds($conn,$HL14d1,'小明','我还没看过呢，介绍一部吧。','Wǒ hái méi kàn guò ne,jièshào yí bù ba.','Tôi chưa xem bao giờ, giới thiệu một bộ đi.',3);
r($conn,$HL14,'Xem phim','朋友介绍了一部中国电影。故事很好。演员也很好。我还没看过，打算星期六去看。已经买了票。','Péngyou jièshào le yí bù Zhōngguó diànyǐng. Gùshì hěn hǎo. Yǎnyuán yě hěn hǎo. Wǒ hái méi kàn guò,dǎsuàn xīngqī liù qù kàn. Yǐjīng mǎi le piào.','Bạn giới thiệu phim TQ. Câu chuyện hay. Diễn viên giỏi. Tôi chưa xem, định thứ 7 đi xem. Đã mua vé.','medium',68,1);
echo "  HSK2 L14 done: $HL14v vocab, 2 grammar, 1 dialogue, 1 reading\n";

// ═══ HSK2 L15: 新年快乐 ═══
$HL15 = createLesson($conn,2,15,'Bài 15: 新年快乐 - Chúc mừng năm mới','Tổng hợp HSK2. Ngày Tết, phong tục. Chúc mừng. Tổng kết.','["Lễ Tết","Chúc mừng","Tổng kết"]','Lễ Tết','medium','HSK2 Bài 15: Tết Trung Quốc. Chúc Tết: 新年快乐. Phong tục: 红包,春联,放鞭炮. Tổng kết kiến thức HSK2.');
$HL15v = 0;
v($conn,$HL15,2,'新年','xīnnián','năm mới','năm mới','新年好！','Xīnnián hǎo!','Chúc mừng năm mới!',++$HL15v);
v($conn,$HL15,2,'春节','chūnjié','Tết Nguyên Đán','Tết','春节快乐。','Chūnjié kuàilè.','Chúc Tết vui vẻ.',++$HL15v);
v($conn,$HL15,2,'红包','hóngbāo','bao lì xì','lì xì','给红包。','Gěi hóngbāo.','Cho lì xì.',++$HL15v);
v($conn,$HL15,2,'礼物','lǐwù','quà tặng','quà','送礼物。','Sòng lǐwù.','Tặng quà.',++$HL15v);
v($conn,$HL15,2,'快乐','kuàilè','vui vẻ','vui','新年快乐！','Xīnnián kuàilè!','Chúc mừng năm mới!',++$HL15v);
v($conn,$HL15,2,'幸福','xìngfú','hạnh phúc','hạnh phúc','祝你幸福。','Zhù nǐ xìngfú.','Chúc bạn hạnh phúc.',++$HL15v);
v($conn,$HL15,2,'希望','xīwàng','hy vọng','hy vọng','希望明年更好。','Xīwàng míngnián gèng hǎo.','Hy vọng năm sau tốt hơn.',++$HL15v);
$HL15g1 = g($conn,$HL15,'Tổng kết cấu trúc so sánh','比/没有/一样','So sánh hơn/kém/bằng','Tổng kết.',1);
ge($conn,$HL15g1,'新年比去年好。','Xīnnián bǐ qùnián hǎo.','Năm mới tốt hơn năm ngoái.',1);
$HL15g2 = g($conn,$HL15,'Tổng kết 着/过/了','着(đang)/过(đã từng)/了(rồi)','Tổng kết 3 trợ từ động thái.','Phân biệt rõ nghĩa.',2);
ge($conn,$HL15g2,'我学过汉语了。','Wǒ xué guò Hànyǔ le.','Tôi đã từng học TQ rồi.',1);
$HL15d1 = d($conn,$HL15,'Chúc Tết','Mừng năm mới Trung Quốc.',1);
ds($conn,$HL15d1,'小明','新年快乐！祝你身体健康！','Xīnnián kuàilè! Zhù nǐ shēntǐ jiànkāng!','Chúc mừng năm mới! Chúc bạn sức khỏe!',1);
ds($conn,$HL15d1,'Anna','新年快乐！这是给你的礼物。','Xīnnián kuàilè! Zhè shì gěi nǐ de lǐwù.','Chúc mừng năm mới! Đây là quà cho bạn.',2);
ds($conn,$HL15d1,'小明','谢谢！希望明年我们去中国旅游。','Xièxie! Xīwàng míngnián wǒmen qù Zhōngguó lǚyóu.','Cảm ơn! Hy vọng năm sau chúng ta đi TQ du lịch.',3);
r($conn,$HL15,'Tết Trung Quốc','春节是中国人最重要的节日。新年大家送红包。说"新年快乐"。说"身体健康"。我们学了一年的汉语。明年去中国。','Chūnjié shì Zhōngguó rén zuì zhòngyào de jiérì. Xīnnián dàjiā sòng hóngbāo. Shuō "xīnnián kuàilè". Shuō "shēntǐ jiànkāng". Wǒmen xué le yì nián de Hànyǔ. Míngnián qù Zhōngguó.','Tết là lễ quan trọng nhất của người TQ. Mọi người lì xì. Nói "chúc mừng năm mới", "sức khỏe". Chúng tôi học TQ một năm. Năm sau đi TQ.','medium',85,1);
$HL15l = l($conn,$HL15,'Tổng kết cuối','A:你学了多久汉语了？B:学了两年了。A:你的汉语越来越好。B:谢谢！新年快乐！','A:Nǐ xué le duōjiǔ Hànyǔ le? B:Xué le liǎng nián le. A:Nǐ de Hànyǔ yuè lái yuè hǎo. B:Xièxie! Xīnnián kuàilè!','A:Học TQ bao lâu? B:2 năm. A:TQ ngày càng tốt. B:Cảm ơn! Chúc mừng năm mới!','15');
lq($conn,$HL15l,'Người B học TQ bao lâu?','{"A":"1 năm","B":"2 năm","C":"3 năm"}','2 năm','Hai năm.','multiple_choice',1);
$E15_1 = e($conn,$HL15,'Chọn','"Chúc mừng năm mới" là:','multiple_choice','medium',1,'A',1);
eo($conn,$E15_1,'新年快乐','A',1,1); eo($conn,$E15_1,'生日快乐','B',0,2); eo($conn,$E15_1,'节日快乐','C',0,3);
$E15_2 = e($conn,$HL15,'Dịch','"Chúc bạn sức khỏe tốt."','translation','medium',1,'祝你身体健康。',2);
echo "  HSK2 L15 done: $HL15v vocab, 2 grammar, 1 dialogue, 1 reading, 1 listening, 2 exercises\n";

echo "\n=== HSK2 COMPLETE (15 lessons) ===\n\n";
echo "\n=== ALL HSK1+2 DATA SEEDED SUCCESSFULLY! ===\n\n";
echo "HSK1: 15 lessons, ~180 vocabulary, ~33 grammar points\n";
echo "HSK2: 15 lessons, ~130 vocabulary, ~28 grammar points\n";
echo "Total: 30 lessons\n";




