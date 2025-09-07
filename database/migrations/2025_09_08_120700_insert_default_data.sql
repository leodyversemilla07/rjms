-- Migration: Insert default data
-- Created: 2025-09-08 12:07:00

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

-- Insert default admin user (password: admin123)
INSERT INTO users (username, password, email, role, first_name, last_name, country, bio) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@rjms.com', 'admin', 'System', 'Administrator', 'Global', 'Default system administrator account');

-- Insert sample editor user (password: editor123)
INSERT INTO users (username, password, email, role, first_name, last_name, country, bio) VALUES
('editor', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'editor@rjms.com', 'editor', 'John', 'Editor', 'USA', 'Senior journal editor with 10+ years experience');

-- Insert sample reviewer user (password: reviewer123)
INSERT INTO users (username, password, email, role, first_name, last_name, country, bio) VALUES
('reviewer', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'reviewer@rjms.com', 'reviewer', 'Jane', 'Reviewer', 'UK', 'Research expert specializing in peer review');

-- Insert sample author user (password: author123)
INSERT INTO users (username, password, email, role, first_name, last_name, country, bio) VALUES
('author', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'author@rjms.com', 'author', 'Robert', 'Author', 'Canada', 'Research scientist and academic writer');
