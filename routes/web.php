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

// User Management
$router->get('/admin/users', ['AdminController', 'users']);
$router->post('/admin/users/create', ['AdminController', 'createUser']);
$router->post('/admin/users/{id}/update', ['AdminController', 'updateUser']);
$router->post('/admin/users/{id}/delete', ['AdminController', 'deleteUser']);

// Submission Management
$router->get('/admin/submissions', ['AdminController', 'submissions']);
$router->post('/admin/submissions/{id}/publish', ['AdminController', 'publishArticle']);
$router->post('/admin/submissions/{id}/unpublish', ['AdminController', 'unpublishArticle']);

// Category Management
$router->get('/admin/categories', ['AdminController', 'categories']);
$router->post('/admin/categories/create', ['AdminController', 'createCategory']);
$router->post('/admin/categories/{id}/delete', ['AdminController', 'deleteCategory']);

// Reviewer Assignment
$router->post('/admin/assign-reviewer', ['AdminController', 'assignReviewer']);

// ============================================
// Editor Routes
// ============================================

$router->get('/editor/dashboard', ['EditorController', 'dashboard']);
$router->get('/editor/submissions', ['EditorController', 'submissions']);
$router->get('/editor/submission/{id}', ['EditorController', 'viewSubmission']);
$router->post('/editor/assign-reviewer', ['EditorController', 'assignReviewer']);
$router->post('/editor/submission/{id}/decision', ['EditorController', 'publishDecision']);
$router->get('/editor/reviewers', ['EditorController', 'getReviewers']);

// ============================================
// Reviewer Routes
// ============================================

$router->get('/reviewer/dashboard', ['ReviewerController', 'dashboard']);
$router->get('/reviewer/submissions', ['ReviewerController', 'submissions']);
$router->get('/reviewer/submission/{id}', ['ReviewerController', 'viewSubmission']);
$router->post('/reviewer/review/{id}/submit', ['ReviewerController', 'submitReview']);
$router->post('/reviewer/review/{id}/update', ['ReviewerController', 'updateReview']);
$router->get('/reviewer/history', ['ReviewerController', 'history']);

// ============================================
// API Routes (Optional)
// ============================================

$router->get('/api/submissions', ['ApiController', 'submissions']);
$router->get('/api/submission/{id}', ['ApiController', 'submission']);

// Return router instance
return $router;
