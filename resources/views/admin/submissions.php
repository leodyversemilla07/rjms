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
        body { background: #f8f9fa; }
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .filter-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-file-alt me-3"></i>Manage Submissions</h1>
            <p class="mb-0">Review and manage all article submissions</p>
        </div>
    </div>

    <div class="container-fluid px-4 mb-5">
        <?php if (isset($_SESSION['flash'])): ?>
            <?php foreach ($_SESSION['flash'] as $type => $message): ?>
                <div class="alert alert-<?= $type ?> alert-dismissible fade show">
                    <?= htmlspecialchars($message) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['flash'][$type]); ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Filters -->
        <div class="filter-card">
            <div class="row align-items-end">
                <div class="col-md-3 mb-2">
                    <label class="form-label">Filter by Status</label>
                    <select id="statusFilter" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="under_review">Under Review</option>
                        <option value="revision_required">Revision Required</option>
                        <option value="accepted">Accepted</option>
                        <option value="published">Published</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label">Filter by Category</label>
                    <select id="categoryFilter" class="form-select">
                        <option value="">All Categories</option>
                        <option value="1">Computer Science</option>
                        <option value="2">Engineering</option>
                        <option value="3">Medicine</option>
                        <option value="4">Education</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label">Date Range</label>
                    <input type="date" id="dateFrom" class="form-control">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-grid">
                        <button onclick="applyFilters()" class="btn btn-primary">
                            <i class="fas fa-filter me-2"></i>Apply Filters
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-card">
            <div class="table-responsive">
                <table id="submissionsTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th>Reviews</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($submissions as $submission): ?>
                            <tr>
                                <td><?= $submission['id'] ?></td>
                                <td>
                                    <strong><?= htmlspecialchars(substr($submission['title'], 0, 60)) ?><?= strlen($submission['title']) > 60 ? '...' : '' ?></strong>
                                    <?php if (!empty($submission['keywords'])): ?>
                                        <br><small class="text-muted">
                                            <i class="fas fa-tags"></i> <?= htmlspecialchars(substr($submission['keywords'], 0, 40)) ?>
                                        </small>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($submission['author_name'] ?? 'Unknown') ?></td>
                                <td>
                                    <span class="badge bg-info">
                                        <?= htmlspecialchars($submission['category_name'] ?? 'N/A') ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge bg-<?= getStatusColor($submission['status']) ?>">
                                        <?= getStatusLabel($submission['status']) ?>
                                    </span>
                                </td>
                                <td><?= date('M d, Y', strtotime($submission['submission_date'])) ?></td>
                                <td>
                                    <?php $reviewCount = $submission['review_count'] ?? 0; ?>
                                    <span class="badge bg-<?= $reviewCount > 0 ? 'success' : 'secondary' ?>">
                                        <?= $reviewCount ?> review<?= $reviewCount != 1 ? 's' : '' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="/admin/submissions/<?= $submission['id'] ?>" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button onclick="changeStatus(<?= $submission['id'] ?>)" 
                                                class="btn btn-sm btn-outline-secondary" 
                                                title="Change Status">
                                            <i class="fas fa-exchange-alt"></i>
                                        </button>
                                        <button onclick="assignReviewer(<?= $submission['id'] ?>)" 
                                                class="btn btn-sm btn-outline-info" 
                                                title="Assign Reviewer">
                                            <i class="fas fa-user-check"></i>
                                        </button>
                                        <button onclick="deleteSubmission(<?= $submission['id'] ?>)" 
                                                class="btn btn-sm btn-outline-danger" 
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Change Status Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Submission Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="statusForm">
                    <div class="modal-body">
                        <input type="hidden" id="submissionId" name="submission_id">
                        <div class="mb-3">
                            <label for="newStatus" class="form-label">New Status</label>
                            <select class="form-control" id="newStatus" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="under_review">Under Review</option>
                                <option value="revision_required">Revision Required</option>
                                <option value="accepted">Accepted</option>
                                <option value="published">Published</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="statusComment" class="form-label">Comment (Optional)</label>
                            <textarea class="form-control" id="statusComment" name="comment" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Assign Reviewer Modal -->
    <div class="modal fade" id="reviewerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Reviewer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="reviewerForm">
                    <div class="modal-body">
                        <input type="hidden" id="submissionIdReviewer" name="submission_id">
                        <div class="mb-3">
                            <label for="reviewerId" class="form-label">Select Reviewer</label>
                            <select class="form-control" id="reviewerId" name="reviewer_id" required>
                                <option value="">Choose a reviewer...</option>
                                <!-- Populated via AJAX -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dueDate" class="form-label">Due Date</label>
                            <input type="date" class="form-control" id="dueDate" name="due_date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Assign Reviewer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#submissionsTable').DataTable({
                order: [[0, 'desc']],
                pageLength: 25,
                language: {
                    search: "Search submissions:",
                    lengthMenu: "Show _MENU_ submissions per page"
                }
            });
        });

        function applyFilters() {
            // Filter logic would go here
            alert('Filters applied! (Feature to be fully implemented)');
        }

        function changeStatus(id) {
            $('#submissionId').val(id);
            new bootstrap.Modal($('#statusModal')).show();
        }

        function assignReviewer(id) {
            $('#submissionIdReviewer').val(id);
            // Load reviewers via AJAX
            $.get('/api/reviewers', function(reviewers) {
                const select = $('#reviewerId');
                select.html('<option value="">Choose a reviewer...</option>');
                reviewers.forEach(r => {
                    select.append(`<option value="${r.id}">${r.name}</option>`);
                });
            });
            new bootstrap.Modal($('#reviewerModal')).show();
        }

        function deleteSubmission(id) {
            if (confirm('Are you sure you want to delete this submission? This action cannot be undone.')) {
                $.ajax({
                    url: '/admin/submissions/' + id + '/delete',
                    method: 'POST',
                    data: { _method: 'DELETE' },
                    success: function(response) {
                        if (response.success) {
                            alert('Submission deleted');
                            location.reload();
                        } else {
                            alert(response.message || 'Failed to delete');
                        }
                    }
                });
            }
        }

        $('#statusForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/admin/submissions/update-status',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        alert('Status updated successfully!');
                        location.reload();
                    } else {
                        alert(response.message || 'Failed to update status');
                    }
                }
            });
        });

        $('#reviewerForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/admin/submissions/assign-reviewer',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        alert('Reviewer assigned successfully!');
                        location.reload();
                    } else {
                        alert(response.message || 'Failed to assign reviewer');
                    }
                }
            });
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

function getStatusLabel($status) {
    $labels = [
        'draft' => 'Draft',
        'pending' => 'Pending',
        'under_review' => 'Under Review',
        'revision_required' => 'Revision Required',
        'accepted' => 'Accepted',
        'published' => 'Published',
        'rejected' => 'Rejected'
    ];
    return $labels[$status] ?? ucfirst($status);
}
?>
