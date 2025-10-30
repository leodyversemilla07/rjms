<?php
$stats = $stats ?? [];
$recentSubmissions = $recentSubmissions ?? [];
$recentUsers = $recentUsers ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - RJMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.css" rel="stylesheet">
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
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
            border-left: 4px solid;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .stat-card.primary { border-color: #667eea; }
        .stat-card.success { border-color: #28a745; }
        .stat-card.warning { border-color: #ffc107; }
        .stat-card.danger { border-color: #dc3545; }
        .stat-value {
            font-size: 36px;
            font-weight: bold;
            margin: 10px 0;
        }
        .stat-label {
            color: #6c757d;
            font-size: 14px;
            text-transform: uppercase;
        }
        .content-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .quick-action {
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
            border: 2px solid #e9ecef;
        }
        .quick-action:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }
        .activity-item {
            padding: 15px;
            border-left: 3px solid #667eea;
            margin-bottom: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="dashboard-header">
        <div class="container">
            <h1><i class="fas fa-tachometer-alt me-3"></i>Admin Dashboard</h1>
            <p class="mb-0">System Overview & Management</p>
        </div>
    </div>

    <div class="container-fluid px-4">
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
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="stat-card primary">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">Total Users</div>
                            <div class="stat-value text-primary"><?= $stats['total_users'] ?? 0 ?></div>
                            <small class="text-muted">
                                <i class="fas fa-arrow-up text-success"></i> 
                                <?= $stats['new_users_month'] ?? 0 ?> this month
                            </small>
                        </div>
                        <div>
                            <i class="fas fa-users fa-3x text-primary opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="stat-card success">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">Published Articles</div>
                            <div class="stat-value text-success"><?= $stats['published_articles'] ?? 0 ?></div>
                            <small class="text-muted">
                                <i class="fas fa-arrow-up text-success"></i> 
                                <?= $stats['published_this_month'] ?? 0 ?> this month
                            </small>
                        </div>
                        <div>
                            <i class="fas fa-check-circle fa-3x text-success opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="stat-card warning">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">Pending Review</div>
                            <div class="stat-value text-warning"><?= $stats['pending_submissions'] ?? 0 ?></div>
                            <small class="text-muted">Require attention</small>
                        </div>
                        <div>
                            <i class="fas fa-clock fa-3x text-warning opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="stat-card danger">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">Total Submissions</div>
                            <div class="stat-value text-danger"><?= $stats['total_submissions'] ?? 0 ?></div>
                            <small class="text-muted">All time</small>
                        </div>
                        <div>
                            <i class="fas fa-file-alt fa-3x text-danger opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Submissions -->
            <div class="col-xl-8 mb-4">
                <div class="content-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Recent Submissions</h5>
                        <a href="/admin/submissions" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($recentSubmissions)): ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No recent submissions</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($recentSubmissions as $submission): ?>
                                        <tr>
                                            <td>#<?= $submission['id'] ?></td>
                                            <td>
                                                <strong><?= htmlspecialchars(substr($submission['title'], 0, 50)) ?><?= strlen($submission['title']) > 50 ? '...' : '' ?></strong>
                                            </td>
                                            <td><?= htmlspecialchars($submission['author_name'] ?? 'Unknown') ?></td>
                                            <td>
                                                <span class="badge bg-<?= getStatusColor($submission['status']) ?>">
                                                    <?= ucfirst($submission['status']) ?>
                                                </span>
                                            </td>
                                            <td><?= date('M d, Y', strtotime($submission['submission_date'])) ?></td>
                                            <td>
                                                <a href="/admin/submissions/<?= $submission['id'] ?>" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Submission Chart -->
                <div class="content-card">
                    <h5 class="mb-3"><i class="fas fa-chart-line me-2"></i>Submission Trends</h5>
                    <canvas id="submissionChart" height="80"></canvas>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-xl-4">
                <!-- Quick Actions -->
                <div class="content-card mb-4">
                    <h5 class="mb-3"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                    <div class="row g-2">
                        <div class="col-6">
                            <a href="/admin/users" class="quick-action text-decoration-none d-block">
                                <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                <div class="fw-bold">Manage Users</div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="/admin/submissions" class="quick-action text-decoration-none d-block">
                                <i class="fas fa-file-alt fa-2x text-success mb-2"></i>
                                <div class="fw-bold">Submissions</div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="/admin/categories" class="quick-action text-decoration-none d-block">
                                <i class="fas fa-folder fa-2x text-warning mb-2"></i>
                                <div class="fw-bold">Categories</div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="/admin/settings" class="quick-action text-decoration-none d-block">
                                <i class="fas fa-cog fa-2x text-danger mb-2"></i>
                                <div class="fw-bold">Settings</div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="content-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>New Users</h5>
                        <a href="/admin/users" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <?php if (empty($recentUsers)): ?>
                        <p class="text-muted text-center">No recent users</p>
                    <?php else: ?>
                        <div class="list-group list-group-flush">
                            <?php foreach (array_slice($recentUsers, 0, 5) as $user): ?>
                                <div class="list-group-item px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            <?= strtoupper(substr($user['first_name'] ?? 'U', 0, 1)) ?>
                                        </div>
                                        <div class="flex-grow-1">
                                            <strong><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></strong>
                                            <br><small class="text-muted"><?= htmlspecialchars($user['email']) ?></small>
                                        </div>
                                        <small class="text-muted"><?= date('M d', strtotime($user['created_at'])) ?></small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- System Status -->
                <div class="content-card">
                    <h5 class="mb-3"><i class="fas fa-server me-2"></i>System Status</h5>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Storage Used</span>
                            <span class="fw-bold">45%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 45%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Database Size</span>
                            <span class="fw-bold">2.4 GB</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: 60%"></div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-outline-secondary btn-sm" onclick="alert('System optimization feature coming soon!')">
                            <i class="fas fa-wrench me-2"></i>Optimize System
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Submission Trends Chart
        const ctx = document.getElementById('submissionChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Submissions',
                    data: [12, 19, 15, 25, 22, 30, 28, 35, 32, 38, 42, 45],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
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
