<?php
// Set page metadata
$title = 'My Review Assignments - Reviewer Dashboard - Research Journal Management System';
$description = 'All submissions assigned to you for review';
$keywords = 'reviewer, assignments, submissions, reviews';

$submissions = $submissions ?? [];

// Start output buffering
ob_start();
?>

    <!-- Page Header -->
    <div class="bg-primary-700 text-white border-b-4 border-primary-800">
        <div class="container mx-auto px-4 py-12">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        <i class="fas fa-list-check mr-3"></i>My Review Assignments
                    </h1>
                    <p class="text-primary-100">All submissions assigned to you for review</p>
                </div>
                <div>
                    <a href="/reviewer/dashboard" class="inline-flex items-center justify-center bg-white text-primary-700 hover:bg-primary-50 font-semibold py-3 px-6 rounded-lg transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-card overflow-hidden">
            <div class="overflow-x-auto">
                <table id="submissionsTable" class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Assigned</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Deadline</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                    <tbody class="bg-white divide-y divide-slate-200">
                        <?php if (empty($submissions)): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <i class="fas fa-inbox text-6xl text-slate-300 mb-4 block"></i>
                                    <p class="text-slate-600">No submissions assigned to you yet</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($submissions as $submission): ?>
                                <?php
                                $deadline = strtotime($submission['deadline'] ?? '+14 days');
                                $daysLeft = ceil(($deadline - time()) / 86400);
                                $rowClass = '';
                                if ($daysLeft < 0) {
                                    $rowClass = 'bg-red-50';
                                } elseif ($daysLeft <= 3) {
                                    $rowClass = 'bg-amber-50';
                                }
                                ?>
                                <tr class="<?= $rowClass ?> hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">#<?= $submission['id'] ?></td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-slate-800"><?= htmlspecialchars($submission['title']) ?></div>
                                        <?php if (isset($submission['abstract'])): ?>
                                            <div class="text-xs text-slate-600 mt-1"><?= htmlspecialchars(substr($submission['abstract'], 0, 80)) ?>...</div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-block px-2 py-1 bg-slate-100 text-slate-700 text-xs font-semibold rounded">
                                            <?= htmlspecialchars($submission['category_name'] ?? 'Uncategorized') ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                        <?= date('M d, Y', strtotime($submission['assigned_at'])) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm <?= $daysLeft < 0 ? 'text-red-600' : ($daysLeft <= 3 ? 'text-amber-600' : 'text-slate-600') ?>">
                                            <?= date('M d, Y', $deadline) ?>
                                        </div>
                                        <?php if ($daysLeft < 0): ?>
                                            <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded mt-1">Overdue</span>
                                        <?php elseif ($daysLeft <= 3): ?>
                                            <span class="inline-block px-2 py-1 bg-amber-100 text-amber-700 text-xs font-semibold rounded mt-1"><?= $daysLeft ?> day<?= $daysLeft != 1 ? 's' : '' ?> left</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php
                                        $statusColors = [
                                            'pending' => 'bg-amber-100 text-amber-700',
                                            'in_progress' => 'bg-blue-100 text-blue-700',
                                            'completed' => 'bg-green-100 text-green-700'
                                        ];
                                        $status = $submission['review_status'] ?? 'pending';
                                        $colorClass = $statusColors[$status] ?? 'bg-slate-100 text-slate-700';
                                        ?>
                                        <span class="inline-block px-2 py-1 <?= $colorClass ?> text-xs font-semibold rounded">
                                            <?= ucfirst(str_replace('_', ' ', $status)) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="/reviewer/view-submission/<?= $submission['id'] ?>" 
                                           class="inline-flex items-center justify-center bg-primary-700 hover:bg-primary-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                                            <i class="fas fa-eye mr-1"></i>
                                            <?= ($submission['review_status'] ?? 'pending') == 'completed' ? 'View' : 'Review' ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTables Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    
    <script>
        $(document).ready(function() {
            $('#submissionsTable').DataTable({
                order: [[4, 'asc']], // Sort by deadline
                pageLength: 25,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search submissions..."
                }
            });
        });
    </script>

<?php
// Get the buffered content
$content = ob_get_clean();

// Include the main layout
include __DIR__ . '/../layouts/main.php';
?>
