<?php

/**
 * Get environment variable
 */
function env(string $key, $default = null)
{
    $value = $_ENV[$key] ?? getenv($key);
    
    if ($value === false) {
        return $default;
    }

    // Convert string boolean values
    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;
        case 'false':
        case '(false)':
            return false;
        case 'empty':
        case '(empty)':
            return '';
        case 'null':
        case '(null)':
            return null;
    }

    return $value;
}

/**
 * Get application root path
 */
function base_path(string $path = ''): string
{
    return dirname(__DIR__, 2) . ($path ? DIRECTORY_SEPARATOR . $path : '');
}

/**
 * Redirect to URL
 */
function redirect(string $url, int $statusCode = 302): void
{
    header('Location: ' . $url, true, $statusCode);
    exit;
}

/**
 * Redirect back
 */
function back(): void
{
    $referer = $_SERVER['HTTP_REFERER'] ?? '/';
    redirect($referer);
}

/**
 * Sanitize input
 */
function sanitize(string $data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Escape output for HTML
 */
function e(?string $string): string
{
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Get old input value (from previous request)
 */
function old(string $key, $default = '')
{
    return \App\Core\Session::getFlash('old_' . $key, $default);
}

/**
 * Get validation error
 */
function error(string $field): ?string
{
    $errors = \App\Core\Session::getFlash('errors', []);
    return $errors[$field] ?? null;
}

/**
 * Check if user is authenticated
 */
function auth(): bool
{
    return \App\Core\Session::has('user_id');
}

/**
 * Get authenticated user
 */
function user(): ?array
{
    if (!auth()) {
        return null;
    }

    $userId = \App\Core\Session::get('user_id');
    return \App\Core\Database::fetchOne(
        'SELECT * FROM users WHERE id = ? AND is_active = 1',
        [$userId]
    );
}

/**
 * Get user role
 */
function userRole(): ?string
{
    $user = user();
    return $user['role'] ?? null;
}

/**
 * Check if user has role
 */
function hasRole(string $role): bool
{
    return userRole() === $role;
}

/**
 * Check if user has any of the given roles
 */
function hasAnyRole(array $roles): bool
{
    return in_array(userRole(), $roles);
}

/**
 * Format date
 */
function formatDate(?string $date, string $format = 'Y-m-d H:i:s'): string
{
    if (!$date) {
        return '';
    }
    return date($format, strtotime($date));
}

/**
 * JSON response
 */
function jsonResponse(array $data, int $statusCode = 200): void
{
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

/**
 * Dump and die (for debugging)
 */
function dd(...$vars): void
{
    echo '<pre>';
    foreach ($vars as $var) {
        var_dump($var);
    }
    echo '</pre>';
    die;
}

/**
 * Generate random string
 */
function randomString(int $length = 32): string
{
    return bin2hex(random_bytes($length / 2));
}

/**
 * Check if request is AJAX
 */
function isAjax(): bool
{
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

/**
 * Get request method
 */
function requestMethod(): string
{
    return $_SERVER['REQUEST_METHOD'] ?? 'GET';
}

/**
 * Check if request is POST
 */
function isPost(): bool
{
    return requestMethod() === 'POST';
}

/**
 * Check if request is GET
 */
function isGet(): bool
{
    return requestMethod() === 'GET';
}

/**
 * Render a view with optional layout
 * 
 * @param string $view View file path relative to resources/views (without .php)
 * @param array $data Data to pass to the view
 * @param string|null $layout Layout file path relative to resources/views/layouts (without .php), null for no layout
 * @return void
 */
function view(string $view, array $data = [], ?string $layout = 'main'): void
{
    // Extract data to variables
    extract($data);
    
    // Start output buffering
    ob_start();
    
    // Include the view file
    $viewPath = base_path('resources/views/' . str_replace('.', '/', $view) . '.php');
    
    if (!file_exists($viewPath)) {
        throw new Exception("View file not found: {$viewPath}");
    }
    
    include $viewPath;
    
    // Get the content
    $content = ob_get_clean();
    
    // If no layout, just output the content
    if ($layout === null) {
        echo $content;
        return;
    }
    
    // Include the layout file
    $layoutPath = base_path('resources/views/layouts/' . str_replace('.', '/', $layout) . '.php');
    
    if (!file_exists($layoutPath)) {
        throw new Exception("Layout file not found: {$layoutPath}");
    }
    
    include $layoutPath;
}

/**
 * Render a view section (content only, no layout)
 * 
 * @param string $view View file path relative to resources/views (without .php)
 * @param array $data Data to pass to the view
 * @return string
 */
function section(string $view, array $data = []): string
{
    extract($data);
    
    ob_start();
    
    $viewPath = base_path('resources/views/' . str_replace('.', '/', $view) . '.php');
    
    if (!file_exists($viewPath)) {
        throw new Exception("View file not found: {$viewPath}");
    }
    
    include $viewPath;
    
    return ob_get_clean();
}
