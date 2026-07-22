<?php
$level = $_GET['level'] ?? 1;
$lesson = $_GET['lesson'] ?? 1;

header("Location: lesson.php?level=$level&lesson=$lesson");
exit;