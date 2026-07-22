<?php
namespace App\Controllers\Frontend;

use App\Controllers\Controller;
use App\Helpers\Database;
use App\Helpers\Session;

class FavoriteController extends Controller
{
    public function index(): void
    {
        $userId = Session::get('user_id');
        if (!$userId) {
            $this->redirect('login.php');
            return;
        }

        $words = Database::fetchAll(
            "SELECT v.*, fw.created_at as favorited_at
             FROM favorite_words fw
             JOIN vocab v ON fw.vocab_id = v.id
             WHERE fw.user_id = ?
             ORDER BY fw.created_at DESC",
            [$userId]
        );

        $lessons = Database::fetchAll(
            "SELECT l.*, fl.created_at as favorited_at
             FROM favorite_lessons fl
             JOIN lessons l ON fl.lesson_id = l.id
             WHERE fl.user_id = ?
             ORDER BY fl.created_at DESC",
            [$userId]
        );

        $this->view('frontend/favorite/index', [
            'words' => $words,
            'lessons' => $lessons,
        ]);
    }
}
