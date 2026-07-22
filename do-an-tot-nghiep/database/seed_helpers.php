<?php
/**
 * HÀNNGỮ - Shared helpers for HSK1-6 seeds
 * Include before running any level seed.
 */
if (!function_exists('getOrCreateLevel')) {
function getOrCreateLevel($conn,$level,$name,$nameVi,$desc,$totalVocab,$totalLessons) {
    $stmt=$conn->prepare("SELECT id FROM hsk_levels WHERE `level`=?");
    $stmt->execute([$level]);
    if ($id=$stmt->fetchColumn()) return $id;
    $ins=$conn->prepare("INSERT INTO hsk_levels (`level`,`name`,`name_vi`,`description`,`total_vocab`,`total_lessons`,`sort_order`,`is_active`) VALUES (?,?,?,?,?,?,?,1)");
    $ins->execute([$level,$name,$nameVi,$desc,$totalVocab,$totalLessons,$level]);
    echo "  Created HSK level $level: $name\n"; return $conn->lastInsertId();
}}

if (!function_exists('createLesson')) {
function createLesson($conn,$hskLevel,$lessonNum,$title,$description,$objectivesJson,$topic,$difficulty,$summary) {
    $stmt=$conn->prepare("INSERT IGNORE INTO lessons (hsk_level,lesson_num,title,description,objectives,topic,duration_minutes,difficulty,`status`,sort_order,summary) VALUES (?,?,?,?,?,?,45,?,'published',?,?)");
    $stmt->execute([$hskLevel,$lessonNum,$title,$description,$objectivesJson,$topic,$difficulty,$lessonNum,$summary]);
    if ($stmt->rowCount()>0) return $conn->lastInsertId();
    $chk=$conn->prepare("SELECT id FROM lessons WHERE hsk_level=? AND lesson_num=?");
    $chk->execute([$hskLevel,$lessonNum]);
    return $chk->fetchColumn();
}}

if (!function_exists('v')) {
function v($conn,$lid,$l,$h,$p,$m,$mv,$e,$ep,$ev,$wt,$rn,$so) {
    $stmt=$conn->prepare("INSERT IGNORE INTO vocabulary (lesson_id,hsk_level,hanzi,pinyin,meaning,meaning_vi,example,example_pinyin,example_vi,word_type,review_notes,sort_order,is_active) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,1)");
    $stmt->execute([$lid,$l,$h,$p,$m,$mv,$e,$ep,$ev,$wt,$rn,$so]);
    if ($stmt->rowCount()>0) return $conn->lastInsertId();
    $chk=$conn->prepare("SELECT id FROM vocabulary WHERE hanzi=? AND lesson_id=?");
    $chk->execute([$h,$lid]); return $chk->fetchColumn();
}}

if (!function_exists('g')) {
function g($conn,$lid,$t,$f,$m,$mv,$u,$n,$so) {
    $stmt=$conn->prepare("INSERT INTO grammar (lesson_id,title,formula,meaning,meaning_vi,`usage`,notes,sort_order,is_active) VALUES (?,?,?,?,?,?,?,?,1)");
    $stmt->execute([$lid,$t,$f,$m,$mv,$u,$n,$so]); return $conn->lastInsertId();
}}

if (!function_exists('ge')) {
function ge($conn,$gid,$cn,$py,$vi,$so) {
    $conn->prepare("INSERT INTO grammar_examples (grammar_id,example_cn,example_pinyin,example_vi,sort_order) VALUES (?,?,?,?,?)")->execute([$gid,$cn,$py,$vi,$so]);
}}

if (!function_exists('d')) {
function d($conn,$lid,$t,$cv,$vi,$so) {
    $stmt=$conn->prepare("INSERT INTO dialogues (lesson_id,title,context,context_vi,sort_order,is_active) VALUES (?,?,?,?,?,1)");
    $stmt->execute([$lid,$t,$cv,$vi,$so]); return $conn->lastInsertId();
}}

if (!function_exists('ds')) {
function ds($conn,$did,$s,$c,$p,$v,$so) {
    $conn->prepare("INSERT INTO dialogue_sentences (dialogue_id,speaker,chinese,pinyin,vietnamese,sort_order) VALUES (?,?,?,?,?,?)")->execute([$did,$s,$c,$p,$v,$so]);
}}

if (!function_exists('r')) {
function r($conn,$lid,$t,$c,$p,$tr,$df,$wc,$so) {
    $stmt=$conn->prepare("INSERT INTO reading (lesson_id,title,content,pinyin,translation,difficulty,word_count,sort_order,is_active) VALUES (?,?,?,?,?,?,?,?,1)");
    $stmt->execute([$lid,$t,$c,$p,$tr,$df,$wc,$so]); return $conn->lastInsertId();
}}

if (!function_exists('l')) {
function l($conn,$lid,$t,$tr,$tp,$tv,$so) {
    $stmt=$conn->prepare("INSERT INTO listening_exercises (lesson_id,title,audio_url,transcript,transcript_pinyin,transcript_vi,sort_order,is_active) VALUES (?,?,'',?,?,?,?,1)");
    $stmt->execute([$lid,$t,$tr,$tp,$tv,$so]); return $conn->lastInsertId();
}}

if (!function_exists('lq')) {
function lq($conn,$lid,$q,$oj,$ca,$e,$t,$so) {
    $conn->prepare("INSERT INTO listening_questions (listening_id,question,options,correct_answer,explanation,type,sort_order) VALUES (?,?,?,?,?,?,?)")->execute([$lid,$q,$oj,$ca,$e,$t,$so]);
}}

if (!function_exists('e')) {
function e($conn,$lid,$t,$i,$ty,$df,$p,$ca,$so) {
    $stmt=$conn->prepare("INSERT INTO exercises (lesson_id,title,instruction,type,difficulty,points,correct_answer,sort_order,is_active) VALUES (?,?,?,?,?,?,?,?,1)");
    $stmt->execute([$lid,$t,$i,$ty,$df,$p,$ca,$so]); return $conn->lastInsertId();
}}

if (!function_exists('eo')) {
function eo($conn,$eid,$ot,$ol,$ic,$so) {
    $conn->prepare("INSERT INTO exercise_options (exercise_id,option_text,option_label,is_correct,sort_order) VALUES (?,?,?,?,?)")->execute([$eid,$ot,$ol,$ic,$so]);
}}

if (!function_exists('rv')) {
function rv($conn,$lid,$vid,$rt,$so) {
    $conn->prepare("INSERT IGNORE INTO review_vocabulary (lesson_id,vocab_id,review_type,sort_order) VALUES (?,?,?,?)")->execute([$lid,$vid,$rt,$so]);
}}

if (!function_exists('clearLevel')) {
function clearLevel($conn,$level) {
    $ls=$conn->prepare("SELECT id FROM lessons WHERE hsk_level=?");
    $ls->execute([$level]); $ids=$ls->fetchAll(PDO::FETCH_COLUMN);
    if (empty($ids)) return;
    $in=implode(',',$ids);
    foreach (['review_vocabulary','listening_questions','listening_exercises','reading','dialogue_sentences','dialogues','grammar_examples','grammar','exercise_options','exercises'] as $t) {
        $conn->exec("DELETE FROM $t WHERE lesson_id IN ($in)");
    }
    $conn->exec("DELETE FROM vocabulary WHERE hsk_level=$level");
    $conn->exec("DELETE FROM lessons WHERE hsk_level=$level");
}}
