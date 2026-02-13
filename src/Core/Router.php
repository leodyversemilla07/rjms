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
        $request = new Request();
        $method = $request->method();
        $uri = $this->normalizePath($request->uri());

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
                    
                    // Create the final core task: executing the handler
                    $coreHandler = function($req) use ($route, $matches) {
                        return $this->executeHandler($route['handler'], $matches, $req);
                    };

                    // Wrap the core task with middlewares (Onion style)
                    $pipeline = array_reduce(
                        array_reverse($route['middlewares']),
                        function ($next, $middleware) {
                            return function ($req) use ($next, $middleware) {
                                return $this->resolveMiddleware($middleware)->handle($req, $next);
                            };
                        },
                        $coreHandler
                    );

                    // Execute the pipeline and get response
                    $response = $pipeline($request);

                    // If the handler returned a Response object, send it
                    if ($response instanceof Response) {
                        $response->send();
                    }
                    return;
                }
            }
        }

        // 404 Not Found
        $this->notFound();
    }

    /**
     * Resolve middleware instance
     */
    private function resolveMiddleware($middleware)
    {
        $container = Container::getInstance();

        if (is_string($middleware)) {
            $middlewareClass = "App\\Middleware\\{$middleware}";
            if (class_exists($middlewareClass)) {
                return $container->resolve($middlewareClass);
            }
            throw new \Exception("Middleware class [$middlewareClass] not found.");
        }

        if (is_callable($middleware)) {
            // If it's a closure, we wrap it to satisfy the Middleware interface
            return new class($middleware) implements \App\Middleware\Middleware {
                private $callback;
                public function __construct($callback) { $this->callback = $callback; }
                public function handle($request, \Closure $next) {
                    return ($this->callback)($request, $next);
                }
            };
        }

        throw new \Exception("Invalid middleware type.");
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
     * Execute route handler
     */
    private function executeHandler($handler, array $params = [], ?Request $request = null): void
    {
        if (is_array($handler)) {
            [$controller, $method] = $handler;
            
            if (is_string($controller)) {
                $controllerClass = "App\\Controllers\\{$controller}";
                if (class_exists($controllerClass)) {
                    try {
                        // Resolve Controller
                        $container = Container::getInstance();
                        $instance = $container->resolve($controllerClass);
                        
                        if (method_exists($instance, $method)) {
                            // Use Reflection to map parameters
                            $reflector = new \ReflectionMethod($instance, $method);
                            $methodParams = $reflector->getParameters();
                            $dependencies = [];

                            foreach ($methodParams as $param) {
                                $type = $param->getType();
                                $name = $param->getName();

                                // Inject Request object if type-hinted
                                if ($type && !$type->isBuiltin() && $type->getName() === Request::class) {
                                    $dependencies[] = $request;
                                } 
                                // Inject route parameter by name (e.g., 'id')
                                elseif (array_key_exists($name, $params)) {
                                    $dependencies[] = $params[$name];
                                }
                                // Fallback: Inject route parameter by position (if unnamed in route regex)
                                elseif (!empty($params)) {
                                    $dependencies[] = array_shift($params);
                                }
                                // Check for default value
                                elseif ($param->isDefaultValueAvailable()) {
                                    $dependencies[] = $param->getDefaultValue();
                                }
                                else {
                                    throw new \Exception("Cannot resolve argument \${$name} for {$controller}::{$method}");
                                }
                            }

                            $response = $reflector->invokeArgs($instance, $dependencies);

                            // Handle Response object return
                            if ($response instanceof Response) {
                                $response->send();
                            }
                        } else {
                            $this->error("Method {$method} not found in controller {$controller}");
                        }
                    } catch (\Exception $e) {
                        $this->error("Failed to execute {$controller}::{$method}: " . $e->getMessage());
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
