<?php
$submission = $submission ?? null;
$review = $review ?? null;
$readonly = isset($review['reviewed_at']);
$title = htmlspecialchars($submission['title'] ?? 'Review Submission');
$description = 'Review and provide feedback on submission';
$keywords = 'review, submission, peer review, feedback';
ob_start();
?>
<style>
    .content-card {
        background: white;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .rating-stars { font-size: 24px; color: #e9ecef; cursor: pointer; }
    .rating-stars i.active { color: #ffc107; }
    .rating-stars i:hover, .rating-stars i:hover ~ i { color: #ffc107; }
    .criteria-section {
        background: #F3F4F6;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
</style>

    </style>

<?php if ($submission): ?>
    <div class="bg-blue-600 text-white py-10 mb-8">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2"><?= htmlspecialchars($submission['title']) ?></h1>
                    <p>Submission ID: #<?= $submission['id'] ?></p>
                </div>
                <div>
                    <a href="/reviewer/submissions" class="bg-white text-blue-600 px-6 py-3 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-arrow-left mr-2"></i>Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 mb-8">
        <div class="grid grid-cols-12 gap-6">
                <!-- Submission Content -->
                <div class="col-md-8">
                    <!-- Submission Details -->
                    <div class="content-card">
                        <h5 class="mb-4"><i class="fas fa-file-alt me-2"></i>Submission Details</h5>
                        
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
                                    <a href="/uploads/<?= htmlspecialchars($submission['file_path']) ?>" 
                                       class="btn btn-outline-primary" target="_blank">
                                        <i class="fas fa-eye me-2"></i>View in Browser
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Review Form -->
                    <div class="content-card">
                        <h5 class="mb-4">
                            <i class="fas fa-clipboard-check me-2"></i>
                            <?= $readonly ? 'Your Review' : 'Submit Your Review' ?>
                        </h5>

                        <?php if ($readonly): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                You submitted this review on <?= date('F d, Y', strtotime($review['reviewed_at'])) ?>
                            </div>
                        <?php endif; ?>

                        <form id="reviewForm" method="POST" action="/reviewer/submit-review">
                            <input type="hidden" name="submission_id" value="<?= $submission['id'] ?>">
                            
                            <!-- Overall Rating -->
                            <div class="mb-4">
                                <label class="form-label">Overall Rating *</label>
                                <div class="rating-stars" id="overallRating">
                                    <?php for ($i = 5; $i >= 1; $i--): ?>
                                        <i class="fas fa-star <?= (isset($review['rating']) && $i <= $review['rating']) ? 'active' : '' ?>" 
                                           data-rating="<?= $i ?>" 
                                           <?= $readonly ? 'style="cursor:default;"' : '' ?>></i>
                                    <?php endfor; ?>
                                </div>
                                <input type="hidden" name="rating" id="ratingValue" value="<?= $review['rating'] ?? '' ?>" required>
                            </div>

                            <!-- Recommendation -->
                            <div class="mb-4">
                                <label class="form-label">Recommendation *</label>
                                <select class="form-select" name="recommendation" required <?= $readonly ? 'disabled' : '' ?>>
                                    <option value="">Select recommendation...</option>
                                    <option value="accept" <?= (isset($review['recommendation']) && $review['recommendation'] == 'accept') ? 'selected' : '' ?>>
                                        Accept
                                    </option>
                                    <option value="minor_revision" <?= (isset($review['recommendation']) && $review['recommendation'] == 'minor_revision') ? 'selected' : '' ?>>
                                        Minor Revision
                                    </option>
                                    <option value="major_revision" <?= (isset($review['recommendation']) && $review['recommendation'] == 'major_revision') ? 'selected' : '' ?>>
                                        Major Revision
                                    </option>
                                    <option value="reject" <?= (isset($review['recommendation']) && $review['recommendation'] == 'reject') ? 'selected' : '' ?>>
                                        Reject
                                    </option>
                                </select>
                            </div>

                            <!-- Review Criteria -->
                            <div class="criteria-section">
                                <h6 class="mb-3">Detailed Evaluation</h6>
                                
                                <div class="mb-3">
                                    <label class="form-label">Originality (1-5)</label>
                                    <input type="number" class="form-control" name="originality" min="1" max="5" 
                                           value="<?= $review['originality'] ?? '' ?>" <?= $readonly ? 'readonly' : '' ?>>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Methodology (1-5)</label>
                                    <input type="number" class="form-control" name="methodology" min="1" max="5" 
                                           value="<?= $review['methodology'] ?? '' ?>" <?= $readonly ? 'readonly' : '' ?>>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Clarity (1-5)</label>
                                    <input type="number" class="form-control" name="clarity" min="1" max="5" 
                                           value="<?= $review['clarity'] ?? '' ?>" <?= $readonly ? 'readonly' : '' ?>>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Significance (1-5)</label>
                                    <input type="number" class="form-control" name="significance" min="1" max="5" 
                                           value="<?= $review['significance'] ?? '' ?>" <?= $readonly ? 'readonly' : '' ?>>
                                </div>
                            </div>

                            <!-- Comments -->
                            <div class="mb-4">
                                <label class="form-label">General Comments *</label>
                                <textarea class="form-control" name="comments" rows="5" required <?= $readonly ? 'readonly' : '' ?>
                                          placeholder="Provide your overall assessment of the submission..."><?= htmlspecialchars($review['comments'] ?? '') ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Strengths</label>
                                <textarea class="form-control" name="strengths" rows="4" <?= $readonly ? 'readonly' : '' ?>
                                          placeholder="What are the strong points of this work?"><?= htmlspecialchars($review['strengths'] ?? '') ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Weaknesses</label>
                                <textarea class="form-control" name="weaknesses" rows="4" <?= $readonly ? 'readonly' : '' ?>
                                          placeholder="What areas need improvement?"><?= htmlspecialchars($review['weaknesses'] ?? '') ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Suggestions for Improvement</label>
                                <textarea class="form-control" name="suggestions" rows="4" <?= $readonly ? 'readonly' : '' ?>
                                          placeholder="Specific suggestions to improve the manuscript..."><?= htmlspecialchars($review['suggestions'] ?? '') ?></textarea>
                            </div>

                            <!-- Confidential Comments to Editor -->
                            <div class="mb-4">
                                <label class="form-label">
                                    Confidential Comments to Editor
                                    <small class="text-muted">(Not visible to author)</small>
                                </label>
                                <textarea class="form-control" name="confidential_comments" rows="3" <?= $readonly ? 'readonly' : '' ?>
                                          placeholder="Comments for the editor only..."><?= htmlspecialchars($review['confidential_comments'] ?? '') ?></textarea>
                            </div>

                            <?php if (!$readonly): ?>
                                <div class="d-flex gap-2">
                                    <button type="submit" name="action" value="submit" class="btn btn-success">
                                        <i class="fas fa-paper-plane me-2"></i>Submit Review
                                    </button>
                                    <button type="submit" name="action" value="save_draft" class="btn btn-secondary">
                                        <i class="fas fa-save me-2"></i>Save Draft
                                    </button>
                                    <a href="/reviewer/submissions" class="btn btn-outline-secondary">
                                        Cancel
                                    </a>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <!-- Metadata -->
                    <div class="content-card">
                        <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i>Submission Info</h6>
                        
                        <div class="mb-3">
                            <small class="text-muted d-block">Category</small>
                            <span class="badge bg-secondary">
                                <?= htmlspecialchars($submission['category_name'] ?? 'Uncategorized') ?>
                            </span>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted d-block">Submitted</small>
                            <strong><?= date('M d, Y', strtotime($submission['created_at'])) ?></strong>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted d-block">Review Deadline</small>
                            <?php
                            $deadline = strtotime($submission['deadline'] ?? '+14 days');
                            $daysLeft = ceil(($deadline - time()) / 86400);
                            ?>
                            <strong class="<?= $daysLeft <= 3 ? 'text-danger' : '' ?>">
                                <?= date('M d, Y', $deadline) ?>
                                <?php if ($daysLeft > 0): ?>
                                    <br><small>(<?= $daysLeft ?> day<?= $daysLeft != 1 ? 's' : '' ?> left)</small>
                                <?php elseif ($daysLeft == 0): ?>
                                    <br><small class="text-danger">(Due today!)</small>
                                <?php else: ?>
                                    <br><small class="text-danger">(Overdue by <?= abs($daysLeft) ?> days)</small>
                                <?php endif; ?>
                            </strong>
                        </div>

                        <?php if ($readonly): ?>
                            <div class="mb-3">
                                <small class="text-muted d-block">Review Submitted</small>
                                <strong><?= date('M d, Y', strtotime($review['reviewed_at'])) ?></strong>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Guidelines -->
                    <div class="content-card">
                        <h6 class="mb-3"><i class="fas fa-clipboard-list me-2"></i>Review Guidelines</h6>
                        <ul class="small mb-0">
                            <li class="mb-2">Evaluate work objectively</li>
                            <li class="mb-2">Be constructive in feedback</li>
                            <li class="mb-2">Maintain confidentiality</li>
                            <li class="mb-2">Focus on content, not author</li>
                            <li class="mb-2">Support claims with evidence</li>
                            <li>Complete before deadline</li>
                        </ul>
                    </div>

                    <?php if (!$readonly): ?>
                        <!-- Quick Actions -->
                        <div class="content-card">
                            <h6 class="mb-3"><i class="fas fa-bolt me-2"></i>Quick Actions</h6>
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="$('#reviewForm').find('[name=action]').val('save_draft').closest('form').submit();">
                                    <i class="fas fa-save me-2"></i>Save Progress
                                </button>
                                <a href="/reviewer/submissions" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-list me-2"></i>My Assignments
                                </a>
                            </div>
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
            <a href="/reviewer/submissions" class="btn btn-primary">Back to Assignments</a>
        </div>
    <?php endif; ?>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        <?php if (!$readonly): ?>
        // Star rating interaction
        $('#overallRating i').on('click', function() {
            const rating = $(this).data('rating');
            $('#ratingValue').val(rating);
            $('#overallRating i').removeClass('active');
            $('#overallRating i').each(function() {
                if ($(this).data('rating') <= rating) {
                    $(this).addClass('active');
                }
            });
        });

        // Form validation
        $('#reviewForm').on('submit', function(e) {
            if (!$('#ratingValue').val()) {
                e.preventDefault();
                alert('Please provide an overall rating');
                return false;
            }
        });
        <?php endif; ?>
    </script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
