<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Submission;
use App\Models\Category;
use App\Models\Review;
use App\Services\EmailService;
use App\Core\Logger;

/**
 * Admin Controller
 * Handles admin dashboard and management
 */
class AdminController extends Controller
{
    private User $userModel;
    private Submission $submissionModel;
    private Category $categoryModel;
    private Review $reviewModel;
    private EmailService $emailService;

    public function __construct()
    {
        $this->requireRole('admin');
        $this->layout = 'layouts/dashboard'; // Use dashboard layout instead of main
        $this->userModel = new User();
        $this->submissionModel = new Submission();
        $this->categoryModel = new Category();
        $this->reviewModel = new Review();
        $this->emailService = new EmailService();
    }

    /**
     * Admin dashboard
     */
    public function dashboard(): void
    {
        $stats = [
            'total_users' => $this->userModel->count(),
            'total_submissions' => $this->submissionModel->count(),
            'pending_submissions' => count($this->submissionModel->getByStatus('pending')),
            'published_articles' => count($this->submissionModel->getPublished()),
            'total_categories' => $this->categoryModel->count()
        ];

        $recentSubmissions = $this->submissionModel->orderBy('submission_date', 'DESC');
        array_splice($recentSubmissions, 5); // Limit to 5

        $this->view('admin/dashboard', [
            'user' => $this->user(),
            'stats' => $stats,
            'recent_submissions' => $recentSubmissions
        ]);
    }

    /**
     * Manage users
     */
    public function users(): void
    {
        $users = $this->userModel->all();
        
        $this->view('admin/users', [
            'users' => $users
        ]);
    }

    /**
     * Create user
     */
    public function createUser(): void
    {
        try {
            $data = $this->validate([
                'username' => 'required|alphanumeric|min:3|max:50',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'role' => 'required',
                'first_name' => 'required|max:100',
                'last_name' => 'required|max:100',
                'country' => 'required|max:100'
            ]);

            // Check if username or email exists
            if ($this->userModel->findByUsername($data['username'])) {
                $this->flash('error', 'Username already exists.');
                $this->back();
                return;
            }

            if ($this->userModel->findByEmail($data['email'])) {
                $this->flash('error', 'Email already exists.');
                $this->back();
                return;
            }

            $data['is_active'] = 1;
            $userId = $this->userModel->createUser($data);

            Logger::info('User created by admin', [
                'new_user_id' => $userId,
                'admin_id' => $this->user()['id']
            ]);

            // Send welcome email
            $this->emailService->sendWelcomeEmail($data['email'], $data['first_name']);

            $this->flash('success', 'User created successfully!');
            $this->redirect('/admin/users');

        } catch (\Exception $e) {
            Logger::error('User creation failed', ['error' => $e->getMessage()]);
            $this->flash('error', 'Failed to create user.');
            $this->back();
        }
    }

    /**
     * Update user
     */
    public function updateUser(int $id): void
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            $this->flash('error', 'User not found.');
            $this->redirect('/admin/users');
            return;
        }

        try {
            $data = $this->validate([
                'email' => 'required|email',
                'role' => 'required',
                'first_name' => 'required|max:100',
                'last_name' => 'required|max:100'
            ]);

            $this->userModel->update($id, $data);

            Logger::info('User updated by admin', [
                'user_id' => $id,
                'admin_id' => $this->user()['id']
            ]);

            $this->flash('success', 'User updated successfully!');
            $this->redirect('/admin/users');

        } catch (\Exception $e) {
            $this->flash('error', 'Failed to update user.');
            $this->back();
        }
    }

    /**
     * Delete user
     */
    public function deleteUser(int $id): void
    {
        if ($id == $this->user()['id']) {
            $this->flash('error', 'You cannot delete your own account.');
            $this->redirect('/admin/users');
            return;
        }

        $this->userModel->delete($id);

        Logger::info('User deleted by admin', [
            'deleted_user_id' => $id,
            'admin_id' => $this->user()['id']
        ]);

        $this->flash('success', 'User deleted successfully!');
        $this->redirect('/admin/users');
    }

    /**
     * Manage submissions
     */
    public function submissions(): void
    {
        $submissions = $this->submissionModel->query(
            "SELECT s.*, u.username as author_name 
             FROM submissions s 
             INNER JOIN users u ON s.author_id = u.id 
             ORDER BY s.submission_date DESC"
        );

        $this->view('admin/submissions', [
            'submissions' => $submissions
        ]);
    }

    /**
     * Publish article
     */
    public function publishArticle(int $id): void
    {
        $submission = $this->submissionModel->find($id);
        if (!$submission) {
            $this->flash('error', 'Submission not found.');
            $this->redirect('/admin/submissions');
            return;
        }

        $this->submissionModel->publish($id);

        Logger::info('Article published by admin', [
            'submission_id' => $id,
            'admin_id' => $this->user()['id']
        ]);

        $this->flash('success', 'Article published successfully!');
        $this->redirect('/admin/submissions');
    }

    /**
     * Unpublish article
     */
    public function unpublishArticle(int $id): void
    {
        $this->submissionModel->unpublish($id);

        Logger::info('Article unpublished by admin', [
            'submission_id' => $id,
            'admin_id' => $this->user()['id']
        ]);

        $this->flash('success', 'Article unpublished successfully!');
        $this->redirect('/admin/submissions');
    }

    /**
     * Manage categories
     */
    public function categories(): void
    {
        $categories = $this->categoryModel->getWithSubmissionCount();

        $this->view('admin/categories', [
            'categories' => $categories
        ]);
    }

    /**
     * Create category
     */
    public function createCategory(): void
    {
        try {
            $data = $this->validate([
                'name' => 'required|max:255',
                'description' => 'required'
            ]);

            $data['is_active'] = 1;
            $categoryId = $this->categoryModel->create($data);

            Logger::info('Category created', [
                'category_id' => $categoryId,
                'admin_id' => $this->user()['id']
            ]);

            $this->flash('success', 'Category created successfully!');
            $this->redirect('/admin/categories');

        } catch (\Exception $e) {
            $this->flash('error', 'Failed to create category.');
            $this->back();
        }
    }

    /**
     * Delete category
     */
    public function deleteCategory(int $id): void
    {
        $this->categoryModel->delete($id);

        Logger::info('Category deleted', [
            'category_id' => $id,
            'admin_id' => $this->user()['id']
        ]);

        $this->flash('success', 'Category deleted successfully!');
        $this->redirect('/admin/categories');
    }

    /**
     * Assign reviewer to submission
     */
    public function assignReviewer(): void
    {
        $submissionId = $_POST['submission_id'] ?? 0;
        $reviewerId = $_POST['reviewer_id'] ?? 0;

        if (!$submissionId || !$reviewerId) {
            $this->json(['success' => false, 'message' => 'Invalid data'], 400);
            return;
        }

        try {
            $this->reviewModel->create([
                'submission_id' => $submissionId,
                'reviewer_id' => $reviewerId,
                'status' => 'pending',
                'review_date' => null
            ]);

            // Update submission status
            $this->submissionModel->updateStatus($submissionId, 'under_review');

            // Send assignment email
            $reviewer = $this->userModel->find($reviewerId);
            $submission = $this->submissionModel->find($submissionId);
            
            if ($reviewer && $submission) {
                $deadline = date('Y-m-d', strtotime('+2 weeks'));
                $this->emailService->sendReviewAssignment(
                    $reviewer['email'], 
                    $reviewer['first_name'], 
                    $submission['title'], 
                    $deadline
                );
            }

            Logger::info('Reviewer assigned', [
                'submission_id' => $submissionId,
                'reviewer_id' => $reviewerId,
                'admin_id' => $this->user()['id']
            ]);

            $this->json(['success' => true, 'message' => 'Reviewer assigned successfully!']);

        } catch (\Exception $e) {
            Logger::error('Reviewer assignment failed', ['error' => $e->getMessage()]);
            $this->json(['success' => false, 'message' => 'Failed to assign reviewer'], 500);
        }
    }
}
