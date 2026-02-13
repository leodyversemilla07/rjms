<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Review;
use App\Models\Submission;
use App\Core\Logger;

/**
 * Reviewer Controller
 * Handles reviewer dashboard and review functions
 */
class ReviewerController extends Controller
{
    private Review $reviewModel;
    private Submission $submissionModel;

    public function __construct(Review $reviewModel, Submission $submissionModel)
    {
        $this->requireRole('reviewer');
        $this->layout = 'layouts/dashboard';
        $this->submissionModel = $submissionModel;
        $this->reviewModel = $reviewModel;
    }

    /**
     * Reviewer dashboard
     */
    public function dashboard(Request $request): Response
    {
        $user = $this->user();
        $userId = $user['id'];

        $pendingReviews = $this->reviewModel->getPendingByReviewer($userId);
        $completedReviews = $this->reviewModel->getCompletedByReviewer($userId);

        $stats = [
            'pending' => count($pendingReviews),
            'completed' => count($completedReviews),
            'total' => count($pendingReviews) + count($completedReviews)
        ];

        return $this->view('reviewer/dashboard', [
            'user' => $user,
            'stats' => $stats,
            'pending_reviews' => $pendingReviews,
            'completed_reviews' => array_slice($completedReviews, 0, 5)
        ]);
    }

    /**
     * View all assignments
     */
    public function submissions(Request $request): Response
    {
        $user = $this->user();
        $reviews = $this->reviewModel->getByReviewer($user['id']);

        // Get submission details for each review
        $reviewsWithDetails = [];
        foreach ($reviews as $review) {
            $submission = $this->submissionModel->find($review->submission_id);
            if ($submission) {
                $review->submission = $submission;
                $reviewsWithDetails[] = $review;
            }
        }

        return $this->view('reviewer/submissions', [
            'reviews' => $reviewsWithDetails
        ]);
    }

    /**
     * View submission for review
     */
    public function viewSubmission(Request $request, int $id): Response
    {
        $user = $this->user();
        
        // Find the review assignment
        $review = $this->reviewModel->firstWhere('id', $id);
        
        if (!$review) {
            $this->flash('error', 'Review assignment not found.');
            return $this->redirect('/reviewer/dashboard');
        }

        // Verify this reviewer is assigned
        if ($review->reviewer_id != $user['id']) {
            $this->flash('error', 'Unauthorized access.');
            return $this->redirect('/reviewer/dashboard');
        }

        // Get submission details
        $submission = $this->submissionModel->getWithAuthor($review->submission_id);

        if (!$submission) {
            $this->flash('error', 'Submission not found.');
            return $this->redirect('/reviewer/dashboard');
        }

        return $this->view('reviewer/view-submission', [
            'review' => $review,
            'submission' => $submission
        ]);
    }

    /**
     * Submit review
     */
    public function submitReview(Request $request, int $id): Response
    {
        $user = $this->user();
        
        $review = $this->reviewModel->find($id);
        
        if (!$review) {
            $this->flash('error', 'Review not found.');
            return $this->redirect('/reviewer/dashboard');
        }

        // Verify reviewer
        if ($review->reviewer_id != $user['id']) {
            $this->flash('error', 'Unauthorized access.');
            return $this->redirect('/reviewer/dashboard');
        }

        try {
            $data = $this->validate([
                'recommendation' => 'required',
                'comments' => 'required',
                'rating' => 'required|numeric'
            ], $request->all());

            $this->reviewModel->submitReview($id, $data);

            Logger::info('Review submitted', [
                'review_id' => $id,
                'reviewer_id' => $user['id'],
                'submission_id' => $review->submission_id
            ]);

            $this->flash('success', 'Review submitted successfully!');
            return $this->redirect('/reviewer/dashboard');

        } catch (\Exception $e) {
            Logger::error('Review submission failed', ['error' => $e->getMessage()]);
            $this->flash('error', 'Failed to submit review.');
            return $this->back();
        }
    }

    /**
     * Update review
     */
    public function updateReview(Request $request, int $id): Response
    {
        $user = $this->user();
        
        $review = $this->reviewModel->find($id);
        
        if (!$review || $review->reviewer_id != $user['id']) {
            $this->flash('error', 'Unauthorized access.');
            return $this->redirect('/reviewer/dashboard');
        }

        try {
            $data = $this->validate([
                'recommendation' => 'required',
                'comments' => 'required',
                'rating' => 'required|numeric'
            ], $request->all());

            $this->reviewModel->update($id, $data);

            Logger::info('Review updated', [
                'review_id' => $id,
                'reviewer_id' => $user['id']
            ]);

            $this->flash('success', 'Review updated successfully!');
            return $this->redirect('/reviewer/submission/' . $id);

        } catch (\Exception $e) {
            $this->flash('error', 'Failed to update review.');
            return $this->back();
        }
    }

    /**
     * View review history
     */
    public function history(Request $request): Response
    {
        $user = $this->user();
        $completedReviews = $this->reviewModel->getCompletedByReviewer($user['id']);

        // Get submission details
        $reviewsWithDetails = [];
        foreach ($completedReviews as $review) {
            $submission = $this->submissionModel->find($review->submission_id);
            if ($submission) {
                $review->submission = $submission;
                $reviewsWithDetails[] = $review;
            }
        }

        return $this->view('reviewer/history', [
            'reviews' => $reviewsWithDetails
        ]);
    }
}
