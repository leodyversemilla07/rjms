<?php
$categories = $categories ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Article - RJMS</title>
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
        .form-section {
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .section-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #4F46E5;
        }
        .required::after {
            content: " *";
            color: red;
        }
        .file-upload-area {
            border: 2px dashed #4F46E5;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            background: #f8f9ff;
            cursor: pointer;
            transition: all 0.3s;
        }
        .file-upload-area:hover {
            background: #e8ebff;
            border-color: #4338CA;
        }
        .file-upload-area i {
            font-size: 48px;
            color: #4F46E5;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-file-upload me-3"></i>Submit New Article</h1>
            <p class="mb-0">Submit your research article for peer review and publication</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-9">
                <?php if (isset($_SESSION['flash'])): ?>
                    <?php foreach ($_SESSION['flash'] as $type => $message): ?>
                        <div class="alert alert-<?= $type ?> alert-dismissible fade show">
                            <?= htmlspecialchars($message) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php unset($_SESSION['flash'][$type]); ?>
                    <?php endforeach; ?>
                <?php endif; ?>

                <form id="submitForm" method="POST" action="/author/submit" enctype="multipart/form-data">
                    <!-- Article Information -->
                    <div class="form-section">
                        <h5 class="section-title">
                            <i class="fas fa-file-alt me-2"></i>Article Information
                        </h5>
                        
                        <div class="mb-3">
                            <label for="title" class="form-label required">Article Title</label>
                            <input type="text" class="form-control" id="title" name="title" required maxlength="500">
                            <small class="text-muted">Be clear and descriptive</small>
                        </div>

                        <div class="mb-3">
                            <label for="abstract" class="form-label required">Abstract</label>
                            <textarea class="form-control" id="abstract" name="abstract" rows="6" required maxlength="5000"></textarea>
                            <small class="text-muted">Maximum 5000 characters</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label required">Category</label>
                                <select class="form-control" id="category" name="category_id" required>
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>">
                                            <?= htmlspecialchars($category['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="keywords" class="form-label required">Keywords</label>
                                <input type="text" class="form-control" id="keywords" name="keywords" required>
                                <small class="text-muted">Separate with commas (e.g., AI, Machine Learning)</small>
                            </div>
                        </div>
                    </div>

                    <!-- Authors -->
                    <div class="form-section">
                        <h5 class="section-title">
                            <i class="fas fa-users me-2"></i>Author Information
                        </h5>
                        
                        <div class="mb-3">
                            <label for="authors" class="form-label required">Authors</label>
                            <input type="text" class="form-control" id="authors" name="authors" required>
                            <small class="text-muted">Full names separated by commas</small>
                        </div>

                        <div class="mb-3">
                            <label for="affiliations" class="form-label">Affiliations</label>
                            <textarea class="form-control" id="affiliations" name="affiliations" rows="2"></textarea>
                            <small class="text-muted">Institutional affiliations of authors</small>
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div class="form-section">
                        <h5 class="section-title">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Manuscript Upload
                        </h5>
                        
                        <div class="file-upload-area" id="fileUploadArea">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <h5>Drop your manuscript here or click to browse</h5>
                            <p class="text-muted">Accepted formats: PDF, DOC, DOCX (Max 10MB)</p>
                            <input type="file" id="manuscript" name="manuscript" accept=".pdf,.doc,.docx" required hidden>
                            <button type="button" class="btn btn-primary mt-3" onclick="document.getElementById('manuscript').click()">
                                <i class="fas fa-folder-open me-2"></i>Choose File
                            </button>
                        </div>
                        <div id="fileInfo" class="mt-3 d-none">
                            <div class="alert alert-info">
                                <i class="fas fa-file me-2"></i>
                                <span id="fileName"></span>
                                <button type="button" class="btn-close float-end" onclick="clearFile()"></button>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="supplementary" class="form-label">Supplementary Files (Optional)</label>
                            <input type="file" class="form-control" id="supplementary" name="supplementary[]" multiple accept=".pdf,.doc,.docx,.zip">
                            <small class="text-muted">Additional materials, data sets, etc.</small>
                        </div>
                    </div>

                    <!-- Declaration -->
                    <div class="form-section">
                        <h5 class="section-title">
                            <i class="fas fa-check-square me-2"></i>Declaration
                        </h5>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="originality" name="originality" required>
                            <label class="form-check-label" for="originality">
                                I confirm that this manuscript is original work and has not been published elsewhere
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="plagiarism" name="plagiarism" required>
                            <label class="form-check-label" for="plagiarism">
                                I confirm that this work is free from plagiarism and properly cites all sources
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="guidelines" name="guidelines" required>
                            <label class="form-check-label" for="guidelines">
                                I have read and agree to the <a href="/submission-guidelines" target="_blank">submission guidelines</a>
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="/author/dashboard" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" name="action" value="draft" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Save as Draft
                        </button>
                        <button type="submit" name="action" value="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane me-2"></i>Submit for Review
                        </button>
                    </div>
                </form>
            </div>

            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Tips</h6>
                    </div>
                    <div class="card-body">
                        <ul class="small mb-0">
                            <li class="mb-2">Ensure your title is clear and concise</li>
                            <li class="mb-2">Abstract should summarize key findings</li>
                            <li class="mb-2">Choose relevant keywords</li>
                            <li class="mb-2">Manuscript must be in PDF or DOC format</li>
                            <li>Review guidelines before submitting</li>
                        </ul>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="mb-0"><i class="fas fa-book me-2"></i>Resources</h6>
                    </div>
                    <div class="card-body">
                        <a href="/submission-guidelines" class="btn btn-sm btn-outline-primary w-100 mb-2">
                            <i class="fas fa-file-alt me-2"></i>Guidelines
                        </a>
                        <a href="/manuscript-template" class="btn btn-sm btn-outline-secondary w-100 mb-2">
                            <i class="fas fa-download me-2"></i>Template
                        </a>
                        <a href="/faq" class="btn btn-sm btn-outline-secondary w-100">
                            <i class="fas fa-question me-2"></i>FAQ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // File upload handling
        const fileInput = document.getElementById('manuscript');
        const fileUploadArea = document.getElementById('fileUploadArea');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');

        fileUploadArea.addEventListener('click', () => fileInput.click());
        
        fileUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadArea.style.borderColor = '#4338CA';
        });

        fileUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            fileInput.files = e.dataTransfer.files;
            handleFileSelect();
        });

        fileInput.addEventListener('change', handleFileSelect);

        function handleFileSelect() {
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                fileName.textContent = file.name + ' (' + formatFileSize(file.size) + ')';
                fileInfo.classList.remove('d-none');
                fileUploadArea.style.borderColor = '#28a745';
            }
        }

        function clearFile() {
            fileInput.value = '';
            fileInfo.classList.add('d-none');
            fileUploadArea.style.borderColor = '#4F46E5';
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }

        // Form validation
        $('#submitForm').on('submit', function(e) {
            const action = $(e.originalEvent.submitter).val();
            if (action === 'submit') {
                if (!confirm('Are you sure you want to submit this article for review? Once submitted, you cannot edit it.')) {
                    e.preventDefault();
                    return false;
                }
            }
        });
    </script>
</body>
</html>
