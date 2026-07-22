<?php
namespace App\Controllers\Admin;

use App\Helpers\Database;
use App\Helpers\Session;

class LessonController extends BaseController
{
    public function index(): void
    {
        $level = $_GET['level'] ?? '';
        $page = (int) ($_GET['page'] ?? 1);
        $perPage = 20;

        $where = '';
        $params = [];
        if ($level !== '') {
            $where = 'WHERE level = ?';
            $params[] = $level;
        }

        $total = Database::fetch("SELECT COUNT(*) as cnt FROM lessons {$where}", $params)['cnt'] ?? 0;
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $offset = ($page - 1) * $perPage;

        $lessons = Database::fetchAll(
            "SELECT l.*, (SELECT COUNT(*) FROM vocab WHERE lesson_id = l.id) as vocab_count FROM lessons l {$where} ORDER BY l.level, l.lesson_num LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        $this->adminView('lessons/index', [
            'lessons' => $lessons,
            'level' => $level,
            'page' => $page,
            'lastPage' => $lastPage,
            'total' => $total,
        ]);
    }

    public function create(): void
    {
        $this->adminView('lessons/form', ['lesson' => null]);
    }

    public function store(): void
    {
        $data = [
            'level' => $_POST['level'] ?? '',
            'lesson_num' => (int) ($_POST['lesson_num'] ?? 0),
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'type' => $_POST['type'] ?? 'vocabulary',
        ];

        Database::insert('lessons', $data);
        Session::flash('success', 'Bài học đã được tạo thành công.');
        $this->adminRedirect('admin/lessons');
    }

    public function edit(int $id): void
    {
        $lesson = Database::fetch("SELECT l.*, (SELECT COUNT(*) FROM vocab WHERE lesson_id = l.id) as vocab_count FROM lessons l WHERE l.id = ?", [$id]);
        if (!$lesson) {
            Session::flash('error', 'Không tìm thấy bài học.');
            $this->adminRedirect('admin/lessons');
        }
        $this->adminView('lessons/form', ['lesson' => $lesson]);
    }

    public function update(int $id): void
    {
        $data = [
            'level' => $_POST['level'] ?? '',
            'lesson_num' => (int) ($_POST['lesson_num'] ?? 0),
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'type' => $_POST['type'] ?? 'vocabulary',
        ];

        Database::update('lessons', $data, 'id = :id', ['id' => $id]);
        Session::flash('success', 'Bài học đã được cập nhật.');
        $this->adminRedirect('admin/lessons');
    }

    public function delete(int $id): void
    {
        Database::delete('lessons', 'id = ?', [$id]);
        Session::flash('success', 'Bài học đã được xóa.');
        $this->adminRedirect('admin/lessons');
    }

    public function manageSections(int $lessonId): void
    {
        $lesson = Database::fetch("SELECT * FROM lessons WHERE id = ?", [$lessonId]);
        if (!$lesson) {
            Session::flash('error', 'Không tìm thấy bài học.');
            $this->adminRedirect('admin/lessons');
        }

        $vocab = Database::fetchAll("SELECT * FROM vocab WHERE lesson_id = ?", [$lessonId]);
        $grammar = Database::fetchAll("SELECT * FROM grammar WHERE lesson_id = ?", [$lessonId]);
        $dialogues = Database::fetchAll("SELECT * FROM dialogues WHERE lesson_id = ?", [$lessonId]);

        $this->adminView('lessons/sections', [
            'lesson' => $lesson,
            'vocab' => $vocab,
            'grammar' => $grammar,
            'dialogues' => $dialogues,
        ]);
    }
}
