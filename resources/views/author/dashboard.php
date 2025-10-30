<?php
// Author Dashboard View
$user = $user ?? [];
$stats = $stats ?? [];
$submissions = $submissions ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Dashboard - RJMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .dashboard-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-icon {
            font-size: 36px;
            opacity: 0.8;
        }
        .stat-value {
            font-size: 32px;
            font-weight: bold;
            margin: 10px 0;
        }
        .quick-action-btn {
            width: 100%;
            padding: 15px;
            border-radius: 8px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .submission-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 4px solid #667eea;
        }
        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-tachometer-alt me-3"></i>Author Dashboard</h1>
                    <p class="mb-0">Welcome back, <?= htmlspecialchars($user['first_name'] ?? 'Author') ?>!</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="/author/submit" class="btn btn-light btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Submit New Article
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php if (isset($_SESSION['flash'])): ?>
            <?php foreach ($_SESSION['flash'] as $type => $message): ?>
                <div class="alert alert-<?= $type ?> alert-dismissible fade show">
                    <?= htmlspecialchars($message) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['flash'][$type]); ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stat-card text-center">
                    <i class="fas fa-file-alt stat-icon text-primary"></i>
                    <div class="stat-value text-primary"><?= $stats['total'] ?? 0 ?></div>
                    <div class="text-muted">Total Submissions</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card text-center">
                    <i class="fas fa-clock stat-icon text-warning"></i>
                    <div class="stat-value text-warning"><?= $stats['pending'] ?? 0 ?></div>
                    <div class="text-muted">Pending Review</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card text-center">
                    <i class="fas fa-search stat-icon text-info"></i>
                    <div class="stat-value text-info"><?= $stats['under_review'] ?? 0 ?></div>
                    <div class="text-muted">Under Review</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card text-center">
                    <i class="fas fa-check-circle stat-icon text-success"></i>
                    <div class="stat-value text-success"><?= $stats['published'] ?? 0 ?></div>
                    <div class="text-muted">Published</div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Main Content -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Recent Submissions</h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($submissions)): ?>
                            <div class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No submissions yet. Start by submitting your first article!</p>
                                <a href="/author/submit" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Submit Article
                                </a>
                            </div>
                        <?php else: ?>
                            <?php foreach ($submissions as $submission): ?>
                                <div class="submission-card">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="mb-0"><?= htmlspecialchars($submission['title']) ?></h6>
                                        <span class="status-badge bg-<?= getStatusColor($submission['status']) ?>">
                                            <?= ucfirst($submission['status']) ?>
                                        </span>
                                    </div>
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-calendar me-2"></i>
                                        Submitted: <?= date('M d, Y', strtotime($submission['submission_date'])) ?>
                                    </p>
                                    <div class="d-flex gap-2">
                                        <a href="/author/article/<?= $submission['id'] ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                        <?php if ($submission['status'] == 'draft'): ?>
                                            <a href="/author/article/<?= $submission['id'] ?>/edit" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="text-center mt-3">
                                <a href="/author/manage" class="btn btn-link">View All Submissions →</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Quick Actions -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h6 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <a href="/author/submit" class="btn btn-primary quick-action-btn">
                            <i class="fas fa-plus-circle me-2"></i>Submit New Article
                        </a>
                        <a href="/author/manage" class="btn btn-outline-primary quick-action-btn">
                            <i class="fas fa-folder me-2"></i>Manage Submissions
                        </a>
                        <a href="/author/guidelines" class="btn btn-outline-secondary quick-action-btn">
                            <i class="fas fa-book me-2"></i>Submission Guidelines
                        </a>
                    </div>
                </div>

                <!-- Help & Resources -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="mb-0"><i class="fas fa-question-circle me-2"></i>Help & Resources</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="/faq" class="text-decoration-none">
                                    <i class="fas fa-question me-2"></i>FAQs
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="/submission-guidelines" class="text-decoration-none">
                                    <i class="fas fa-file-alt me-2"></i>Submission Guidelines
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="/contact" class="text-decoration-none">
                                    <i class="fas fa-envelope me-2"></i>Contact Support
                                </a>
                            </li>
                            <li>
                                <a href="/about" class="text-decoration-none">
                                    <i class="fas fa-info-circle me-2"></i>About RJMS
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>

<?php
function getStatusColor($status) {
    $colors = [
        'draft' => 'secondary',
        'pending' => 'warning',
        'under_review' => 'info',
        'revision_required' => 'warning',
        'accepted' => 'success',
        'published' => 'success',
        'rejected' => 'danger'
    ];
    return $colors[$status] ?? 'secondary';
}
?>
