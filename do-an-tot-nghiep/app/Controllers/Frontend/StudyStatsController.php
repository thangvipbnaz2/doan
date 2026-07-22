<?php
namespace App\Controllers\Frontend;

use App\Controllers\Controller;
use App\Helpers\Database;
use App\Helpers\Session;
use App\Helpers\View;

class StudyStatsController extends Controller
{
    public function __construct()
    {
        $userId = Session::get('user_id');
        if (!$userId) {
            Session::flash('error', 'Vui lòng đăng nhập để xem thống kê.');
            header('Location: ' . View::baseUrl() . '/login.php');
            exit;
        }
    }

    public function index(): void
    {
        $userId = Session::get('user_id');

        $totalStudyTime = Database::fetch(
            "SELECT COALESCE(SUM(duration_seconds), 0) as total FROM study_logs WHERE user_id = ?",
            [$userId]
        )['total'] ?? 0;

        $lessonsCompleted = Database::fetch(
            "SELECT COUNT(*) as cnt FROM lesson_progress WHERE user_id = ? AND is_completed = 1",
            [$userId]
        )['cnt'] ?? 0;

        $vocabLearned = Database::fetch(
            "SELECT COUNT(*) as cnt FROM progress WHERE user_id = ? AND is_completed = 1 AND vocab_id IS NOT NULL",
            [$userId]
        )['cnt'] ?? 0;

        $exercisesDone = Database::fetch(
            "SELECT COUNT(*) as cnt FROM exercise_answers WHERE user_id = ?",
            [$userId]
        )['cnt'] ?? 0;

        $examResults = Database::fetchAll(
            "SELECT er.*, e.title as exam_title FROM exam_results er JOIN exams e ON er.exam_id = e.id WHERE er.user_id = ? ORDER BY er.created_at DESC LIMIT 10",
            [$userId]
        );

        $activityByDay = Database::fetchAll(
            "SELECT DATE(logged_at) as date, COUNT(*) as count, SUM(duration_seconds) as total_time FROM study_logs WHERE user_id = ? AND logged_at > DATE_SUB(NOW(), INTERVAL 30 DAY) GROUP BY DATE(logged_at) ORDER BY date",
            [$userId]
        );

        $this->view('frontend/study_stats/index', [
            'totalStudyTime' => $totalStudyTime,
            'lessonsCompleted' => $lessonsCompleted,
            'vocabLearned' => $vocabLearned,
            'exercisesDone' => $exercisesDone,
            'examResults' => $examResults,
            'activityByDay' => $activityByDay,
        ]);
    }
}
