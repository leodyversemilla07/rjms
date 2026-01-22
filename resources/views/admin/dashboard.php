<?php
// Set page metadata
$title = 'Admin Dashboard - Research Journal Management System';
$description = 'System administration and analytics dashboard';
$keywords = 'admin, dashboard, statistics, management';

$stats = $stats ?? [];
$recentSubmissions = $recentSubmissions ?? [];
$recentUsers = $recentUsers ?? [];

// Helper function
function getStatusColor($status) {
    $colors = [
        'draft' => 'bg-slate-100 text-slate-700',
        'pending' => 'bg-amber-100 text-amber-700',
        'under_review' => 'bg-blue-100 text-blue-700',
        'revision_required' => 'bg-amber-100 text-amber-700',
        'accepted' => 'bg-green-100 text-green-700',
        'published' => 'bg-green-100 text-green-700',
        'rejected' => 'bg-red-100 text-red-700'
    ];
    return $colors[$status] ?? 'bg-slate-100 text-slate-700';
}
?>

<div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Page Header -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">
            <i class="fas fa-tachometer-alt mr-3 text-indigo-600"></i>Admin Dashboard
        </h2>
        <p class="text-gray-600">System Overview & Management</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <!-- Total Users Card -->
        <div class="stat-card bg-white rounded-xl p-6 shadow-lg border-l-4 border-indigo-600 transition-transform duration-300 hover:-translate-y-1">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-slate-600 text-sm font-semibold uppercase tracking-wide mb-2">Total Users</div>
                    <div class="text-4xl font-bold text-indigo-600 mb-2"><?= $stats['total_users'] ?? 0 ?></div>
                    <div class="text-sm text-slate-500">
                        <i class="fas fa-arrow-up text-green-500"></i> 
                        <?= $stats['new_users_month'] ?? 0 ?> this month
                    </div>
                </div>
                <div>
                    <i class="fas fa-users text-5xl text-indigo-600 opacity-20"></i>
                </div>
            </div>
        </div>

        <!-- Published Articles Card -->
        <div class="stat-card bg-white rounded-xl p-6 shadow-lg border-l-4 border-green-500 transition-transform duration-300 hover:-translate-y-1">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-slate-600 text-sm font-semibold uppercase tracking-wide mb-2">Published Articles</div>
                    <div class="text-4xl font-bold text-green-600 mb-2"><?= $stats['published_articles'] ?? 0 ?></div>
                    <div class="text-sm text-slate-500">
                        <i class="fas fa-arrow-up text-green-500"></i> 
                        <?= $stats['published_this_month'] ?? 0 ?> this month
                    </div>
                </div>
                <div>
                    <i class="fas fa-check-circle text-5xl text-green-600 opacity-20"></i>
                </div>
            </div>
        </div>

        <!-- Pending Review Card -->
        <div class="stat-card bg-white rounded-xl p-6 shadow-lg border-l-4 border-amber-500 transition-transform duration-300 hover:-translate-y-1">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-slate-600 text-sm font-semibold uppercase tracking-wide mb-2">Pending Review</div>
                    <div class="text-4xl font-bold text-amber-600 mb-2"><?= $stats['pending_submissions'] ?? 0 ?></div>
                    <div class="text-sm text-slate-500">Require attention</div>
                </div>
                <div>
                    <i class="fas fa-clock text-5xl text-amber-600 opacity-20"></i>
                </div>
            </div>
        </div>

        <!-- Total Submissions Card -->
        <div class="stat-card bg-white rounded-xl p-6 shadow-lg border-l-4 border-red-500 transition-transform duration-300 hover:-translate-y-1">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-slate-600 text-sm font-semibold uppercase tracking-wide mb-2">Total Submissions</div>
                    <div class="text-4xl font-bold text-red-600 mb-2"><?= $stats['total_submissions'] ?? 0 ?></div>
                    <div class="text-sm text-slate-500">All time</div>
                </div>
                <div>
                    <i class="fas fa-file-alt text-5xl text-red-600 opacity-20"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Recent Submissions - Takes 2 columns -->
        <div class="xl:col-span-2 space-y-6">
            <!-- Recent Submissions Table -->
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-file-alt mr-2 text-indigo-600"></i>Recent Submissions
                    </h5>
                    <a href="/admin/submissions" class="px-4 py-2 text-sm font-semibold text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-50 transition">
                        View All
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 text-left">
                                <th class="pb-3 text-sm font-semibold text-gray-600">ID</th>
                                <th class="pb-3 text-sm font-semibold text-gray-600">Title</th>
                                <th class="pb-3 text-sm font-semibold text-gray-600">Author</th>
                                <th class="pb-3 text-sm font-semibold text-gray-600">Status</th>
                                <th class="pb-3 text-sm font-semibold text-gray-600">Date</th>
                                <th class="pb-3 text-sm font-semibold text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($recentSubmissions)): ?>
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-gray-500">No recent submissions</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($recentSubmissions as $submission): ?>
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                        <td class="py-4 text-sm text-gray-600">#<?= $submission['id'] ?></td>
                                        <td class="py-4">
                                            <span class="font-semibold text-gray-800">
                                                <?= htmlspecialchars(substr($submission['title'], 0, 50)) ?><?= strlen($submission['title']) > 50 ? '...' : '' ?>
                                            </span>
                                        </td>
                                        <td class="py-4 text-sm text-gray-600"><?= htmlspecialchars($submission['author_name'] ?? 'Unknown') ?></td>
                                        <td class="py-4">
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full <?= getStatusColor($submission['status']) ?>">
                                                <?= ucfirst(str_replace('_', ' ', $submission['status'])) ?>
                                            </span>
                                        </td>
                                        <td class="py-4 text-sm text-gray-600"><?= date('M d, Y', strtotime($submission['submission_date'])) ?></td>
                                        <td class="py-4">
                                            <a href="/admin/submissions/<?= $submission['id'] ?>" class="inline-flex items-center justify-center w-8 h-8 text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-50 transition">
                                                <i class="fas fa-eye text-sm"></i>
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
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <h5 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-chart-line mr-2 text-indigo-600"></i>Submission Trends
                </h5>
                <canvas id="submissionChart" height="80"></canvas>
            </div>
        </div>

        <!-- Sidebar - Takes 1 column -->
        <div class="xl:col-span-1 space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <h5 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-bolt mr-2 text-indigo-600"></i>Quick Actions
                </h5>
                <div class="grid grid-cols-2 gap-3">
                    <a href="/admin/users" class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-lg hover:border-indigo-600 hover:bg-indigo-50 transition text-center cursor-pointer">
                        <i class="fas fa-users text-3xl text-indigo-600 mb-2"></i>
                        <div class="font-bold text-sm text-gray-700">Manage Users</div>
                    </a>
                    <a href="/admin/submissions" class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-lg hover:border-green-600 hover:bg-green-50 transition text-center cursor-pointer">
                        <i class="fas fa-file-alt text-3xl text-green-600 mb-2"></i>
                        <div class="font-bold text-sm text-gray-700">Submissions</div>
                    </a>
                    <a href="/admin/categories" class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-lg hover:border-amber-600 hover:bg-amber-50 transition text-center cursor-pointer">
                        <i class="fas fa-folder text-3xl text-amber-600 mb-2"></i>
                        <div class="font-bold text-sm text-gray-700">Categories</div>
                    </a>
                    <a href="/admin/settings" class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-lg hover:border-red-600 hover:bg-red-50 transition text-center cursor-pointer">
                        <i class="fas fa-cog text-3xl text-red-600 mb-2"></i>
                        <div class="font-bold text-sm text-gray-700">Settings</div>
                    </a>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-user-plus mr-2 text-indigo-600"></i>New Users
                    </h5>
                    <a href="/admin/users" class="px-3 py-1 text-xs font-semibold text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-50 transition">
                        View All
                    </a>
                </div>
                <?php if (empty($recentUsers)): ?>
                    <p class="text-gray-500 text-center py-4">No recent users</p>
                <?php else: ?>
                    <div class="space-y-3">
                        <?php foreach (array_slice($recentUsers, 0, 5) as $user): ?>
                            <div class="flex items-center py-2 border-b border-gray-100 last:border-0">
                                <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold mr-3">
                                    <?= strtoupper(substr($user['first_name'] ?? 'U', 0, 1)) ?>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-semibold text-gray-800 truncate">
                                        <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>
                                    </div>
                                    <div class="text-xs text-gray-500 truncate"><?= htmlspecialchars($user['email']) ?></div>
                                </div>
                                <div class="text-xs text-gray-400 ml-2"><?= date('M d', strtotime($user['created_at'])) ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- System Status -->
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <h5 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-server mr-2 text-indigo-600"></i>System Status
                </h5>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Storage Used</span>
                            <span class="text-sm font-bold text-gray-800">45%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-indigo-600 h-2 rounded-full" style="width: 45%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Database Size</span>
                            <span class="text-sm font-bold text-gray-800">2.4 GB</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 60%"></div>
                        </div>
                    </div>
                    <button class="w-full mt-4 px-4 py-2 text-sm font-semibold text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition" onclick="alert('System optimization feature coming soon!')">
                        <i class="fas fa-wrench mr-2"></i>Optimize System
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js for the submission trends chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Submission Trends Chart
    const ctx = document.getElementById('submissionChart');
    if (ctx) {
        new Chart(ctx.getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Submissions',
                    data: [12, 19, 15, 25, 22, 30, 28, 35, 32, 38, 42, 45],
                    borderColor: '#4F46E5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
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
    }
</script>
