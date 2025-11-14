<?php
function getStatusColor($status) {
    $colors = [
        'draft' => 'gray-100 text-gray-700',
        'pending' => 'blue-100 text-blue-700',
        'under_review' => 'yellow-100 text-yellow-700',
        'revision_required' => 'orange-100 text-orange-700',
        'accepted' => 'green-100 text-green-700',
        'published' => 'green-100 text-green-700',
        'rejected' => 'red-100 text-red-700'
    ];
    return $colors[$status] ?? 'gray-100 text-gray-700';
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

$submission = $submission ?? [];
$reviews = $reviews ?? [];
$title = htmlspecialchars($submission['title'] ?? 'View Article');
$description = 'View submission details and reviews';
$keywords = 'submission, article details, peer review';
ob_start();
?>
<style>
    .content-card {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .review-card {
        border-left: 4px solid #4F46E5;
        margin-bottom: 15px;
    }
    .rating-stars {
        color: #ffc107;
    }
</style>

    </style>

<div class="bg-blue-600 text-white py-10 mb-8">
    <div class="container mx-auto px-4">
        <a href="/author/manage" class="inline-block bg-white text-blue-600 px-4 py-2 rounded mb-4 hover:bg-gray-100">
            <i class="fas fa-arrow-left mr-2"></i>Back to Submissions
        </a>
        <h1 class="text-3xl font-bold mb-2"><?= htmlspecialchars($submission['title'] ?? 'Article Details') ?></h1>
        <p>Submission ID: #<?= $submission['id'] ?? 'N/A' ?></p>
    </div>
</div>

<div class="container mx-auto px-4 mb-8">
    <div class="grid grid-cols-12 gap-6">
        <!-- Main Content -->
        <div class="col-span-12 lg:col-span-8">
            <!-- Article Details -->
            <div class="content-card">
                <div class="flex justify-between items-start mb-6">
                    <h3 class="text-2xl font-bold"><?= htmlspecialchars($submission['title'] ?? '') ?></h3>
                    <span class="px-4 py-2 rounded-full text-sm font-semibold bg-<?= getStatusColor($submission['status'] ?? 'draft') ?>">
                        <?= getStatusLabel($submission['status'] ?? 'draft') ?>
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="mb-2">
                            <strong><i class="fas fa-user mr-2"></i>Authors:</strong><br>
                            <?= htmlspecialchars($submission['authors'] ?? 'N/A') ?>
                        </p>
                    </div>
                    <div>
                        <p class="mb-2">
                            <strong><i class="fas fa-calendar mr-2"></i>Submitted:</strong><br>
                            <?= isset($submission['submission_date']) ? date('F d, Y', strtotime($submission['submission_date'])) : 'N/A' ?>
                        </p>
                    </div>
                </div>

                <div class="mb-6">
                    <strong><i class="fas fa-tags mr-2"></i>Keywords:</strong><br>
                    <?php if (!empty($submission['keywords'])): ?>
                        <?php foreach (explode(',', $submission['keywords']) as $keyword): ?>
                            <span class="inline-block bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm mr-2 mt-1"><?= htmlspecialchars(trim($keyword)) ?></span>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="text-gray-500">No keywords</span>
                    <?php endif; ?>
                </div>

                <div class="mb-6">
                    <h5 class="text-lg font-semibold mb-2"><i class="fas fa-file-alt mr-2"></i>Abstract</h5>
                    <p class="text-justify"><?= nl2br(htmlspecialchars($submission['abstract'] ?? '')) ?></p>
                </div>

                <?php if (!empty($submission['file_path'])): ?>
                    <div class="mb-6">
                        <h5 class="text-lg font-semibold mb-2"><i class="fas fa-file-download mr-2"></i>Manuscript</h5>
                        <a href="/uploads/<?= htmlspecialchars($submission['file_path']) ?>" 
                           class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700" target="_blank">
                            <i class="fas fa-download mr-2"></i>Download Manuscript
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Reviews (if any) -->
            <?php if (!empty($reviews)): ?>
                <div class="content-card">
                    <h5 class="text-lg font-semibold mb-4"><i class="fas fa-comments mr-2"></i>Reviews (<?= count($reviews) ?>)</h5>
                    <?php foreach ($reviews as $review): ?>
                        <div class="bg-white rounded-lg border-l-4 border-blue-600 p-4 mb-4 shadow-sm review-card">
                            <div class="flex justify-between mb-2">
                                <strong>Reviewer #<?= $review['id'] ?></strong>
                                <div class="rating-stars">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star<?= $i <= ($review['rating'] ?? 0) ? '' : '-o' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="mb-2">
                                <strong>Recommendation:</strong> 
                                <span class="inline-block px-3 py-1 rounded text-sm font-semibold bg-<?= $review['recommendation'] == 'accept' ? 'green-100 text-green-700' : ($review['recommendation'] == 'reject' ? 'red-100 text-red-700' : 'yellow-100 text-yellow-700') ?>">
                                    <?= ucfirst($review['recommendation'] ?? 'pending') ?>
                                </span>
                            </p>
                            <p class="mb-2"><?= nl2br(htmlspecialchars($review['comments'] ?? '')) ?></p>
                            <small class="text-gray-500">
                                Reviewed on <?= isset($review['review_date']) ? date('M d, Y', strtotime($review['review_date'])) : 'Pending' ?>
                            </small>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-span-12 lg:col-span-4">
            <!-- Actions -->
            <div class="content-card">
                <h6 class="font-semibold mb-4"><i class="fas fa-bolt mr-2"></i>Actions</h6>
                <div class="space-y-2">
                    <?php if (in_array($submission['status'] ?? '', ['draft', 'revision_required'])): ?>
                        <a href="/author/article/<?= $submission['id'] ?>/edit" class="block text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-edit mr-2"></i>Edit Submission
                        </a>
                    <?php endif; ?>
                    <?php if (($submission['status'] ?? '') == 'draft'): ?>
                        <button onclick="submitForReview(<?= $submission['id'] ?>)" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            <i class="fas fa-paper-plane mr-2"></i>Submit for Review
                        </button>
                    <?php endif; ?>
                    <?php if (!empty($submission['file_path'])): ?>
                        <a href="/uploads/<?= htmlspecialchars($submission['file_path'] ?? '') ?>" 
                           class="block text-center border border-blue-600 text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50" target="_blank">
                            <i class="fas fa-download mr-2"></i>Download Manuscript
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Timeline -->
            <div class="content-card">
                <h6 class="font-semibold mb-4"><i class="fas fa-history mr-2"></i>Timeline</h6>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-circle text-blue-600 text-xs mt-1 mr-2"></i>
                        <div>
                            <strong>Submitted</strong><br>
                            <small class="text-gray-500">
                                <?= isset($submission['submission_date']) ? date('M d, Y', strtotime($submission['submission_date'])) : 'N/A' ?>
                            </small>
                        </div>
                    </li>
                    <?php if (isset($submission['updated_at'])): ?>
                        <li class="flex items-start">
                            <i class="fas fa-circle text-blue-400 text-xs mt-1 mr-2"></i>
                            <div>
                                <strong>Last Updated</strong><br>
                                <small class="text-gray-500">
                                    <?= date('M d, Y', strtotime($submission['updated_at'])) ?>
                                </small>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Help -->
            <div class="content-card">
                <h6 class="font-semibold mb-2"><i class="fas fa-question-circle mr-2"></i>Need Help?</h6>
                <p class="text-sm mb-3">Have questions about your submission?</p>
                <a href="/contact" class="block text-center border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-envelope mr-2"></i>Contact Support
                </a>
            </div>
        </div>
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
