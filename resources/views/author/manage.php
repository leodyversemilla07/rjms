<?php
$submissions = $submissions ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Submissions - RJMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        body { background: #F3F4F6; }
        .page-header {
            background: linear-gradient(135deg, #4F46E5 0%, #4F46E5 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 30px;
        }
        .content-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .action-btn {
            padding: 4px 8px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-folder-open me-3"></i>Manage Submissions</h1>
                    <p class="mb-0">View and manage all your submitted articles</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="/author/submit" class="btn btn-light btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>New Submission
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <?php if (isset($_SESSION['flash'])): ?>
            <?php foreach ($_SESSION['flash'] as $type => $message): ?>
                <div class="alert alert-<?= $type ?> alert-dismissible fade show">
                    <?= htmlspecialchars($message) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['flash'][$type]); ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="content-card">
            <?php if (empty($submissions)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-4x text-muted mb-4"></i>
                    <h4>No Submissions Yet</h4>
                    <p class="text-muted mb-4">You haven't submitted any articles yet. Start by submitting your research!</p>
                    <a href="/author/submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Submit Your First Article
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table id="submissionsTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Submission Date</th>
                                <th>Last Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($submissions as $submission): ?>
                                <tr>
                                    <td><?= $submission['id'] ?></td>
                                    <td>
                                        <strong><?= htmlspecialchars($submission['title']) ?></strong>
                                        <?php if (!empty($submission['keywords'])): ?>
                                            <br><small class="text-muted">
                                                <i class="fas fa-tags"></i> <?= htmlspecialchars($submission['keywords']) ?>
                                            </small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            <?= htmlspecialchars($submission['category_name'] ?? 'Uncategorized') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-badge bg-<?= getStatusColor($submission['status']) ?>">
                                            <?= getStatusLabel($submission['status']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('M d, Y', strtotime($submission['submission_date'])) ?></td>
                                    <td><?= date('M d, Y', strtotime($submission['updated_at'] ?? $submission['submission_date'])) ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="/author/article/<?= $submission['id'] ?>" 
                                               class="btn btn-sm btn-outline-primary action-btn"
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <?php if (in_array($submission['status'], ['draft', 'revision_required'])): ?>
                                                <a href="/author/article/<?= $submission['id'] ?>/edit" 
                                                   class="btn btn-sm btn-outline-secondary action-btn"
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($submission['status'] == 'draft'): ?>
                                                <button onclick="deleteSubmission(<?= $submission['id'] ?>)" 
                                                        class="btn btn-sm btn-outline-danger action-btn"
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
            <div class="content-card mt-4">
                <h6><i class="fas fa-info-circle me-2"></i>Status Legend</h6>
                <div class="row">
                    <div class="col-md-3">
                        <span class="status-badge bg-secondary">Draft</span> - Not yet submitted
                    </div>
                    <div class="col-md-3">
                        <span class="status-badge bg-warning">Pending</span> - Awaiting review
                    </div>
                    <div class="col-md-3">
                        <span class="status-badge bg-info">Under Review</span> - Being reviewed
                    </div>
                    <div class="col-md-3">
                        <span class="status-badge bg-success">Published</span> - Published
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
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
?>
