-- Migration: Create submissions table
-- Created: 2025-09-08 12:01:00

CREATE TABLE submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author_user_id INT NOT NULL,
    title VARCHAR(500) NOT NULL,
    abstract TEXT NOT NULL,
    keywords TEXT DEFAULT NULL,
    status ENUM('pending', 'Under Review', 'Accepted', 'Rejected', 'Published') DEFAULT 'pending',
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    file_path VARCHAR(500) NOT NULL,
    is_published BOOLEAN DEFAULT FALSE,
    date_published TIMESTAMP NULL,
    review_comments TEXT DEFAULT NULL,
    editor_notes TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (author_user_id) REFERENCES users(id) ON DELETE CASCADE,
    
    INDEX idx_author (author_user_id),
    INDEX idx_status (status),
    INDEX idx_published (is_published),
    INDEX idx_submission_date (submission_date),
    INDEX idx_date_published (date_published)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
