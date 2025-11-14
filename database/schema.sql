-- RJMS Database Schema
-- Research Journal Management System
-- Generated: 2025-09-08

-- Create database
CREATE DATABASE IF NOT EXISTS rjdb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE rjdb;

-- Disable foreign key checks during setup
SET FOREIGN_KEY_CHECKS = 0;

-- Create users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('admin', 'author', 'reviewer', 'editor') NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    middle_name VARCHAR(100) DEFAULT NULL,
    last_name VARCHAR(100) NOT NULL,
    affiliation VARCHAR(255) DEFAULT NULL,
    country VARCHAR(100) NOT NULL,
    bio TEXT DEFAULT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    email_verified BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_username (username),
    INDEX idx_email (email),
    INDEX idx_role (role),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create categories table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    description TEXT DEFAULT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_name (name),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create submissions table
CREATE TABLE submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author_id INT NOT NULL,
    title VARCHAR(500) NOT NULL,
    abstract TEXT NOT NULL,
    keywords TEXT DEFAULT NULL,
    status ENUM('pending', 'under_review', 'accepted', 'rejected', 'published') DEFAULT 'pending',
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    file_path VARCHAR(500) NOT NULL,
    is_published BOOLEAN DEFAULT FALSE,
    date_published TIMESTAMP NULL,
    review_comments TEXT DEFAULT NULL,
    editor_notes TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE,
    
    INDEX idx_author (author_id),
    INDEX idx_status (status),
    INDEX idx_published (is_published),
    INDEX idx_submission_date (submission_date),
    INDEX idx_date_published (date_published)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create reviews table
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    submission_id INT NOT NULL,
    reviewer_id INT NOT NULL,
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    recommendation ENUM('accept', 'minor_revision', 'major_revision', 'reject') DEFAULT NULL,
    comments TEXT DEFAULT NULL,
    confidential_comments TEXT DEFAULT NULL,
    assigned_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed_date TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (submission_id) REFERENCES submissions(id) ON DELETE CASCADE,
    FOREIGN KEY (reviewer_id) REFERENCES users(id) ON DELETE CASCADE,
    
    UNIQUE KEY unique_reviewer_submission (submission_id, reviewer_id),
    
    INDEX idx_submission (submission_id),
    INDEX idx_reviewer (reviewer_id),
    INDEX idx_status (status),
    INDEX idx_assigned_date (assigned_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create submission_categories table
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

-- Create user_sessions table
CREATE TABLE user_sessions (
    id VARCHAR(128) PRIMARY KEY,
    user_id INT DEFAULT NULL,
    ip_address VARCHAR(45) DEFAULT NULL,
    user_agent TEXT DEFAULT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    
    INDEX idx_user_id (user_id),
    INDEX idx_last_activity (last_activity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create migrations table
CREATE TABLE migrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_migration (migration)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Re-enable foreign key checks
SET FOREIGN_KEY_CHECKS = 1;

-- Insert default data
-- Insert default categories
INSERT INTO categories (name, description) VALUES
('Computer Science', 'Research in computer science and related fields'),
('Engineering', 'Engineering research and innovations'),
('Medicine', 'Medical research and healthcare studies'),
('Physics', 'Physics and applied physics research'),
('Mathematics', 'Mathematical research and applications'),
('Biology', 'Biological sciences and biotechnology'),
('Chemistry', 'Chemical research and applications'),
('Social Sciences', 'Social science research and studies'),
('Business', 'Business and management research'),
('Education', 'Educational research and pedagogy');

-- Insert default users
-- Admin user (username: admin, password: admin123)
INSERT INTO users (username, password, email, role, first_name, last_name, country, bio) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@rjms.com', 'admin', 'System', 'Administrator', 'Global', 'Default system administrator account');

-- Editor user (username: editor, password: editor123)
INSERT INTO users (username, password, email, role, first_name, last_name, country, bio) VALUES
('editor', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'editor@rjms.com', 'editor', 'John', 'Editor', 'USA', 'Senior journal editor with 10+ years experience');

-- Reviewer user (username: reviewer, password: reviewer123)
INSERT INTO users (username, password, email, role, first_name, last_name, country, bio) VALUES
('reviewer', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'reviewer@rjms.com', 'reviewer', 'Jane', 'Reviewer', 'UK', 'Research expert specializing in peer review');

-- Author user (username: author, password: author123)
INSERT INTO users (username, password, email, role, first_name, last_name, country, bio) VALUES
('author', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'author@rjms.com', 'author', 'Robert', 'Author', 'Canada', 'Research scientist and academic writer');
