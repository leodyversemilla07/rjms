-- Migration: Create reviews table
-- Created: 2025-09-08 12:03:00

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    submission_id INT NOT NULL,
    reviewer_user_id INT NOT NULL,
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    recommendation ENUM('accept', 'minor_revision', 'major_revision', 'reject') DEFAULT NULL,
    comments TEXT DEFAULT NULL,
    confidential_comments TEXT DEFAULT NULL,
    assigned_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed_date TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (submission_id) REFERENCES submissions(id) ON DELETE CASCADE,
    FOREIGN KEY (reviewer_user_id) REFERENCES users(id) ON DELETE CASCADE,
    
    UNIQUE KEY unique_reviewer_submission (submission_id, reviewer_user_id),
    
    INDEX idx_submission (submission_id),
    INDEX idx_reviewer (reviewer_user_id),
    INDEX idx_status (status),
    INDEX idx_assigned_date (assigned_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
