<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search - RJMS</title>
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
        .search-box {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }
        .filter-section {
            background: #F3F4F6;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .result-item {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .result-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Search Publications</h1>
            <p class="lead">Find research articles, papers, and publications</p>
        </div>
    </div>

    <div class="container mb-5">
        <!-- Search Box -->
        <div class="search-box">
            <form id="searchForm" method="GET" action="/search">
                <div class="row g-3 align-items-end">
                    <div class="col-md-8">
                        <label for="query" class="form-label">Search Terms</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" id="query" name="q" 
                                   placeholder="Enter keywords, author names, or topics..."
                                   value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-search me-2"></i>Search
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <!-- Filters Sidebar -->
            <div class="col-md-3">
                <div class="filter-section">
                    <h5 class="mb-4"><i class="fas fa-filter me-2"></i>Filters</h5>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Category</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="cs" id="cat1">
                            <label class="form-check-label" for="cat1">Computer Science</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="eng" id="cat2">
                            <label class="form-check-label" for="cat2">Engineering</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="math" id="cat3">
                            <label class="form-check-label" for="cat3">Mathematics</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="bio" id="cat4">
                            <label class="form-check-label" for="cat4">Biology</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="phys" id="cat5">
                            <label class="form-check-label" for="cat5">Physics</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Publication Year</label>
                        <select class="form-select">
                            <option value="">All Years</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Sort By</label>
                        <select class="form-select">
                            <option value="relevance">Relevance</option>
                            <option value="date_desc">Newest First</option>
                            <option value="date_asc">Oldest First</option>
                            <option value="title">Title (A-Z)</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-secondary w-100" onclick="resetFilters()">
                        <i class="fas fa-redo me-2"></i>Reset Filters
                    </button>
                </div>
            </div>

            <!-- Search Results -->
            <div class="col-md-9">
                <?php if (isset($_GET['q']) && !empty($_GET['q'])): ?>
                    <div class="mb-4">
                        <h5>Search Results for "<?= htmlspecialchars($_GET['q']) ?>"</h5>
                        <p class="text-muted">Found 12 results</p>
                    </div>

                    <!-- Sample Results -->
                    <div class="result-item">
                        <h5>
                            <a href="#" class="text-decoration-none text-dark">
                                Machine Learning Applications in Modern Healthcare Systems
                            </a>
                        </h5>
                        <p class="text-muted small mb-2">
                            <i class="fas fa-user me-2"></i>Dr. John Smith, Dr. Jane Doe
                            <span class="mx-2">|</span>
                            <i class="fas fa-calendar me-2"></i>December 2024
                            <span class="mx-2">|</span>
                            <i class="fas fa-tag me-2"></i>Computer Science
                        </p>
                        <p class="mb-3">
                            This comprehensive study explores the integration of machine learning algorithms in healthcare 
                            diagnostics, patient care management, and predictive analytics. The research demonstrates 
                            significant improvements in accuracy and efficiency...
                        </p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye me-1"></i>View Abstract
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download me-1"></i>Download PDF
                            </a>
                        </div>
                    </div>

                    <div class="result-item">
                        <h5>
                            <a href="#" class="text-decoration-none text-dark">
                                Sustainable Energy Solutions for Urban Development
                            </a>
                        </h5>
                        <p class="text-muted small mb-2">
                            <i class="fas fa-user me-2"></i>Dr. Michael Johnson
                            <span class="mx-2">|</span>
                            <i class="fas fa-calendar me-2"></i>November 2024
                            <span class="mx-2">|</span>
                            <i class="fas fa-tag me-2"></i>Engineering
                        </p>
                        <p class="mb-3">
                            An in-depth analysis of renewable energy implementation in metropolitan areas, focusing on 
                            solar, wind, and hybrid systems. The paper presents case studies from major cities worldwide...
                        </p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye me-1"></i>View Abstract
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download me-1"></i>Download PDF
                            </a>
                        </div>
                    </div>

                    <div class="result-item">
                        <h5>
                            <a href="#" class="text-decoration-none text-dark">
                                Advanced Graph Theory: Algorithms and Applications
                            </a>
                        </h5>
                        <p class="text-muted small mb-2">
                            <i class="fas fa-user me-2"></i>Dr. Sarah Williams
                            <span class="mx-2">|</span>
                            <i class="fas fa-calendar me-2"></i>October 2024
                            <span class="mx-2">|</span>
                            <i class="fas fa-tag me-2"></i>Mathematics
                        </p>
                        <p class="mb-3">
                            Novel algorithmic approaches to complex graph problems with applications in network optimization, 
                            social network analysis, and computational biology...
                        </p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye me-1"></i>View Abstract
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download me-1"></i>Download PDF
                            </a>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Search results pagination" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>

                <?php else: ?>
                    <!-- No Search Yet -->
                    <div class="text-center py-5">
                        <i class="fas fa-search fa-4x text-muted mb-4"></i>
                        <h4>Start Your Search</h4>
                        <p class="text-muted">Enter keywords above to find research articles and publications</p>
                        
                        <div class="mt-5">
                            <h6 class="mb-3">Popular Searches:</h6>
                            <div class="d-flex flex-wrap gap-2 justify-content-center">
                                <a href="/search?q=machine+learning" class="badge bg-secondary fs-6 text-decoration-none">Machine Learning</a>
                                <a href="/search?q=artificial+intelligence" class="badge bg-secondary fs-6 text-decoration-none">Artificial Intelligence</a>
                                <a href="/search?q=data+science" class="badge bg-secondary fs-6 text-decoration-none">Data Science</a>
                                <a href="/search?q=quantum+computing" class="badge bg-secondary fs-6 text-decoration-none">Quantum Computing</a>
                                <a href="/search?q=renewable+energy" class="badge bg-secondary fs-6 text-decoration-none">Renewable Energy</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        function resetFilters() {
            document.querySelectorAll('.form-check-input').forEach(cb => cb.checked = false);
            document.querySelectorAll('select').forEach(sel => sel.selectedIndex = 0);
        }
    </script>
</body>
</html>
