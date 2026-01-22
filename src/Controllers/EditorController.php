<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Submission;
use App\Models\Review;
use App\Models\User;
use App\Services\EmailService;
use App\Core\Logger;

/**
 * Editor Controller
 * Handles editor dashboard and editorial functions
 */
class EditorController extends Controller
{
    private Submission $submissionModel;
    private Review $reviewModel;
    private User $userModel;
    private EmailService $emailService;

    public function __construct()
    {
        $this->requireRole('editor');
        $this->layout = 'layouts/dashboard';
        $this->submissionModel = new Submission();
        $this->reviewModel = new Review();
        $this->userModel = new User();
        $this->emailService = new EmailService();
    }

    /**
     * Editor dashboard
     */
    public function dashboard(): void
    {
        $stats = [
            'total_submissions' => $this->submissionModel->count(),
            'pending' => count($this->submissionModel->getByStatus('pending')),
            'under_review' => count($this->submissionModel->getByStatus('under_review')),
            'published' => count($this->submissionModel->getPublished())
        ];

        $recentSubmissions = $this->submissionModel->orderBy('submission_date', 'DESC');
        array_splice($recentSubmissions, 10);

        $this->view('editor/dashboard', [
            'user' => $this->user(),
            'stats' => $stats,
            'submissions' => $recentSubmissions
        ]);
    }

    /**
     * View all submissions
     */
    public function submissions(): void
    {
        $submissions = $this->submissionModel->query(
            "SELECT s.*, u.username as author_name,
                    COUNT(r.id) as review_count
             FROM submissions s
             LEFT JOIN users u ON s.author_id = u.id
             LEFT JOIN reviews r ON s.id = r.submission_id
             GROUP BY s.id
             ORDER BY s.submission_date DESC"
        );

        $this->view('editor/submissions', [
            'submissions' => $submissions
        ]);
    }

    /**
     * View single submission details
     */
    public function viewSubmission(int $id): void
    {
        $submission = $this->submissionModel->getWithAuthor($id);
        
        if (!$submission) {
            $this->flash('error', 'Submission not found.');
            $this->redirect('/editor/dashboard');
            return;
        }

        $reviews = $this->reviewModel->getBySubmission($id);
        $reviewStats = $this->reviewModel->getSubmissionStats($id);
        $reviewers = $this->userModel->getByRole('reviewer');

        $this->view('editor/view-submission', [
            'submission' => $submission,
            'reviews' => $reviews,
            'review_stats' => $reviewStats,
            'reviewers' => $reviewers
        ]);
    }

    /**
     * Assign reviewer
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
                'status' => 'pending'
            ]);

            // Update submission status to under review
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

            Logger::info('Reviewer assigned by editor', [
                'submission_id' => $submissionId,
                'reviewer_id' => $reviewerId,
                'editor_id' => $this->user()['id']
            ]);

            $this->json([
                'success' => true,
                'message' => 'Reviewer assigned successfully!'
            ]);

        } catch (\Exception $e) {
            Logger::error('Reviewer assignment failed', ['error' => $e->getMessage()]);
            $this->json([
                'success' => false,
                'message' => 'Failed to assign reviewer'
            ], 500);
        }
    }

    /**
     * Make publication decision
     */
    public function publishDecision(int $id): void
    {
        $decision = $_POST['decision'] ?? '';
        
        if (!in_array($decision, ['accept', 'reject', 'revise'])) {
            $this->flash('error', 'Invalid decision.');
            $this->back();
            return;
        }

        $submission = $this->submissionModel->find($id);
        if (!$submission) {
            $this->flash('error', 'Submission not found.');
            $this->redirect('/editor/submissions');
            return;
        }

        try {
            if ($decision === 'accept') {
                $this->submissionModel->publish($id);
                $message = 'Article published successfully!';
            } elseif ($decision === 'reject') {
                $this->submissionModel->updateStatus($id, 'rejected');
                $message = 'Article rejected.';
            } else {
                $this->submissionModel->updateStatus($id, 'revision_required');
                $message = 'Revision requested.';
            }

            // Send decision email
            $author = $this->userModel->find($submission['author_id']);
            if ($author) {
                $this->emailService->sendDecisionNotification(
                    $author['email'],
                    $author['first_name'],
                    $submission['title'],
                    $decision
                );
            }

            Logger::info('Publication decision made', [
                'submission_id' => $id,
                'decision' => $decision,
                'editor_id' => $this->user()['id']
            ]);

            $this->flash('success', $message);
            $this->redirect('/editor/submission/' . $id);

        } catch (\Exception $e) {
            Logger::error('Publication decision failed', ['error' => $e->getMessage()]);
            $this->flash('error', 'Failed to process decision.');
            $this->back();
        }
    }

    /**
     * Get reviewers list (for AJAX)
     */
    public function getReviewers(): void
    {
        $reviewers = $this->userModel->getByRole('reviewer');
        $this->json(['success' => true, 'reviewers' => $reviewers]);
    }
}
