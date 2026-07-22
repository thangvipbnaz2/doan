<?php
namespace App\Controllers\Admin;

use App\Helpers\Database;
use App\Helpers\Session;

class ListeningController extends BaseController
{
    public function index(?int $lessonId = null): void
    {
        $lessonId = $lessonId ?? (int) ($_GET['lesson_id'] ?? 0);
        $page = (int) ($_GET['page'] ?? 1);
        $perPage = 20;

        $conditions = [];
        $params = [];

        if ($lessonId > 0) {
            $conditions[] = 'le.lesson_id = ?';
            $params[] = $lessonId;
        }

        $where = '';
        if (!empty($conditions)) {
            $where = 'WHERE ' . implode(' AND ', $conditions);
        }

        $total = Database::fetch("SELECT COUNT(*) as cnt FROM listening_exercises le {$where}", $params)['cnt'] ?? 0;
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $offset = ($page - 1) * $perPage;

        $exercises = Database::fetchAll(
            "SELECT le.*, l.title as lesson_title FROM listening_exercises le LEFT JOIN lessons l ON le.lesson_id = l.id {$where} ORDER BY le.sort_order, le.id LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        $lessons = Database::fetchAll("SELECT id, title, level, lesson_num FROM lessons ORDER BY level, lesson_num");

        $this->adminView('listening/index', [
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
        $this->adminView('listening/form', ['exercise' => null, 'lessons' => $lessons]);
    }

    public function store(): void
    {
        $data = [
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'title' => $_POST['title'] ?? '',
            'audio_url' => $_POST['audio_url'] ?? '',
            'transcript' => $_POST['transcript'] ?? '',
            'transcript_pinyin' => $_POST['transcript_pinyin'] ?? '',
            'transcript_vi' => $_POST['transcript_vi'] ?? '',
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ];

        Database::insert('listening_exercises', $data);
        Session::flash('success', 'Bài nghe đã được thêm thành công.');
        $this->adminRedirect('admin/listening');
    }

    public function edit(int $id): void
    {
        $exercise = Database::fetch("SELECT * FROM listening_exercises WHERE id = ?", [$id]);
        if (!$exercise) {
            Session::flash('error', 'Không tìm thấy bài nghe.');
            $this->adminRedirect('admin/listening');
        }
        $lessons = Database::fetchAll("SELECT id, title, level, lesson_num FROM lessons ORDER BY level, lesson_num");
        $this->adminView('listening/form', ['exercise' => $exercise, 'lessons' => $lessons]);
    }

    public function update(int $id): void
    {
        $data = [
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'title' => $_POST['title'] ?? '',
            'audio_url' => $_POST['audio_url'] ?? '',
            'transcript' => $_POST['transcript'] ?? '',
            'transcript_pinyin' => $_POST['transcript_pinyin'] ?? '',
            'transcript_vi' => $_POST['transcript_vi'] ?? '',
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ];

        Database::update('listening_exercises', $data, 'id = :id', ['id' => $id]);
        Session::flash('success', 'Bài nghe đã được cập nhật.');
        $this->adminRedirect('admin/listening');
    }

    public function delete(int $id): void
    {
        Database::delete('listening_exercises', 'id = ?', [$id]);
        Session::flash('success', 'Bài nghe đã được xóa.');
        $this->adminRedirect('admin/listening');
    }
}
