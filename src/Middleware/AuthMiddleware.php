<?php

namespace App\Middleware;

use App\Core\Session;
use App\Core\Router;

class AuthMiddleware implements Middleware
{
    public function handle($request, \Closure $next)
    {
        // BEFORE: check authentication
        if (!isset($_SESSION['user_id'])) {
            Session::flash('error', 'Please login to continue.');
            Router::redirect('/login');
            return null;
        }

        // Proceed to next middleware/controller
        $response = $next($request);

        // AFTER: You could modify the response here if needed
        return $response;
    }
}
