<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Core\Session;
use App\Core\Logger;

// Check if .env file exists
$envPath = dirname(__DIR__);
if (!file_exists($envPath . '/.env')) {
    die('Environment file (.env) not found. Please copy .env.example to .env and configure your settings.');
}

// Load environment variables
$dotenv = Dotenv::createImmutable($envPath);
$dotenv->load();

// Start session
Session::start();

// Set timezone
date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

// Error handling based on environment
if (env('APP_ENV') === 'production') {
    error_reporting(0);
    ini_set('display_errors', '0');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}

// Custom error handler
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    Logger::error("PHP Error: $errstr", [
        'file' => $errfile,
        'line' => $errline,
        'type' => $errno
    ]);
    
    if (env('APP_DEBUG', false)) {
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }
});

// Custom exception handler
set_exception_handler(function ($exception) {
    Logger::critical('Uncaught Exception: ' . $exception->getMessage(), [
        'file' => $exception->getFile(),
        'line' => $exception->getLine(),
        'trace' => $exception->getTraceAsString()
    ]);
    
    if (env('APP_DEBUG', false)) {
        echo '<h1>Error</h1>';
        echo '<p>' . $exception->getMessage() . '</p>';
        echo '<pre>' . $exception->getTraceAsString() . '</pre>';
    } else {
        echo '<h1>An error occurred</h1>';
        echo '<p>Please try again later.</p>';
    }
    exit(1);
});

// Register shutdown function
register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        Logger::critical('Fatal Error: ' . $error['message'], [
            'file' => $error['file'],
            'line' => $error['line']
        ]);
    }
});
