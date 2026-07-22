<?php
namespace App\Controllers\Admin;

use App\Helpers\Database;
use App\Helpers\Session;

class ExamController extends BaseController
{
    public function index(): void
    {
        $level = (int) ($_GET['level'] ?? 0);
        $page = (int) ($_GET['page'] ?? 1);
        $perPage = 20;

        $conditions = [];
        $params = [];

        if ($level > 0) {
            $conditions[] = 'et.level = ?';
            $params[] = $level;
        }

        $where = '';
        if (!empty($conditions)) {
            $where = 'WHERE ' . implode(' AND ', $conditions);
        }

        $total = Database::fetch("SELECT COUNT(*) as cnt FROM exam_templates et {$where}", $params)['cnt'] ?? 0;
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $offset = ($page - 1) * $perPage;

        $templates = Database::fetchAll(
            "SELECT et.* FROM exam_templates et {$where} ORDER BY et.id LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        $this->adminView('exam/index', [
            'templates' => $templates,
            'level' => $level,
            'page' => $page,
            'lastPage' => $lastPage,
            'total' => $total,
        ]);
    }

    public function create(): void
    {
        $this->adminView('exam/form', ['exam' => null, 'editing' => false]);
    }

    public function store(): void
    {
        $data = [
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'level' => $_POST['level'] ?? '',
            'title' => $_POST['title'] ?? '',
            'duration_minutes' => (int) ($_POST['duration_minutes'] ?? 0),
            'total_questions' => (int) ($_POST['total_questions'] ?? 0),
            'passing_score' => (int) ($_POST['passing_score'] ?? 0),
        ];

        Database::insert('exam_templates', $data);
        Session::flash('success', 'Đề thi đã được thêm thành công.');
        $this->adminRedirect('admin/exam');
    }

    public function edit(int $id): void
    {
        $exam = Database::fetch("SELECT * FROM exam_templates WHERE id = ?", [$id]);
        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->adminRedirect('admin/exam');
        }
        $this->adminView('exam/form', ['exam' => $exam, 'editing' => true]);
    }

    public function update(int $id): void
    {
        $data = [
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'level' => $_POST['level'] ?? '',
            'title' => $_POST['title'] ?? '',
            'duration_minutes' => (int) ($_POST['duration_minutes'] ?? 0),
            'total_questions' => (int) ($_POST['total_questions'] ?? 0),
            'passing_score' => (int) ($_POST['passing_score'] ?? 0),
        ];

        Database::update('exam_templates', $data, 'id = :id', ['id' => $id]);
        Session::flash('success', 'Đề thi đã được cập nhật.');
        $this->adminRedirect('admin/exam');
    }

    public function delete(int $id): void
    {
        Database::delete('exam_templates', 'id = ?', [$id]);
        Session::flash('success', 'Đề thi đã được xóa.');
        $this->adminRedirect('admin/exam');
    }

    public function questions(int $examId): void
    {
        $exam = Database::fetch("SELECT * FROM exam_templates WHERE id = ?", [$examId]);
        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->adminRedirect('admin/exam');
        }

        $questions = Database::fetchAll(
            "SELECT * FROM exam_questions WHERE exam_id = ? ORDER BY section, sort_order, id",
            [$examId]
        );

        $this->adminView('exam/questions', [
            'exam' => $exam,
            'questions' => $questions,
        ]);
    }

    public function questionAdd(): void
    {
        $examId = (int) ($_POST['exam_id'] ?? 0);
        $data = [
            'exam_id' => $examId,
            'section' => $_POST['section'] ?? 'reading',
            'question' => $_POST['question'] ?? '',
            'options' => $_POST['options'] ?? '',
            'answer' => $_POST['answer'] ?? '',
            'explanation' => $_POST['explanation'] ?? '',
            'points' => (int) ($_POST['points'] ?? 1),
        ];

        Database::insert('exam_questions', $data);
        Session::flash('success', 'Câu hỏi đã được thêm.');
        $this->adminRedirect('admin/exam/questions/' . $examId);
    }

    public function questionDelete(int $questionId): void
    {
        $q = Database::fetch("SELECT exam_id FROM exam_questions WHERE id = ?", [$questionId]);
        $examId = $q ? (int) $q['exam_id'] : 0;
        Database::delete('exam_questions', 'id = ?', [$questionId]);
        Session::flash('success', 'Câu hỏi đã được xóa.');
        $this->adminRedirect('admin/exam/questions/' . $examId);
    }
}
