<?php
namespace App\Controllers\Frontend;

use App\Controllers\Controller;
use App\Helpers\Database;
use App\Helpers\Session;

class DashboardController extends Controller
{
    public function __construct()
    {
        $userId = Session::get('user_id');
        if (!$userId) {
            Session::flash('error', 'Vui lòng đăng nhập để xem bảng điều khiển.');
            header('Location: ' . \App\Helpers\View::baseUrl() . '/login.php');
            exit;
        }
    }

    public function index(): void
    {
        $userId = Session::get('user_id');

        $stats = [
            'lessons_completed' => Database::fetch("SELECT COUNT(*) as cnt FROM lesson_progress WHERE user_id = ? AND is_completed = 1", [$userId])['cnt'] ?? 0,
            'total_lessons' => Database::fetch("SELECT COUNT(*) as cnt FROM lessons")['cnt'] ?? 0,
            'vocab_learned' => Database::fetch("SELECT COUNT(*) as cnt FROM progress WHERE user_id = CONCAT('user_', ?) AND (write_completed = 1 OR speech_completed = 1)", [$userId])['cnt'] ?? 0,
            'streak_days' => Database::fetch("SELECT COUNT(*) as cnt FROM daily_streak WHERE user_id = CONCAT('user_', ?)", [$userId])['cnt'] ?? 0,
            'average_score' => Database::fetch("SELECT AVG(score * 100.0 / total_questions) as avg_score FROM quiz_results WHERE user_id = CONCAT('user_', ?) AND total_questions > 0", [$userId])['avg_score'] ?? 0,
        ];

        $recentActivity = Database::fetchAll(
            "SELECT lp.*, l.title as lesson_title FROM lesson_progress lp JOIN lessons l ON lp.lesson_id = l.id WHERE lp.user_id = ? ORDER BY lp.updated_at DESC LIMIT 10",
            [$userId]
        );

        $achievements = Database::fetchAll(
            "SELECT * FROM achievements WHERE user_id = ? ORDER BY unlocked_at DESC",
            [$userId]
        );

        $currentLevel = Database::fetch(
            "SELECT level FROM lesson_progress lp JOIN lessons l ON lp.lesson_id = l.id WHERE lp.user_id = ? AND lp.is_completed = 1 ORDER BY l.level DESC LIMIT 1",
            [$userId]
        );

        $this->view('frontend/dashboard/index', [
            'stats' => $stats,
            'recentActivity' => $recentActivity,
            'achievements' => $achievements,
            'currentLevel' => $currentLevel['level'] ?? 'HSK1',
        ]);
    }
}
