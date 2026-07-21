<?php
namespace App\Helpers;

class View
{
    public static function render(string $view, array $data = [], string $layout = 'main'): void
    {
        extract($data);

        $viewPath = __DIR__ . '/../Views/' . str_replace('.', '/', $view) . '.php';

        ob_start();
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            echo "<!-- View not found: {$viewPath} -->";
        }
        $content = ob_get_clean();

        $layoutPath = __DIR__ . '/../Views/layouts/' . $layout . '.php';
        if (file_exists($layoutPath)) {
            require $layoutPath;
        } else {
            echo $content;
        }
    }

    public static function renderPartial(string $view, array $data = []): string
    {
        extract($data);
        $viewPath = __DIR__ . '/../Views/' . str_replace('.', '/', $view) . '.php';

        ob_start();
        if (file_exists($viewPath)) {
            require $viewPath;
        }
        return ob_get_clean();
    }

    public static function escape(?string $value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }

    public static function asset(string $path): string
    {
        return self::baseUrl() . '/' . ltrim($path, '/');
    }

    public static function url(string $path = ''): string
    {
        return self::baseUrl() . '/' . ltrim($path, '/');
    }

    public static function baseUrl(): string
    {
        static $base = null;
        if ($base === null) {
            $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
            // In CLI, SCRIPT_NAME may be a full filesystem path
            if (php_sapi_name() === 'cli' || strpos($scriptName, DIRECTORY_SEPARATOR) !== false) {
                $base = '';
            } else {
                $base = rtrim(dirname($scriptName), '/');
            }
        }
        return $base;
    }
}
