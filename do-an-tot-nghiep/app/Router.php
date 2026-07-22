<?php
declare(strict_types=1);
namespace App;

class Router
{
    private array $routes = [];
    private array $groupStack = [];
    private array $patterns = [
        'id' => '\d+',
        'slug' => '[a-z0-9-]+',
        'uuid' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}',
    ];
    private array $namedRoutes = [];
    private string $currentGroupPrefix = '';
    private array $currentGroupMiddleware = [];
    private ?string $currentName = null;
    private array $currentMiddleware = [];

    public function get(string $path, callable|array $handler): self
    {
        return $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, callable|array $handler): self
    {
        return $this->addRoute('POST', $path, $handler);
    }

    public function put(string $path, callable|array $handler): self
    {
        return $this->addRoute('PUT', $path, $handler);
    }

    public function patch(string $path, callable|array $handler): self
    {
        return $this->addRoute('PATCH', $path, $handler);
    }

    public function delete(string $path, callable|array $handler): self
    {
        return $this->addRoute('DELETE', $path, $handler);
    }

    public function match(array $methods, string $path, callable|array $handler): self
    {
        foreach ($methods as $method) {
            $this->addRoute(strtoupper($method), $path, $handler);
        }
        return $this;
    }

    public function group(string $prefix, callable $callback): self
    {
        $previousPrefix = $this->currentGroupPrefix;
        $previousMiddleware = $this->currentGroupMiddleware;

        $this->currentGroupPrefix = $previousPrefix . '/' . trim($prefix, '/');
        $this->currentGroupPrefix = rtrim($this->currentGroupPrefix, '/');

        $callback($this);

        $this->currentGroupPrefix = $previousPrefix;
        $this->currentGroupMiddleware = $previousMiddleware;

        return $this;
    }

    public function middleware(array|string $middleware): self
    {
        $classes = is_array($middleware) ? $middleware : [$middleware];
        $this->currentMiddleware = array_merge($this->currentMiddleware, $classes);
        $this->currentGroupMiddleware = array_merge($this->currentGroupMiddleware, $classes);
        return $this;
    }

    public function name(string $name): self
    {
        $this->currentName = $name;
        $lastIndex = count($this->routes) - 1;
        if ($lastIndex >= 0) {
            $this->namedRoutes[$name] = $lastIndex;
        }
        return $this;
    }

    public function addPattern(string $key, string $regex): self
    {
        $this->patterns[$key] = $regex;
        return $this;
    }

    public function resolve(?string $url = null): void
    {
        $url = $url ?? $_SERVER['REQUEST_URI'] ?? '/';
        $url = parse_url($url, PHP_URL_PATH);
        $url = rtrim($url, '/') ?: '/';

        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/');
        if ($basePath !== '' && str_starts_with($url, $basePath)) {
            $url = substr($url, strlen($basePath));
        }
        $url = $url ?: '/';

        $route = $this->matchRoute($url, $method);

        if ($route === null) {
            http_response_code(404);
            $this->handleNotFound();
            return;
        }

        $this->runMiddleware($route['middleware']);

        if (is_callable($route['handler'])) {
            call_user_func_array($route['handler'], $route['params']);
        } elseif (is_array($route['handler'])) {
            [$class, $action] = $route['handler'];
            if (class_exists($class)) {
                $instance = new $class();
                call_user_func_array([$instance, $action], $route['params']);
            }
        }
    }

    public function url(string $name, array $params = []): ?string
    {
        if (!isset($this->namedRoutes[$name])) {
            return null;
        }
        $index = $this->namedRoutes[$name];
        $route = $this->routes[$index];
        $path = $route['path'];
        foreach ($params as $key => $value) {
            $path = str_replace('{' . $key . '}', (string) $value, $path);
        }
        return $path;
    }

    private function addRoute(string $method, string $path, callable|array $handler): self
    {
        $prefix = $this->currentGroupPrefix;
        $fullPath = $prefix . '/' . trim($path, '/');
        $fullPath = rtrim($fullPath, '/') ?: '/';

        $middleware = array_merge($this->currentGroupMiddleware, $this->currentMiddleware);

        $this->routes[] = [
            'method' => $method,
            'path' => $fullPath,
            'handler' => $handler,
            'middleware' => $middleware,
        ];

        if ($this->currentName !== null) {
            $this->namedRoutes[$this->currentName] = count($this->routes) - 1;
            $this->currentName = null;
        }

        $this->currentMiddleware = [];

        return $this;
    }

    private function matchRoute(string $url, string $method): ?array
    {
        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            $pattern = $route['path'];
            $regex = $this->patternToRegex($pattern);

            if (preg_match($regex, $url, $matches)) {
                $params = array_filter($matches, fn($key) => is_string($key), ARRAY_FILTER_USE_KEY);
                $route['params'] = $params;
                return $route;
            }
        }

        return null;
    }

    private function patternToRegex(string $pattern): string
    {
        $regex = preg_replace_callback('/\{(\w+)(?::([^}]+))?\}/', function ($matches) {
            $name = $matches[1];
            if (isset($matches[2])) {
                return '(?P<' . $name . '>' . $matches[2] . ')';
            }
            if (isset($this->patterns[$name])) {
                return '(?P<' . $name . '>' . $this->patterns[$name] . ')';
            }
            return '(?P<' . $name . '>[^/]+)';
        }, $pattern);

        return '#^' . $regex . '$#';
    }

    private function runMiddleware(array $middlewareClasses): void
    {
        foreach ($middlewareClasses as $class) {
            $fullClass = class_exists($class) ? $class : 'App\\Middleware\\' . $class;
            if (class_exists($fullClass)) {
                $instance = new $fullClass();
                if (method_exists($instance, 'handle')) {
                    $instance->handle();
                }
            }
        }
    }

    private function handleNotFound(): void
    {
        $custom404 = __DIR__ . '/../404.php';
        if (file_exists($custom404)) {
            include $custom404;
        } else {
            echo '<h1>404 - Not Found</h1>';
        }
    }
}
