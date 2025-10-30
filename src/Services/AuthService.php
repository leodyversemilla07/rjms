<?php

namespace App\Services;

use App\Core\Database;
use App\Core\Session;
use App\Core\Logger;

class AuthService
{
    /**
     * Attempt to authenticate user
     */
    public static function attempt(string $username, string $password): bool
    {
        $user = Database::fetchOne(
            'SELECT * FROM users WHERE username = ? AND is_active = 1',
            [$username]
        );

        if (!$user) {
            Logger::warning('Login attempt failed: user not found', ['username' => $username]);
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            Logger::warning('Login attempt failed: invalid password', ['username' => $username]);
            return false;
        }

        // Set session data
        Session::set('user_id', $user['id']);
        Session::set('username', $user['username']);
        Session::set('role', $user['role']);
        Session::set('email', $user['email']);
        
        // Regenerate session ID for security
        Session::regenerate();

        Logger::info('User logged in successfully', [
            'user_id' => $user['id'],
            'username' => $username
        ]);

        return true;
    }

    /**
     * Log out user
     */
    public static function logout(): void
    {
        $userId = Session::get('user_id');
        $username = Session::get('username');

        Session::destroy();

        Logger::info('User logged out', [
            'user_id' => $userId,
            'username' => $username
        ]);
    }

    /**
     * Check if user is authenticated
     */
    public static function check(): bool
    {
        return Session::has('user_id');
    }

    /**
     * Get authenticated user
     */
    public static function user(): ?array
    {
        if (!self::check()) {
            return null;
        }

        $userId = Session::get('user_id');
        return Database::fetchOne(
            'SELECT id, username, email, role, first_name, middle_name, last_name, affiliation, country, bio, created_at 
             FROM users 
             WHERE id = ? AND is_active = 1',
            [$userId]
        );
    }

    /**
     * Register new user
     */
    public static function register(array $data): bool
    {
        // Check if username already exists
        $existing = Database::fetchOne(
            'SELECT id FROM users WHERE username = ? OR email = ?',
            [$data['username'], $data['email']]
        );

        if ($existing) {
            Logger::warning('Registration failed: username or email already exists', [
                'username' => $data['username'],
                'email' => $data['email']
            ]);
            return false;
        }

        // Hash password
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        // Insert user
        $sql = "INSERT INTO users (username, password, email, role, first_name, middle_name, last_name, affiliation, country, bio) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $params = [
            $data['username'],
            $hashedPassword,
            $data['email'],
            $data['role'] ?? 'author',
            $data['first_name'],
            $data['middle_name'] ?? null,
            $data['last_name'],
            $data['affiliation'] ?? null,
            $data['country'],
            $data['bio'] ?? null
        ];

        $result = Database::execute($sql, $params);

        if ($result) {
            Logger::info('New user registered', [
                'username' => $data['username'],
                'email' => $data['email'],
                'role' => $data['role'] ?? 'author'
            ]);
        }

        return $result;
    }

    /**
     * Update user password
     */
    public static function updatePassword(int $userId, string $newPassword): bool
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        $result = Database::execute(
            'UPDATE users SET password = ?, updated_at = NOW() WHERE id = ?',
            [$hashedPassword, $userId]
        );

        if ($result) {
            Logger::info('Password updated', ['user_id' => $userId]);
        }

        return $result;
    }

    /**
     * Check if user has role
     */
    public static function hasRole(string $role): bool
    {
        return Session::get('role') === $role;
    }

    /**
     * Check if user has any of the given roles
     */
    public static function hasAnyRole(array $roles): bool
    {
        return in_array(Session::get('role'), $roles);
    }

    /**
     * Require authentication (redirect if not authenticated)
     */
    public static function requireAuth(string $redirectUrl = '/login.php'): void
    {
        if (!self::check()) {
            Session::flash('error', 'Please login to continue');
            redirect($redirectUrl);
        }
    }

    /**
     * Require specific role (redirect if not authorized)
     */
    public static function requireRole(string $role, string $redirectUrl = '/'): void
    {
        self::requireAuth();
        
        if (!self::hasRole($role)) {
            Session::flash('error', 'You are not authorized to access this page');
            Logger::warning('Unauthorized access attempt', [
                'user_id' => Session::get('user_id'),
                'required_role' => $role,
                'user_role' => Session::get('role')
            ]);
            redirect($redirectUrl);
        }
    }
}
