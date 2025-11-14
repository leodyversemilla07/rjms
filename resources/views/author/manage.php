<?php
// Set page metadata
$title = 'Manage Submissions - Research Journal Management System';
$description = 'View and manage all your submitted articles';
$keywords = 'author, submissions, manage articles';

$submissions = $submissions ?? [];

// Helper functions
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

function getStatusLabel($status) {
    $labels = [
        'draft' => 'Draft',
        'pending' => 'Pending Review',
        'under_review' => 'Under Review',
        'revision_required' => 'Revision Required',
        'accepted' => 'Accepted',
        'published' => 'Published',
        'rejected' => 'Rejected'
    ];
    return $labels[$status] ?? ucfirst($status);
}

// Start output buffering
ob_start();
?>

    <!-- Page Header -->
    <div class="bg-primary-700 text-white border-b-4 border-primary-800">
        <div class="container mx-auto px-4 py-12">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        <i class="fas fa-folder-open mr-3"></i>Manage Submissions
                    </h1>
                    <p class="text-primary-100">View and manage all your submitted articles</p>
                </div>
                <div>
                    <a href="/author/submit" class="inline-flex items-center justify-center bg-white text-primary-700 hover:bg-primary-50 font-semibold py-3 px-6 rounded-lg transition-colors">
                        <i class="fas fa-plus-circle mr-2"></i>New Submission
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-card p-6">
            <?php if (empty($submissions)): ?>
                <div class="text-center py-12">
                    <i class="fas fa-inbox text-8xl text-slate-300 mb-6"></i>
                    <h4 class="text-2xl font-bold text-slate-800 mb-3">No Submissions Yet</h4>
                    <p class="text-slate-600 mb-6">You haven't submitted any articles yet. Start by submitting your research!</p>
                    <a href="/author/submit" class="inline-flex items-center justify-center bg-primary-700 hover:bg-primary-800 text-white font-semibold py-3 px-8 rounded-lg transition-colors">
                        <i class="fas fa-plus-circle mr-2"></i>Submit Your First Article
                    </a>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table id="submissionsTable" class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Submission Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Last Updated</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php foreach ($submissions as $submission): ?>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><?= $submission['id'] ?></td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-slate-800"><?= htmlspecialchars($submission['title']) ?></div>
                                        <?php if (!empty($submission['keywords'])): ?>
                                            <div class="text-xs text-slate-600 mt-1">
                                                <i class="fas fa-tags"></i> <?= htmlspecialchars($submission['keywords']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded">
                                            <?= htmlspecialchars($submission['category_name'] ?? 'Uncategorized') ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-block px-3 py-1 <?= getStatusColor($submission['status']) ?> text-xs font-bold rounded-full uppercase">
                                            <?= getStatusLabel($submission['status']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600"><?= date('M d, Y', strtotime($submission['submission_date'])) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600"><?= date('M d, Y', strtotime($submission['updated_at'] ?? $submission['submission_date'])) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex gap-2">
                                            <a href="/author/article/<?= $submission['id'] ?>" 
                                               class="inline-flex items-center justify-center border-2 border-primary-700 text-primary-700 hover:bg-primary-50 font-semibold py-1 px-3 rounded transition-colors text-xs"
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <?php if (in_array($submission['status'], ['draft', 'revision_required'])): ?>
                                                <a href="/author/article/<?= $submission['id'] ?>/edit" 
                                                   class="inline-flex items-center justify-center border-2 border-slate-700 text-slate-700 hover:bg-slate-50 font-semibold py-1 px-3 rounded transition-colors text-xs"
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($submission['status'] == 'draft'): ?>
                                                <button onclick="deleteSubmission(<?= $submission['id'] ?>)" 
                                                        class="inline-flex items-center justify-center border-2 border-red-700 text-red-700 hover:bg-red-50 font-semibold py-1 px-3 rounded transition-colors text-xs"
                                                        title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!-- Legend -->
        <?php if (!empty($submissions)): ?>
            <div class="bg-white rounded-xl shadow-card p-6 mt-6">
                <h6 class="text-lg font-bold text-slate-800 mb-4">
                    <i class="fas fa-info-circle mr-2"></i>Status Legend
                </h6>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                    <div>
                        <span class="inline-block px-3 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded-full uppercase">Draft</span>
                        <span class="ml-2 text-slate-600">- Not yet submitted</span>
                    </div>
                    <div>
                        <span class="inline-block px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full uppercase">Pending</span>
                        <span class="ml-2 text-slate-600">- Awaiting review</span>
                    </div>
                    <div>
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full uppercase">Under Review</span>
                        <span class="ml-2 text-slate-600">- Being reviewed</span>
                    </div>
                    <div>
                        <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full uppercase">Published</span>
                        <span class="ml-2 text-slate-600">- Published</span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- DataTables Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    
    <script>
        $(document).ready(function() {
            $('#submissionsTable').DataTable({
                order: [[4, 'desc']],
                pageLength: 25,
                language: {
                    search: "Search submissions:",
                    lengthMenu: "Show _MENU_ submissions per page"
                }
            });
        });

        function deleteSubmission(id) {
            if (confirm('Are you sure you want to delete this submission? This action cannot be undone.')) {
                $.ajax({
                    url: '/author/article/' + id + '/delete',
                    method: 'POST',
                    data: { _method: 'DELETE' },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message || 'Failed to delete submission');
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            }
        }
    </script>

<?php
// Get the buffered content
$content = ob_get_clean();

// Include the main layout
include __DIR__ . '/../layouts/main.php';
?>
