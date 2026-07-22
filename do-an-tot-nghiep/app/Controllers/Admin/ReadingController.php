<?php
namespace App\Controllers\Admin;

use App\Helpers\Database;
use App\Helpers\Session;

class ReadingController extends BaseController
{
    public function index(?int $lessonId = null): void
    {
        $lessonId = $lessonId ?? (int) ($_GET['lesson_id'] ?? 0);
        $page = (int) ($_GET['page'] ?? 1);
        $perPage = 20;

        $conditions = [];
        $params = [];

        if ($lessonId > 0) {
            $conditions[] = 'r.lesson_id = ?';
            $params[] = $lessonId;
        }

        $where = '';
        if (!empty($conditions)) {
            $where = 'WHERE ' . implode(' AND ', $conditions);
        }

        $total = Database::fetch("SELECT COUNT(*) as cnt FROM readings r {$where}", $params)['cnt'] ?? 0;
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $offset = ($page - 1) * $perPage;

        $readings = Database::fetchAll(
            "SELECT r.*, l.title as lesson_title FROM readings r LEFT JOIN lessons l ON r.lesson_id = l.id {$where} ORDER BY r.sort_order, r.id LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        $lessons = Database::fetchAll("SELECT id, title, level, lesson_num FROM lessons ORDER BY level, lesson_num");

        $this->adminView('readings/index', [
            'readings' => $readings,
            'lessonId' => $lessonId,
            'lessons' => $lessons,
            'page' => $page,
            'lastPage' => $lastPage,
            'total' => $total,
        ]);
    }

    public function create(): void
    {
        $lessons = Database::fetchAll("SELECT id, title, level, lesson_num FROM lessons ORDER BY level, lesson_num");
        $this->adminView('readings/form', ['reading' => null, 'lessons' => $lessons]);
    }

    public function store(): void
    {
        $data = [
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'title' => $_POST['title'] ?? '',
            'content' => $_POST['content'] ?? '',
            'pinyin' => $_POST['pinyin'] ?? '',
            'translation' => $_POST['translation'] ?? '',
            'vocabulary_notes' => $_POST['vocabulary_notes'] ?? '',
            'audio_url' => $_POST['audio_url'] ?? '',
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ];

        Database::insert('readings', $data);
        Session::flash('success', 'Bài đọc đã được thêm thành công.');
        $this->adminRedirect('admin/reading');
    }

    public function edit(int $id): void
    {
        $reading = Database::fetch("SELECT * FROM readings WHERE id = ?", [$id]);
        if (!$reading) {
            Session::flash('error', 'Không tìm thấy bài đọc.');
            $this->adminRedirect('admin/reading');
        }
        $lessons = Database::fetchAll("SELECT id, title, level, lesson_num FROM lessons ORDER BY level, lesson_num");
        $this->adminView('readings/form', ['reading' => $reading, 'lessons' => $lessons]);
    }

    public function update(int $id): void
    {
        $data = [
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'title' => $_POST['title'] ?? '',
            'content' => $_POST['content'] ?? '',
            'pinyin' => $_POST['pinyin'] ?? '',
            'translation' => $_POST['translation'] ?? '',
            'vocabulary_notes' => $_POST['vocabulary_notes'] ?? '',
            'audio_url' => $_POST['audio_url'] ?? '',
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ];

        Database::update('readings', $data, 'id = :id', ['id' => $id]);
        Session::flash('success', 'Bài đọc đã được cập nhật.');
        $this->adminRedirect('admin/reading');
    }

    public function delete(int $id): void
    {
        Database::delete('readings', 'id = ?', [$id]);
        Session::flash('success', 'Bài đọc đã được xóa.');
        $this->adminRedirect('admin/reading');
    }
}
