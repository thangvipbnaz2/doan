<?php
namespace App\Controllers\Admin;

use App\Helpers\Database;
use App\Helpers\Session;

class DialogueController extends BaseController
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

        $total = Database::fetch("SELECT COUNT(*) as cnt FROM dialogues {$where}", $params)['cnt'] ?? 0;
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $offset = ($page - 1) * $perPage;

        $dialogues = Database::fetchAll(
            "SELECT d.*, l.title as lesson_title FROM dialogues d LEFT JOIN lessons l ON d.lesson_id = l.id {$where} ORDER BY d.lesson_id, d.id LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        $lessons = Database::fetchAll("SELECT id, title, level, lesson_num FROM lessons ORDER BY level, lesson_num");

        $this->adminView('dialogues/index', [
            'dialogues' => $dialogues,
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
        $this->adminView('dialogues/form', ['dialogue' => null, 'lessons' => $lessons]);
    }

    public function store(): void
    {
        $data = [
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'title' => $_POST['title'] ?? '',
            'context' => $_POST['context'] ?? '',
        ];

        $dialogueId = Database::insert('dialogues', $data);

        if (!empty($_POST['sentences'])) {
            foreach ($_POST['sentences'] as $order => $sentence) {
                if (!empty($sentence['speaker']) && !empty($sentence['chinese'])) {
                    Database::insert('dialogue_sentences', [
                        'dialogue_id' => $dialogueId,
                        'speaker' => $sentence['speaker'],
                        'chinese' => $sentence['chinese'],
                        'pinyin' => $sentence['pinyin'] ?? '',
                        'vietnamese' => $sentence['vietnamese'] ?? '',
                        'sort_order' => $order,
                    ]);
                }
            }
        }

        Session::flash('success', 'Hội thoại đã được tạo thành công.');
        $this->adminRedirect('admin/dialogues');
    }

    public function edit(int $id): void
    {
        $dialogue = Database::fetch("SELECT * FROM dialogues WHERE id = ?", [$id]);
        if (!$dialogue) {
            Session::flash('error', 'Không tìm thấy hội thoại.');
            $this->adminRedirect('admin/dialogues');
        }
        $sentences = Database::fetchAll("SELECT * FROM dialogue_sentences WHERE dialogue_id = ? ORDER BY sort_order", [$id]);
        $lessons = Database::fetchAll("SELECT id, title, level, lesson_num FROM lessons ORDER BY level, lesson_num");
        $this->adminView('dialogues/form', [
            'dialogue' => $dialogue,
            'sentences' => $sentences,
            'lessons' => $lessons,
        ]);
    }

    public function update(int $id): void
    {
        $data = [
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'title' => $_POST['title'] ?? '',
            'context' => $_POST['context'] ?? '',
        ];

        Database::update('dialogues', $data, 'id = :id', ['id' => $id]);

        Database::delete('dialogue_sentences', 'dialogue_id = ?', [$id]);
        if (!empty($_POST['sentences'])) {
            foreach ($_POST['sentences'] as $order => $sentence) {
                if (!empty($sentence['speaker']) && !empty($sentence['chinese'])) {
                    Database::insert('dialogue_sentences', [
                        'dialogue_id' => $id,
                        'speaker' => $sentence['speaker'],
                        'chinese' => $sentence['chinese'],
                        'pinyin' => $sentence['pinyin'] ?? '',
                        'vietnamese' => $sentence['vietnamese'] ?? '',
                        'sort_order' => $order,
                    ]);
                }
            }
        }

        Session::flash('success', 'Hội thoại đã được cập nhật.');
        $this->adminRedirect('admin/dialogues');
    }

    public function delete(int $id): void
    {
        Database::delete('dialogue_sentences', 'dialogue_id = ?', [$id]);
        Database::delete('dialogues', 'id = ?', [$id]);
        Session::flash('success', 'Hội thoại đã được xóa.');
        $this->adminRedirect('admin/dialogues');
    }
}
