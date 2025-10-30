<?php
$completed_reviews = $completed_reviews ?? [];
$stats = $stats ?? ['total_reviews' => 0, 'avg_rating' => 0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review History - Reviewer Dashboard - RJMS</title>
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
        .stat-box {
            text-align: center;
            padding: 20px;
            background: #F3F4F6;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .review-card {
            background: #F3F4F6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid #4F46E5;
        }
        .rating-stars { color: #ffc107; }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-history me-3"></i>Review History</h1>
                    <p class="mb-0">Your completed reviews and performance statistics</p>
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
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-8">
                <div class="content-card">
                    <h5 class="mb-4"><i class="fas fa-check-circle me-2"></i>Completed Reviews</h5>

                    <?php if (empty($completed_reviews)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-history fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No completed reviews yet</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($completed_reviews as $review): ?>
                            <div class="review-card">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h6 class="mb-2">
                                            <?= htmlspecialchars($review['submission_title']) ?>
                                        </h6>
                                        <div class="mb-2">
                                            <small class="text-muted">
                                                <i class="fas fa-folder me-1"></i>
                                                <?= htmlspecialchars($review['category_name'] ?? 'Uncategorized') ?>
                                            </small>
                                            <small class="text-muted ms-3">
                                                <i class="fas fa-calendar me-1"></i>
                                                Reviewed on <?= date('M d, Y', strtotime($review['reviewed_at'])) ?>
                                            </small>
                                        </div>
                                        <div class="mb-2">
                                            <span class="rating-stars">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fas fa-star<?= $i <= $review['rating'] ? '' : '-o' ?>"></i>
                                                <?php endfor; ?>
                                            </span>
                                            <span class="ms-2"><?= $review['rating'] ?>/5</span>
                                        </div>
                                        <div>
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
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-end">
                                        <a href="/reviewer/view-submission/<?= $review['submission_id'] ?>" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    </div>
                                </div>
                                
                                <?php if (isset($review['comments'])): ?>
                                    <div class="mt-3 pt-3 border-top">
                                        <small class="text-muted d-block mb-1">Your Comments:</small>
                                        <p class="small mb-0">
                                            <?= htmlspecialchars(substr($review['comments'], 0, 200)) ?>
                                            <?= strlen($review['comments']) > 200 ? '...' : '' ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Statistics -->
                <div class="content-card">
                    <h6 class="mb-3"><i class="fas fa-chart-bar me-2"></i>Your Statistics</h6>
                    
                    <div class="stat-box">
                        <h3 class="mb-1"><?= $stats['total_reviews'] ?></h3>
                        <small class="text-muted">Total Reviews</small>
                    </div>

                    <div class="stat-box">
                        <h3 class="mb-1"><?= number_format($stats['avg_rating'] ?? 0, 1) ?></h3>
                        <small class="text-muted">Average Rating Given</small>
                    </div>

                    <?php if (isset($stats['on_time_percentage'])): ?>
                        <div class="stat-box">
                            <h3 class="mb-1"><?= $stats['on_time_percentage'] ?>%</h3>
                            <small class="text-muted">On-Time Completion</small>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Recommendation Breakdown -->
                <?php if (!empty($completed_reviews)): ?>
                    <div class="content-card">
                        <h6 class="mb-3"><i class="fas fa-pie-chart me-2"></i>Recommendations</h6>
                        <?php
                        $recommendations = array_column($completed_reviews, 'recommendation');
                        $recCounts = array_count_values($recommendations);
                        $total = count($recommendations);
                        ?>
                        <?php foreach ($recCounts as $rec => $count): ?>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <small><?= ucfirst(str_replace('_', ' ', $rec)) ?></small>
                                    <small><?= $count ?> (<?= round(($count/$total)*100) ?>%)</small>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" style="width: <?= ($count/$total)*100 ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Category Expertise -->
                <?php if (!empty($completed_reviews)): ?>
                    <div class="content-card">
                        <h6 class="mb-3"><i class="fas fa-tag me-2"></i>Categories Reviewed</h6>
                        <?php
                        $categories = array_column($completed_reviews, 'category_name');
                        $catCounts = array_count_values($categories);
                        arsort($catCounts);
                        ?>
                        <div class="d-flex flex-wrap gap-2">
                            <?php foreach (array_slice($catCounts, 0, 10) as $cat => $count): ?>
                                <span class="badge bg-secondary">
                                    <?= htmlspecialchars($cat) ?> (<?= $count ?>)
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
