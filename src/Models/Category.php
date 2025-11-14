<?php

namespace App\Models;

use App\Core\Model;

/**
 * Category Model
 * Handles article categories/topics
 */
class Category extends Model
{
    protected string $table = 'categories';
    protected string $primaryKey = 'id';
    
    protected array $fillable = [
        'name',
        'description',
        'is_active'
    ];

    /**
     * Get active categories
     */
    public function getActive(): array
    {
        return $this->where('is_active', 1);
    }

    /**
     * Get category with submission count
     */
    public function getWithSubmissionCount(): array
    {
        $sql = "SELECT c.*, COUNT(sc.submission_id) as submission_count
                FROM {$this->table} c
                LEFT JOIN submission_categories sc ON c.id = sc.category_id
                GROUP BY c.id
                ORDER BY c.name";
        return $this->query($sql);
    }

    /**
     * Get submissions by category
     */
    public function getSubmissions(int $categoryId): array
    {
        $sql = "SELECT s.*
                FROM submissions s
                INNER JOIN submission_categories sc ON s.id = sc.submission_id
                WHERE sc.category_id = ?
                ORDER BY s.submission_date DESC";
        return $this->query($sql, [$categoryId]);
    }
}
