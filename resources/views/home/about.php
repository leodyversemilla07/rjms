<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About RJMS - Research Journal Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="/resources/css/app.css" rel="stylesheet">
    <style>
        .page-header {
            background: linear-gradient(135deg, #4F46E5 0%, #4F46E5 100%);
            color: white;
            padding: 60px 0;
            margin-bottom: 50px;
        }
        .content-section {
            padding: 60px 0;
        }
        .mission-card {
            background: #F3F4F6;
            padding: 40px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .team-member {
            text-align: center;
            margin-bottom: 30px;
        }
        .team-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4F46E5 0%, #4F46E5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 48px;
            color: white;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">About RJMS</h1>
            <p class="lead">Transforming Research Publication Management</p>
        </div>
    </div>

    <div class="container">
        <!-- Mission Section -->
        <div class="content-section">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="mission-card">
                        <h2 class="mb-4 text-center">Our Mission</h2>
                        <p class="lead text-center mb-4">
                            To provide a modern, efficient, and user-friendly platform for managing academic journal submissions, 
                            peer reviews, and publications.
                        </p>
                        <p class="text-muted">
                            RJMS (Research Journal Management System) was created to address the challenges faced by academic 
                            institutions, researchers, and publishers in managing the complex workflow of scholarly publishing. 
                            Our platform streamlines the entire process from submission to publication, making it easier for 
                            authors to share their research and for journals to maintain high standards of quality.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="content-section bg-light py-5">
            <div class="container">
                <h2 class="text-center mb-5">What We Offer</h2>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                            </div>
                            <div>
                                <h5>Streamlined Submission Process</h5>
                                <p class="text-muted">Easy-to-use interface for authors to submit their research papers with all necessary metadata and files.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                            </div>
                            <div>
                                <h5>Efficient Peer Review</h5>
                                <p class="text-muted">Comprehensive tools for managing the peer review process, including reviewer assignment and feedback collection.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                            </div>
                            <div>
                                <h5>Editorial Workflow</h5>
                                <p class="text-muted">Powerful editorial dashboard for making decisions, communicating with authors, and managing the publication pipeline.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                            </div>
                            <div>
                                <h5>Analytics & Reporting</h5>
                                <p class="text-muted">Detailed insights into submission trends, review times, and overall journal performance.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Values Section -->
        <div class="content-section">
            <h2 class="text-center mb-5">Our Core Values</h2>
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <i class="fas fa-lightbulb fa-3x text-primary mb-3"></i>
                    <h4>Innovation</h4>
                    <p class="text-muted">Continuously improving our platform with the latest technologies and best practices.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                    <h4>Integrity</h4>
                    <p class="text-muted">Maintaining the highest standards of research ethics and publication quality.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h4>Collaboration</h4>
                    <p class="text-muted">Fostering a community of researchers, reviewers, and editors working together.</p>
                </div>
            </div>
        </div>

        <!-- Technology Section -->
        <div class="content-section bg-light py-5">
            <div class="container">
                <h2 class="text-center mb-5">Built with Modern Technology</h2>
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <p class="text-center mb-4">
                            RJMS is built using modern web technologies to ensure reliability, security, and excellent performance.
                        </p>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <span class="badge bg-primary fs-6">PHP 8.3</span>
                            <span class="badge bg-primary fs-6">MySQL</span>
                            <span class="badge bg-primary fs-6">MVC Architecture</span>
                            <span class="badge bg-primary fs-6">Bootstrap 5</span>
                            <span class="badge bg-primary fs-6">RESTful API</span>
                            <span class="badge bg-primary fs-6">Responsive Design</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact CTA -->
        <div class="content-section text-center">
            <h2 class="mb-4">Have Questions?</h2>
            <p class="lead text-muted mb-4">We're here to help. Get in touch with us anytime.</p>
            <a href="/contact" class="btn btn-primary btn-lg">
                <i class="fas fa-envelope me-2"></i>Contact Us
            </a>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</body>
</html>
