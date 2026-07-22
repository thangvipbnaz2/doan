<?php
namespace App\Controllers\Admin;

use App\Helpers\Database;
use App\Helpers\Session;

class SpeakingController extends BaseController
{
    public function index(?int $lessonId = null): void
    {
        $lessonId = $lessonId ?? (int) ($_GET['lesson_id'] ?? 0);
        $page = (int) ($_GET['page'] ?? 1);
        $perPage = 20;

        $conditions = [];
        $params = [];

        if ($lessonId > 0) {
            $conditions[] = 'se.lesson_id = ?';
            $params[] = $lessonId;
        }

        $where = '';
        if (!empty($conditions)) {
            $where = 'WHERE ' . implode(' AND ', $conditions);
        }

        $total = Database::fetch("SELECT COUNT(*) as cnt FROM speaking_exercises se {$where}", $params)['cnt'] ?? 0;
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $offset = ($page - 1) * $perPage;

        $exercises = Database::fetchAll(
            "SELECT se.*, l.title as lesson_title FROM speaking_exercises se LEFT JOIN lessons l ON se.lesson_id = l.id {$where} ORDER BY se.sort_order, se.id LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        $lessons = Database::fetchAll("SELECT id, title, level, lesson_num FROM lessons ORDER BY level, lesson_num");

        $this->adminView('speaking/index', [
            'exercises' => $exercises,
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
        $this->adminView('speaking/form', ['exercise' => null, 'lessons' => $lessons]);
    }

    public function store(): void
    {
        $data = [
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'instruction' => $_POST['instruction'] ?? '',
            'target_text' => $_POST['target_text'] ?? '',
            'target_pinyin' => $_POST['target_pinyin'] ?? '',
            'audio_reference' => $_POST['audio_reference'] ?? '',
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ];

        Database::insert('speaking_exercises', $data);
        Session::flash('success', 'Bài nói đã được thêm thành công.');
        $this->adminRedirect('admin/speaking');
    }

    public function edit(int $id): void
    {
        $exercise = Database::fetch("SELECT * FROM speaking_exercises WHERE id = ?", [$id]);
        if (!$exercise) {
            Session::flash('error', 'Không tìm thấy bài nói.');
            $this->adminRedirect('admin/speaking');
        }
        $lessons = Database::fetchAll("SELECT id, title, level, lesson_num FROM lessons ORDER BY level, lesson_num");
        $this->adminView('speaking/form', ['exercise' => $exercise, 'lessons' => $lessons]);
    }

    public function update(int $id): void
    {
        $data = [
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'instruction' => $_POST['instruction'] ?? '',
            'target_text' => $_POST['target_text'] ?? '',
            'target_pinyin' => $_POST['target_pinyin'] ?? '',
            'audio_reference' => $_POST['audio_reference'] ?? '',
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ];

        Database::update('speaking_exercises', $data, 'id = :id', ['id' => $id]);
        Session::flash('success', 'Bài nói đã được cập nhật.');
        $this->adminRedirect('admin/speaking');
    }

    public function delete(int $id): void
    {
        Database::delete('speaking_exercises', 'id = ?', [$id]);
        Session::flash('success', 'Bài nói đã được xóa.');
        $this->adminRedirect('admin/speaking');
    }
}
