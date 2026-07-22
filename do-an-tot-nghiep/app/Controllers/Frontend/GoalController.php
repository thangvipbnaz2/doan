<?php
namespace App\Controllers\Frontend;

use App\Controllers\Controller;
use App\Helpers\Database;
use App\Helpers\Session;

class GoalController extends Controller
{
    public function index(): void
    {
        $userId = Session::get('user_id');
        if (!$userId) {
            $this->redirect('login.php');
            return;
        }

        $goal = Database::fetch("SELECT * FROM user_goals WHERE user_id = ?", [$userId]);

        $stats = [];
        $stats['lessons_completed'] = Database::fetch(
            "SELECT COUNT(*) as cnt FROM lesson_progress WHERE user_id = ? AND is_completed = 1", [$userId]
        )['cnt'] ?? 0;
        $stats['vocab_learned'] = Database::fetch(
            "SELECT COUNT(*) as cnt FROM progress WHERE user_id = ? AND write_completed = 1", [$userId]
        )['cnt'] ?? 0;
        $streak = 0;
        $d = new \DateTime();
        for ($i = 0; $i < 365; $i++) {
            $check = Database::fetch("SELECT id FROM daily_streak WHERE user_id = ? AND streak_date = ?", [$userId, $d->format('Y-m-d')]);
            if ($check) { $streak++; $d->modify('-1 day'); } else break;
        }
        $stats['streak_days'] = $streak;

        $this->view('frontend/goal/index', [
            'goal' => $goal,
            'stats' => $stats,
        ]);
    }

    public function save(): void
    {
        $userId = Session::get('user_id');
        if (!$userId) {
            $this->redirect('login.php');
            return;
        }

        $data = [
            'user_id' => $userId,
            'target_hsk_level' => (int) ($_POST['target_hsk_level'] ?? 0) ?: null,
            'daily_goal_minutes' => (int) ($_POST['daily_goal_minutes'] ?? 30),
            'daily_vocab_goal' => (int) ($_POST['daily_vocab_goal'] ?? 10),
            'start_date' => $_POST['start_date'] ?: date('Y-m-d'),
        ];

        $existing = Database::fetch("SELECT id FROM user_goals WHERE user_id = ?", [$userId]);
        if ($existing) {
            Database::query("UPDATE user_goals SET target_hsk_level = ?, daily_goal_minutes = ?, daily_vocab_goal = ?, start_date = ? WHERE user_id = ?", [
                $data['target_hsk_level'], $data['daily_goal_minutes'], $data['daily_vocab_goal'], $data['start_date'], $userId
            ]);
        } else {
            Database::insert('user_goals', $data);
        }

        Session::flash('success', 'Mục tiêu đã được lưu.');
        $this->redirect('goals');
    }
}
