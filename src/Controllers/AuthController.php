<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Services\AuthService;
use App\Core\Logger;

/**
 * Auth Controller
 * Handles authentication (login, register, logout)
 */
class AuthController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * Show login form
     */
    public function showLogin(): void
    {
        // If already logged in, redirect to dashboard
        if (AuthService::check()) {
            $this->redirectToDashboard();
        }

        $this->view('auth/login', [], ''); // No layout
    }

    /**
     * Handle login
     */
    public function login(): void
    {
        header('Content-Type: application/json');

        try {
            $usernameEmail = trim($_POST['username_email'] ?? '');
            $password = $_POST['password'] ?? '';
            $rememberMe = isset($_POST['remember_me']);

            // Validation
            if (empty($usernameEmail) || empty($password)) {
                $this->json([
                    'success' => false,
                    'message' => 'Please fill in all fields.'
                ]);
                return;
            }

            // Find user
            $user = $this->userModel->findByUsernameOrEmail($usernameEmail);

            if (!$user) {
                Logger::warning('Failed login attempt - user not found', [
                    'identifier' => $usernameEmail,
                    'ip' => $_SERVER['REMOTE_ADDR']
                ]);

                $this->json([
                    'success' => false,
                    'message' => 'Invalid username or password.'
                ]);
                return;
            }

            // Verify password (get full user data with password)
            $userWithPassword = $this->userModel->find($user['id']);
            
            if (!password_verify($password, $userWithPassword['password'] ?? '')) {
                Logger::warning('Failed login attempt - invalid password', [
                    'user_id' => $user['id'],
                    'ip' => $_SERVER['REMOTE_ADDR']
                ]);

                $this->json([
                    'success' => false,
                    'message' => 'Invalid username or password.'
                ]);
                return;
            }

            // Check if account is active
            if (!$user['is_active']) {
                $this->json([
                    'success' => false,
                    'message' => 'Your account has been deactivated. Please contact administrator.'
                ]);
                return;
            }

            // Login successful
            AuthService::login($user['id']);

            // Handle remember me
            if ($rememberMe) {
                $cookieValue = base64_encode($user['username'] . ':' . $user['id']);
                setcookie('remember_login', $cookieValue, time() + (86400 * 30), '/');
            }

            Logger::info('User logged in', [
                'user_id' => $user['id'],
                'username' => $user['username']
            ]);

            // Determine redirect URL based on role
            $redirectUrl = $this->getDashboardUrl($user['role']);

            $this->json([
                'success' => true,
                'message' => 'Login successful! Redirecting to your dashboard...',
                'redirect' => $redirectUrl
            ]);

        } catch (\Exception $e) {
            Logger::error('Login error', ['error' => $e->getMessage()]);
            $this->json([
                'success' => false,
                'message' => 'An error occurred. Please try again.'
            ], 500);
        }
    }

    /**
     * Show registration form
     */
    public function showRegister(): void
    {
        // If already logged in, redirect to dashboard
        if (AuthService::check()) {
            $this->redirectToDashboard();
        }

        $this->view('auth/register', [], ''); // No layout
    }

    /**
     * Handle registration
     */
    public function register(): void
    {
        header('Content-Type: application/json');

        try {
            // Validate input
            $data = $this->validate([
                'username' => 'required|alphanumeric|min:3|max:50',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'first_name' => 'required|max:100',
                'last_name' => 'required|max:100',
                'country' => 'required|max:100'
            ]);

            // Check if username exists
            if ($this->userModel->findByUsername($data['username'])) {
                $this->json([
                    'success' => false,
                    'message' => 'Username already exists.'
                ]);
                return;
            }

            // Check if email exists
            if ($this->userModel->findByEmail($data['email'])) {
                $this->json([
                    'success' => false,
                    'message' => 'Email already exists.'
                ]);
                return;
            }

            // Create user
            $data['role'] = 'author'; // Default role
            $data['is_active'] = 1;
            $data['middle_name'] = $_POST['middle_name'] ?? null;
            $data['affiliation'] = $_POST['affiliation'] ?? null;

            $userId = $this->userModel->createUser($data);

            Logger::info('New user registered', [
                'user_id' => $userId,
                'username' => $data['username'],
                'email' => $data['email']
            ]);

            $this->json([
                'success' => true,
                'message' => 'Registration successful! Redirecting to login...',
                'redirect' => '/login'
            ]);

        } catch (\Exception $e) {
            Logger::error('Registration error', ['error' => $e->getMessage()]);
            
            $errors = $this->getFlash('errors', []);
            if (!empty($errors)) {
                $firstError = reset($errors);
                $message = is_array($firstError) ? $firstError[0] : $firstError;
            } else {
                $message = 'An error occurred. Please try again.';
            }

            $this->json([
                'success' => false,
                'message' => $message
            ]);
        }
    }

    /**
     * Handle logout
     */
    public function logout(): void
    {
        $userId = $_SESSION['user_id'] ?? null;
        
        AuthService::logout();

        // Remove remember me cookie
        if (isset($_COOKIE['remember_login'])) {
            setcookie('remember_login', '', time() - 3600, '/');
        }

        if ($userId) {
            Logger::info('User logged out', ['user_id' => $userId]);
        }

        $this->redirect('/');
    }

    /**
     * Get dashboard URL based on role
     */
    private function getDashboardUrl(string $role): string
    {
        $dashboards = [
            'admin' => '/admin/dashboard',
            'author' => '/author/dashboard',
            'editor' => '/editor/dashboard',
            'reviewer' => '/reviewer/dashboard'
        ];

        return $dashboards[$role] ?? '/';
    }

    /**
     * Redirect to appropriate dashboard
     */
    private function redirectToDashboard(): void
    {
        $role = $_SESSION['role'] ?? '';
        $url = $this->getDashboardUrl($role);
        $this->redirect($url);
    }
}
