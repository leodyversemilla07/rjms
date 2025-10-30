<?php
$submissions = $submissions ?? [];
$filters = $filters ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submissions - Editor Dashboard - RJMS</title>
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
        .filter-card {
            background: #F3F4F6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .table-actions {
            display: flex;
            gap: 5px;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-list me-3"></i>Assigned Submissions</h1>
                    <p class="mb-0">Manage all submissions assigned to you as editor</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="/editor/dashboard" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <!-- Filters -->
        <div class="filter-card">
            <form id="filterForm" method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label small">Status</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="">All Statuses</option>
                            <option value="pending" <?= ($filters['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="under_review" <?= ($filters['status'] ?? '') === 'under_review' ? 'selected' : '' ?>>Under Review</option>
                            <option value="reviewed" <?= ($filters['status'] ?? '') === 'reviewed' ? 'selected' : '' ?>>Reviewed</option>
                            <option value="revision_required" <?= ($filters['status'] ?? '') === 'revision_required' ? 'selected' : '' ?>>Revision Required</option>
                            <option value="accepted" <?= ($filters['status'] ?? '') === 'accepted' ? 'selected' : '' ?>>Accepted</option>
                            <option value="rejected" <?= ($filters['status'] ?? '') === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">Category</label>
                        <select name="category" class="form-select form-select-sm">
                            <option value="">All Categories</option>
                            <?php if (isset($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>" <?= ($filters['category'] ?? '') == $category['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">Date Range</label>
                        <select name="date_range" class="form-select form-select-sm">
                            <option value="">All Time</option>
                            <option value="today" <?= ($filters['date_range'] ?? '') === 'today' ? 'selected' : '' ?>>Today</option>
                            <option value="week" <?= ($filters['date_range'] ?? '') === 'week' ? 'selected' : '' ?>>This Week</option>
                            <option value="month" <?= ($filters['date_range'] ?? '') === 'month' ? 'selected' : '' ?>>This Month</option>
                            <option value="year" <?= ($filters['date_range'] ?? '') === 'year' ? 'selected' : '' ?>>This Year</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-sm btn-primary flex-grow-1">
                                <i class="fas fa-filter me-1"></i>Filter
                            </button>
                            <a href="/editor/submissions" class="btn btn-sm btn-secondary">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Submissions Table -->
        <div class="content-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5><i class="fas fa-table me-2"></i>All Submissions</h5>
                <div>
                    <button class="btn btn-sm btn-outline-secondary" onclick="$('#submissionsTable').DataTable().ajax.reload();">
                        <i class="fas fa-sync-alt me-1"></i>Refresh
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table id="submissionsTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Reviewers</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($submissions)): ?>
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                    <p class="text-muted">No submissions found</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($submissions as $submission): ?>
                                <tr>
                                    <td>#<?= $submission['id'] ?></td>
                                    <td>
                                        <strong><?= htmlspecialchars($submission['title']) ?></strong>
                                        <?php if (isset($submission['abstract'])): ?>
                                            <br><small class="text-muted"><?= htmlspecialchars(substr($submission['abstract'], 0, 80)) ?>...</small>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($submission['author_name'] ?? 'Unknown') ?></td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            <?= htmlspecialchars($submission['category_name'] ?? 'Uncategorized') ?>
                                        </span>
                                    </td>
                                    <td>
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
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">
                                            <?= $submission['reviewer_count'] ?? 0 ?>
                                        </span>
                                    </td>
                                    <td>
                                        <small><?= date('M d, Y', strtotime($submission['created_at'])) ?></small>
                                    </td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="/editor/view-submission/<?= $submission['id'] ?>" 
                                               class="btn btn-sm btn-primary" 
                                               title="View & Manage">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button onclick="assignReviewers(<?= $submission['id'] ?>)" 
                                                    class="btn btn-sm btn-info" 
                                                    title="Assign Reviewers">
                                                <i class="fas fa-user-plus"></i>
                                            </button>
                                            <button onclick="updateStatus(<?= $submission['id'] ?>)" 
                                                    class="btn btn-sm btn-warning" 
                                                    title="Update Status">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Assign Reviewers Modal -->
    <div class="modal fade" id="assignReviewersModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Assign Reviewers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="assignReviewersForm">
                    <div class="modal-body">
                        <input type="hidden" id="submission_id" name="submission_id">
                        <div class="mb-3">
                            <label class="form-label">Select Reviewers *</label>
                            <select class="form-select" name="reviewers[]" multiple size="5" required>
                                <!-- Will be populated dynamically -->
                            </select>
                            <small class="text-muted">Hold Ctrl/Cmd to select multiple reviewers</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Review Deadline</label>
                            <input type="date" class="form-control" name="deadline" 
                                   min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d', strtotime('+14 days')) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Instructions for Reviewers</label>
                            <textarea class="form-control" name="instructions" rows="3" 
                                      placeholder="Special instructions or focus areas..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Assign Reviewers
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Status Modal -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Update Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="updateStatusForm">
                    <div class="modal-body">
                        <input type="hidden" id="status_submission_id" name="submission_id">
                        <div class="mb-3">
                            <label class="form-label">New Status *</label>
                            <select class="form-select" name="status" required>
                                <option value="under_review">Under Review</option>
                                <option value="reviewed">Reviewed</option>
                                <option value="revision_required">Revision Required</option>
                                <option value="accepted">Accepted</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Comments</label>
                            <textarea class="form-control" name="comments" rows="4" 
                                      placeholder="Reason for status change..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Status
                        </button>
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
                    search: "_INPUT_",
                    searchPlaceholder: "Search submissions..."
                }
            });
        });

        function assignReviewers(submissionId) {
            $('#submission_id').val(submissionId);
            // Load available reviewers via AJAX
            $.get('/api/reviewers/available', function(reviewers) {
                const select = $('select[name="reviewers[]"]');
                select.empty();
                reviewers.forEach(function(reviewer) {
                    select.append(`<option value="${reviewer.id}">${reviewer.name} (${reviewer.expertise || 'General'})</option>`);
                });
            });
            new bootstrap.Modal($('#assignReviewersModal')).show();
        }

        function updateStatus(submissionId) {
            $('#status_submission_id').val(submissionId);
            new bootstrap.Modal($('#updateStatusModal')).show();
        }

        $('#assignReviewersForm').on('submit', function(e) {
            e.preventDefault();
            const submissionId = $('#submission_id').val();
            $.ajax({
                url: '/editor/submissions/' + submissionId + '/assign-reviewers',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        alert('Reviewers assigned successfully!');
                        location.reload();
                    } else {
                        alert(response.message || 'Failed to assign reviewers');
                    }
                }
            });
        });

        $('#updateStatusForm').on('submit', function(e) {
            e.preventDefault();
            const submissionId = $('#status_submission_id').val();
            $.ajax({
                url: '/editor/submissions/' + submissionId + '/update-status',
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
    </script>
</body>
</html>
