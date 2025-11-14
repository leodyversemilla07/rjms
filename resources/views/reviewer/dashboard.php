<?php
// Set page metadata
$title = 'Reviewer Dashboard - Research Journal Management System';
$description = 'Manage and review assigned submissions';
$keywords = 'reviewer, dashboard, submissions, reviews';

$stats = $stats ?? [
    'pending' => 0,
    'completed' => 0,
    'total' => 0
];
$assigned_submissions = $assigned_submissions ?? [];

// Start output buffering
ob_start();
?>

    <!-- Page Header -->
    <div class="bg-primary-700 text-white border-b-4 border-primary-800">
        <div class="container mx-auto px-4 py-12">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        <i class="fas fa-user-graduate mr-3"></i>Reviewer Dashboard
                    </h1>
                    <p class="text-primary-100">Review and evaluate assigned submissions</p>
                </div>
                <div>
                    <a href="/reviewer/submissions" class="inline-flex items-center justify-center bg-white text-primary-700 hover:bg-primary-50 font-semibold py-3 px-6 rounded-lg transition-colors">
                        <i class="fas fa-list mr-2"></i>All Assignments
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-card p-6 hover:-translate-y-1 transition-transform">
                <div class="flex justify-between items-center">
                    <div>
                        <h6 class="text-slate-600 text-sm font-medium mb-2">Pending Reviews</h6>
                        <h2 class="text-3xl font-bold text-slate-800"><?= $stats['pending'] ?></h2>
                    </div>
                    <div class="w-16 h-16 bg-amber-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clock text-3xl text-amber-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-card p-6 hover:-translate-y-1 transition-transform">
                <div class="flex justify-between items-center">
                    <div>
                        <h6 class="text-slate-600 text-sm font-medium mb-2">Completed Reviews</h6>
                        <h2 class="text-3xl font-bold text-slate-800"><?= $stats['completed'] ?></h2>
                    </div>
                    <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-3xl text-green-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-card p-6 hover:-translate-y-1 transition-transform">
                <div class="flex justify-between items-center">
                    <div>
                        <h6 class="text-slate-600 text-sm font-medium mb-2">Total Assigned</h6>
                        <h2 class="text-3xl font-bold text-slate-800"><?= $stats['total'] ?></h2>
                    </div>
                    <div class="w-16 h-16 bg-primary-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-file-alt text-3xl text-primary-700"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Pending Reviews -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Pending Reviews -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-card p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h5 class="text-xl font-bold text-slate-800">
                            <i class="fas fa-tasks mr-2"></i>Pending Reviews
                        </h5>
                        <a href="/reviewer/submissions?status=pending" class="text-sm font-medium text-primary-700 hover:text-primary-800">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>

                    <?php if (empty($assigned_submissions)): ?>
                        <div class="text-center py-12">
                            <i class="fas fa-check-double text-6xl text-slate-300 mb-4"></i>
                            <p class="text-slate-600">No pending reviews. Great job!</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                        <?php foreach ($assigned_submissions as $submission): ?>
                            <?php
                            $deadline = strtotime($submission['deadline'] ?? '+14 days');
                            $daysLeft = ceil(($deadline - time()) / 86400);
                            $borderColor = 'border-primary-500';
                            if ($daysLeft <= 2) {
                                $borderColor = 'border-red-500';
                            } elseif ($daysLeft <= 5) {
                                $borderColor = 'border-amber-500';
                            }
                            ?>
                            <div class="bg-slate-50 border-l-4 <?= $borderColor ?> rounded-r-lg p-4 hover:bg-slate-100 transition-all">
                                <div class="flex justify-between items-start gap-4">
                                    <div class="flex-1">
                                        <h6 class="font-semibold text-slate-800 mb-2">
                                            <a href="/reviewer/view-submission/<?= $submission['id'] ?>" class="hover:text-primary-700 transition-colors">
                                                <?= htmlspecialchars($submission['title']) ?>
                                            </a>
                                        </h6>
                                        <p class="text-sm text-slate-600 mb-3">
                                            <?= htmlspecialchars(substr($submission['abstract'] ?? '', 0, 150)) ?>...
                                        </p>
                                        <div class="flex flex-wrap gap-4 mb-2">
                                            <small class="text-slate-600">
                                                <i class="fas fa-user mr-1"></i>
                                                <?= htmlspecialchars($submission['author_name'] ?? 'Anonymous') ?>
                                            </small>
                                            <small class="text-slate-600">
                                                <i class="fas fa-folder mr-1"></i>
                                                <?= htmlspecialchars($submission['category_name'] ?? 'Uncategorized') ?>
                                            </small>
                                            <small class="<?= $daysLeft <= 2 ? 'text-red-600' : ($daysLeft <= 5 ? 'text-amber-600' : 'text-slate-600') ?>">
                                                <i class="fas fa-calendar-alt mr-1"></i>
                                                Due in <?= $daysLeft ?> day<?= $daysLeft != 1 ? 's' : '' ?>
                                            </small>
                                        </div>
                                        <?php if ($submission['review_status'] == 'in_progress'): ?>
                                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded">Draft Saved</span>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <a href="/reviewer/view-submission/<?= $submission['id'] ?>" class="inline-flex items-center justify-center bg-primary-700 hover:bg-primary-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                                            <i class="fas fa-eye mr-1"></i>Review
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6"

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h6 class="text-lg font-bold text-slate-800 mb-4">
                        <i class="fas fa-bolt mr-2"></i>Quick Actions
                    </h6>
                    <div class="flex flex-col gap-3">
                        <a href="/reviewer/submissions?status=pending" class="flex items-center justify-center border-2 border-amber-500 text-amber-700 hover:bg-amber-50 font-semibold py-2 px-4 rounded-lg transition-colors">
                            <i class="fas fa-clock mr-2"></i>Pending (<?= $stats['pending'] ?>)
                        </a>
                        <a href="/reviewer/submissions" class="flex items-center justify-center border-2 border-primary-700 text-primary-700 hover:bg-primary-50 font-semibold py-2 px-4 rounded-lg transition-colors">
                            <i class="fas fa-list mr-2"></i>All Submissions
                        </a>
                        <a href="/reviewer/history" class="flex items-center justify-center border-2 border-slate-700 text-slate-700 hover:bg-slate-50 font-semibold py-2 px-4 rounded-lg transition-colors">
                            <i class="fas fa-history mr-2"></i>Review History
                        </a>
                    </div>
                </div>

                <!-- Performance Stats -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h6 class="text-lg font-bold text-slate-800 mb-4">
                        <i class="fas fa-chart-line mr-2"></i>Your Performance
                    </h6>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-2">
                                <small class="text-slate-700 font-medium">Completion Rate</small>
                                <small class="text-slate-700 font-semibold">
                                    <?php 
                                    $total = $stats['total'];
                                    $completed = $stats['completed'];
                                    $percentage = $total > 0 ? round(($completed / $total) * 100) : 0;
                                    echo $percentage . '%';
                                    ?>
                                </small>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: <?= $percentage ?>%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-2">
                                <small class="text-slate-700 font-medium">On-Time Reviews</small>
                                <small class="text-slate-700 font-semibold">95%</small>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 95%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviewer Guidelines -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h6 class="text-lg font-bold text-slate-800 mb-4">
                        <i class="fas fa-info-circle mr-2"></i>Reviewer Guidelines
                    </h6>
                    <ul class="text-sm text-slate-700 space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary-700 mr-2 mt-1"></i>
                            <span>Be objective and constructive</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary-700 mr-2 mt-1"></i>
                            <span>Complete reviews by the deadline</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary-700 mr-2 mt-1"></i>
                            <span>Maintain confidentiality</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary-700 mr-2 mt-1"></i>
                            <span>Disclose conflicts of interest</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary-700 mr-2 mt-1"></i>
                            <span>Provide detailed feedback</span>
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
