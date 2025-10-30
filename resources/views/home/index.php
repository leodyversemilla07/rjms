<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to RJMS - Research Journal Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="/resources/css/app.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #4F46E5 0%, #4F46E5 100%);
            color: white;
            padding: 100px 0;
            margin-bottom: 50px;
        }
        .feature-card {
            padding: 30px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            height: 100%;
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-10px);
        }
        .feature-icon {
            font-size: 48px;
            color: #4F46E5;
            margin-bottom: 20px;
        }
        .stats-section {
            background: #F3F4F6;
            padding: 60px 0;
            margin: 50px 0;
        }
        .stat-box {
            text-align: center;
            padding: 30px;
        }
        .cta-section {
            background: linear-gradient(135deg, #4F46E5 0%, #4F46E5 100%);
            color: white;
            padding: 80px 0;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container text-center">
            <h1 class="display-3 fw-bold mb-4">Welcome to RJMS</h1>
            <p class="lead mb-5">A Modern Research Journal Management System for Authors, Reviewers, and Editors</p>
            <div class="d-flex gap-3 justify-content-center">
                <a href="/register" class="btn btn-light btn-lg">
                    <i class="fas fa-user-plus me-2"></i>Get Started
                </a>
                <a href="/about" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-info-circle me-2"></i>Learn More
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container mb-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Why Choose RJMS?</h2>
            <p class="text-muted">Everything you need for efficient journal management</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <h4>Easy Submission</h4>
                    <p class="text-muted">Submit your research papers online with our intuitive interface. Track your submissions in real-time.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Peer Review</h4>
                    <p class="text-muted">Streamlined peer review process with expert reviewers and comprehensive feedback systems.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h4>Editorial Management</h4>
                    <p class="text-muted">Powerful tools for editors to manage submissions, assign reviewers, and make decisions.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4>Analytics & Reports</h4>
                    <p class="text-muted">Comprehensive dashboards and reports to track journal performance and metrics.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h4>Real-time Notifications</h4>
                    <p class="text-muted">Stay updated with instant email and in-app notifications for all important events.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>Secure & Reliable</h4>
                    <p class="text-muted">Enterprise-grade security to protect your research and personal information.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-box">
                        <h2 class="fw-bold text-primary">500+</h2>
                        <p class="text-muted mb-0">Submissions</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box">
                        <h2 class="fw-bold text-primary">200+</h2>
                        <p class="text-muted mb-0">Authors</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box">
                        <h2 class="fw-bold text-primary">50+</h2>
                        <p class="text-muted mb-0">Reviewers</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box">
                        <h2 class="fw-bold text-primary">95%</h2>
                        <p class="text-muted mb-0">Satisfaction</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works -->
    <div class="container mb-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">How It Works</h2>
            <p class="text-muted">Simple steps to get started</p>
        </div>

        <div class="row g-4">
            <div class="col-md-3 text-center">
                <div class="mb-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" 
                         style="width: 80px; height: 80px;">
                        <span class="display-6 text-primary fw-bold">1</span>
                    </div>
                </div>
                <h5>Create Account</h5>
                <p class="text-muted">Sign up as an author, reviewer, or editor</p>
            </div>
            <div class="col-md-3 text-center">
                <div class="mb-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" 
                         style="width: 80px; height: 80px;">
                        <span class="display-6 text-primary fw-bold">2</span>
                    </div>
                </div>
                <h5>Submit Paper</h5>
                <p class="text-muted">Upload your research manuscript</p>
            </div>
            <div class="col-md-3 text-center">
                <div class="mb-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" 
                         style="width: 80px; height: 80px;">
                        <span class="display-6 text-primary fw-bold">3</span>
                    </div>
                </div>
                <h5>Peer Review</h5>
                <p class="text-muted">Expert reviewers evaluate your work</p>
            </div>
            <div class="col-md-3 text-center">
                <div class="mb-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" 
                         style="width: 80px; height: 80px;">
                        <span class="display-6 text-primary fw-bold">4</span>
                    </div>
                </div>
                <h5>Publication</h5>
                <p class="text-muted">Get your research published</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <div class="container text-center">
            <h2 class="display-5 fw-bold mb-4">Ready to Get Started?</h2>
            <p class="lead mb-5">Join hundreds of researchers using RJMS for their publications</p>
            <a href="/register" class="btn btn-light btn-lg">
                <i class="fas fa-rocket me-2"></i>Start Publishing Today
            </a>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</body>
</html>
