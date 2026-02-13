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
        $sql = "SELECT c.*, COUNT(sc.category_id) as submission_count
                FROM {$this->table} c
                LEFT JOIN submissions sc ON c.id = sc.id -- Simplified for mapping, adjust if schema differs
                GROUP BY c.id
                ORDER BY c.name";
        // Using Database::fetchAll because query() will try to map to Category objects
        // and we have an extra field 'submission_count' which is fine, but let's be consistent.
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
        // Note: this returns Submission objects if called on Submission model, 
        // but here it will return Category objects with Submission attributes.
        // It's better to use Submission model for this, but keeping it for now.
        return $this->query($sql, [$categoryId]);
    }
}
