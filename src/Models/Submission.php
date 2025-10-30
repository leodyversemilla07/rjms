<?php

namespace App\Models;

use App\Core\Model;

/**
 * Submission Model
 */
class Submission extends Model
{
    protected string $table = 'submissions';
    protected string $primaryKey = 'id';
    
    protected array $fillable = [
        'author_id',
        'title',
        'abstract',
        'keywords',
        'file_path',
        'status',
        'submission_date',
        'review_deadline',
        'revision_notes',
        'is_published',
        'date_published',
        'views_count',
        'downloads_count'
    ];

    /**
     * Get submissions by author
     */
    public function getByAuthor(int $authorId): array
    {
        return $this->where('author_id', $authorId);
    }

    /**
     * Get published submissions
     */
    public function getPublished(): array
    {
        return $this->where('is_published', 1);
    }

    /**
     * Get submissions by status
     */
    public function getByStatus(string $status): array
    {
        return $this->where('status', $status);
    }

    /**
     * Get recent submissions
     */
    public function getRecent(int $limit = 10): array
    {
        $sql = "SELECT * FROM {$this->table} 
                WHERE is_published = 1 
                ORDER BY date_published DESC 
                LIMIT ?";
        return $this->query($sql, [$limit]);
    }

    /**
     * Search submissions
     */
    public function search(string $keyword): array
    {
        $keyword = "%{$keyword}%";
        $sql = "SELECT * FROM {$this->table} 
                WHERE (title LIKE ? OR abstract LIKE ? OR keywords LIKE ?) 
                AND is_published = 1";
        return $this->query($sql, [$keyword, $keyword, $keyword]);
    }

    /**
     * Get submission with author details
     */
    public function getWithAuthor(int $id): ?array
    {
        $sql = "SELECT s.*, u.username, u.first_name, u.last_name, u.email, u.affiliation
                FROM {$this->table} s
                INNER JOIN users u ON s.author_id = u.id
                WHERE s.id = ?";
        $result = $this->query($sql, [$id]);
        return !empty($result) ? $result[0] : null;
    }

    /**
     * Increment view count
     */
    public function incrementViews(int $id): bool
    {
        $sql = "UPDATE {$this->table} SET views_count = views_count + 1 WHERE id = ?";
        return $this->query($sql, [$id]) !== false;
    }

    /**
     * Increment download count
     */
    public function incrementDownloads(int $id): bool
    {
        $sql = "UPDATE {$this->table} SET downloads_count = downloads_count + 1 WHERE id = ?";
        return $this->query($sql, [$id]) !== false;
    }

    /**
     * Update submission status
     */
    public function updateStatus(int $id, string $status): bool
    {
        return $this->update($id, ['status' => $status]);
    }

    /**
     * Publish submission
     */
    public function publish(int $id): bool
    {
        return $this->update($id, [
            'is_published' => 1,
            'date_published' => date('Y-m-d H:i:s'),
            'status' => 'published'
        ]);
    }

    /**
     * Unpublish submission
     */
    public function unpublish(int $id): bool
    {
        return $this->update($id, [
            'is_published' => 0,
            'status' => 'unpublished'
        ]);
    }
}
