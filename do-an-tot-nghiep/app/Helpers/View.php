<?php
declare(strict_types=1);
namespace App\Helpers;

class View
{
    private static array $globalData = [];
    private static array $layoutPaths = [];

    public static function addGlobal(string $key, mixed $value): void
    {
        self::$globalData[$key] = $value;
    }

    public static function getGlobals(): array
    {
        return self::$globalData;
    }

    public static function addLayoutPath(string $path): void
    {
        self::$layoutPaths[] = rtrim($path, '/\\');
    }

    public static function render(string $view, array $data = [], ?string $layout = null): void
    {
        $data = array_merge(self::$globalData, $data);
        extract($data);

        $viewPath = self::findView($view);

        ob_start();
        if ($viewPath !== null && file_exists($viewPath)) {
            require $viewPath;
        } else {
            echo "<!-- View not found: {$view} -->";
        }
        $content = ob_get_clean();

        if ($layout === null) {
            echo $content;
            return;
        }

        $layoutPath = self::findLayout($layout);
        if ($layoutPath !== null && file_exists($layoutPath)) {
            require $layoutPath;
        } else {
            echo $content;
        }
    }

    public static function renderPartial(string $view, array $data = []): string
    {
        $data = array_merge(self::$globalData, $data);
        extract($data);

        $viewPath = self::findView($view);

        ob_start();
        if ($viewPath !== null && file_exists($viewPath)) {
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
            if (php_sapi_name() === 'cli' || strpos($scriptName, DIRECTORY_SEPARATOR) !== false) {
                $base = '';
            } else {
                $base = rtrim(dirname($scriptName), '/');
            }
        }
        return $base;
    }

    private static function findView(string $view): ?string
    {
        $paths = [
            __DIR__ . '/../Views/',
        ];
        $relativePath = str_replace('.', '/', $view) . '.php';
        foreach ($paths as $path) {
            $fullPath = $path . $relativePath;
            if (file_exists($fullPath)) {
                return $fullPath;
            }
        }
        return null;
    }

    private static function findLayout(string $layout): ?string
    {
        $paths = array_merge(self::$layoutPaths, [
            __DIR__ . '/../Views/layouts/',
        ]);
        foreach ($paths as $path) {
            $fullPath = rtrim($path, '/\\') . DIRECTORY_SEPARATOR . $layout . '.php';
            if (file_exists($fullPath)) {
                return $fullPath;
            }
        }
        return null;
    }
}
