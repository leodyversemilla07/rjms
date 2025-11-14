<?php
// Author Dashboard View
$user = $user ?? [];
$stats = $stats ?? [];
$submissions = $submissions ?? [];

// Set page metadata
$title = 'Author Dashboard - RJMS';
$description = 'Manage your research submissions and track their status';
$keywords = 'author dashboard, research submissions, manuscript management';

// Additional CSS for dashboard
$additionalCss = <<<'CSS'
<style>
.stat-card {
    transition: transform 0.3s, box-shadow 0.3s;
}
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
</style>
CSS;

// Start output buffering
ob_start();
?>

<!-- Dashboard Header -->
<div class="bg-slate-800 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold mb-2">
                    <i class="fas fa-tachometer-alt mr-3"></i>Author Dashboard
                </h1>
                <p class="text-slate-200">Welcome back, <?= htmlspecialchars($user['first_name'] ?? 'Author') ?>!</p>
            </div>
            <div>
                <a href="/author/submit" class="btn-primary text-lg">
                    <i class="fas fa-plus-circle mr-2"></i>Submit New Article
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Submissions -->
        <div class="stat-card bg-white rounded-lg shadow-card border-l-4 border-primary-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 uppercase">Total Submissions</p>
                    <p class="text-3xl font-bold text-primary-700 mt-2"><?= $stats['total'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-alt text-2xl text-primary-700"></i>
                </div>
            </div>
        </div>

        <!-- Pending Review -->
        <div class="stat-card bg-white rounded-lg shadow-card border-l-4 border-amber-500 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 uppercase">Pending Review</p>
                    <p class="text-3xl font-bold text-amber-600 mt-2"><?= $stats['pending'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-2xl text-amber-600"></i>
                </div>
            </div>
        </div>

        <!-- Under Review -->
        <div class="stat-card bg-white rounded-lg shadow-card border-l-4 border-blue-500 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 uppercase">Under Review</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2"><?= $stats['under_review'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-search text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>

        <!-- Published -->
        <div class="stat-card bg-white rounded-lg shadow-card border-l-4 border-green-500 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 uppercase">Published</p>
                    <p class="text-3xl font-bold text-green-600 mt-2"><?= $stats['published'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-2xl text-green-600"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content - Recent Submissions -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-card border border-slate-200">
                <div class="border-b border-slate-200 px-6 py-4">
                    <h5 class="text-lg font-semibold text-slate-800">
                        <i class="fas fa-list mr-2"></i>Recent Submissions
                    </h5>
                </div>
                <div class="p-6">
                    <?php if (empty($submissions)): ?>
                        <div class="text-center py-12">
                            <i class="fas fa-inbox text-6xl text-slate-300 mb-4"></i>
                            <p class="text-slate-600 mb-4">No submissions yet. Start by submitting your first article!</p>
                            <a href="/author/submit" class="btn-primary">
                                <i class="fas fa-plus mr-2"></i>Submit Article
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php foreach ($submissions as $submission): ?>
                                <div class="border-l-4 border-primary-700 bg-slate-50 rounded-r-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-3">
                                        <h6 class="font-semibold text-slate-800 mb-2 md:mb-0">
                                            <?= htmlspecialchars($submission['title']) ?>
                                        </h6>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold <?= getStatusBadgeClass($submission['status']) ?>">
                                            <?= ucfirst(str_replace('_', ' ', $submission['status'])) ?>
                                        </span>
                                    </div>
                                    <p class="text-sm text-slate-600 mb-3">
                                        <i class="fas fa-calendar mr-2"></i>
                                        Submitted: <?= date('M d, Y', strtotime($submission['submission_date'])) ?>
                                    </p>
                                    <div class="flex flex-wrap gap-2">
                                        <a href="/author/article/<?= $submission['id'] ?>" class="inline-flex items-center px-3 py-1.5 border border-primary-700 text-primary-700 rounded-md hover:bg-primary-50 transition-colors text-sm font-medium">
                                            <i class="fas fa-eye mr-1"></i>View
                                        </a>
                                        <?php if ($submission['status'] == 'draft'): ?>
                                            <a href="/author/article/<?= $submission['id'] ?>/edit" class="inline-flex items-center px-3 py-1.5 border border-slate-300 text-slate-700 rounded-md hover:bg-slate-50 transition-colors text-sm font-medium">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="text-center mt-6">
                            <a href="/author/manage" class="text-primary-700 hover:text-primary-800 font-medium">
                                View All Submissions →
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-card border border-slate-200 mb-6">
                <div class="border-b border-slate-200 px-6 py-4">
                    <h6 class="text-lg font-semibold text-slate-800">
                        <i class="fas fa-bolt mr-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="p-6 space-y-3">
                    <a href="/author/submit" class="btn-primary w-full justify-center">
                        <i class="fas fa-plus-circle mr-2"></i>Submit New Article
                    </a>
                    <a href="/author/manage" class="btn-outline w-full justify-center">
                        <i class="fas fa-folder mr-2"></i>Manage Submissions
                    </a>
                    <a href="/author/guidelines" class="btn-ghost w-full justify-center">
                        <i class="fas fa-book mr-2"></i>Submission Guidelines
                    </a>
                </div>
            </div>

            <!-- Help & Resources -->
            <div class="bg-white rounded-lg shadow-card border border-slate-200">
                <div class="border-b border-slate-200 px-6 py-4">
                    <h6 class="text-lg font-semibold text-slate-800">
                        <i class="fas fa-question-circle mr-2"></i>Help & Resources
                    </h6>
                </div>
                <div class="p-6">
                    <ul class="space-y-3">
                        <li>
                            <a href="/faq" class="flex items-center text-slate-700 hover:text-primary-700 transition-colors">
                                <i class="fas fa-question w-5 mr-2"></i>FAQs
                            </a>
                        </li>
                        <li>
                            <a href="/submission-guidelines" class="flex items-center text-slate-700 hover:text-primary-700 transition-colors">
                                <i class="fas fa-file-alt w-5 mr-2"></i>Submission Guidelines
                            </a>
                        </li>
                        <li>
                            <a href="/contact" class="flex items-center text-slate-700 hover:text-primary-700 transition-colors">
                                <i class="fas fa-envelope w-5 mr-2"></i>Contact Support
                            </a>
                        </li>
                        <li>
                            <a href="/about" class="flex items-center text-slate-700 hover:text-primary-700 transition-colors">
                                <i class="fas fa-info-circle w-5 mr-2"></i>About RJMS
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Get the buffered content
$content = ob_get_clean();

// Helper function for status badge colors
function getStatusBadgeClass($status) {
    $classes = [
        'draft' => 'bg-slate-100 text-slate-800',
        'pending' => 'bg-amber-100 text-amber-800',
        'under_review' => 'bg-blue-100 text-blue-800',
        'revision_required' => 'bg-amber-100 text-amber-800',
        'accepted' => 'bg-green-100 text-green-800',
        'published' => 'bg-green-100 text-green-800',
        'rejected' => 'bg-red-100 text-red-800'
    ];
    return $classes[$status] ?? 'bg-slate-100 text-slate-800';
}

// Include the main layout
include __DIR__ . '/../layouts/main.php';
?>
