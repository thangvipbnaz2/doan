<?php
namespace App\Controllers\Api;

use App\Helpers\Database;
use App\Helpers\Session;

class FlashcardApiController extends BaseApiController
{
    public function due(): void
    {
        $this->requireAuth();
        $userId = Session::get('user_id');

        $dueCards = Database::fetchAll(
            "SELECT f.*, v.hanzi, v.pinyin, v.meaning, v.example, v.example_vi
             FROM flashcards f
             JOIN vocabulary v ON f.vocab_id = v.id
             WHERE f.user_id = ? AND f.is_active = 1 AND (f.next_review_at IS NULL OR f.next_review_at <= CURDATE())
             ORDER BY f.next_review_at ASC, f.id ASC
             LIMIT 20",
            [$userId]
        );

        $this->json(['success' => true, 'data' => $dueCards, 'total' => count($dueCards)]);
    }

    public function review(): void
    {
        $this->requireAuth();
        $userId = Session::get('user_id');
        $input = $this->getJsonInput();

        $flashcardId = (int) ($input['flashcard_id'] ?? 0);
        $quality = (int) ($input['quality'] ?? 0);

        if ($flashcardId === 0 || $quality < 0 || $quality > 5) {
            $this->error('Invalid input. flashcard_id required, quality 0-5');
        }

        $card = Database::fetch(
            "SELECT * FROM flashcards WHERE id = ? AND user_id = ?",
            [$flashcardId, $userId]
        );

        if (!$card) {
            $this->error('Flashcard not found', 404);
        }

        $ease = (float) $card['ease_factor'];
        $interval = (int) $card['interval_days'];
        $consecutive = (int) $card['consecutive_correct'];

        if ($quality < 3) {
            $interval = 1;
            $consecutive = 0;
        } else {
            $consecutive++;
            if ($interval === 0) {
                $interval = 1;
            } elseif ($interval === 1) {
                $interval = 3;
            } else {
                $interval = (int) round($interval * $ease);
            }
            $ease += (0.1 - (5 - $quality) * (0.08 + (5 - $quality) * 0.02));
            if ($ease < 1.3) $ease = 1.3;
        }

        Database::insert('flashcard_reviews', [
            'flashcard_id' => $flashcardId,
            'quality' => $quality,
        ]);

        Database::update('flashcards', [
            'ease_factor' => $ease,
            'interval_days' => $interval,
            'consecutive_correct' => $consecutive,
            'review_count' => (int) $card['review_count'] + 1,
            'next_review_at' => date('Y-m-d', strtotime("+{$interval} days")),
            'last_reviewed_at' => date('Y-m-d H:i:s'),
        ], 'id = :id', ['id' => $flashcardId]);

        $this->json(['success' => true, 'next_interval' => $interval, 'ease_factor' => $ease]);
    }
}
