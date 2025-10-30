<?php
$submissions = $submissions ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Assignments - Reviewer Dashboard - RJMS</title>
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
        .deadline-soon { background-color: #fff3cd !important; }
        .deadline-overdue { background-color: #f8d7da !important; }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-list-check me-3"></i>My Review Assignments</h1>
                    <p class="mb-0">All submissions assigned to you for review</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="/reviewer/dashboard" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="content-card">
            <div class="table-responsive">
                <table id="submissionsTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Assigned</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($submissions)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                    <p class="text-muted">No submissions assigned to you yet</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($submissions as $submission): ?>
                                <?php
                                $deadline = strtotime($submission['deadline'] ?? '+14 days');
                                $daysLeft = ceil(($deadline - time()) / 86400);
                                $rowClass = '';
                                if ($daysLeft < 0) {
                                    $rowClass = 'deadline-overdue';
                                } elseif ($daysLeft <= 3) {
                                    $rowClass = 'deadline-soon';
                                }
                                ?>
                                <tr class="<?= $rowClass ?>">
                                    <td>#<?= $submission['id'] ?></td>
                                    <td>
                                        <strong><?= htmlspecialchars($submission['title']) ?></strong>
                                        <?php if (isset($submission['abstract'])): ?>
                                            <br><small class="text-muted"><?= htmlspecialchars(substr($submission['abstract'], 0, 80)) ?>...</small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            <?= htmlspecialchars($submission['category_name'] ?? 'Uncategorized') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <small><?= date('M d, Y', strtotime($submission['assigned_at'])) ?></small>
                                    </td>
                                    <td>
                                        <small class="<?= $daysLeft < 0 ? 'text-danger' : ($daysLeft <= 3 ? 'text-warning' : '') ?>">
                                            <?= date('M d, Y', $deadline) ?>
                                            <?php if ($daysLeft < 0): ?>
                                                <br><span class="badge bg-danger">Overdue</span>
                                            <?php elseif ($daysLeft <= 3): ?>
                                                <br><span class="badge bg-warning"><?= $daysLeft ?> day<?= $daysLeft != 1 ? 's' : '' ?> left</span>
                                            <?php endif; ?>
                                        </small>
                                    </td>
                                    <td>
                                        <?php
                                        $statusColors = [
                                            'pending' => 'warning',
                                            'in_progress' => 'info',
                                            'completed' => 'success'
                                        ];
                                        $status = $submission['review_status'] ?? 'pending';
                                        $color = $statusColors[$status] ?? 'secondary';
                                        ?>
                                        <span class="badge bg-<?= $color ?>">
                                            <?= ucfirst(str_replace('_', ' ', $status)) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/reviewer/view-submission/<?= $submission['id'] ?>" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye me-1"></i>
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

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
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
</body>
</html>
