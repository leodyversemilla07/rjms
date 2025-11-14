<?php
// Set page metadata
$title = 'Review History - Reviewer Dashboard - Research Journal Management System';
$description = 'Your completed reviews and performance statistics';
$keywords = 'reviewer, history, completed reviews, statistics';

$completed_reviews = $completed_reviews ?? [];
$stats = $stats ?? ['total_reviews' => 0, 'avg_rating' => 0];

// Start output buffering
ob_start();
?>

    <!-- Page Header -->
    <div class="bg-primary-700 text-white border-b-4 border-primary-800">
        <div class="container mx-auto px-4 py-12">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        <i class="fas fa-history mr-3"></i>Review History
                    </h1>
                    <p class="text-primary-100">Your completed reviews and performance statistics</p>
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
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h5 class="text-xl font-bold text-slate-800 mb-6">
                        <i class="fas fa-check-circle mr-2"></i>Completed Reviews
                    </h5>

                    <?php if (empty($completed_reviews)): ?>
                        <div class="text-center py-12">
                            <i class="fas fa-history text-6xl text-slate-300 mb-4"></i>
                            <p class="text-slate-600">No completed reviews yet</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                        <?php foreach ($completed_reviews as $review): ?>
                            <div class="bg-slate-50 border-l-4 border-primary-500 rounded-r-lg p-5">
                                <div class="grid md:grid-cols-4 gap-4">
                                    <div class="md:col-span-3">
                                        <h6 class="font-semibold text-slate-800 mb-2">
                                            <?= htmlspecialchars($review['submission_title']) ?>
                                        </h6>
                                        <div class="flex flex-wrap gap-3 mb-2">
                                            <small class="text-slate-600">
                                                <i class="fas fa-folder mr-1"></i>
                                                <?= htmlspecialchars($review['category_name'] ?? 'Uncategorized') ?>
                                            </small>
                                            <small class="text-slate-600">
                                                <i class="fas fa-calendar mr-1"></i>
                                                Reviewed on <?= date('M d, Y', strtotime($review['reviewed_at'])) ?>
                                            </small>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-amber-500">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fas fa-star<?= $i <= $review['rating'] ? '' : ' opacity-30' ?>"></i>
                                                <?php endfor; ?>
                                            </span>
                                            <span class="ml-2 text-sm text-slate-700"><?= $review['rating'] ?>/5</span>
                                        </div>
                                        <div>
                                            <?php
                                            $recColors = [
                                                'accept' => 'bg-green-100 text-green-700',
                                                'minor_revision' => 'bg-blue-100 text-blue-700',
                                                'major_revision' => 'bg-amber-100 text-amber-700',
                                                'reject' => 'bg-red-100 text-red-700'
                                            ];
                                            $colorClass = $recColors[$review['recommendation']] ?? 'bg-slate-100 text-slate-700';
                                            ?>
                                            <span class="inline-block px-2 py-1 <?= $colorClass ?> text-xs font-semibold rounded">
                                                <?= ucfirst(str_replace('_', ' ', $review['recommendation'])) ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <a href="/reviewer/view-submission/<?= $review['submission_id'] ?>" 
                                           class="inline-flex items-center justify-center border-2 border-primary-700 text-primary-700 hover:bg-primary-50 font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                                            <i class="fas fa-eye mr-1"></i>View
                                        </a>
                                    </div>
                                </div>
                                
                                <?php if (isset($review['comments'])): ?>
                                    <div class="mt-4 pt-4 border-t border-slate-200">
                                        <small class="text-slate-600 font-medium block mb-2">Your Comments:</small>
                                        <p class="text-sm text-slate-700">
                                            <?= htmlspecialchars(substr($review['comments'], 0, 200)) ?>
                                            <?= strlen($review['comments']) > 200 ? '...' : '' ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Statistics -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h6 class="text-lg font-bold text-slate-800 mb-4">
                        <i class="fas fa-chart-bar mr-2"></i>Your Statistics
                    </h6>
                    
                    <div class="text-center bg-slate-50 rounded-lg p-5 mb-4">
                        <h3 class="text-3xl font-bold text-slate-800 mb-1"><?= $stats['total_reviews'] ?></h3>
                        <small class="text-slate-600">Total Reviews</small>
                    </div>

                    <div class="text-center bg-slate-50 rounded-lg p-5 mb-4">
                        <h3 class="text-3xl font-bold text-slate-800 mb-1"><?= number_format($stats['avg_rating'] ?? 0, 1) ?></h3>
                        <small class="text-slate-600">Average Rating Given</small>
                    </div>

                    <?php if (isset($stats['on_time_percentage'])): ?>
                        <div class="text-center bg-slate-50 rounded-lg p-5">
                            <h3 class="text-3xl font-bold text-slate-800 mb-1"><?= $stats['on_time_percentage'] ?>%</h3>
                            <small class="text-slate-600">On-Time Completion</small>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Recommendation Breakdown -->
                <?php if (!empty($completed_reviews)): ?>
                    <div class="bg-white rounded-xl shadow-card p-6">
                        <h6 class="text-lg font-bold text-slate-800 mb-4">
                            <i class="fas fa-pie-chart mr-2"></i>Recommendations
                        </h6>
                        <?php
                        $recommendations = array_column($completed_reviews, 'recommendation');
                        $recCounts = array_count_values($recommendations);
                        $total = count($recommendations);
                        ?>
                        <div class="space-y-3">
                        <?php foreach ($recCounts as $rec => $count): ?>
                            <div>
                                <div class="flex justify-between mb-2">
                                    <small class="text-slate-700 font-medium"><?= ucfirst(str_replace('_', ' ', $rec)) ?></small>
                                    <small class="text-slate-700 font-semibold"><?= $count ?> (<?= round(($count/$total)*100) ?>%)</small>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2">
                                    <div class="bg-primary-600 h-2 rounded-full" style="width: <?= ($count/$total)*100 ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Category Expertise -->
                <?php if (!empty($completed_reviews)): ?>
                    <div class="bg-white rounded-xl shadow-card p-6">
                        <h6 class="text-lg font-bold text-slate-800 mb-4">
                            <i class="fas fa-tag mr-2"></i>Categories Reviewed
                        </h6>
                        <?php
                        $categories = array_column($completed_reviews, 'category_name');
                        $catCounts = array_count_values($categories);
                        arsort($catCounts);
                        ?>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach (array_slice($catCounts, 0, 10) as $cat => $count): ?>
                                <span class="inline-block px-2 py-1 bg-slate-100 text-slate-700 text-xs font-semibold rounded">
                                    <?= htmlspecialchars($cat) ?> (<?= $count ?>)
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php
// Get the buffered content
$content = ob_get_clean();

// Include the main layout
include __DIR__ . '/../layouts/main.php';
?>
