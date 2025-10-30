<?php
$submission = $submission ?? [];
$reviews = $reviews ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($submission['title'] ?? 'View Article') ?> - RJMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            margin-bottom: 20px;
        }
        .status-badge {
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        .review-card {
            border-left: 4px solid #4F46E5;
            margin-bottom: 15px;
        }
        .rating-stars {
            color: #ffc107;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container">
            <a href="/author/manage" class="btn btn-light mb-3">
                <i class="fas fa-arrow-left me-2"></i>Back to Submissions
            </a>
            <h1><?= htmlspecialchars($submission['title'] ?? 'Article Details') ?></h1>
            <p class="mb-0">Submission ID: #<?= $submission['id'] ?? 'N/A' ?></p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-8">
                <!-- Article Details -->
                <div class="content-card">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <h3><?= htmlspecialchars($submission['title'] ?? '') ?></h3>
                        <span class="status-badge bg-<?= getStatusColor($submission['status'] ?? 'draft') ?>">
                            <?= getStatusLabel($submission['status'] ?? 'draft') ?>
                        </span>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong><i class="fas fa-user me-2"></i>Authors:</strong><br>
                                <?= htmlspecialchars($submission['authors'] ?? 'N/A') ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong><i class="fas fa-calendar me-2"></i>Submitted:</strong><br>
                                <?= isset($submission['submission_date']) ? date('F d, Y', strtotime($submission['submission_date'])) : 'N/A' ?>
                            </p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <strong><i class="fas fa-tags me-2"></i>Keywords:</strong><br>
                        <?php if (!empty($submission['keywords'])): ?>
                            <?php foreach (explode(',', $submission['keywords']) as $keyword): ?>
                                <span class="badge bg-secondary me-1"><?= htmlspecialchars(trim($keyword)) ?></span>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="text-muted">No keywords</span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <h5><i class="fas fa-file-alt me-2"></i>Abstract</h5>
                        <p class="text-justify"><?= nl2br(htmlspecialchars($submission['abstract'] ?? '')) ?></p>
                    </div>

                    <?php if (!empty($submission['file_path'])): ?>
                        <div class="mb-4">
                            <h5><i class="fas fa-file-download me-2"></i>Manuscript</h5>
                            <a href="/uploads/<?= htmlspecialchars($submission['file_path']) ?>" 
                               class="btn btn-primary" target="_blank">
                                <i class="fas fa-download me-2"></i>Download Manuscript
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Reviews (if any) -->
                <?php if (!empty($reviews)): ?>
                    <div class="content-card">
                        <h5><i class="fas fa-comments me-2"></i>Reviews (<?= count($reviews) ?>)</h5>
                        <?php foreach ($reviews as $review): ?>
                            <div class="card review-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>Reviewer #<?= $review['id'] ?></strong>
                                        <div class="rating-stars">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star<?= $i <= ($review['rating'] ?? 0) ? '' : '-o' ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <p class="mb-2">
                                        <strong>Recommendation:</strong> 
                                        <span class="badge bg-<?= $review['recommendation'] == 'accept' ? 'success' : ($review['recommendation'] == 'reject' ? 'danger' : 'warning') ?>">
                                            <?= ucfirst($review['recommendation'] ?? 'pending') ?>
                                        </span>
                                    </p>
                                    <p class="mb-0"><?= nl2br(htmlspecialchars($review['comments'] ?? '')) ?></p>
                                    <small class="text-muted">
                                        Reviewed on <?= isset($review['review_date']) ? date('M d, Y', strtotime($review['review_date'])) : 'Pending' ?>
                                    </small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Actions -->
                <div class="content-card">
                    <h6><i class="fas fa-bolt me-2"></i>Actions</h6>
                    <div class="d-grid gap-2">
                        <?php if (in_array($submission['status'] ?? '', ['draft', 'revision_required'])): ?>
                            <a href="/author/article/<?= $submission['id'] ?>/edit" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i>Edit Submission
                            </a>
                        <?php endif; ?>
                        <?php if (($submission['status'] ?? '') == 'draft'): ?>
                            <button onclick="submitForReview(<?= $submission['id'] ?>)" class="btn btn-success">
                                <i class="fas fa-paper-plane me-2"></i>Submit for Review
                            </button>
                        <?php endif; ?>
                        <a href="/uploads/<?= htmlspecialchars($submission['file_path'] ?? '') ?>" 
                           class="btn btn-outline-primary" target="_blank">
                            <i class="fas fa-download me-2"></i>Download Manuscript
                        </a>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="content-card">
                    <h6><i class="fas fa-history me-2"></i>Timeline</h6>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-circle text-primary me-2"></i>
                            <strong>Submitted</strong><br>
                            <small class="text-muted">
                                <?= isset($submission['submission_date']) ? date('M d, Y', strtotime($submission['submission_date'])) : 'N/A' ?>
                            </small>
                        </li>
                        <?php if (isset($submission['updated_at'])): ?>
                            <li class="mb-3">
                                <i class="fas fa-circle text-info me-2"></i>
                                <strong>Last Updated</strong><br>
                                <small class="text-muted">
                                    <?= date('M d, Y', strtotime($submission['updated_at'])) ?>
                                </small>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Help -->
                <div class="content-card">
                    <h6><i class="fas fa-question-circle me-2"></i>Need Help?</h6>
                    <p class="small mb-2">Have questions about your submission?</p>
                    <a href="/contact" class="btn btn-sm btn-outline-secondary w-100">
                        <i class="fas fa-envelope me-2"></i>Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function submitForReview(id) {
            if (confirm('Submit this article for peer review? You will not be able to edit it after submission.')) {
                $.ajax({
                    url: '/author/article/' + id + '/submit',
                    method: 'POST',
                    success: function(response) {
                        if (response.success) {
                            alert('Article submitted successfully!');
                            location.reload();
                        } else {
                            alert(response.message || 'Failed to submit article');
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
