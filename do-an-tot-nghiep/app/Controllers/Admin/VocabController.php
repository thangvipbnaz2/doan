<?php
namespace App\Controllers\Admin;

use App\Helpers\Database;
use App\Helpers\Session;

class VocabController extends BaseController
{
    public function index(?int $lessonId = null): void
    {
        $level = $_GET['level'] ?? '';
        $lessonId = $lessonId ?? (int) ($_GET['lesson_id'] ?? 0);
        $page = (int) ($_GET['page'] ?? 1);
        $perPage = 20;

        $conditions = [];
        $params = [];

        if ($lessonId > 0) {
            $conditions[] = 'v.lesson_id = ?';
            $params[] = $lessonId;
        }
        if ($level !== '') {
            $conditions[] = 'v.level = ?';
            $params[] = $level;
        }

        $where = '';
        if (!empty($conditions)) {
            $where = 'WHERE ' . implode(' AND ', $conditions);
        }

        $total = Database::fetch("SELECT COUNT(*) as cnt FROM vocab v {$where}", $params)['cnt'] ?? 0;
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $offset = ($page - 1) * $perPage;

        $vocab = Database::fetchAll(
            "SELECT v.*, l.title as lesson_title FROM vocab v LEFT JOIN lessons l ON v.lesson_id = l.id {$where} ORDER BY v.level, v.id LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        $lessons = Database::fetchAll("SELECT id, title, level, lesson_num FROM lessons ORDER BY level, lesson_num");

        $this->adminView('vocab/index', [
            'vocab' => $vocab,
            'level' => $level,
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
        $this->adminView('vocab/form', ['vocab' => null, 'lessons' => $lessons]);
    }

    public function store(): void
    {
        $data = [
            'hanzi' => $_POST['hanzi'] ?? '',
            'pinyin' => $_POST['pinyin'] ?? '',
            'meaning' => $_POST['meaning'] ?? '',
            'level' => $_POST['level'] ?? '',
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'strokes' => (int) ($_POST['strokes'] ?? 0),
            'radical' => $_POST['radical'] ?? '',
            'example' => $_POST['example'] ?? '',
            'example_vi' => $_POST['example_vi'] ?? '',
        ];

        Database::insert('vocab', $data);
        Session::flash('success', 'Từ vựng đã được thêm thành công.');
        $this->redirect('/do-an-tot-nghiep/admin/vocab');
    }

    public function edit(int $id): void
    {
        $vocab = Database::fetch("SELECT * FROM vocab WHERE id = ?", [$id]);
        if (!$vocab) {
            Session::flash('error', 'Không tìm thấy từ vựng.');
            $this->redirect('/do-an-tot-nghiep/admin/vocab');
        }
        $lessons = Database::fetchAll("SELECT id, title, level, lesson_num FROM lessons ORDER BY level, lesson_num");
        $this->adminView('vocab/form', ['vocab' => $vocab, 'lessons' => $lessons]);
    }

    public function update(int $id): void
    {
        $data = [
            'hanzi' => $_POST['hanzi'] ?? '',
            'pinyin' => $_POST['pinyin'] ?? '',
            'meaning' => $_POST['meaning'] ?? '',
            'level' => $_POST['level'] ?? '',
            'lesson_id' => (int) ($_POST['lesson_id'] ?? 0),
            'strokes' => (int) ($_POST['strokes'] ?? 0),
            'radical' => $_POST['radical'] ?? '',
            'example' => $_POST['example'] ?? '',
            'example_vi' => $_POST['example_vi'] ?? '',
        ];

        Database::update('vocab', $data, 'id = :id', ['id' => $id]);
        Session::flash('success', 'Từ vựng đã được cập nhật.');
        $this->redirect('/do-an-tot-nghiep/admin/vocab');
    }

    public function delete(int $id): void
    {
        Database::delete('vocab', 'id = ?', [$id]);
        Session::flash('success', 'Từ vựng đã được xóa.');
        $this->redirect('/do-an-tot-nghiep/admin/vocab');
    }

    public function import(): void
    {
        if ($this->isPost() && isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if ($ext === 'csv') {
                $handle = fopen($file['tmp_name'], 'r');
                $header = fgetcsv($handle);
                $imported = 0;
                while (($row = fgetcsv($handle)) !== false) {
                    $data = array_combine($header, $row);
                    Database::insert('vocab', [
                        'hanzi' => $data['hanzi'] ?? '',
                        'pinyin' => $data['pinyin'] ?? '',
                        'meaning' => $data['meaning'] ?? '',
                        'level' => $data['level'] ?? '',
                        'lesson_id' => (int) ($data['lesson_id'] ?? 0),
                    ]);
                    $imported++;
                }
                fclose($handle);
                Session::flash('success', "Đã nhập {$imported} từ vựng từ CSV.");
            } elseif ($ext === 'json') {
                $json = file_get_contents($file['tmp_name']);
                $items = json_decode($json, true);
                $imported = 0;
                foreach ($items as $item) {
                    Database::insert('vocab', [
                        'hanzi' => $item['hanzi'] ?? '',
                        'pinyin' => $item['pinyin'] ?? '',
                        'meaning' => $item['meaning'] ?? '',
                        'level' => $item['level'] ?? '',
                        'lesson_id' => (int) ($item['lesson_id'] ?? 0),
                    ]);
                    $imported++;
                }
                Session::flash('success', "Đã nhập {$imported} từ vựng từ JSON.");
            }
        }
        $this->redirect('/do-an-tot-nghiep/admin/vocab');
    }

    public function export(): void
    {
        $level = $_GET['level'] ?? '';
        $lessonId = (int) ($_GET['lesson_id'] ?? 0);

        $conditions = [];
        $params = [];
        if ($lessonId > 0) {
            $conditions[] = 'lesson_id = ?';
            $params[] = $lessonId;
        }
        if ($level !== '') {
            $conditions[] = 'level = ?';
            $params[] = $level;
        }
        $where = '';
        if (!empty($conditions)) {
            $where = 'WHERE ' . implode(' AND ', $conditions);
        }

        $vocab = Database::fetchAll("SELECT hanzi, pinyin, meaning, level, lesson_id FROM vocab {$where} ORDER BY id", $params);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="vocab_export.csv"');
        $output = fopen('php://output', 'w');
        fwrite($output, "\xEF\xBB\xBF");
        fputcsv($output, ['hanzi', 'pinyin', 'meaning', 'level', 'lesson_id']);
        foreach ($vocab as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
        exit;
    }
}
