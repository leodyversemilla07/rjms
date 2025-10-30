<?php

namespace App\Core;

/**
 * Router Class
 * Handles HTTP routing and request dispatching
 */
class Router
{
    private array $routes = [];
    private array $middlewares = [];
    private string $currentRoute = '';

    /**
     * Add a GET route
     */
    public function get(string $path, $handler, array $middlewares = []): void
    {
        $this->addRoute('GET', $path, $handler, $middlewares);
    }

    /**
     * Add a POST route
     */
    public function post(string $path, $handler, array $middlewares = []): void
    {
        $this->addRoute('POST', $path, $handler, $middlewares);
    }

    /**
     * Add a PUT route
     */
    public function put(string $path, $handler, array $middlewares = []): void
    {
        $this->addRoute('PUT', $path, $handler, $middlewares);
    }

    /**
     * Add a DELETE route
     */
    public function delete(string $path, $handler, array $middlewares = []): void
    {
        $this->addRoute('DELETE', $path, $handler, $middlewares);
    }

    /**
     * Add any HTTP method route
     */
    public function any(string $path, $handler, array $middlewares = []): void
    {
        foreach (['GET', 'POST', 'PUT', 'DELETE', 'PATCH'] as $method) {
            $this->addRoute($method, $path, $handler, $middlewares);
        }
    }

    /**
     * Add route to collection
     */
    private function addRoute(string $method, string $path, $handler, array $middlewares = []): void
    {
        $path = $this->normalizePath($path);
        $this->routes[$method][$path] = [
            'handler' => $handler,
            'middlewares' => $middlewares
        ];
    }

    /**
     * Normalize path (remove trailing slashes, ensure leading slash)
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path, '/');
        return '/' . $path;
    }

    /**
     * Dispatch the request to the appropriate handler
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = $this->normalizePath($uri);

        // Remove base path if running in subdirectory
        $basePath = $this->getBasePath();
        if ($basePath && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
            $uri = $this->normalizePath($uri);
        }

        // Find matching route
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $path => $route) {
                $pattern = $this->convertToRegex($path);
                if (preg_match($pattern, $uri, $matches)) {
                    array_shift($matches); // Remove full match
                    $this->currentRoute = $path;
                    
                    // Execute middlewares
                    if (!empty($route['middlewares'])) {
                        foreach ($route['middlewares'] as $middleware) {
                            $this->executeMiddleware($middleware);
                        }
                    }

                    // Execute handler
                    $this->executeHandler($route['handler'], $matches);
                    return;
                }
            }
        }

        // 404 Not Found
        $this->notFound();
    }

    /**
     * Convert route path to regex pattern
     */
    private function convertToRegex(string $path): string
    {
        // Replace {param} with named capture groups
        $pattern = preg_replace('/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/', '(?P<$1>[^/]+)', $path);
        return '#^' . $pattern . '$#';
    }

    /**
     * Get base path for subdirectory installations
     */
    private function getBasePath(): string
    {
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $basePath = dirname($scriptName);
        return $basePath === '/' ? '' : $basePath;
    }

    /**
     * Execute middleware
     */
    private function executeMiddleware($middleware): void
    {
        if (is_string($middleware)) {
            // Assume it's a class name
            $middlewareClass = "App\\Middleware\\{$middleware}";
            if (class_exists($middlewareClass)) {
                $instance = new $middlewareClass();
                $instance->handle();
            }
        } elseif (is_callable($middleware)) {
            call_user_func($middleware);
        }
    }

    /**
     * Execute route handler
     */
    private function executeHandler($handler, array $params = []): void
    {
        if (is_array($handler)) {
            // Controller@method format
            [$controller, $method] = $handler;
            
            if (is_string($controller)) {
                $controllerClass = "App\\Controllers\\{$controller}";
                if (class_exists($controllerClass)) {
                    $instance = new $controllerClass();
                    if (method_exists($instance, $method)) {
                        call_user_func_array([$instance, $method], $params);
                    } else {
                        $this->error("Method {$method} not found in controller {$controller}");
                    }
                } else {
                    $this->error("Controller {$controller} not found");
                }
            } else {
                call_user_func_array([$controller, $method], $params);
            }
        } elseif (is_callable($handler)) {
            call_user_func_array($handler, $params);
        } elseif (is_string($handler)) {
            // Check if it's a view file
            $viewPath = __DIR__ . '/../../resources/views/' . $handler;
            if (file_exists($viewPath)) {
                require $viewPath;
            } else {
                $this->error("View {$handler} not found");
            }
        }
    }

    /**
     * Handle 404 Not Found
     */
    private function notFound(): void
    {
        http_response_code(404);
        $viewPath = __DIR__ . '/../../resources/views/errors/404.php';
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            echo "404 - Page Not Found";
        }
        exit();
    }

    /**
     * Handle errors
     */
    private function error(string $message): void
    {
        http_response_code(500);
        if (env('APP_DEBUG', false)) {
            echo "Router Error: {$message}";
        } else {
            echo "500 - Internal Server Error";
        }
        exit();
    }

    /**
     * Redirect to a URL
     */
    public static function redirect(string $url, int $code = 302): void
    {
        header("Location: {$url}", true, $code);
        exit();
    }

    /**
     * Get current route path
     */
    public function getCurrentRoute(): string
    {
        return $this->currentRoute;
    }
}
