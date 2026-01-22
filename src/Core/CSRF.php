<?php

namespace App\Core;

use App\Core\Session;
use App\Core\Logger;

class CSRF
{
    private const TOKEN_NAME = 'csrf_token';

    /**
     * Generate CSRF token
     */
    public static function generateToken(): string
    {
        $token = bin2hex(random_bytes(32));
        Session::set(self::TOKEN_NAME, $token);
        return $token;
    }

    /**
     * Get current CSRF token
     */
    public static function getToken(): string
    {
        if (!Session::has(self::TOKEN_NAME)) {
            return self::generateToken();
        }
        return Session::get(self::TOKEN_NAME);
    }

    /**
     * Validate CSRF token
     */
    public static function validateToken(?string $token): bool
    {
        if (!$token) {
            return false;
        }

        $sessionToken = Session::get(self::TOKEN_NAME);
        
        if (!$sessionToken) {
            return false;
        }

        return hash_equals($sessionToken, $token);
    }

    /**
     * Get token field HTML
     */
    public static function field(): string
    {
        $token = self::getToken();
        return sprintf(
            '<input type="hidden" name="%s" value="%s">',
            self::TOKEN_NAME,
            htmlspecialchars($token, ENT_QUOTES, 'UTF-8')
        );
    }

    /**
     * Verify token from request
     */
    public static function verify(): bool
    {
        $token = $_POST[self::TOKEN_NAME] ?? $_GET[self::TOKEN_NAME] ?? null;
        
        if (!self::validateToken($token)) {
            Logger::warning('CSRF token validation failed', [
                'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
                'uri' => $_SERVER['REQUEST_URI'] ?? 'unknown'
            ]);
            return false;
        }

        return true;
    }
}
