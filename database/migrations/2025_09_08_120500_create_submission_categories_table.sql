-- Migration: Create submission_categories table
-- Created: 2025-09-08 12:05:00

CREATE TABLE submission_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    submission_id INT NOT NULL,
    category_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (submission_id) REFERENCES submissions(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
    
    UNIQUE KEY unique_submission_category (submission_id, category_id),
    
    INDEX idx_submission (submission_id),
    INDEX idx_category (category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
