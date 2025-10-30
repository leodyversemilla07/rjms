<?php
$submission = $submission ?? null;
$reviews = $reviews ?? [];
$timeline = $timeline ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($submission['title'] ?? 'View Submission') ?> - RJMS</title>
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
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .review-card {
            background: #F3F4F6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid #4F46E5;
        }
        .timeline-item {
            position: relative;
            padding-left: 40px;
            padding-bottom: 20px;
            border-left: 2px solid #e9ecef;
        }
        .timeline-item:last-child {
            border-left: none;
        }
        .timeline-icon {
            position: absolute;
            left: -12px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #4F46E5;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }
        .rating-stars {
            color: #ffc107;
        }
        .meta-item {
            padding: 15px;
            background: #F3F4F6;
            border-radius: 8px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <?php if ($submission): ?>
        <div class="page-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1><?= htmlspecialchars($submission['title']) ?></h1>
                        <p class="mb-0">Submission ID: #<?= $submission['id'] ?></p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="/editor/submissions" class="btn btn-light">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mb-5">
            <div class="row">
                <!-- Main Content -->
                <div class="col-md-8">
                    <!-- Submission Details -->
                    <div class="content-card">
                        <h5 class="mb-4"><i class="fas fa-file-alt me-2"></i>Submission Details</h5>
                        
                        <div class="mb-4">
                            <h6 class="text-muted">Title</h6>
                            <h4><?= htmlspecialchars($submission['title']) ?></h4>
                        </div>

                        <?php if (isset($submission['abstract'])): ?>
                            <div class="mb-4">
                                <h6 class="text-muted">Abstract</h6>
                                <p class="text-justify"><?= nl2br(htmlspecialchars($submission['abstract'])) ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($submission['keywords'])): ?>
                            <div class="mb-4">
                                <h6 class="text-muted">Keywords</h6>
                                <div>
                                    <?php foreach (explode(',', $submission['keywords']) as $keyword): ?>
                                        <span class="badge bg-secondary me-2 mb-2"><?= htmlspecialchars(trim($keyword)) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($submission['file_path'])): ?>
                            <div class="mb-4">
                                <h6 class="text-muted">Manuscript File</h6>
                                <div class="d-flex gap-2">
                                    <a href="/uploads/<?= htmlspecialchars($submission['file_path']) ?>" 
                                       class="btn btn-primary" target="_blank">
                                        <i class="fas fa-download me-2"></i>Download Manuscript
                                    </a>
                                    <button onclick="viewInBrowser()" class="btn btn-outline-primary">
                                        <i class="fas fa-eye me-2"></i>View in Browser
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Reviews -->
                    <div class="content-card">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5><i class="fas fa-comments me-2"></i>Reviewer Feedback</h5>
                            <button class="btn btn-sm btn-primary" onclick="assignReviewers()">
                                <i class="fas fa-user-plus me-1"></i>Assign Reviewers
                            </button>
                        </div>

                        <?php if (empty($reviews)): ?>
                            <div class="text-center py-4">
                                <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No reviews yet. Assign reviewers to get feedback.</p>
                                <button class="btn btn-primary" onclick="assignReviewers()">
                                    <i class="fas fa-user-plus me-2"></i>Assign Reviewers
                                </button>
                            </div>
                        <?php else: ?>
                            <?php foreach ($reviews as $review): ?>
                                <div class="review-card">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h6 class="mb-1"><?= htmlspecialchars($review['reviewer_name'] ?? 'Anonymous Reviewer') ?></h6>
                                            <small class="text-muted">
                                                Reviewed on <?= date('M d, Y', strtotime($review['reviewed_at'])) ?>
                                            </small>
                                        </div>
                                        <div class="text-end">
                                            <?php if (isset($review['recommendation'])): ?>
                                                <?php
                                                $recColors = [
                                                    'accept' => 'success',
                                                    'minor_revision' => 'info',
                                                    'major_revision' => 'warning',
                                                    'reject' => 'danger'
                                                ];
                                                $color = $recColors[$review['recommendation']] ?? 'secondary';
                                                ?>
                                                <span class="badge bg-<?= $color ?>">
                                                    <?= ucfirst(str_replace('_', ' ', $review['recommendation'])) ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php if (isset($review['rating'])): ?>
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-1">Overall Rating</small>
                                            <div class="rating-stars">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fas fa-star<?= $i <= $review['rating'] ? '' : '-o' ?>"></i>
                                                <?php endfor; ?>
                                                <span class="ms-2"><?= $review['rating'] ?>/5</span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (isset($review['comments'])): ?>
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-1">Comments</small>
                                            <p class="mb-0"><?= nl2br(htmlspecialchars($review['comments'])) ?></p>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (isset($review['strengths'])): ?>
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-1">Strengths</small>
                                            <p class="mb-0"><?= nl2br(htmlspecialchars($review['strengths'])) ?></p>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (isset($review['weaknesses'])): ?>
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-1">Weaknesses</small>
                                            <p class="mb-0"><?= nl2br(htmlspecialchars($review['weaknesses'])) ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Timeline -->
                    <div class="content-card">
                        <h5 class="mb-4"><i class="fas fa-history me-2"></i>Submission Timeline</h5>
                        <?php if (empty($timeline)): ?>
                            <p class="text-muted">No activity recorded yet.</p>
                        <?php else: ?>
                            <?php foreach ($timeline as $event): ?>
                                <div class="timeline-item">
                                    <div class="timeline-icon">
                                        <i class="fas fa-<?= $event['icon'] ?? 'circle' ?>"></i>
                                    </div>
                                    <div>
                                        <strong><?= htmlspecialchars($event['title']) ?></strong>
                                        <p class="mb-1 small"><?= htmlspecialchars($event['description'] ?? '') ?></p>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            <?= date('M d, Y H:i', strtotime($event['created_at'])) ?>
                                        </small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <!-- Actions -->
                    <div class="content-card">
                        <h6 class="mb-3"><i class="fas fa-tasks me-2"></i>Editor Actions</h6>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" onclick="makeDecision()">
                                <i class="fas fa-gavel me-2"></i>Make Decision
                            </button>
                            <button class="btn btn-info" onclick="assignReviewers()">
                                <i class="fas fa-user-plus me-2"></i>Assign Reviewers
                            </button>
                            <button class="btn btn-warning" onclick="requestRevision()">
                                <i class="fas fa-edit me-2"></i>Request Revision
                            </button>
                            <button class="btn btn-secondary" onclick="sendMessage()">
                                <i class="fas fa-envelope me-2"></i>Message Author
                            </button>
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="content-card">
                        <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i>Metadata</h6>
                        
                        <div class="meta-item">
                            <small class="text-muted d-block">Status</small>
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
                        </div>

                        <div class="meta-item">
                            <small class="text-muted d-block">Author</small>
                            <strong><?= htmlspecialchars($submission['author_name'] ?? 'Unknown') ?></strong>
                        </div>

                        <div class="meta-item">
                            <small class="text-muted d-block">Category</small>
                            <span class="badge bg-secondary">
                                <?= htmlspecialchars($submission['category_name'] ?? 'Uncategorized') ?>
                            </span>
                        </div>

                        <div class="meta-item">
                            <small class="text-muted d-block">Submitted</small>
                            <strong><?= date('M d, Y', strtotime($submission['created_at'])) ?></strong>
                        </div>

                        <div class="meta-item">
                            <small class="text-muted d-block">Reviewers Assigned</small>
                            <strong><?= count($reviews) ?></strong>
                        </div>

                        <div class="meta-item">
                            <small class="text-muted d-block">Reviews Completed</small>
                            <strong><?= count(array_filter($reviews, fn($r) => isset($r['reviewed_at']))) ?></strong>
                        </div>
                    </div>

                    <!-- Review Summary -->
                    <?php if (!empty($reviews)): ?>
                        <div class="content-card">
                            <h6 class="mb-3"><i class="fas fa-chart-bar me-2"></i>Review Summary</h6>
                            <?php
                            $recommendations = array_column($reviews, 'recommendation');
                            $recCounts = array_count_values($recommendations);
                            ?>
                            <?php foreach ($recCounts as $rec => $count): ?>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between mb-1">
                                        <small><?= ucfirst(str_replace('_', ' ', $rec)) ?></small>
                                        <small><?= $count ?></small>
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar" style="width: <?= ($count / count($reviews)) * 100 ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php else: ?>
        <div class="container text-center py-5">
            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
            <h3>Submission Not Found</h3>
            <p class="text-muted">The submission you're looking for doesn't exist or you don't have access to it.</p>
            <a href="/editor/submissions" class="btn btn-primary">Back to Submissions</a>
        </div>
    <?php endif; ?>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function makeDecision() {
            // Implementation for making editorial decision
            alert('Make Decision feature coming soon');
        }

        function assignReviewers() {
            window.location.href = '/editor/submissions/<?= $submission['id'] ?? '' ?>/assign-reviewers';
        }

        function requestRevision() {
            if (confirm('Send revision request to the author?')) {
                $.post('/editor/submissions/<?= $submission['id'] ?? '' ?>/request-revision', function(response) {
                    if (response.success) {
                        alert('Revision request sent successfully!');
                        location.reload();
                    }
                });
            }
        }

        function sendMessage() {
            window.location.href = '/messages/compose?to=<?= $submission['author_id'] ?? '' ?>';
        }

        function viewInBrowser() {
            window.open('/uploads/<?= htmlspecialchars($submission['file_path'] ?? '') ?>', '_blank');
        }
    </script>
</body>
</html>
