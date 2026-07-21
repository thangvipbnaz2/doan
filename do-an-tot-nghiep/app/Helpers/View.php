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
        return '/do-an-tot-nghiep/' . ltrim($path, '/');
    }

    public static function url(string $path = ''): string
    {
        return '/do-an-tot-nghiep/' . ltrim($path, '/');
    }
}
