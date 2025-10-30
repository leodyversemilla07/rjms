<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Issues - RJMS</title>
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
        .issue-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .issue-card:hover {
            transform: translateY(-5px);
        }
        .article-item {
            padding: 20px;
            border-left: 4px solid #4F46E5;
            background: #F3F4F6;
            margin-bottom: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Current Issues</h1>
            <p class="lead">Browse the latest published research</p>
        </div>
    </div>

    <div class="container mb-5">
        <!-- Latest Issue -->
        <div class="issue-card">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h3>Volume 5, Issue 2</h3>
                    <p class="text-muted mb-0">Published: December 2024</p>
                </div>
                <span class="badge bg-success fs-6">Latest Issue</span>
            </div>

            <p class="lead mb-4">
                This issue features cutting-edge research across various fields of study, including computer science, 
                engineering, and applied mathematics.
            </p>

            <h5 class="mb-3">Articles in This Issue:</h5>

            <div class="article-item">
                <h6>Machine Learning Approaches for Predictive Analytics in Healthcare</h6>
                <p class="text-muted small mb-2">
                    <i class="fas fa-user me-1"></i>Dr. John Smith, Dr. Jane Doe<br>
                    <i class="fas fa-tag me-1"></i>Computer Science, Healthcare
                </p>
                <p class="small">
                    This paper presents novel machine learning algorithms for predicting patient outcomes using 
                    electronic health records...
                </p>
                <a href="#" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-download me-1"></i>Download PDF
                </a>
            </div>

            <div class="article-item">
                <h6>Sustainable Energy Systems: A Comprehensive Review</h6>
                <p class="text-muted small mb-2">
                    <i class="fas fa-user me-1"></i>Dr. Michael Johnson<br>
                    <i class="fas fa-tag me-1"></i>Engineering, Renewable Energy
                </p>
                <p class="small">
                    A systematic review of current sustainable energy technologies and their implementation challenges...
                </p>
                <a href="#" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-download me-1"></i>Download PDF
                </a>
            </div>

            <div class="article-item">
                <h6>Advanced Algorithms for Graph Theory Applications</h6>
                <p class="text-muted small mb-2">
                    <i class="fas fa-user me-1"></i>Dr. Sarah Williams<br>
                    <i class="fas fa-tag me-1"></i>Mathematics, Computer Science
                </p>
                <p class="small">
                    Novel algorithmic approaches to solving complex graph theory problems with applications in 
                    network optimization...
                </p>
                <a href="#" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-download me-1"></i>Download PDF
                </a>
            </div>
        </div>

        <!-- Previous Issues -->
        <h3 class="mb-4">Previous Issues</h3>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="issue-card">
                    <h5>Volume 5, Issue 1</h5>
                    <p class="text-muted">Published: June 2024</p>
                    <p>Featured 8 research articles covering topics in AI, data science, and software engineering.</p>
                    <a href="#" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-eye me-1"></i>View Issue
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="issue-card">
                    <h5>Volume 4, Issue 2</h5>
                    <p class="text-muted">Published: December 2023</p>
                    <p>Special issue on Quantum Computing and its applications in modern technology.</p>
                    <a href="#" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-eye me-1"></i>View Issue
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="issue-card">
                    <h5>Volume 4, Issue 1</h5>
                    <p class="text-muted">Published: June 2023</p>
                    <p>Research papers on cybersecurity, blockchain, and distributed systems.</p>
                    <a href="#" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-eye me-1"></i>View Issue
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="issue-card">
                    <h5>Volume 3, Issue 2</h5>
                    <p class="text-muted">Published: December 2022</p>
                    <p>Advances in artificial intelligence and machine learning methodologies.</p>
                    <a href="#" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-eye me-1"></i>View Issue
                    </a>
                </div>
            </div>
        </div>

        <!-- Archive Link -->
        <div class="text-center mt-5 p-5 bg-light rounded">
            <h4 class="mb-3">Looking for Older Issues?</h4>
            <p class="text-muted mb-4">Browse our complete archive of published research</p>
            <a href="/search" class="btn btn-primary btn-lg">
                <i class="fas fa-archive me-2"></i>View Archive
            </a>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</body>
</html>
