<?php

/**
 * Application Routes
 * Define all application routes here
 */

use App\Core\Router;

$router = new Router();

// ============================================
// Public Routes
// ============================================

// Home
$router->get('/', ['HomeController', 'index']);
$router->get('/home', ['HomeController', 'index']);

// About & Info Pages
$router->get('/about', ['HomeController', 'about']);
$router->get('/contact', ['HomeController', 'contact']);
$router->post('/contact', ['HomeController', 'sendContact']);
$router->get('/faq', ['HomeController', 'faq']);
$router->get('/current-issues', ['HomeController', 'currentIssues']);

// Search
$router->get('/search', ['HomeController', 'search']);

// ============================================
// Authentication Routes
// ============================================

$router->get('/login', ['AuthController', 'showLogin']);
$router->post('/login', ['AuthController', 'login']);
$router->get('/register', ['AuthController', 'showRegister']);
$router->post('/register', ['AuthController', 'register']);
$router->get('/logout', ['AuthController', 'logout']);
$router->post('/logout', ['AuthController', 'logout']);

// ============================================
// Author Routes
// ============================================

$router->get('/author/dashboard', ['AuthorController', 'dashboard']);
$router->get('/author/submit', ['AuthorController', 'showSubmit']);
$router->post('/author/submit', ['AuthorController', 'submit']);
$router->get('/author/manage', ['AuthorController', 'manageArticles']);
$router->get('/author/article/{id}', ['AuthorController', 'viewArticle']);
$router->post('/author/article/{id}/delete', ['AuthorController', 'deleteArticle']);

// ============================================
// Admin Routes
// ============================================

$router->get('/admin/dashboard', ['AdminController', 'dashboard']);
$router->get('/admin/users', ['AdminController', 'users']);
$router->get('/admin/submissions', ['AdminController', 'submissions']);
$router->get('/admin/categories', ['AdminController', 'categories']);

// ============================================
// Editor Routes
// ============================================

$router->get('/editor/dashboard', ['EditorController', 'dashboard']);
$router->get('/editor/submissions', ['EditorController', 'submissions']);
$router->get('/editor/submission/{id}', ['EditorController', 'viewSubmission']);
$router->post('/editor/submission/{id}/publish', ['EditorController', 'publish']);

// ============================================
// Reviewer Routes
// ============================================

$router->get('/reviewer/dashboard', ['ReviewerController', 'dashboard']);
$router->get('/reviewer/submissions', ['ReviewerController', 'submissions']);
$router->get('/reviewer/submission/{id}', ['ReviewerController', 'viewSubmission']);
$router->post('/reviewer/submission/{id}/review', ['ReviewerController', 'submitReview']);

// ============================================
// API Routes (Optional)
// ============================================

$router->get('/api/submissions', ['ApiController', 'submissions']);
$router->get('/api/submission/{id}', ['ApiController', 'submission']);

// Return router instance
return $router;
