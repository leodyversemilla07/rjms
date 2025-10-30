<?php

/**
 * Front Controller
 * Single entry point for all requests
 */

// Define base path
define('BASE_PATH', dirname(__DIR__));

// Load Composer autoloader
require_once BASE_PATH . '/vendor/autoload.php';

// Load application bootstrap
require_once BASE_PATH . '/src/bootstrap.php';

// Load routes
$router = require_once BASE_PATH . '/routes/web.php';

// Dispatch request
$router->dispatch();
