<?php

namespace App\Middleware;

use App\Core\Router;

class GuestMiddleware implements Middleware
{
    public function handle($request, \Closure $next)
    {
        if (isset($_SESSION['user_id'])) {
            Router::redirect('/dashboard');
            return null;
        }

        return $next($request);
    }
}
