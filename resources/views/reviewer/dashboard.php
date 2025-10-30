<?php
$stats = $stats ?? [
    'pending' => 0,
    'completed' => 0,
    'total' => 0
];
$assigned_submissions = $assigned_submissions ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviewer Dashboard - RJMS</title>
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
        .submission-card {
            padding: 20px;
            border-left: 4px solid #667eea;
            margin-bottom: 15px;
            background: #f8f9fa;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .submission-card:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }
        .deadline-warning { border-left-color: #ffc107; }
        .deadline-urgent { border-left-color: #dc3545; }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-user-graduate me-3"></i>Reviewer Dashboard</h1>
                    <p class="mb-0">Review and evaluate assigned submissions</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="/reviewer/submissions" class="btn btn-light btn-lg">
                        <i class="fas fa-list me-2"></i>All Assignments
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Pending Reviews</h6>
                            <h2 class="mb-0"><?= $stats['pending'] ?></h2>
                        </div>
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Completed Reviews</h6>
                            <h2 class="mb-0"><?= $stats['completed'] ?></h2>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Assigned</h6>
                            <h2 class="mb-0"><?= $stats['total'] ?></h2>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Pending Reviews -->
            <div class="col-md-8">
                <div class="content-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5><i class="fas fa-tasks me-2"></i>Pending Reviews</h5>
                        <a href="/reviewer/submissions?status=pending" class="btn btn-sm btn-outline-primary">
                            View All <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>

                    <?php if (empty($assigned_submissions)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-check-double fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No pending reviews. Great job!</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($assigned_submissions as $submission): ?>
                            <?php
                            $deadline = strtotime($submission['deadline'] ?? '+14 days');
                            $daysLeft = ceil(($deadline - time()) / 86400);
                            $urgencyClass = '';
                            if ($daysLeft <= 2) {
                                $urgencyClass = 'deadline-urgent';
                            } elseif ($daysLeft <= 5) {
                                $urgencyClass = 'deadline-warning';
                            }
                            ?>
                            <div class="submission-card <?= $urgencyClass ?>">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-2">
                                            <a href="/reviewer/view-submission/<?= $submission['id'] ?>" class="text-decoration-none text-dark">
                                                <?= htmlspecialchars($submission['title']) ?>
                                            </a>
                                        </h6>
                                        <p class="mb-2 small text-muted">
                                            <?= htmlspecialchars(substr($submission['abstract'] ?? '', 0, 150)) ?>...
                                        </p>
                                        <div class="d-flex gap-3 mb-2">
                                            <small class="text-muted">
                                                <i class="fas fa-user me-1"></i>
                                                <?= htmlspecialchars($submission['author_name'] ?? 'Anonymous') ?>
                                            </small>
                                            <small class="text-muted">
                                                <i class="fas fa-folder me-1"></i>
                                                <?= htmlspecialchars($submission['category_name'] ?? 'Uncategorized') ?>
                                            </small>
                                            <small class="<?= $daysLeft <= 2 ? 'text-danger' : ($daysLeft <= 5 ? 'text-warning' : 'text-muted') ?>">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                Due in <?= $daysLeft ?> day<?= $daysLeft != 1 ? 's' : '' ?>
                                            </small>
                                        </div>
                                        <?php if ($submission['review_status'] == 'in_progress'): ?>
                                            <span class="badge bg-info">Draft Saved</span>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <a href="/reviewer/view-submission/<?= $submission['id'] ?>" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye me-1"></i>Review
                                        </a>
                                    </div>
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
                        <a href="/reviewer/submissions?status=pending" class="btn btn-outline-warning">
                            <i class="fas fa-clock me-2"></i>Pending (<?= $stats['pending'] ?>)
                        </a>
                        <a href="/reviewer/submissions" class="btn btn-outline-primary">
                            <i class="fas fa-list me-2"></i>All Submissions
                        </a>
                        <a href="/reviewer/history" class="btn btn-outline-secondary">
                            <i class="fas fa-history me-2"></i>Review History
                        </a>
                    </div>
                </div>

                <!-- Performance Stats -->
                <div class="content-card mb-4">
                    <h6 class="mb-3"><i class="fas fa-chart-line me-2"></i>Your Performance</h6>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Completion Rate</small>
                            <small>
                                <?php 
                                $total = $stats['total'];
                                $completed = $stats['completed'];
                                $percentage = $total > 0 ? round(($completed / $total) * 100) : 0;
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
                            <small>On-Time Reviews</small>
                            <small>95%</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" style="width: 95%"></div>
                        </div>
                    </div>
                </div>

                <!-- Reviewer Guidelines -->
                <div class="content-card">
                    <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i>Reviewer Guidelines</h6>
                    <ul class="small mb-0">
                        <li class="mb-2">Be objective and constructive</li>
                        <li class="mb-2">Complete reviews by the deadline</li>
                        <li class="mb-2">Maintain confidentiality</li>
                        <li class="mb-2">Disclose conflicts of interest</li>
                        <li>Provide detailed feedback</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
