<?php
// Start the session
session_start();

// Get the current file name
$currentPage = basename($_SERVER['PHP_SELF']);

// Check if user is logged in
$isLoggedIn = isset($_SESSION['username']) && isset($_SESSION['role']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MinSU Research Journal</title>
    <link rel="shortcut icon" href="https://www.minsu.edu.ph/template/images/logo.png" type="image/x-icon">
    <!-- Bootstrap CSS (Local) -->
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome (Local) -->
    <link rel="stylesheet" href="vendor/fortawesome/font-awesome/css/all.min.css">
    <!-- Custom App CSS -->
    <link rel="stylesheet" href="resources/css/app.css">

    <!-- Bootstrap 5 JavaScript Bundle (Local) -->
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <!-- Academic Journal Header - Inspired by Nature, Science, The Lancet -->
    
    <!-- Top Utility Bar -->
    <div class="journal-utility-bar">
        <div class="container-fluid px-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="utility-left">
                        <div class="journal-metadata">
                            <span class="publication-info">
                                <strong>ISSN:</strong> 2234-5678 (Print) | 2234-5679 (Online)
                            </span>
                            <span class="impact-factor">
                                <strong>Impact Factor:</strong> 2.847 (2024)
                            </span>
                            <span class="indexing">
                                Indexed in: Scopus, DOAJ, Google Scholar
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="utility-right text-end">
                        <div class="journal-access">
                            <span class="open-access-badge">
                                <i class="fas fa-unlock-alt"></i> Open Access
                            </span>
                            <div class="journal-social">
                                <a href="#" class="social-link" title="Follow on Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="social-link" title="ResearchGate">
                                    <i class="fab fa-researchgate"></i>
                                </a>
                                <a href="#" class="social-link" title="LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Academic Header -->
    <header class="academic-journal-header">
        <div class="container-fluid px-4">
            <!-- Institution and Journal Identity -->
            <div class="journal-masthead">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-3">
                        <div class="institution-logo">
                            <a href="index.php" class="logo-link">
                                <img src="https://www.minsu.edu.ph/template/images/logo.png" 
                                     alt="Mindoro State University" 
                                     class="university-seal">
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-8 col-md-6">
                        <div class="journal-identity text-center">
                            <div class="institution-name">
                                MINDORO STATE UNIVERSITY
                            </div>
                            <h1 class="journal-main-title">
                                <a href="index.php" class="title-link">
                                    Research Journal
                                </a>
                            </h1>
                            <div class="journal-tagline">
                                Advancing Knowledge Through Scientific Excellence
                            </div>
                            <div class="publication-details">
                                <span class="frequency">Bi-Annual Publication</span>
                                <span class="separator">•</span>
                                <span class="established">Established 2020</span>
                                <span class="separator">•</span>
                                <span class="current-volume">Volume 5, Issue 2 (2025)</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-3">
                        <div class="header-actions">
                            <?php if ($isLoggedIn) { ?>
                                <div class="user-portal">
                                    <div class="user-info">
                                        <span class="user-greeting">Welcome</span>
                                        <strong class="user-name"><?php echo ucfirst($_SESSION['username']); ?></strong>
                                        <span class="user-role-indicator role-<?php echo $_SESSION['role']; ?>">
                                            <?php echo ucfirst($_SESSION['role']); ?>
                                        </span>
                                    </div>
                                    <div class="portal-actions">
                                        <?php
                                        // Determine dashboard link based on user role
                                        switch ($_SESSION['role']) {
                                            case 'author':
                                                $dashboardLink = 'author-dashboard/index.php';
                                                $dashboardText = 'Author Portal';
                                                break;
                                            case 'editor':
                                                $dashboardLink = 'editor-dashboard/index.php';
                                                $dashboardText = 'Editorial Portal';
                                                break;
                                            case 'admin':
                                                $dashboardLink = 'admin-dashboard/index.php';
                                                $dashboardText = 'Admin Portal';
                                                break;
                                            case 'reviewer':
                                                $dashboardLink = 'reviewer-dashboard/index.php';
                                                $dashboardText = 'Reviewer Portal';
                                                break;
                                            default:
                                                $dashboardLink = 'auth/login.php';
                                                $dashboardText = 'Portal';
                                                break;
                                        }
                                        ?>
                                        <a href="<?php echo $dashboardLink; ?>" class="btn btn-portal">
                                            <i class="fas fa-tachometer-alt"></i> <?php echo $dashboardText; ?>
                                        </a>
                                        <a href="logout.php" class="btn btn-logout">
                                            <i class="fas fa-sign-out-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="guest-actions">
                                    <div class="access-prompt">
                                        <span class="prompt-text">Access Your Account</span>
                                    </div>
                                    <div class="auth-buttons">
                                        <button type="button" class="btn btn-login" data-bs-toggle="modal" data-bs-target="#loginModal">
                                            <i class="fas fa-sign-in-alt"></i> Sign In
                                        </button>
                                        <button type="button" class="btn btn-register" data-bs-toggle="modal" data-bs-target="#registerModal">
                                            <i class="fas fa-user-plus"></i> Register
                                        </button>
                                    </div>
                                </div>
                            <?php } ?>
                            
                            <!-- Quick Tools -->
                            <div class="header-tools mt-3">
                                <div class="tool-group">
                                    <a href="current_issues.php" class="tool-link" title="Current Issue">
                                        <i class="fas fa-book-open"></i>
                                    </a>
                                    <a href="archives.php" class="tool-link" title="Archives">
                                        <i class="fas fa-archive"></i>
                                    </a>
                                    <a href="submission_form.php" class="tool-link highlight" title="Submit Manuscript">
                                        <i class="fas fa-upload"></i>
                                    </a>
                                    <a href="contact.php" class="tool-link" title="Contact Editorial">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php
    // Get the current file name
    $currentPage = basename($_SERVER['PHP_SELF']);
    ?>

    <!-- Academic Navigation -->
    <nav class="academic-navigation">
        <div class="container-fluid px-4">
            <!-- Main Navigation Menu -->
            <div class="nav-container">
                <!-- Mobile Toggle -->
                <button class="mobile-nav-toggle d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#academicNav" aria-controls="academicNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="toggle-icon">
                        <i class="fas fa-bars"></i>
                    </span>
                    <span class="toggle-text">Menu</span>
                </button>

                <!-- Navigation Items -->
                <div class="collapse navbar-collapse" id="academicNav">
                    <ul class="academic-nav-menu">
                        <li class="nav-section">
                            <a class="nav-link <?php if ($currentPage == 'index.php') echo 'current'; ?>" href="index.php">
                                <i class="nav-icon fas fa-home"></i>
                                <span class="nav-text">Home</span>
                            </a>
                        </li>

                        <li class="nav-section dropdown">
                            <a class="nav-link dropdown-toggle <?php if (in_array($currentPage, ['about-overview.php', 'about-editorial-board.php', 'about-members.php', 'about-policies-responsibilities.php'])) echo 'current'; ?>"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="nav-icon fas fa-university"></i>
                                <span class="nav-text">About Journal</span>
                            </a>
                            <ul class="academic-dropdown">
                                <li><a class="dropdown-item <?php if ($currentPage == 'about-overview.php') echo 'active'; ?>"
                                        href="about-overview.php">
                                        <i class="fas fa-eye"></i>Journal Overview</a></li>
                                <li><a class="dropdown-item <?php if ($currentPage == 'about-editorial-board.php') echo 'active'; ?>"
                                        href="about-editorial-board.php">
                                        <i class="fas fa-users"></i>Editorial Board</a></li>
                                <li><a class="dropdown-item <?php if ($currentPage == 'about-members.php') echo 'active'; ?>"
                                        href="about-members.php">
                                        <i class="fas fa-user-friends"></i>Advisory Board</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item <?php if ($currentPage == 'about-policies-responsibilities.php') echo 'active'; ?>"
                                        href="about-policies-responsibilities.php">
                                        <i class="fas fa-gavel"></i>Policies & Ethics</a></li>
                            </ul>
                        </li>

                        <li class="nav-section dropdown">
                            <a class="nav-link dropdown-toggle <?php if (in_array($currentPage, ['submission_guidelines.php', 'submission_form.php'])) echo 'current'; ?>"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="nav-icon fas fa-file-upload"></i>
                                <span class="nav-text">Submit</span>
                            </a>
                            <ul class="academic-dropdown">
                                <li><a class="dropdown-item <?php if ($currentPage == 'submission_guidelines.php') echo 'active'; ?>"
                                        href="submission_guidelines.php">
                                        <i class="fas fa-list-ul"></i>Author Guidelines</a></li>
                                <li><a class="dropdown-item <?php if ($currentPage == 'submission_form.php') echo 'active'; ?>"
                                        href="submission_form.php">
                                        <i class="fas fa-upload"></i>Submit Manuscript</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="manuscript_template.php">
                                        <i class="fas fa-file-alt"></i>Manuscript Template</a></li>
                                <li><a class="dropdown-item" href="submission_checklist.php">
                                        <i class="fas fa-check-square"></i>Submission Checklist</a></li>
                            </ul>
                        </li>

                        <li class="nav-section dropdown">
                            <a class="nav-link dropdown-toggle <?php if (in_array($currentPage, ['review_process_overview.php', 'reviewer_guidelines.php'])) echo 'current'; ?>"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="nav-icon fas fa-microscope"></i>
                                <span class="nav-text">Peer Review</span>
                            </a>
                            <ul class="academic-dropdown">
                                <li><a class="dropdown-item <?php if ($currentPage == 'review_process_overview.php') echo 'active'; ?>"
                                        href="review_process_overview.php">
                                        <i class="fas fa-route"></i>Review Process</a></li>
                                <li><a class="dropdown-item <?php if ($currentPage == 'reviewer_guidelines.php') echo 'active'; ?>"
                                        href="reviewer_guidelines.php">
                                        <i class="fas fa-user-check"></i>Reviewer Guidelines</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="become_reviewer.php">
                                        <i class="fas fa-hand-paper"></i>Become a Reviewer</a></li>
                            </ul>
                        </li>

                        <li class="nav-section dropdown">
                            <a class="nav-link dropdown-toggle <?php if (in_array($currentPage, ['current_issues.php', 'archives.php', 'by_year.php', 'by_topic.php'])) echo 'current'; ?>"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="nav-icon fas fa-journal-whills"></i>
                                <span class="nav-text">Articles</span>
                            </a>
                            <ul class="academic-dropdown">
                                <li><a class="dropdown-item featured <?php if ($currentPage == 'current_issues.php') echo 'active'; ?>"
                                        href="current_issues.php">
                                        <i class="fas fa-star"></i>Current Issue</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item <?php if ($currentPage == 'archives.php') echo 'active'; ?>"
                                        href="archives.php">
                                        <i class="fas fa-archive"></i>All Issues</a></li>
                                <li><a class="dropdown-item <?php if ($currentPage == 'by_year.php') echo 'active'; ?>"
                                        href="by_year.php">
                                        <i class="fas fa-calendar"></i>Browse by Year</a></li>
                                <li><a class="dropdown-item <?php if ($currentPage == 'by_topic.php') echo 'active'; ?>"
                                        href="by_topic.php">
                                        <i class="fas fa-tags"></i>Browse by Topic</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="most_cited.php">
                                        <i class="fas fa-quote-right"></i>Most Cited</a></li>
                                <li><a class="dropdown-item" href="open_access.php">
                                        <i class="fas fa-unlock-alt"></i>Open Access</a></li>
                            </ul>
                        </li>

                        <li class="nav-section dropdown">
                            <a class="nav-link dropdown-toggle <?php if (in_array($currentPage, ['contact.php', 'FAQ.php'])) echo 'current'; ?>"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="nav-icon fas fa-address-book"></i>
                                <span class="nav-text">Contact</span>
                            </a>
                            <ul class="academic-dropdown">
                                <li><a class="dropdown-item <?php if ($currentPage == 'contact.php') echo 'active'; ?>"
                                        href="contact.php">
                                        <i class="fas fa-envelope"></i>Editorial Office</a></li>
                                <li><a class="dropdown-item <?php if ($currentPage == 'FAQ.php') echo 'active'; ?>"
                                        href="FAQ.php">
                                        <i class="fas fa-question-circle"></i>FAQ</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="editorial_inquiries.php">
                                        <i class="fas fa-comments"></i>Editorial Inquiries</a></li>
                                <li><a class="dropdown-item" href="technical_support.php">
                                        <i class="fas fa-tools"></i>Technical Support</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Mobile User Menu -->
                    <div class="mobile-user-section d-lg-none">
                        <?php if ($isLoggedIn) { ?>
                            <div class="mobile-user-info">
                                <div class="user-details">
                                    <span class="mobile-user-name"><?php echo ucfirst($_SESSION['username']); ?></span>
                                    <span class="mobile-user-role"><?php echo ucfirst($_SESSION['role']); ?></span>
                                </div>
                                <div class="mobile-user-actions">
                                    <a href="<?php echo $dashboardLink; ?>" class="mobile-action-btn">
                                        <i class="fas fa-tachometer-alt"></i> Dashboard
                                    </a>
                                    <a href="logout.php" class="mobile-action-btn logout">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="mobile-auth-section">
                                <button type="button" class="mobile-auth-btn login" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    <i class="fas fa-sign-in-alt"></i> Sign In
                                </button>
                                <button type="button" class="mobile-auth-btn register" data-bs-toggle="modal" data-bs-target="#registerModal">
                                    <i class="fas fa-user-plus"></i> Register
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Login Modal with Alpine.js -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true"
         x-data="loginModal()" x-init="init()">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">
                        <i class="fas fa-sign-in-alt me-2"></i>Sign In to Your Account
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submitForm()" x-ref="loginForm">
                        <div class="mb-3">
                            <label for="loginUsername" class="form-label">
                                <i class="fas fa-user me-1"></i>Username or Email
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="loginUsername" 
                                   x-model="formData.username_email" 
                                   required
                                   :disabled="loading">
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">
                                <i class="fas fa-lock me-1"></i>Password
                            </label>
                            <div class="input-group">
                                <input :type="showPassword ? 'text' : 'password'" 
                                       class="form-control" 
                                       id="loginPassword" 
                                       x-model="formData.password" 
                                       required
                                       :disabled="loading">
                                <button class="btn btn-outline-secondary" 
                                        type="button" 
                                        @click="togglePassword()"
                                        :disabled="loading">
                                    <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="rememberMe" 
                                   x-model="formData.remember_me"
                                   :disabled="loading">
                            <label class="form-check-label" for="rememberMe">
                                Remember me
                            </label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" 
                                    class="btn btn-login-modal" 
                                    :disabled="loading"
                                    :class="{ 'opacity-50': loading }">
                                <template x-if="!loading">
                                    <span><i class="fas fa-sign-in-alt me-1"></i>Sign In</span>
                                </template>
                                <template x-if="loading">
                                    <span><i class="fas fa-spinner fa-spin me-1"></i>Signing In...</span>
                                </template>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Error Alert -->
                    <div x-show="errorMessage" 
                         x-transition
                         class="alert alert-danger mt-3">
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        <span x-text="errorMessage"></span>
                    </div>
                    
                    <!-- Success Alert -->
                    <div x-show="successMessage" 
                         x-transition
                         class="alert alert-success mt-3">
                        <i class="fas fa-check-circle me-1"></i>
                        <span x-text="successMessage"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center w-100">
                        <p class="mb-0">Don't have an account? 
                            <button type="button" class="btn btn-link p-0 text-decoration-none" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">
                                <strong>Register here</strong>
                            </button>
                        </p>
                        <hr class="my-2">
                        <p class="mb-0">
                            <a href="auth/forgot_password.php" class="text-muted text-decoration-none">
                                <i class="fas fa-question-circle me-1"></i>Forgot your password?
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function loginModal() {
            return {
                // Form data
                formData: {
                    username_email: '',
                    password: '',
                    remember_me: false
                },
                
                // UI state
                showPassword: false,
                loading: false,
                errorMessage: '',
                successMessage: '',
                
                // Initialize component
                init() {
                    // Reset form when modal is hidden
                    const modal = document.getElementById('loginModal');
                    modal.addEventListener('hidden.bs.modal', () => {
                        this.resetForm();
                    });
                },
                
                // Toggle password visibility
                togglePassword() {
                    this.showPassword = !this.showPassword;
                },
                
                // Reset form and messages
                resetForm() {
                    this.formData = {
                        username_email: '',
                        password: '',
                        remember_me: false
                    };
                    this.showPassword = false;
                    this.loading = false;
                    this.errorMessage = '';
                    this.successMessage = '';
                },
                
                // Submit form with AJAX
                async submitForm() {
                    if (this.loading) return;
                    
                    // Reset messages
                    this.errorMessage = '';
                    this.successMessage = '';
                    this.loading = true;
                    
                    try {
                        // Create FormData object
                        const formData = new FormData();
                        formData.append('username_email', this.formData.username_email);
                        formData.append('password', this.formData.password);
                        if (this.formData.remember_me) {
                            formData.append('remember_me', '1');
                        }
                        
                        // Submit form
                        const response = await fetch('auth/login_process.php', {
                            method: 'POST',
                            body: formData
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            this.successMessage = data.message;
                            
                            // Redirect after a short delay
                            setTimeout(() => {
                                window.location.href = data.redirect;
                            }, 1500);
                        } else {
                            this.errorMessage = data.message;
                        }
                    } catch (error) {
                        this.errorMessage = 'An error occurred. Please try again.';
                    } finally {
                        this.loading = false;
                    }
                }
            }
        }
    </script>

    <!-- Registration Modal with Alpine.js -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true"
         x-data="registerModal()" x-init="init()">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Create Your Account
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submitForm()" x-ref="registerForm">
                        <div class="row">
                            <!-- Username and Email -->
                            <div class="col-md-6 mb-3">
                                <label for="registerUsername" class="form-label">
                                    <i class="fas fa-user me-1"></i>Username <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="registerUsername" 
                                       x-model="formData.username" 
                                       required
                                       :disabled="loading">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="registerEmail" class="form-label">
                                    <i class="fas fa-envelope me-1"></i>Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" 
                                       class="form-control" 
                                       id="registerEmail" 
                                       x-model="formData.email" 
                                       required
                                       :disabled="loading">
                            </div>
                        </div>

                        <div class="row">
                            <!-- Password and Confirm Password -->
                            <div class="col-md-6 mb-3">
                                <label for="registerPassword" class="form-label">
                                    <i class="fas fa-lock me-1"></i>Password <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input :type="showPassword ? 'text' : 'password'" 
                                           class="form-control" 
                                           id="registerPassword" 
                                           x-model="formData.password" 
                                           required
                                           minlength="6"
                                           :disabled="loading">
                                    <button class="btn btn-outline-secondary" 
                                            type="button" 
                                            @click="togglePassword()"
                                            :disabled="loading">
                                        <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirmPassword" class="form-label">
                                    <i class="fas fa-lock me-1"></i>Confirm Password <span class="text-danger">*</span>
                                </label>
                                <input :type="showPassword ? 'text' : 'password'" 
                                       class="form-control" 
                                       id="confirmPassword" 
                                       x-model="formData.confirm_password" 
                                       required
                                       :disabled="loading">
                            </div>
                        </div>

                        <!-- Name Fields -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="firstName" class="form-label">
                                    <i class="fas fa-user me-1"></i>First Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="firstName" 
                                       x-model="formData.first_name" 
                                       required
                                       :disabled="loading">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="middleName" class="form-label">
                                    <i class="fas fa-user me-1"></i>Middle Name
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="middleName" 
                                       x-model="formData.middle_name" 
                                       :disabled="loading">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lastName" class="form-label">
                                    <i class="fas fa-user me-1"></i>Last Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="lastName" 
                                       x-model="formData.last_name" 
                                       required
                                       :disabled="loading">
                            </div>
                        </div>

                        <div class="row">
                            <!-- Role and Country -->
                            <div class="col-md-6 mb-3">
                                <label for="registerRole" class="form-label">
                                    <i class="fas fa-briefcase me-1"></i>Role <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" 
                                        id="registerRole" 
                                        x-model="formData.role" 
                                        required
                                        :disabled="loading">
                                    <option value="">Select Role</option>
                                    <option value="author">Author</option>
                                    <option value="reviewer">Reviewer</option>
                                    <option value="editor">Editor</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="registerCountry" class="form-label">
                                    <i class="fas fa-globe me-1"></i>Country <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" 
                                        id="registerCountry" 
                                        x-model="formData.country" 
                                        required
                                        :disabled="loading">
                                    <option value="">Select Country</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="United States">United States</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="France">France</option>
                                    <option value="Japan">Japan</option>
                                    <option value="South Korea">South Korea</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Vietnam">Vietnam</option>
                                    <option value="India">India</option>
                                    <option value="China">China</option>
                                    <!-- Add more countries as needed -->
                                </select>
                            </div>
                        </div>

                        <!-- Affiliation -->
                        <div class="mb-3">
                            <label for="affiliation" class="form-label">
                                <i class="fas fa-university me-1"></i>Institution/Affiliation
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="affiliation" 
                                   x-model="formData.affiliation" 
                                   placeholder="e.g., University Name, Department"
                                   :disabled="loading">
                        </div>

                        <!-- Bio -->
                        <div class="mb-3">
                            <label for="bio" class="form-label">
                                <i class="fas fa-info-circle me-1"></i>Bio
                            </label>
                            <textarea class="form-control" 
                                      id="bio" 
                                      x-model="formData.bio" 
                                      rows="3" 
                                      placeholder="Tell us about yourself..."
                                      :disabled="loading"></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" 
                                    class="btn btn-register-modal" 
                                    :disabled="loading"
                                    :class="{ 'opacity-50': loading }">
                                <template x-if="!loading">
                                    <span><i class="fas fa-user-plus me-1"></i>Create Account</span>
                                </template>
                                <template x-if="loading">
                                    <span><i class="fas fa-spinner fa-spin me-1"></i>Creating Account...</span>
                                </template>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Error Alert -->
                    <div x-show="errorMessage" 
                         x-transition
                         class="alert alert-danger mt-3">
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        <span x-text="errorMessage"></span>
                    </div>
                    
                    <!-- Success Alert -->
                    <div x-show="successMessage" 
                         x-transition
                         class="alert alert-success mt-3">
                        <i class="fas fa-check-circle me-1"></i>
                        <span x-text="successMessage"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center w-100">
                        <p class="mb-0">Already have an account? 
                            <button type="button" class="btn btn-link p-0 text-decoration-none" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">
                                <strong>Sign in here</strong>
                            </button>
                        </p>
                        <hr class="my-2">
                        <p class="mb-0 text-muted">
                            <small><span class="text-danger">*</span> Required fields</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function registerModal() {
            return {
                // Form data
                formData: {
                    username: '',
                    email: '',
                    password: '',
                    confirm_password: '',
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    role: '',
                    country: '',
                    affiliation: '',
                    bio: ''
                },
                
                // UI state
                showPassword: false,
                loading: false,
                errorMessage: '',
                successMessage: '',
                
                // Initialize component
                init() {
                    // Reset form when modal is hidden
                    const modal = document.getElementById('registerModal');
                    modal.addEventListener('hidden.bs.modal', () => {
                        this.resetForm();
                    });
                },
                
                // Toggle password visibility
                togglePassword() {
                    this.showPassword = !this.showPassword;
                },
                
                // Reset form and messages
                resetForm() {
                    this.formData = {
                        username: '',
                        email: '',
                        password: '',
                        confirm_password: '',
                        first_name: '',
                        middle_name: '',
                        last_name: '',
                        role: '',
                        country: '',
                        affiliation: '',
                        bio: ''
                    };
                    this.showPassword = false;
                    this.loading = false;
                    this.errorMessage = '';
                    this.successMessage = '';
                },
                
                // Submit form with AJAX
                async submitForm() {
                    if (this.loading) return;
                    
                    // Reset messages
                    this.errorMessage = '';
                    this.successMessage = '';
                    this.loading = true;
                    
                    try {
                        // Create FormData object
                        const formData = new FormData();
                        Object.keys(this.formData).forEach(key => {
                            formData.append(key, this.formData[key]);
                        });
                        
                        // Submit form
                        const response = await fetch('auth/register_process.php', {
                            method: 'POST',
                            body: formData
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            this.successMessage = data.message;
                            
                            // Close modal and show login modal after a short delay
                            setTimeout(() => {
                                const registerModal = bootstrap.Modal.getInstance(document.getElementById('registerModal'));
                                registerModal.hide();
                                
                                setTimeout(() => {
                                    const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                                    loginModal.show();
                                }, 500);
                            }, 2000);
                        } else {
                            this.errorMessage = data.message;
                        }
                    } catch (error) {
                        this.errorMessage = 'An error occurred. Please try again.';
                    } finally {
                        this.loading = false;
                    }
                }
            }
        }
    </script>