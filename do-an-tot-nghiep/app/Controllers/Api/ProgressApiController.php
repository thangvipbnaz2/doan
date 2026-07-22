<?php
namespace App\Controllers\Api;

use App\Helpers\Database;
use App\Helpers\Session;

class ProgressApiController extends BaseApiController
{
    public function get(): void
    {
        $this->requireAuth();
        $userId = Session::get('user_id');

        $lessonsCompleted = Database::fetch(
            "SELECT COUNT(*) as cnt FROM lesson_progress WHERE user_id = ? AND is_completed = 1",
            [$userId]
        )['cnt'] ?? 0;

        $vocabLearned = Database::fetch(
            "SELECT COUNT(*) as cnt FROM progress WHERE user_id = ? AND is_completed = 1 AND vocab_id IS NOT NULL",
            [$userId]
        )['cnt'] ?? 0;

        $streak = 0;
        $d = new \DateTime();
        for ($i = 0; $i < 365; $i++) {
            $check = Database::fetch(
                "SELECT id FROM study_logs WHERE user_id = ? AND DATE(logged_at) = ?",
                [$userId, $d->format('Y-m-d')]
            );
            if ($check) { $streak++; $d->modify('-1 day'); } else break;
        }

        $totalTime = Database::fetch(
            "SELECT COALESCE(SUM(duration_seconds), 0) as total FROM study_logs WHERE user_id = ?",
            [$userId]
        )['total'] ?? 0;

        $this->json([
            'success' => true,
            'data' => [
                'lessons_completed' => (int) $lessonsCompleted,
                'vocab_learned' => (int) $vocabLearned,
                'streak_days' => $streak,
                'total_study_seconds' => (int) $totalTime,
            ]
        ]);
    }

    public function sync(): void
    {
        $this->requireAuth();
        $userId = Session::get('user_id');
        $input = $this->getJsonInput();

        $type = $input['type'] ?? '';
        $referenceId = (int) ($input['reference_id'] ?? 0);
        $score = $input['score'] ?? null;
        $duration = (int) ($input['duration_seconds'] ?? 0);

        if (empty($type)) {
            $this->error('Type is required');
        }

        Database::insert('study_logs', [
            'user_id' => $userId,
            'activity_type' => $type,
            'reference_id' => $referenceId ?: null,
            'duration_seconds' => $duration ?: null,
            'score' => $score !== null ? (float) $score : null,
        ]);

        // Update streak via study log insert
        $this->json(['success' => true]);
    }
}
