<?php
declare(strict_types=1);
namespace App;

use App\Helpers\View;
use App\Helpers\Session;
use App\Helpers\Database;

class BaseController
{
    protected array $globalData = [];

    protected function view(string $view, array $data = [], ?string $layout = null): void
    {
        View::render($view, $data, $layout);
    }

    protected function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    protected function redirect(string $url): void
    {
        $baseUrl = rtrim(View::baseUrl(), '/');
        $url = preg_replace('#^/do-an-tot-nghiep#', '', $url);
        if (str_starts_with($url, '/')) {
            $url = $baseUrl . $url;
        }
        header('Location: ' . $url);
        exit;
    }

    protected function back(): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? (View::baseUrl() . '/');
        $this->redirect($referer);
    }

    protected function validate(array $data, array $rules): array
    {
        $errors = [];
        foreach ($rules as $field => $ruleSet) {
            $ruleList = is_array($ruleSet) ? $ruleSet : explode('|', $ruleSet);
            foreach ($ruleList as $rule) {
                if ($rule === 'required') {
                    if (!isset($data[$field]) || (is_string($data[$field]) && trim($data[$field]) === '') || $data[$field] === null) {
                        $errors[$field][] = "{$field} is required";
                    }
                }
                if (str_starts_with($rule, 'min:')) {
                    $min = (int) substr($rule, 4);
                    if (isset($data[$field]) && is_string($data[$field]) && mb_strlen($data[$field]) < $min) {
                        $errors[$field][] = "{$field} must be at least {$min} characters";
                    }
                }
                if (str_starts_with($rule, 'max:')) {
                    $max = (int) substr($rule, 4);
                    if (isset($data[$field]) && is_string($data[$field]) && mb_strlen($data[$field]) > $max) {
                        $errors[$field][] = "{$field} must not exceed {$max} characters";
                    }
                }
                if ($rule === 'email') {
                    if (isset($data[$field]) && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                        $errors[$field][] = "{$field} must be a valid email";
                    }
                }
                if ($rule === 'numeric') {
                    if (isset($data[$field]) && !is_numeric($data[$field])) {
                        $errors[$field][] = "{$field} must be numeric";
                    }
                }
                if (str_starts_with($rule, 'unique:')) {
                    $parts = explode(',', substr($rule, 7));
                    $table = $parts[0];
                    $ignoreId = $parts[1] ?? null;
                    if (isset($data[$field])) {
                        $sql = "SELECT COUNT(*) as cnt FROM {$table} WHERE {$field} = ?";
                        $params = [$data[$field]];
                        if ($ignoreId !== null) {
                            $sql .= " AND id != ?";
                            $params[] = (int) $ignoreId;
                        }
                        $result = Database::fetch($sql, $params);
                        if (($result['cnt'] ?? 0) > 0) {
                            $errors[$field][] = "{$field} has already been taken";
                        }
                    }
                }
                if ($rule === 'confirmed') {
                    if (isset($data[$field]) && ($data[$field . '_confirmation'] ?? null) !== $data[$field]) {
                        $errors[$field][] = "{$field} confirmation does not match";
                    }
                }
            }
        }
        return $errors;
    }

    protected function isPost(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] ?? '') === 'POST';
    }

    protected function isGet(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] ?? '') === 'GET';
    }

    protected function getParam(string $key, mixed $default = null): mixed
    {
        return $_GET[$key] ?? $_POST[$key] ?? $default;
    }

    protected function getPost(string $key, mixed $default = null): mixed
    {
        return $_POST[$key] ?? $default;
    }

    protected function callMiddleware(array $classes): void
    {
        foreach ($classes as $class) {
            $fullClass = class_exists($class) ? $class : 'App\\Middleware\\' . $class;
            if (class_exists($fullClass)) {
                $instance = new $fullClass();
                if (method_exists($instance, 'handle')) {
                    $instance->handle();
                }
            }
        }
    }

    protected function uploadFile(string $key, string $directory, array $rules = []): array
    {
        if (!isset($_FILES[$key]) || $_FILES[$key]['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'File upload failed'];
        }

        $file = $_FILES[$key];
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!empty($rules['extensions']) && !in_array($extension, $rules['extensions'])) {
            return ['success' => false, 'error' => 'File type not allowed'];
        }

        if (!empty($rules['max_size']) && $file['size'] > $rules['max_size']) {
            return ['success' => false, 'error' => 'File size exceeds limit'];
        }

        $uploadPath = rtrim($directory, '/\\');
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $filename = uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
        $destPath = $uploadPath . DIRECTORY_SEPARATOR . $filename;

        if (move_uploaded_file($file['tmp_name'], $destPath)) {
            return [
                'success' => true,
                'path' => $destPath,
                'filename' => $filename,
                'extension' => $extension,
                'size' => $file['size'],
                'original_name' => $file['name'],
            ];
        }

        return ['success' => false, 'error' => 'Could not move uploaded file'];
    }
}
