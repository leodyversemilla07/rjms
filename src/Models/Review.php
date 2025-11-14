<?php

namespace App\Models;

use App\Core\Model;

/**
 * Review Model
 * Handles peer review records
 */
class Review extends Model
{
    protected string $table = 'reviews';
    protected string $primaryKey = 'id';
    
    protected array $fillable = [
        'submission_id',
        'reviewer_id',
        'review_date',
        'recommendation',
        'comments',
        'rating',
        'status'
    ];

    /**
     * Get reviews by submission
     */
    public function getBySubmission(int $submissionId): array
    {
        return $this->where('submission_id', $submissionId);
    }

    /**
     * Get reviews by reviewer
     */
    public function getByReviewer(int $reviewerId): array
    {
        return $this->where('reviewer_id', $reviewerId);
    }

    /**
     * Get review with submission and reviewer details
     */
    public function getWithDetails(int $id): ?array
    {
        $sql = "SELECT r.*, 
                       s.title as submission_title,
                       u.username as reviewer_name,
                       u.email as reviewer_email
                FROM {$this->table} r
                INNER JOIN submissions s ON r.submission_id = s.id
                INNER JOIN users u ON r.reviewer_id = u.id
                WHERE r.id = ?";
        $result = $this->query($sql, [$id]);
        return !empty($result) ? $result[0] : null;
    }

    /**
     * Get pending reviews for reviewer
     */
    public function getPendingByReviewer(int $reviewerId): array
    {
        $sql = "SELECT * FROM {$this->table} 
                WHERE reviewer_id = ? AND status = 'pending'
                ORDER BY assigned_date DESC";
        return $this->query($sql, [$reviewerId]);
    }

    /**
     * Get completed reviews for reviewer
     */
    public function getCompletedByReviewer(int $reviewerId): array
    {
        $sql = "SELECT * FROM {$this->table} 
                WHERE reviewer_id = ? AND status = 'completed'
                ORDER BY review_date DESC";
        return $this->query($sql, [$reviewerId]);
    }

    /**
     * Submit review
     */
    public function submitReview(int $id, array $data): bool
    {
        $data['status'] = 'completed';
        $data['review_date'] = date('Y-m-d H:i:s');
        return $this->update($id, $data);
    }

    /**
     * Get review statistics for submission
     */
    public function getSubmissionStats(int $submissionId): array
    {
        $sql = "SELECT 
                    COUNT(*) as total_reviews,
                    AVG(rating) as average_rating,
                    SUM(CASE WHEN recommendation = 'accept' THEN 1 ELSE 0 END) as accept_count,
                    SUM(CASE WHEN recommendation = 'reject' THEN 1 ELSE 0 END) as reject_count,
                    SUM(CASE WHEN recommendation = 'revise' THEN 1 ELSE 0 END) as revise_count
                FROM {$this->table}
                WHERE submission_id = ? AND status = 'completed'";
        $result = $this->query($sql, [$submissionId]);
        return !empty($result) ? $result[0] : [];
    }
}
