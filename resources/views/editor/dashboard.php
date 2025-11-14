<?php
// Set page metadata
$title = 'Editor Dashboard - Research Journal Management System';
$description = 'Manage and review submissions assigned to you';
$keywords = 'editor, dashboard, submissions, review management';

$stats = $stats ?? [
    'pending_review' => 0,
    'under_review' => 0,
    'reviewed' => 0,
    'total_assigned' => 0
];
$recent_submissions = $recent_submissions ?? [];

// Start output buffering
ob_start();
?>

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
                                    <div class="flex items-center">
                                    <i class="fas fa-file-alt text-blue-600 text-xl mr-3"></i>
                                    <div class="grow">
                                        <h6 class="font-semibold"><?= htmlspecialchars($submission['title']) ?></h6>
                                        <small class="text-gray-500">by <?= htmlspecialchars($submission['author_name']) ?></small>
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
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h6 class="text-lg font-bold text-slate-800 mb-4">
                        <i class="fas fa-info-circle mr-2"></i>Editor Guidelines
                    </h6>
                    <ul class="text-sm text-slate-700 space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary-700 mr-2 mt-1"></i>
                            <span>Review submissions within 7 days</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary-700 mr-2 mt-1"></i>
                            <span>Assign at least 2 reviewers per submission</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary-700 mr-2 mt-1"></i>
                            <span>Provide constructive feedback</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary-700 mr-2 mt-1"></i>
                            <span>Maintain communication with authors</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary-700 mr-2 mt-1"></i>
                            <span>Make final decisions based on reviewer feedback</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php
// Get the buffered content
$content = ob_get_clean();

// Include the main layout
include __DIR__ . '/../layouts/main.php';
?>
