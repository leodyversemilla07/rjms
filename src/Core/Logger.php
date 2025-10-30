<?php

namespace App\Core;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;

class Logger
{
    private static ?MonologLogger $instance = null;

    /**
     * Initialize logger
     */
    private static function init(): void
    {
        if (self::$instance !== null) {
            return;
        }

        self::$instance = new MonologLogger('RJMS');

        $logLevel = env('LOG_LEVEL', 'debug');
        $logFile = env('LOG_FILE', 'logs/app.log');

        // Create logs directory if it doesn't exist
        $logDir = dirname($logFile);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        // Add rotating file handler (keeps 30 days of logs)
        self::$instance->pushHandler(
            new RotatingFileHandler($logFile, 30, $logLevel)
        );
    }

    /**
     * Log debug message
     */
    public static function debug(string $message, array $context = []): void
    {
        self::init();
        self::$instance->debug($message, $context);
    }

    /**
     * Log info message
     */
    public static function info(string $message, array $context = []): void
    {
        self::init();
        self::$instance->info($message, $context);
    }

    /**
     * Log warning message
     */
    public static function warning(string $message, array $context = []): void
    {
        self::init();
        self::$instance->warning($message, $context);
    }

    /**
     * Log error message
     */
    public static function error(string $message, array $context = []): void
    {
        self::init();
        self::$instance->error($message, $context);
    }

    /**
     * Log critical message
     */
    public static function critical(string $message, array $context = []): void
    {
        self::init();
        self::$instance->critical($message, $context);
    }
}
