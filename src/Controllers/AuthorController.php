<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Submission;
use App\Services\EmailService;
use App\Core\Logger;

/**
 * Author Controller
 * Handles author dashboard and article management
 */
class AuthorController extends Controller
{
    private Submission $submissionModel;
    private EmailService $emailService;

    public function __construct(Submission $submissionModel, EmailService $emailService)
    {
        $this->requireRole('author');
        $this->layout = 'layouts/dashboard';
        $this->submissionModel = $submissionModel;
        $this->emailService = $emailService;
    }

    /**
     * Author dashboard
     */
    public function dashboard(Request $request): Response
    {
        $user = $this->user();
        $userId = $user['id'];

        // Get author's submissions
        $submissions = $this->submissionModel->getByAuthor($userId);

        // Get statistics
        $stats = [
            'total' => count($submissions),
            'pending' => count(array_filter($submissions, fn($s) => $s->status === 'pending')),
            'under_review' => count(array_filter($submissions, fn($s) => $s->status === 'under_review')),
            'published' => count(array_filter($submissions, fn($s) => $s->isPublished()))
        ];

        return $this->view('author/dashboard', [
            'user' => $user,
            'submissions' => $submissions,
            'stats' => $stats
        ]);
    }

    /**
     * Show submit article form
     */
    public function showSubmit(Request $request): Response
    {
        return $this->view('author/submit');
    }

    /**
     * Handle article submission
     */
    public function submit(Request $request): Response
    {
        try {
            // Verify CSRF token
            if (!\App\Core\CSRF::verify()) {
                throw new \Exception('Invalid request. Please try again.');
            }

            $data = $this->validate([
                'title' => 'required|max:255',
                'abstract' => 'required',
                'keywords' => 'required|max:255'
            ], $request->all());

            // Handle file upload
            $file = $request->file('manuscript');
            if ($file && $file['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../uploads/submissions/';
                
                // Validate file type
                $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                $fileType = mime_content_type($file['tmp_name']);
                
                if (!in_array($fileType, $allowedTypes)) {
                    throw new \Exception('Invalid file type. Only PDF, DOC, and DOCX files are allowed.');
                }
                
                // Validate file size (10MB max)
                $maxSize = 10 * 1024 * 1024; // 10MB in bytes
                if ($file['size'] > $maxSize) {
                    throw new \Exception('File size exceeds maximum limit of 10MB.');
                }
                
                // Create directory if not exists
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0775, true);
                }

                // Sanitize filename and add unique prefix
                $originalName = basename($file['name']);
                $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                $safeName = preg_replace('/[^a-zA-Z0-9_\-]/', '', pathinfo($originalName, PATHINFO_FILENAME));
                $fileName = uniqid() . '_' . $safeName . '.' . $extension;
                $uploadPath = $uploadDir . $fileName;

                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    $data['file_path'] = 'uploads/submissions/' . $fileName;
                } else {
                    throw new \Exception('Failed to upload file');
                }
            } else {
                throw new \Exception('Please upload a manuscript file');
            }

            $user = $this->user();
            $data['author_id'] = $user['id'];
            $data['status'] = 'pending';
            $data['submission_date'] = date('Y-m-d H:i:s');

            $submissionId = $this->submissionModel->create($data);

            Logger::info('New article submitted', [
                'submission_id' => $submissionId,
                'author_id' => $user['id'],
                'title' => $data['title']
            ]);

            // Send confirmation email
            $this->emailService->sendSubmissionConfirmation($user['email'], $user['first_name'], $data['title']);

            $this->flash('success', 'Article submitted successfully!');
            return $this->redirect('/author/dashboard');

        } catch (\Exception $e) {
            Logger::error('Article submission failed', ['error' => $e->getMessage()]);
            $this->flash('error', $e->getMessage());
            return $this->back();
        }
    }

    /**
     * Show manage articles page
     */
    public function manageArticles(Request $request): Response
    {
        $user = $this->user();
        $submissions = $this->submissionModel->getByAuthor($user['id']);

        return $this->view('author/manage', [
            'submissions' => $submissions
        ]);
    }

    /**
     * View article details
     */
    public function viewArticle(Request $request, int $id): Response
    {
        $submission = $this->submissionModel->getWithAuthor($id);

        if (!$submission) {
            $this->flash('error', 'Article not found.');
            return $this->redirect('/author/dashboard');
        }

        // Check if user owns this submission
        $user = $this->user();
        if ($submission->author_id != $user['id']) {
            $this->flash('error', 'Unauthorized access.');
            return $this->redirect('/author/dashboard');
        }

        return $this->view('author/view', [
            'submission' => $submission
        ]);
    }

    /**
     * Delete article
     */
    public function deleteArticle(Request $request, int $id): Response
    {
        $submission = $this->submissionModel->find($id);

        if (!$submission) {
            $this->flash('error', 'Article not found.');
            return $this->redirect('/author/dashboard');
        }

        // Check if user owns this submission
        $user = $this->user();
        if ($submission->author_id != $user['id']) {
            $this->flash('error', 'Unauthorized access.');
            return $this->redirect('/author/dashboard');
        }

        // Delete file if exists
        if (!empty($submission->file_path) && file_exists($submission->file_path)) {
            unlink($submission->file_path);
        }

        $this->submissionModel->delete($id);

        Logger::info('Article deleted', [
            'submission_id' => $id,
            'author_id' => $user['id']
        ]);

        $this->flash('success', 'Article deleted successfully!');
        return $this->redirect('/author/dashboard');
    }
}
