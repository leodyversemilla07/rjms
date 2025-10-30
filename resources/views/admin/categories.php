<?php
$categories = $categories ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management - RJMS</title>
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
        }
        .category-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid #4F46E5;
            transition: all 0.3s;
        }
        .category-card:hover {
            transform: translateX(5px);
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-folder me-3"></i>Category Management</h1>
                    <p class="mb-0">Manage article categories and classifications</p>
                </div>
                <div class="col-md-4 text-end">
                    <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="fas fa-plus-circle me-2"></i>Add Category
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <?php if (isset($_SESSION['flash'])): ?>
            <?php foreach ($_SESSION['flash'] as $type => $message): ?>
                <div class="alert alert-<?= $type ?> alert-dismissible fade show">
                    <?= htmlspecialchars($message) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['flash'][$type]); ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="row">
            <!-- Categories List -->
            <div class="col-md-8">
                <div class="content-card">
                    <h5 class="mb-4"><i class="fas fa-list me-2"></i>All Categories</h5>
                    
                    <?php if (empty($categories)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No categories yet. Create your first category!</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                <i class="fas fa-plus me-2"></i>Add Category
                            </button>
                        </div>
                    <?php else: ?>
                        <?php foreach ($categories as $category): ?>
                            <div class="category-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h5><?= htmlspecialchars($category['name']) ?></h5>
                                        <p class="text-muted mb-2"><?= htmlspecialchars($category['description'] ?? '') ?></p>
                                        <div class="d-flex gap-3">
                                            <span class="badge bg-primary">
                                                <i class="fas fa-file me-1"></i>
                                                <?= $category['submission_count'] ?? 0 ?> submission<?= ($category['submission_count'] ?? 0) != 1 ? 's' : '' ?>
                                            </span>
                                            <?php if ($category['is_active']): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Inactive</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <button onclick="editCategory(<?= $category['id'] ?>, '<?= htmlspecialchars($category['name'], ENT_QUOTES) ?>', '<?= htmlspecialchars($category['description'] ?? '', ENT_QUOTES) ?>', <?= $category['is_active'] ? 'true' : 'false' ?>)" 
                                                class="btn btn-sm btn-outline-secondary" 
                                                title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="toggleCategoryStatus(<?= $category['id'] ?>, <?= $category['is_active'] ? 'false' : 'true' ?>)" 
                                                class="btn btn-sm btn-outline-warning" 
                                                title="<?= $category['is_active'] ? 'Deactivate' : 'Activate' ?>">
                                            <i class="fas fa-<?= $category['is_active'] ? 'ban' : 'check' ?>"></i>
                                        </button>
                                        <?php if (($category['submission_count'] ?? 0) == 0): ?>
                                            <button onclick="deleteCategory(<?= $category['id'] ?>)" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Statistics -->
                <div class="content-card mb-4">
                    <h6 class="mb-3"><i class="fas fa-chart-pie me-2"></i>Statistics</h6>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Total Categories</span>
                            <strong><?= count($categories) ?></strong>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Active Categories</span>
                            <strong><?= count(array_filter($categories, fn($c) => $c['is_active'])) ?></strong>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Total Submissions</span>
                            <strong><?= array_sum(array_column($categories, 'submission_count')) ?></strong>
                        </div>
                    </div>
                </div>

                <!-- Help -->
                <div class="content-card">
                    <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i>Category Guidelines</h6>
                    <ul class="small mb-0">
                        <li class="mb-2">Category names should be clear and descriptive</li>
                        <li class="mb-2">Add descriptions to help authors choose the right category</li>
                        <li class="mb-2">Categories with submissions cannot be deleted</li>
                        <li>Inactive categories won't appear in submission forms</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="addCategoryForm" method="POST" action="/admin/categories/create">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name *</label>
                            <input type="text" class="form-control" id="name" name="name" required maxlength="100">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" maxlength="500"></textarea>
                            <small class="text-muted">Optional description to help authors</small>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active (visible in forms)
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Create Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editCategoryForm">
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Category Name *</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required maxlength="100">
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="3" maxlength="500"></textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="edit_is_active" name="is_active">
                            <label class="form-check-label" for="edit_is_active">
                                Active (visible in forms)
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#addCategoryForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/admin/categories/create',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Category created successfully!');
                        location.reload();
                    } else {
                        alert(response.message || 'Failed to create category');
                    }
                },
                error: function(xhr) {
                    alert(xhr.responseJSON?.message || 'An error occurred');
                }
            });
        });

        function editCategory(id, name, description, isActive) {
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_description').val(description);
            $('#edit_is_active').prop('checked', isActive);
            new bootstrap.Modal($('#editCategoryModal')).show();
        }

        $('#editCategoryForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#edit_id').val();
            $.ajax({
                url: '/admin/categories/' + id + '/update',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        alert('Category updated successfully!');
                        location.reload();
                    } else {
                        alert(response.message || 'Failed to update category');
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                }
            });
        });

        function toggleCategoryStatus(id, activate) {
            const action = activate ? 'activate' : 'deactivate';
            if (confirm('Are you sure you want to ' + action + ' this category?')) {
                $.ajax({
                    url: '/admin/categories/' + id + '/toggle-status',
                    method: 'POST',
                    data: { is_active: activate },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message || 'Failed to update status');
                        }
                    }
                });
            }
        }

        function deleteCategory(id) {
            if (confirm('Are you sure you want to delete this category? This action cannot be undone.')) {
                $.ajax({
                    url: '/admin/categories/' + id + '/delete',
                    method: 'POST',
                    data: { _method: 'DELETE' },
                    success: function(response) {
                        if (response.success) {
                            alert('Category deleted successfully');
                            location.reload();
                        } else {
                            alert(response.message || 'Failed to delete category');
                        }
                    }
                });
            }
        }
    </script>
</body>
</html>
