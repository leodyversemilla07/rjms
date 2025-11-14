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
    protected function view(string $view, array $data = [], ?string $layout = null): void
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

        // If layout is specified and exists, use it
        if ($layoutFile && file_exists($layoutPath)) {
            // Start output buffering for content
            ob_start();
            require $viewPath;
            $content = ob_get_clean();
            
            // Now render layout with content
            require $layoutPath;
        } else {
            // Just render the view
            require $viewPath;
        }
    }

    /**
     * Render a partial view (no layout)
     */
    protected function partial(string $view, array $data = []): void
    {
        $this->data = array_merge($this->data, $data);
        extract($this->data);

        $viewPath = __DIR__ . '/../../resources/views/' . $view . '.php';
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            throw new \Exception("Partial view not found: {$view}");
        }
    }

    /**
     * Return JSON response
     */
    protected function json($data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    /**
     * Redirect to URL
     */
    protected function redirect(string $url, int $code = 302): void
    {
        header("Location: {$url}", true, $code);
        exit();
    }

    /**
     * Redirect back to previous page
     */
    protected function back(): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        $this->redirect($referer);
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
    protected function validate(array $rules): array
    {
        $errors = [];
        $data = $_POST;

        foreach ($rules as $field => $fieldRules) {
            $value = $data[$field] ?? null;
            $rulesArray = explode('|', $fieldRules);

            foreach ($rulesArray as $rule) {
                // Parse rule parameters (e.g., "max:255")
                $params = [];
                if (strpos($rule, ':') !== false) {
                    [$rule, $paramString] = explode(':', $rule, 2);
                    $params = explode(',', $paramString);
                }

                switch ($rule) {
                    case 'required':
                        if (empty($value)) {
                            $errors[$field][] = ucfirst($field) . ' is required.';
                        }
                        break;

                    case 'email':
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $errors[$field][] = ucfirst($field) . ' must be a valid email.';
                        }
                        break;

                    case 'min':
                        if (strlen($value) < $params[0]) {
                            $errors[$field][] = ucfirst($field) . " must be at least {$params[0]} characters.";
                        }
                        break;

                    case 'max':
                        if (strlen($value) > $params[0]) {
                            $errors[$field][] = ucfirst($field) . " must not exceed {$params[0]} characters.";
                        }
                        break;

                    case 'numeric':
                        if (!is_numeric($value)) {
                            $errors[$field][] = ucfirst($field) . ' must be numeric.';
                        }
                        break;

                    case 'alpha':
                        if (!ctype_alpha($value)) {
                            $errors[$field][] = ucfirst($field) . ' must contain only letters.';
                        }
                        break;

                    case 'alphanumeric':
                        if (!ctype_alnum($value)) {
                            $errors[$field][] = ucfirst($field) . ' must contain only letters and numbers.';
                        }
                        break;
                }
            }
        }

        if (!empty($errors)) {
            $this->flash('errors', $errors);
            $this->flash('old', $_POST);
            throw new \Exception('Validation failed');
        }

        return $data;
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
        if ($_SESSION['role'] ?? '' !== $role) {
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
