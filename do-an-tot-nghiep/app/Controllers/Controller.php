<?php
namespace App\Controllers;

use App\Helpers\View;
use App\Helpers\Session;

class Controller
{
    protected array $data = [];

    protected function view(string $view, array $data = []): void
    {
        View::render($view, $data);
    }

    protected function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    protected function redirect(string $url): void
    {
        $prefix = rtrim(View::baseUrl(), '/');
        // Strip any hardcoded base path from legacy code
        $url = preg_replace('#^/do-an-tot-nghiep#', '', $url);
        if (str_starts_with($url, '/')) {
            $url = $prefix . $url;
        }
        header('Location: ' . $url);
        exit;
    }

    protected function back(): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? (View::baseUrl() . '/');
        $this->redirect($referer);
    }

    protected function getParam(string $key, $default = null)
    {
        return $_GET[$key] ?? $_POST[$key] ?? $default;
    }

    protected function validate(array $data, array $rules): array
    {
        $errors = [];
        foreach ($rules as $field => $ruleSet) {
            $ruleList = is_array($ruleSet) ? $ruleSet : explode('|', $ruleSet);
            foreach ($ruleList as $rule) {
                if ($rule === 'required' && empty($data[$field])) {
                    $errors[$field][] = "{$field} là bắt buộc";
                }
                if (str_starts_with($rule, 'min:') && isset($data[$field])) {
                    $min = (int) substr($rule, 4);
                    if (strlen($data[$field]) < $min) {
                        $errors[$field][] = "{$field} phải có ít nhất {$min} ký tự";
                    }
                }
                if (str_starts_with($rule, 'max:') && isset($data[$field])) {
                    $max = (int) substr($rule, 4);
                    if (strlen($data[$field]) > $max) {
                        $errors[$field][] = "{$field} tối đa {$max} ký tự";
                    }
                }
                if ($rule === 'numeric' && isset($data[$field]) && !is_numeric($data[$field])) {
                    $errors[$field][] = "{$field} phải là số";
                }
                if ($rule === 'email' && isset($data[$field]) && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                    $errors[$field][] = "{$field} không hợp lệ";
                }
            }
        }
        return $errors;
    }

    protected function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    protected function middleware(string $class): void
    {
        $middlewareClass = 'App\\Middleware\\' . $class;
        if (class_exists($middlewareClass)) {
            $instance = new $middlewareClass();
            $instance->handle();
        }
    }
}
