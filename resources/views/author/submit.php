<?php
$categories = $categories ?? [];
$title = 'Submit Article';
$description = 'Submit your research article for peer review and publication';
$keywords = 'submit article, research submission, manuscript upload, peer review';
ob_start();
?>
<style>
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

<div class="bg-blue-600 text-white py-10 mb-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-2"><i class="fas fa-file-upload mr-3"></i>Submit New Article</h1>
        <p>Submit your research article for peer review and publication</p>
    </div>
</div>

<div class="container mx-auto px-4 mb-8">
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-9">
            <form id="submitForm" method="POST" action="/author/submit" enctype="multipart/form-data">
                <?= \App\Core\CSRF::field() ?>
                <!-- Article Information -->
                <div class="form-section">
                    <h5 class="section-title">
                        <i class="fas fa-file-alt mr-2"></i>Article Information
                    </h5>
                    
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium mb-2 required">Article Title</label>
                        <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" id="title" name="title" required maxlength="500">
                        <small class="text-gray-500 text-sm">Be clear and descriptive</small>
                    </div>

                    <div class="mb-4">
                        <label for="abstract" class="block text-sm font-medium mb-2 required">Abstract</label>
                        <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" id="abstract" name="abstract" rows="6" required maxlength="5000"></textarea>
                        <small class="text-gray-500 text-sm">Maximum 5000 characters</small>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="category" class="block text-sm font-medium mb-2 required">Category</label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" id="category" name="category_id" required>
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>">
                                            <?= htmlspecialchars($category['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="keywords" class="block text-sm font-medium mb-2 required">Keywords</label>
                                <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" id="keywords" name="keywords" required>
                                <small class="text-gray-500 text-sm">Separate with commas (e.g., AI, Machine Learning)</small>
                            </div>
                        </div>
                    </div>

                    <!-- Authors -->
                    <div class="form-section">
                        <h5 class="section-title">
                            <i class="fas fa-users mr-2"></i>Author Information
                        </h5>
                        
                        <div class="mb-4">
                            <label for="authors" class="block text-sm font-medium mb-2 required">Authors</label>
                            <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" id="authors" name="authors" required>
                            <small class="text-gray-500 text-sm">Full names separated by commas</small>
                        </div>

                        <div class="mb-4">
                            <label for="affiliations" class="block text-sm font-medium mb-2">Affiliations</label>
                            <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" id="affiliations" name="affiliations" rows="2"></textarea>
                            <small class="text-gray-500 text-sm">Institutional affiliations of authors</small>
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div class="form-section">
                        <h5 class="section-title">
                            <i class="fas fa-cloud-upload-alt mr-2"></i>Manuscript Upload
                        </h5>
                        
                        <div class="file-upload-area" id="fileUploadArea">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <h5>Drop your manuscript here or click to browse</h5>
                            <p class="text-gray-500">Accepted formats: PDF, DOC, DOCX (Max 10MB)</p>
                            <input type="file" id="manuscript" name="manuscript" accept=".pdf,.doc,.docx" required hidden>
                            <button type="button" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 mt-3" onclick="document.getElementById('manuscript').click()">
                                <i class="fas fa-folder-open mr-2"></i>Choose File
                            </button>
                        </div>
                        <div id="fileInfo" class="mt-4 hidden">
                            <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded relative">
                                <i class="fas fa-file mr-2"></i>
                                <span id="fileName"></span>
                                <button type="button" class="absolute top-0 right-0 px-4 py-3 text-blue-700 text-2xl" onclick="clearFile()">&times;</button>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="supplementary" class="block text-sm font-medium mb-2">Supplementary Files (Optional)</label>
                            <input type="file" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" id="supplementary" name="supplementary[]" multiple accept=".pdf,.doc,.docx,.zip">
                            <small class="text-gray-500 text-sm">Additional materials, data sets, etc.</small>
                        </div>
                    </div>

                    <!-- Declaration -->
                    <div class="form-section">
                        <h5 class="section-title">
                            <i class="fas fa-check-square mr-2"></i>Declaration
                        </h5>
                        
                        <div class="flex items-start mb-4">
                            <input class="mt-1 mr-2" type="checkbox" id="originality" name="originality" required>
                            <label class="text-sm" for="originality">
                                I confirm that this manuscript is original work and has not been published elsewhere
                            </label>
                        </div>

                        <div class="flex items-start mb-4">
                            <input class="mt-1 mr-2" type="checkbox" id="plagiarism" name="plagiarism" required>
                            <label class="text-sm" for="plagiarism">
                                I confirm that this work is free from plagiarism and properly cites all sources
                            </label>
                        </div>

                        <div class="flex items-start mb-4">
                            <input class="mt-1 mr-2" type="checkbox" id="guidelines" name="guidelines" required>
                            <label class="text-sm" for="guidelines">
                                I have read and agree to the <a href="/submission-guidelines" class="text-blue-600 hover:underline" target="_blank">submission guidelines</a>
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3 justify-end">
                        <a href="/author/dashboard" class="border border-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit" name="action" value="draft" class="border border-blue-600 text-blue-600 px-6 py-3 rounded-lg hover:bg-blue-50">
                            <i class="fas fa-save mr-2"></i>Save as Draft
                        </button>
                        <button type="submit" name="action" value="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-paper-plane mr-2"></i>Submit for Review
                        </button>
                    </div>
                </form>
            </div>

            <!-- Sidebar -->
            <div class="col-span-12 lg:col-span-3">
                <div class="bg-white rounded-lg shadow mb-4">
                    <div class="bg-blue-600 text-white px-4 py-3 rounded-t-lg">
                        <h6 class="font-semibold"><i class="fas fa-lightbulb mr-2"></i>Tips</h6>
                    </div>
                    <div class="p-4">
                        <ul class="text-sm space-y-2">
                            <li>Ensure your title is clear and concise</li>
                            <li>Abstract should summarize key findings</li>
                            <li>Choose relevant keywords</li>
                            <li>Manuscript must be in PDF or DOC format</li>
                            <li>Review guidelines before submitting</li>
                        </ul>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow">
                    <div class="px-4 py-3 border-b">
                        <h6 class="font-semibold"><i class="fas fa-book mr-2"></i>Resources</h6>
                    </div>
                    <div class="p-4 space-y-2">
                        <a href="/submission-guidelines" class="block text-center border border-blue-600 text-blue-600 px-4 py-2 rounded hover:bg-blue-50">
                            <i class="fas fa-file-alt mr-2"></i>Guidelines
                        </a>
                        <a href="/manuscript-template" class="block text-center border border-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-50">
                            <i class="fas fa-download mr-2"></i>Template
                        </a>
                        <a href="/faq" class="block text-center border border-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-50">
                            <i class="fas fa-question mr-2"></i>FAQ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                fileInfo.classList.remove('hidden');
                fileUploadArea.style.borderColor = '#28a745';
            }
        }

        function clearFile() {
            fileInput.value = '';
            fileInfo.classList.add('hidden');
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
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
