<?php

namespace App\Core;

/**
 * Base Controller Class
 * All controllers should extend this class
 */
class Controller
{
    protected array $data = [];
    protected string $layout = 'layouts/main';

    /**
     * Load a view file
     */
    protected function view(string $view, array $data = [], ?string $layout = null): Response
    {
        // Merge data
        $this->data = array_merge($this->data, $data);
        
        // Extract variables for view
        extract($this->data);

        // Determine layout
        $layoutFile = $layout ?? $this->layout;
        $viewPath = __DIR__ . '/../../resources/views/' . $view . '.php';
        $layoutPath = __DIR__ . '/../../resources/views/' . $layoutFile . '.php';

        // Check if view exists
        if (!file_exists($viewPath)) {
            throw new \Exception("View not found: {$view}");
        }

        ob_start();
        // If layout is specified and exists, use it
        if ($layoutFile && file_exists($layoutPath)) {
            require $viewPath;
            $content = ob_get_clean();
            
            ob_start();
            require $layoutPath;
            $finalContent = ob_get_clean();
        } else {
            require $viewPath;
            $finalContent = ob_get_clean();
        }

        return new Response($finalContent);
    }

    /**
     * Render a partial view (no layout)
     */
    protected function partial(string $view, array $data = []): Response
    {
        $this->data = array_merge($this->data, $data);
        extract($this->data);

        $viewPath = __DIR__ . '/../../resources/views/' . $view . '.php';
        if (file_exists($viewPath)) {
            ob_start();
            require $viewPath;
            return new Response(ob_get_clean());
        } else {
            throw new \Exception("Partial view not found: {$view}");
        }
    }

    /**
     * Return JSON response
     */
    protected function json($data, int $statusCode = 200): Response
    {
        return Response::json($data, $statusCode);
    }

    /**
     * Redirect to URL
     */
    protected function redirect(string $url, int $code = 302): Response
    {
        return Response::redirect($url, $code);
    }

    /**
     * Redirect back to previous page
     */
    protected function back(): Response
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        return $this->redirect($referer);
    }

    /**
     * Set flash message
     */
    protected function flash(string $key, $value): void
    {
        Session::flash($key, $value);
    }

    /**
     * Get flash message
     */
    protected function getFlash(string $key, $default = null)
    {
        return Session::getFlash($key, $default);
    }

    /**
     * Validate request data
     */
    protected function validate(array $rules, ?array $data = null): array
    {
        // For now, if validation fails it still handles its own redirection 
        // because it's a "stopping" action. But we can return data if successful.
        $data = $data ?? $_POST;
        $validator = new Validator($data);

        if (!$validator->validate($rules)) {
            $errors = $validator->getErrors();
            
            // If AJAX, we return a JSON response object and send it immediately
            if ($this->isAjax()) {
                Response::json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $errors
                ], 422)->send();
                exit();
            }

            $this->flash('errors', $errors);
            $this->flash('old', $data);
            
            $this->back()->send();
            exit();
        }

        return $validator->validated($rules);
    }

    /**
     * Check if request is AJAX
     */
    protected function isAjax(): bool
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    /**
     * Get old input value (after validation failure)
     */
    protected function old(string $key, $default = '')
    {
        $old = $_SESSION['flash']['old'] ?? [];
        return $old[$key] ?? $default;
    }

    /**
     * Check if user is authenticated
     */
    protected function requireAuth(): void
    {
        if (!isset($_SESSION['user_id'])) {
            $this->flash('error', 'Please login to continue.');
            $this->redirect('/login');
        }
    }

    /**
     * Check if user has specific role
     */
    protected function requireRole(string $role): void
    {
        $this->requireAuth();
        
        $currentRole = $_SESSION['role'] ?? '';
        
        // Debug logging
        Logger::debug('requireRole check', [
            'required_role' => $role,
            'current_role' => $currentRole,
            'session_data' => $_SESSION,
            'match' => $currentRole === $role
        ]);
        
        if ($currentRole !== $role) {
            Logger::warning('Role check failed', [
                'required' => $role,
                'current' => $currentRole,
                'user_id' => $_SESSION['user_id'] ?? null
            ]);
            $this->flash('error', 'Unauthorized access.');
            $this->redirect('/');
        }
    }

    /**
     * Get current authenticated user
     */
    protected function user(): ?array
    {
        if (isset($_SESSION['user_id'])) {
            return [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username'] ?? '',
                'role' => $_SESSION['role'] ?? ''
            ];
        }
        return null;
    }
}
