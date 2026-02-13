<?php

namespace App\Middleware;

/**
 * Middleware Interface
 */
interface Middleware
{
    /**
     * Handle the request.
     * 
     * @param mixed $request  The request data (could be $_REQUEST or a Request object)
     * @param \Closure $next  The next middleware in the stack
     * @return mixed
     */
    public function handle($request, \Closure $next);
}
