<?php
namespace App\Controllers\Admin;

use App\Helpers\Database;
use App\Helpers\Session;

class GrammarController extends BaseController
{
    public function index(): void
    {
        $lessonId = (int) ($_GET['lesson_id'] ?? 0);
        $page = (int) ($_GET['page'] ?? 1);
        $perPage = 20;

        $where = '';
        $params = [];
        if ($lessonId > 0) {
            $where = 'WHERE lesson_id = ?';
            $params[] = $lessonId;
        }

        $total = Database::fetch("SELECT COUNT(*) as cnt FROM grammar {$where}", $params)['cnt'] ?? 0;
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $offset = ($page - 1) * $perPage;

        $grammar = Database::fetchAll(
            "SELECT g.*, l.title as lesson_title FROM grammar g LEFT JOIN lessons l ON g.lesson_id = l.id {$where} ORDER BY g.lesson_id, g.id LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        $lessons = Database::fetchAll("SELECT id, title, level, lesson_num FROM lessons ORDER BY level, lesson_num");

        $this->adminView('grammar/index', [
            'grammar' => $grammar,
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
        $this->adminView('grammar/form', ['grammar' => null, 'lessons' => $lessons]);
    }

    public function store(): void
    {
        $data = [
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'title' => $_POST['title'] ?? '',
            'formula' => $_POST['formula'] ?? '',
            'meaning' => $_POST['meaning'] ?? '',
            'usage' => $_POST['usage'] ?? '',
            'notes' => $_POST['notes'] ?? '',
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ];

        Database::insert('grammar', $data);
        Session::flash('success', 'Ngữ pháp đã được thêm thành công.');
        $this->adminRedirect('admin/grammar');
    }

    public function edit(int $id): void
    {
        $grammar = Database::fetch("SELECT * FROM grammar WHERE id = ?", [$id]);
        if (!$grammar) {
            Session::flash('error', 'Không tìm thấy ngữ pháp.');
            $this->adminRedirect('admin/grammar');
        }
        $lessons = Database::fetchAll("SELECT id, title, level, lesson_num FROM lessons ORDER BY level, lesson_num");
        $this->adminView('grammar/form', ['grammar' => $grammar, 'lessons' => $lessons]);
    }

    public function update(int $id): void
    {
        $data = [
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'title' => $_POST['title'] ?? '',
            'formula' => $_POST['formula'] ?? '',
            'meaning' => $_POST['meaning'] ?? '',
            'usage' => $_POST['usage'] ?? '',
            'notes' => $_POST['notes'] ?? '',
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ];

        Database::update('grammar', $data, 'id = :id', ['id' => $id]);
        Session::flash('success', 'Ngữ pháp đã được cập nhật.');
        $this->adminRedirect('admin/grammar');
    }

    public function delete(int $id): void
    {
        Database::delete('grammar', 'id = ?', [$id]);
        Session::flash('success', 'Ngữ pháp đã được xóa.');
        $this->adminRedirect('admin/grammar');
    }
}
