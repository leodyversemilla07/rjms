<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Submission;
use App\Core\Logger;

/**
 * Author Controller
 * Handles author dashboard and article management
 */
class AuthorController extends Controller
{
    private Submission $submissionModel;

    public function __construct()
    {
        $this->requireRole('author');
        $this->submissionModel = new Submission();
    }

    /**
     * Author dashboard
     */
    public function dashboard(): void
    {
        $user = $this->user();
        $userId = $user['id'];

        // Get author's submissions
        $submissions = $this->submissionModel->getByAuthor($userId);

        // Get statistics
        $stats = [
            'total' => count($submissions),
            'pending' => count(array_filter($submissions, fn($s) => $s['status'] === 'pending')),
            'under_review' => count(array_filter($submissions, fn($s) => $s['status'] === 'under_review')),
            'published' => count(array_filter($submissions, fn($s) => $s['is_published'] == 1))
        ];

        $this->view('author/dashboard', [
            'user' => $user,
            'submissions' => $submissions,
            'stats' => $stats
        ]);
    }

    /**
     * Show submit article form
     */
    public function showSubmit(): void
    {
        $this->view('author/submit');
    }

    /**
     * Handle article submission
     */
    public function submit(): void
    {
        try {
            $data = $this->validate([
                'title' => 'required|max:255',
                'abstract' => 'required',
                'keywords' => 'required|max:255'
            ]);

            // Handle file upload
            if (isset($_FILES['manuscript']) && $_FILES['manuscript']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../uploads/submissions/';
                
                // Create directory if not exists
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0775, true);
                }

                $fileName = time() . '_' . basename($_FILES['manuscript']['name']);
                $uploadPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['manuscript']['tmp_name'], $uploadPath)) {
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

            $this->flash('success', 'Article submitted successfully!');
            $this->redirect('/author/dashboard');

        } catch (\Exception $e) {
            Logger::error('Article submission failed', ['error' => $e->getMessage()]);
            $this->flash('error', $e->getMessage());
            $this->back();
        }
    }

    /**
     * Show manage articles page
     */
    public function manageArticles(): void
    {
        $user = $this->user();
        $submissions = $this->submissionModel->getByAuthor($user['id']);

        $this->view('author/manage', [
            'submissions' => $submissions
        ]);
    }

    /**
     * View article details
     */
    public function viewArticle(int $id): void
    {
        $submission = $this->submissionModel->getWithAuthor($id);

        if (!$submission) {
            $this->flash('error', 'Article not found.');
            $this->redirect('/author/dashboard');
            return;
        }

        // Check if user owns this submission
        $user = $this->user();
        if ($submission['author_id'] != $user['id']) {
            $this->flash('error', 'Unauthorized access.');
            $this->redirect('/author/dashboard');
            return;
        }

        $this->view('author/view', [
            'submission' => $submission
        ]);
    }

    /**
     * Delete article
     */
    public function deleteArticle(int $id): void
    {
        $submission = $this->submissionModel->find($id);

        if (!$submission) {
            $this->flash('error', 'Article not found.');
            $this->redirect('/author/dashboard');
            return;
        }

        // Check if user owns this submission
        $user = $this->user();
        if ($submission['author_id'] != $user['id']) {
            $this->flash('error', 'Unauthorized access.');
            $this->redirect('/author/dashboard');
            return;
        }

        // Delete file if exists
        if (!empty($submission['file_path']) && file_exists($submission['file_path'])) {
            unlink($submission['file_path']);
        }

        $this->submissionModel->delete($id);

        Logger::info('Article deleted', [
            'submission_id' => $id,
            'author_id' => $user['id']
        ]);

        $this->flash('success', 'Article deleted successfully!');
        $this->redirect('/author/dashboard');
    }
}
