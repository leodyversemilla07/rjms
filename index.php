<?php include 'resources/views/components/header.php';

require_once 'includes/db_connection.php';

$conn = connectDB();

$sql = "SELECT title, abstract, date_published FROM submissions WHERE is_published = 1 ORDER BY date_published DESC LIMIT 6";
$result = $conn->query($sql);
$articles = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();

?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="container-fluid px-4">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-10 mx-auto text-center">
                <div class="hero-content">
                    <div class="hero-badge">
                        <i class="fas fa-graduation-cap me-2"></i>
                        Academic Excellence Since 2020
                    </div>
                    <h1 class="hero-title">Advancing Knowledge Through Scientific Research</h1>
                    <p class="hero-subtitle">The official research journal of Mindoro State University, dedicated to publishing high-quality, peer-reviewed research across multiple disciplines</p>
                    <div class="hero-stats">
                        <div class="row justify-content-center">
                            <div class="col-md-3 col-sm-6">
                                <div class="stat-item">
                                    <div class="stat-number"><?php echo count($articles); ?>+</div>
                                    <div class="stat-label">Published Articles</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="stat-item">
                                    <div class="stat-number">500+</div>
                                    <div class="stat-label">Active Researchers</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="stat-item">
                                    <div class="stat-number">50+</div>
                                    <div class="stat-label">Research Fields</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="stat-item">
                                    <div class="stat-number">2.8</div>
                                    <div class="stat-label">Impact Factor</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hero-actions">
                        <a href="#latest-articles" class="btn btn-primary btn-hero">
                            <i class="fas fa-search me-2"></i>Explore Research
                        </a>
                        <a href="#about" class="btn btn-outline-light btn-hero">
                            <i class="fas fa-info-circle me-2"></i>Learn More
                        </a>
                        <a href="submission_form.php" class="btn btn-success btn-hero">
                            <i class="fas fa-upload me-2"></i>Submit Article
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <a href="#features" class="scroll-link">
            <i class="fas fa-chevron-down"></i>
        </a>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="features-section py-5">
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <div class="section-header">
                    <h2 class="section-title">Why Choose MinSU Research Journal?</h2>
                    <p class="section-subtitle">Leading academic excellence through innovative research publication and scholarly communication</p>
                    <div class="section-ornament">
                        <i class="fas fa-microscope"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h4>Rigorous Peer Review</h4>
                    <p>Our expert editorial board ensures the highest standards of academic excellence through comprehensive peer-review processes.</p>
                    <div class="feature-highlight">
                        <span class="highlight-text">Expert Reviewers</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                    <h4>Global Reach</h4>
                    <p>Indexed in major databases including Scopus, DOAJ, and Google Scholar, ensuring worldwide visibility for your research.</p>
                    <div class="feature-highlight">
                        <span class="highlight-text">International Indexing</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-unlock-alt"></i>
                    </div>
                    <h4>Open Access</h4>
                    <p>Free access to all published articles, promoting knowledge sharing and maximizing the impact of your research.</p>
                    <div class="feature-highlight">
                        <span class="highlight-text">No Publication Fees</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4>Fast Publication</h4>
                    <p>Efficient editorial process with average review time of 6-8 weeks, ensuring timely publication of quality research.</p>
                    <div class="feature-highlight">
                        <span class="highlight-text">Quick Turnaround</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Expert Community</h4>
                    <p>Connect with leading researchers, scholars, and academics from diverse fields of study and research disciplines.</p>
                    <div class="feature-highlight">
                        <span class="highlight-text">Networking Hub</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4>Research Impact</h4>
                    <p>High-quality research that contributes to global knowledge and addresses real-world challenges and societal needs.</p>
                    <div class="feature-highlight">
                        <span class="highlight-text">Measurable Impact</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="about-section py-5">
    <div class="container-fluid px-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="about-content">
                    <div class="section-badge">
                        <i class="fas fa-university me-2"></i>
                        About Our Journal
                    </div>
                    <h2 class="section-title">MinSU Research Journal</h2>
                    <p class="lead">The official research publication of Mindoro State University, serving as a premier platform for academic research and scholarly communication across multiple disciplines.</p>
                    <p>Since our establishment in 2020, we have been committed to advancing knowledge through the publication of high-quality, peer-reviewed research articles. Our journal maintains the highest standards of academic integrity while fostering innovation and collaboration within the global research community.</p>

                    <div class="about-features">
                        <div class="about-feature">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <div>
                                <strong>Rigorous Peer-Review Process</strong>
                                <p class="mb-0">Expert evaluation ensuring scientific quality and validity</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <div>
                                <strong>Open Access Publication Model</strong>
                                <p class="mb-0">Free access to research for maximum global impact</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <div>
                                <strong>Multidisciplinary Research Coverage</strong>
                                <p class="mb-0">Supporting diverse fields of academic inquiry</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <div>
                                <strong>International Editorial Board</strong>
                                <p class="mb-0">Global expertise in research evaluation and guidance</p>
                            </div>
                        </div>
                    </div>

                    <div class="about-actions">
                        <a href="about-overview.php" class="btn btn-primary">
                            <i class="fas fa-book-open me-2"></i>Learn More
                        </a>
                        <a href="about-editorial-board.php" class="btn btn-outline-primary">
                            <i class="fas fa-users me-2"></i>Editorial Board
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-visual">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="stat-info">
                                <div class="stat-value">2.847</div>
                                <div class="stat-label">Impact Factor</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-eye"></i>
                            </div>
                            <div class="stat-info">
                                <div class="stat-value">50K+</div>
                                <div class="stat-label">Monthly Views</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-download"></i>
                            </div>
                            <div class="stat-info">
                                <div class="stat-value">25K+</div>
                                <div class="stat-label">Downloads</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-quote-right"></i>
                            </div>
                            <div class="stat-info">
                                <div class="stat-value">1.2K+</div>
                                <div class="stat-label">Citations</div>
                            </div>
                        </div>
                    </div>

                    <div class="accreditation-badges">
                        <div class="badge-item">
                            <div class="badge-icon">
                                <i class="fas fa-medal"></i>
                            </div>
                            <div class="badge-info">
                                <strong>Scopus Indexed</strong>
                                <span>International Database</span>
                            </div>
                        </div>
                        <div class="badge-item">
                            <div class="badge-icon">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="badge-info">
                                <strong>DOAJ Listed</strong>
                                <span>Directory of Open Access</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Articles Section -->
<section id="latest-articles" class="articles-section py-5">
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <div class="section-header">
                    <h2 class="section-title">Latest Research Publications</h2>
                    <p class="section-subtitle">Discover groundbreaking research from our academic community</p>
                    <div class="section-ornament">
                        <i class="fas fa-book-open"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Publication Statistics -->
        <div class="publication-stats mb-5">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="pub-stat">
                            <div class="pub-stat-number"><?php echo count($articles); ?></div>
                            <div class="pub-stat-label">Current Articles</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="pub-stat">
                            <div class="pub-stat-number">Vol 5, Issue 2</div>
                            <div class="pub-stat-label">Current Issue</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="pub-stat">
                            <div class="pub-stat-number">2025</div>
                            <div class="pub-stat-label">Publication Year</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="pub-stat">
                            <div class="pub-stat-number">Bi-Annual</div>
                            <div class="pub-stat-label">Publication Frequency</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $index => $article): ?>
                    <div class="col-lg-6 col-xl-4">
                        <article class="research-article-card">
                            <div class="article-header">
                                <div class="article-number">
                                    <span>Article</span>
                                    <strong><?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?></strong>
                                </div>
                                <div class="article-type">
                                    <span class="type-badge research">Research Article</span>
                                </div>
                            </div>

                            <div class="article-content">
                                <h4 class="article-title">
                                    <a href="#" class="title-link">
                                        <?php echo htmlspecialchars($article['title']); ?>
                                    </a>
                                </h4>
                                <div class="article-meta">
                                    <span class="publication-date">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        <?php echo date('F j, Y', strtotime($article['date_published'])); ?>
                                    </span>
                                </div>
                                <p class="article-abstract">
                                    <?php
                                    $abstract = htmlspecialchars($article['abstract']);
                                    echo strlen($abstract) > 120 ? substr($abstract, 0, 120) . '...' : $abstract;
                                    ?>
                                </p>
                            </div>

                            <div class="article-actions">
                                <div class="action-buttons">
                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>Read Article
                                    </a>
                                    <a href="#" class="btn btn-outline-success btn-sm">
                                        <i class="fas fa-download me-1"></i>PDF
                                    </a>
                                </div>
                                <div class="article-interactions">
                                    <button class="interaction-btn" title="Cite Article">
                                        <i class="fas fa-quote-right"></i>
                                    </button>
                                    <button class="interaction-btn" title="Share Article">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                    <button class="interaction-btn" title="Bookmark">
                                        <i class="fas fa-bookmark"></i>
                                    </button>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="no-articles-state">
                        <div class="no-articles-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h4>No Articles Published Yet</h4>
                        <p>Be the first to contribute to our research journal by submitting your research article.</p>
                        <div class="no-articles-actions">
                            <a href="submission_form.php" class="btn btn-primary">
                                <i class="fas fa-upload me-2"></i>Submit Article
                            </a>
                            <a href="submission_guidelines.php" class="btn btn-outline-primary">
                                <i class="fas fa-info-circle me-2"></i>Guidelines
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($articles)): ?>
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <div class="view-all-section">
                        <p class="mb-3">Explore our complete collection of research publications</p>
                        <div class="view-all-actions">
                            <a href="current_issues.php" class="btn btn-primary btn-lg">
                                <i class="fas fa-book-open me-2"></i>View All Articles
                            </a>
                            <a href="archives.php" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-archive me-2"></i>Browse Archives
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Call to Action Section -->
<section class="cta-section py-5">
    <div class="cta-overlay"></div>
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-lg-10 mx-auto text-center">
                <div class="cta-content">
                    <div class="cta-badge">
                        <i class="fas fa-rocket me-2"></i>
                        Join Our Research Community
                    </div>
                    <h2>Ready to Share Your Research?</h2>
                    <p>Join our community of researchers and contribute to the advancement of knowledge through quality academic publication</p>

                    <div class="cta-features">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="cta-feature">
                                    <i class="fas fa-upload"></i>
                                    <span>Submit Your Research</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="cta-feature">
                                    <i class="fas fa-users"></i>
                                    <span>Join as Reviewer</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="cta-feature">
                                    <i class="fas fa-bell"></i>
                                    <span>Get Updates</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cta-actions">
                        <a href="submission_form.php" class="btn btn-light btn-lg btn-cta">
                            <i class="fas fa-upload me-2"></i>Submit Research
                        </a>
                        <a href="reviewer_guidelines.php" class="btn btn-outline-light btn-lg btn-cta">
                            <i class="fas fa-user-check me-2"></i>Become a Reviewer
                        </a>
                    </div>

                    <div class="cta-stats">
                        <div class="row justify-content-center">
                            <div class="col-md-3 col-sm-6">
                                <div class="cta-stat">
                                    <strong>Fast Review</strong>
                                    <span>6-8 weeks average</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="cta-stat">
                                    <strong>Open Access</strong>
                                    <span>No publication fees</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="cta-stat">
                                    <strong>Global Reach</strong>
                                    <span>International indexing</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="cta-stat">
                                    <strong>Expert Review</strong>
                                    <span>PhD-level reviewers</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'resources/views/components/footer.php'; ?>