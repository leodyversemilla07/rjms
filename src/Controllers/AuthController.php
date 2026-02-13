<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\CSRF;
use App\Models\User;
use App\Services\AuthService;
use App\Services\EmailService;
use App\Core\Logger;

/**
 * Auth Controller
 * Handles authentication (login, register, logout)
 */
class AuthController extends Controller
{
    private User $userModel;
    private EmailService $emailService;

    public function __construct(User $userModel, EmailService $emailService)
    {
        $this->userModel = $userModel;
        $this->emailService = $emailService;
    }

    /**
     * Show login form
     */
    public function showLogin(Request $request): Response
    {
        // If already logged in, redirect to dashboard
        if (AuthService::check()) {
            return $this->redirectToDashboard();
        }

        return $this->view('auth/login', [], ''); // No layout
    }

    /**
     * Handle login
     */
    public function login(Request $request): Response
    {
        try {
            // Verify CSRF token
            if (!CSRF::verify()) {
                return $this->json([
                    'success' => false,
                    'message' => 'Invalid request. Please refresh and try again.'
                ]);
            }

            $usernameEmail = trim($request->input('username_email', ''));
            $password = $request->input('password', '');
            $rememberMe = $request->input('remember_me') !== null;

            // Validation
            if (empty($usernameEmail) || empty($password)) {
                return $this->json([
                    'success' => false,
                    'message' => 'Please fill in all fields.'
                ]);
            }

            // Find user
            $user = $this->userModel->findByUsernameOrEmailWithPassword($usernameEmail);

            if (!$user) {
                Logger::warning('Failed login attempt - user not found', [
                    'identifier' => $usernameEmail,
                    'ip' => $_SERVER['REMOTE_ADDR']
                ]);

                return $this->json([
                    'success' => false,
                    'message' => 'Invalid username or password.'
                ]);
            }

            // Verify password
            // Note: $user is now an object, but we need to check if password property exists
            // Since our Model returns objects, we access properties directly
            if (!password_verify($password, $user->password ?? '')) {
                Logger::warning('Failed login attempt - invalid password', [
                    'user_id' => $user->id,
                    'ip' => $_SERVER['REMOTE_ADDR']
                ]);

                return $this->json([
                    'success' => false,
                    'message' => 'Invalid username or password.'
                ]);
            }

            // Check if account is active
            if (!$user->is_active) {
                return $this->json([
                    'success' => false,
                    'message' => 'Your account has been deactivated. Please contact administrator.'
                ]);
            }

            // Login successful
            AuthService::login($user->id);

            // Handle remember me
            if ($rememberMe) {
                $cookieValue = base64_encode($user->username . ':' . $user->id);
                setcookie('remember_login', $cookieValue, time() + (86400 * 30), '/');
            }

            Logger::info('User logged in', [
                'user_id' => $user->id,
                'username' => $user->username
            ]);

            // Determine redirect URL based on role
            $redirectUrl = $this->getDashboardUrl($user->role);

            return $this->json([
                'success' => true,
                'message' => 'Login successful! Redirecting to your dashboard...',
                'redirect' => $redirectUrl
            ]);

        } catch (\Exception $e) {
            Logger::error('Login error', ['error' => $e->getMessage()]);
            return $this->json([
                'success' => false,
                'message' => 'An error occurred. Please try again.'
            ], 500);
        }
    }

    /**
     * Show registration form
     */
    public function showRegister(Request $request): Response
    {
        // If already logged in, redirect to dashboard
        if (AuthService::check()) {
            return $this->redirectToDashboard();
        }

        return $this->view('auth/register', [], ''); // No layout
    }

    /**
     * Handle registration
     */
    public function register(Request $request): Response
    {
        try {
            // Verify CSRF token
            if (!CSRF::verify()) {
                return $this->json([
                    'success' => false,
                    'message' => 'Invalid request. Please refresh and try again.'
                ]);
            }

            // Validate input
            // Using the new validate method which returns validated data
            // We pass $request->all() as second arg to be explicit
            $data = $this->validate([
                'username' => 'required|alphanumeric|min:3|max:50|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'first_name' => 'required|max:100',
                'last_name' => 'required|max:100',
                'country' => 'required|max:100'
            ], $request->all());

            // Create user
            $data['role'] = 'author'; // Default role
            $data['is_active'] = 1;
            $data['middle_name'] = $request->input('middle_name');
            $data['affiliation'] = $request->input('affiliation');

            $userId = $this->userModel->createUser($data);

            Logger::info('New user registered', [
                'user_id' => $userId,
                'username' => $data['username'],
                'email' => $data['email']
            ]);

            // Send welcome email
            $this->emailService->sendWelcomeEmail($data['email'], $data['first_name']);

            return $this->json([
                'success' => true,
                'message' => 'Registration successful! Redirecting to login...',
                'redirect' => '/login'
            ]);

        } catch (\Exception $e) {
            // Validator throws no exception now (it returns response), so this catches other errors
            Logger::error('Registration error', ['error' => $e->getMessage()]);
            
            return $this->json([
                'success' => false,
                'message' => 'An error occurred. Please try again.'
            ]);
        }
    }

    /**
     * Handle logout
     */
    public function logout(Request $request): Response
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

        return $this->redirect('/');
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
    private function redirectToDashboard(): Response
    {
        $role = $_SESSION['role'] ?? '';
        $url = $this->getDashboardUrl($role);
        return $this->redirect($url);
    }
}
