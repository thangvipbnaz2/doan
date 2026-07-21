<?php
namespace App\Controllers\Api;

use App\Helpers\Database;

class VocabApiController extends BaseApiController
{
    public function list(): void
    {
        $page = (int) ($_GET['page'] ?? 1);
        $perPage = (int) ($_GET['per_page'] ?? 20);
        $offset = ($page - 1) * $perPage;

        $total = Database::fetch("SELECT COUNT(*) as cnt FROM vocab")['cnt'] ?? 0;
        $items = Database::fetchAll("SELECT * FROM vocab ORDER BY level, id LIMIT {$perPage} OFFSET {$offset}");

        $this->json([
            'data' => $items,
            'total' => (int) $total,
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    public function search(): void
    {
        $q = $_GET['q'] ?? '';
        if (strlen($q) < 1) {
            $this->error('Query parameter "q" is required');
        }

        $items = Database::fetchAll(
            "SELECT * FROM vocab WHERE hanzi LIKE ? OR pinyin LIKE ? OR meaning LIKE ? LIMIT 50",
            ["%{$q}%", "%{$q}%", "%{$q}%"]
        );

        $this->json(['data' => $items, 'total' => count($items)]);
    }

    public function byLevel(string $level): void
    {
        $page = (int) ($_GET['page'] ?? 1);
        $perPage = (int) ($_GET['per_page'] ?? 50);
        $offset = ($page - 1) * $perPage;

        $total = Database::fetch("SELECT COUNT(*) as cnt FROM vocab WHERE level = ?", [$level])['cnt'] ?? 0;
        $items = Database::fetchAll(
            "SELECT * FROM vocab WHERE level = ? ORDER BY id LIMIT {$perPage} OFFSET {$offset}",
            [$level]
        );

        $this->json([
            'data' => $items,
            'total' => (int) $total,
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    public function byLesson(int $lessonId): void
    {
        $items = Database::fetchAll("SELECT * FROM vocab WHERE lesson_id = ? ORDER BY id", [$lessonId]);
        $this->json(['data' => $items, 'total' => count($items)]);
    }
}
