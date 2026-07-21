<?php
namespace App\Controllers\Frontend;

use App\Controllers\Controller;
use App\Helpers\Database;

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
        $grammar = Database::fetchAll("SELECT * FROM grammar WHERE lesson_id = ?", [$id]);
        $dialogues = Database::fetchAll("SELECT * FROM dialogues WHERE lesson_id = ?", [$id]);
        foreach ($dialogues as $i => $dialogue) {
            $dialogues[$i]['sentences'] = Database::fetchAll(
                "SELECT * FROM dialogue_sentences WHERE dialogue_id = ? ORDER BY sort_order",
                [$dialogue['id']]
            );
        }

        $reading = Database::fetch("SELECT * FROM reading_passages WHERE lesson_id = ?", [$id]);
        $listening = Database::fetch("SELECT * FROM listening_exercises WHERE lesson_id = ?", [$id]);

        $exercises = Database::fetchAll("SELECT * FROM exercises WHERE lesson_id = ?", [$id]);

        $this->view('frontend/lesson/show', [
            'lesson' => $lesson,
            'vocab' => $vocab,
            'grammar' => $grammar,
            'dialogues' => $dialogues,
            'reading' => $reading,
            'listening' => $listening,
            'exercises' => $exercises,
        ]);
    }
}
