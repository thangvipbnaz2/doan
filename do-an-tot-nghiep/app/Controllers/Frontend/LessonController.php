<?php
namespace App\Controllers\Frontend;

use App\Controllers\Controller;
use App\Helpers\Database;
use App\Helpers\Session;

class LessonController extends Controller
{
    public function index(?int $level = null): void
    {
        $level = $level ?? $_GET['level'] ?? '';

        $where = '';
        $params = [];
        if ($level !== '') {
            $where = 'WHERE level = ?';
            $params[] = $level;
        }

        $lessons = Database::fetchAll(
            "SELECT l.*, (SELECT COUNT(*) FROM vocab WHERE lesson_id = l.id) as vocab_count FROM lessons l {$where} ORDER BY l.level, l.lesson_num"
        );

        $levels = Database::fetchAll("SELECT DISTINCT level FROM lessons ORDER BY level");

        $this->view('frontend/lesson/index', [
            'lessons' => $lessons,
            'levels' => $levels,
            'currentLevel' => $level,
        ]);
    }

    public function show(int $id): void
    {
        $lesson = Database::fetch("SELECT * FROM lessons WHERE id = ?", [$id]);
        if (!$lesson) {
            http_response_code(404);
            include __DIR__ . '/../../../404.php';
            exit;
        }

        $vocab = Database::fetchAll("SELECT * FROM vocab WHERE lesson_id = ?", [$id]);

        $grammar = Database::fetchAll(
            "SELECT g.*, ge.id as ex_id, ge.example_cn, ge.example_pinyin, ge.example_vi, ge.audio_url as ex_audio, ge.sort_order as ex_sort
             FROM grammar g
             LEFT JOIN grammar_examples ge ON ge.grammar_id = g.id
             WHERE g.lesson_id = ?
             ORDER BY g.sort_order, ge.sort_order", [$id]
        );
        $grammarList = $grammar;

        $dialogues = Database::fetchAll("SELECT * FROM dialogues WHERE lesson_id = ? ORDER BY sort_order", [$id]);
        foreach ($dialogues as $i => $dialogue) {
            $dialogues[$i]['sentences'] = Database::fetchAll(
                "SELECT * FROM dialogue_sentences WHERE dialogue_id = ? ORDER BY sort_order",
                [$dialogue['id']]
            );
        }

        $reading = Database::fetch("SELECT * FROM readings WHERE lesson_id = ?", [$id]);

        $listening = Database::fetch("SELECT * FROM listening_exercises WHERE lesson_id = ?", [$id]);
        if ($listening) {
            $listening['questions'] = Database::fetchAll(
                "SELECT * FROM listening_questions WHERE listening_id = ? ORDER BY sort_order",
                [$listening['id']]
            );
        }

        $speaking = Database::fetchAll("SELECT * FROM speaking_exercises WHERE lesson_id = ? ORDER BY sort_order", [$id]);
        $writing = Database::fetchAll("SELECT * FROM writing_exercises WHERE lesson_id = ? ORDER BY sort_order", [$id]);

        $gIds = Database::fetchAll("SELECT id FROM grammar WHERE lesson_id = ?", [$id]);
        $gIds = array_column($gIds, 'id');
        $exercises = [];
        if (!empty($gIds)) {
            $placeholders = implode(',', array_fill(0, count($gIds), '?'));
            $exercises = Database::fetchAll(
                "SELECT * FROM grammar_exercises WHERE grammar_id IN ($placeholders) ORDER BY sort_order", $gIds
            );
        }

        $prevLesson = Database::fetch(
            "SELECT id, title FROM lessons WHERE (level = ? AND lesson_num < ?) OR (level < ? AND lesson_num = (SELECT MAX(lesson_num) FROM lessons WHERE level < ?)) ORDER BY level DESC, lesson_num DESC LIMIT 1",
            [$lesson['level'], $lesson['lesson_num'], $lesson['level'], $lesson['level']]
        );
        if (!$prevLesson) {
            $prevLesson = Database::fetch(
                "SELECT id, title FROM lessons WHERE level = ? AND lesson_num = (SELECT MAX(lesson_num) FROM lessons WHERE level = ? AND lesson_num < ?)",
                [$lesson['level'], $lesson['level'], $lesson['lesson_num']]
            );
        }

        $nextLesson = Database::fetch(
            "SELECT id, title FROM lessons WHERE (level = ? AND lesson_num > ?) OR (level > ? AND lesson_num = 1) ORDER BY level ASC, lesson_num ASC LIMIT 1",
            [$lesson['level'], $lesson['lesson_num'], $lesson['level']]
        );

        $progress = null;
        $userId = Session::get('user_id');
        if ($userId) {
            $progress = Database::fetch(
                "SELECT * FROM lesson_progress WHERE user_id = ? AND lesson_id = ?",
                [$userId, $id]
            );
        }

        $this->view('frontend/lesson/show', [
            'lesson' => $lesson,
            'vocab' => $vocab,
            'grammarList' => $grammarList,
            'dialogues' => $dialogues,
            'reading' => $reading,
            'listening' => $listening,
            'speaking' => $speaking,
            'writing' => $writing,
            'exercises' => $exercises,
            'prevLesson' => $prevLesson,
            'nextLesson' => $nextLesson,
            'progress' => $progress,
        ]);
    }
}
