<?php
$stats = $stats ?? [
    'pending_review' => 0,
    'under_review' => 0,
    'reviewed' => 0,
    'total_assigned' => 0
];
$recent_submissions = $recent_submissions ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor Dashboard - RJMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        .content-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .submission-item {
            padding: 15px;
            border-left: 4px solid #667eea;
            margin-bottom: 15px;
            background: #f8f9fa;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .submission-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }
        .priority-high { border-left-color: #dc3545; }
        .priority-medium { border-left-color: #ffc107; }
        .priority-low { border-left-color: #28a745; }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-user-tie me-3"></i>Editor Dashboard</h1>
                    <p class="mb-0">Manage and review submissions assigned to you</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="/editor/submissions" class="btn btn-light btn-lg">
                        <i class="fas fa-list me-2"></i>All Submissions
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Pending Review</h6>
                            <h2 class="mb-0"><?= $stats['pending_review'] ?></h2>
                        </div>
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Under Review</h6>
                            <h2 class="mb-0"><?= $stats['under_review'] ?></h2>
                        </div>
                        <div class="stat-icon bg-info bg-opacity-10 text-info">
                            <i class="fas fa-eye"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Reviewed</h6>
                            <h2 class="mb-0"><?= $stats['reviewed'] ?></h2>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Assigned</h6>
                            <h2 class="mb-0"><?= $stats['total_assigned'] ?></h2>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Submissions -->
            <div class="col-md-8">
                <div class="content-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5><i class="fas fa-inbox me-2"></i>Recent Submissions</h5>
                        <a href="/editor/submissions" class="btn btn-sm btn-outline-primary">
                            View All <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>

                    <?php if (empty($recent_submissions)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No submissions assigned to you yet.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($recent_submissions as $submission): ?>
                            <div class="submission-item priority-<?= $submission['priority'] ?? 'low' ?>">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-2">
                                            <a href="/editor/view-submission/<?= $submission['id'] ?>" class="text-decoration-none text-dark">
                                                <?= htmlspecialchars($submission['title']) ?>
                                            </a>
                                        </h6>
                                        <div class="d-flex gap-3 mb-2">
                                            <small class="text-muted">
                                                <i class="fas fa-user me-1"></i>
                                                <?= htmlspecialchars($submission['author_name'] ?? 'Unknown') ?>
                                            </small>
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>
                                                <?= date('M d, Y', strtotime($submission['created_at'])) ?>
                                            </small>
                                            <small class="text-muted">
                                                <i class="fas fa-folder me-1"></i>
                                                <?= htmlspecialchars($submission['category_name'] ?? 'Uncategorized') ?>
                                            </small>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <?php
                                            $statusColors = [
                                                'pending' => 'warning',
                                                'under_review' => 'info',
                                                'reviewed' => 'success',
                                                'accepted' => 'success',
                                                'rejected' => 'danger',
                                                'revision_required' => 'warning'
                                            ];
                                            $color = $statusColors[$submission['status']] ?? 'secondary';
                                            ?>
                                            <span class="badge bg-<?= $color ?>">
                                                <?= ucfirst(str_replace('_', ' ', $submission['status'])) ?>
                                            </span>
                                            <?php if (isset($submission['reviewer_count'])): ?>
                                                <span class="badge bg-secondary">
                                                    <i class="fas fa-users me-1"></i>
                                                    <?= $submission['reviewer_count'] ?> Reviewer<?= $submission['reviewer_count'] != 1 ? 's' : '' ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <a href="/editor/view-submission/<?= $submission['id'] ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Quick Actions -->
                <div class="content-card mb-4">
                    <h6 class="mb-3"><i class="fas fa-bolt me-2"></i>Quick Actions</h6>
                    <div class="d-grid gap-2">
                        <a href="/editor/submissions?status=pending" class="btn btn-outline-warning">
                            <i class="fas fa-clock me-2"></i>Pending Reviews (<?= $stats['pending_review'] ?>)
                        </a>
                        <a href="/editor/submissions?status=under_review" class="btn btn-outline-info">
                            <i class="fas fa-eye me-2"></i>Under Review (<?= $stats['under_review'] ?>)
                        </a>
                        <a href="/editor/submissions" class="btn btn-outline-primary">
                            <i class="fas fa-list me-2"></i>All Submissions
                        </a>
                    </div>
                </div>

                <!-- Submission Statistics -->
                <div class="content-card mb-4">
                    <h6 class="mb-3"><i class="fas fa-chart-pie me-2"></i>Review Progress</h6>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Completion Rate</small>
                            <small>
                                <?php 
                                $total = $stats['total_assigned'];
                                $reviewed = $stats['reviewed'];
                                $percentage = $total > 0 ? round(($reviewed / $total) * 100) : 0;
                                echo $percentage . '%';
                                ?>
                            </small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: <?= $percentage ?>%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small>In Progress</small>
                            <small>
                                <?php 
                                $inProgress = $stats['under_review'];
                                $progressPercentage = $total > 0 ? round(($inProgress / $total) * 100) : 0;
                                echo $progressPercentage . '%';
                                ?>
                            </small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" style="width: <?= $progressPercentage ?>%"></div>
                        </div>
                    </div>
                </div>

                <!-- Editor Guidelines -->
                <div class="content-card">
                    <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i>Editor Guidelines</h6>
                    <ul class="small mb-0">
                        <li class="mb-2">Review submissions within 7 days</li>
                        <li class="mb-2">Assign at least 2 reviewers per submission</li>
                        <li class="mb-2">Provide constructive feedback</li>
                        <li class="mb-2">Maintain communication with authors</li>
                        <li>Make final decisions based on reviewer feedback</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
