<?php
namespace App\Controllers\Admin;

use App\Helpers\Database;
use App\Helpers\Session;

class WritingController extends BaseController
{
    public function index(?int $lessonId = null): void
    {
        $lessonId = $lessonId ?? (int) ($_GET['lesson_id'] ?? 0);
        $page = (int) ($_GET['page'] ?? 1);
        $perPage = 20;

        $conditions = [];
        $params = [];

        if ($lessonId > 0) {
            $conditions[] = 'we.lesson_id = ?';
            $params[] = $lessonId;
        }

        $where = '';
        if (!empty($conditions)) {
            $where = 'WHERE ' . implode(' AND ', $conditions);
        }

        $total = Database::fetch("SELECT COUNT(*) as cnt FROM writing_exercises we {$where}", $params)['cnt'] ?? 0;
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $offset = ($page - 1) * $perPage;

        $exercises = Database::fetchAll(
            "SELECT we.*, l.title as lesson_title FROM writing_exercises we LEFT JOIN lessons l ON we.lesson_id = l.id {$where} ORDER BY we.sort_order, we.id LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        $lessons = Database::fetchAll("SELECT id, title, level, lesson_num FROM lessons ORDER BY level, lesson_num");

        $this->adminView('writing/index', [
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
        $this->adminView('writing/form', ['exercise' => null, 'lessons' => $lessons]);
    }

    public function store(): void
    {
        $data = [
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'character_char' => $_POST['character_char'] ?? '',
            'stroke_count' => (int) ($_POST['stroke_count'] ?? 0),
            'radical' => $_POST['radical'] ?? '',
            'stroke_animation_svg' => $_POST['stroke_animation_svg'] ?? '',
            'stroke_order_image' => $_POST['stroke_order_image'] ?? '',
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ];

        Database::insert('writing_exercises', $data);
        Session::flash('success', 'Bài viết đã được thêm thành công.');
        $this->adminRedirect('admin/writing');
    }

    public function edit(int $id): void
    {
        $exercise = Database::fetch("SELECT * FROM writing_exercises WHERE id = ?", [$id]);
        if (!$exercise) {
            Session::flash('error', 'Không tìm thấy bài viết.');
            $this->adminRedirect('admin/writing');
        }
        $lessons = Database::fetchAll("SELECT id, title, level, lesson_num FROM lessons ORDER BY level, lesson_num");
        $this->adminView('writing/form', ['exercise' => $exercise, 'lessons' => $lessons]);
    }

    public function update(int $id): void
    {
        $data = [
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'character_char' => $_POST['character_char'] ?? '',
            'stroke_count' => (int) ($_POST['stroke_count'] ?? 0),
            'radical' => $_POST['radical'] ?? '',
            'stroke_animation_svg' => $_POST['stroke_animation_svg'] ?? '',
            'stroke_order_image' => $_POST['stroke_order_image'] ?? '',
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ];

        Database::update('writing_exercises', $data, 'id = :id', ['id' => $id]);
        Session::flash('success', 'Bài viết đã được cập nhật.');
        $this->adminRedirect('admin/writing');
    }

    public function delete(int $id): void
    {
        Database::delete('writing_exercises', 'id = ?', [$id]);
        Session::flash('success', 'Bài viết đã được xóa.');
        $this->adminRedirect('admin/writing');
    }
}
