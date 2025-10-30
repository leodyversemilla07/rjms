<?php

namespace App\Core;

use RuntimeException;

class Session
{
    private static bool $started = false;

    /**
     * Start session with secure settings
     */
    public static function start(): void
    {
        if (self::$started) {
            return;
        }

        if (session_status() === PHP_SESSION_NONE) {
            $secure = env('SESSION_SECURE', false);
            $httpOnly = env('SESSION_HTTP_ONLY', true);
            $lifetime = env('SESSION_LIFETIME', 120) * 60;

            session_set_cookie_params([
                'lifetime' => $lifetime,
                'path' => '/',
                'domain' => '',
                'secure' => $secure,
                'httponly' => $httpOnly,
                'samesite' => 'Strict'
            ]);

            if (!session_start()) {
                throw new RuntimeException('Failed to start session');
            }

            self::$started = true;

            // Regenerate session ID periodically
            if (!self::has('_session_created')) {
                self::regenerate();
                self::set('_session_created', time());
            }

            // Check session expiry
            if (self::has('_session_expires') && self::get('_session_expires') < time()) {
                self::destroy();
                throw new RuntimeException('Session expired');
            }

            self::set('_session_expires', time() + $lifetime);
        }
    }

    /**
     * Set a session variable
     */
    public static function set(string $key, $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Get a session variable
     */
    public static function get(string $key, $default = null)
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Check if session variable exists
     */
    public static function has(string $key): bool
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    /**
     * Remove a session variable
     */
    public static function remove(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    /**
     * Regenerate session ID
     */
    public static function regenerate(): bool
    {
        self::start();
        return session_regenerate_id(true);
    }

    /**
     * Destroy session
     */
    public static function destroy(): bool
    {
        self::start();
        $_SESSION = [];
        
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        self::$started = false;
        return session_destroy();
    }

    /**
     * Flash a message for next request
     */
    public static function flash(string $key, $value): void
    {
        self::set('_flash_' . $key, $value);
    }

    /**
     * Get and remove flash message
     */
    public static function getFlash(string $key, $default = null)
    {
        $flashKey = '_flash_' . $key;
        $value = self::get($flashKey, $default);
        self::remove($flashKey);
        return $value;
    }

    /**
     * Check if flash message exists
     */
    public static function hasFlash(string $key): bool
    {
        return self::has('_flash_' . $key);
    }
}
