<?php
// Set page metadata
$title = 'User Management - Research Journal Management System';
$description = 'Manage system users and their roles';
$keywords = 'admin, users, management, roles';

$users = $users ?? [];

// Helper function
function getRoleColor($role) {
    $colors = [
        'admin' => 'bg-red-100 text-red-700',
        'editor' => 'bg-primary-100 text-primary-700',
        'reviewer' => 'bg-blue-100 text-blue-700',
        'author' => 'bg-green-100 text-green-700'
    ];
    return $colors[$role] ?? 'bg-slate-100 text-slate-700';
}

// Start output buffering
ob_start();
?>
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-users me-3"></i>User Management</h1>
                    <p class="mb-0">Manage system users and their roles</p>
                </div>
                <div class="col-md-4 text-end">
                    <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fas fa-user-plus me-2"></i>Add New User
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid px-4 mb-5">
        <?php if (isset($_SESSION['flash'])): ?>
            <?php foreach ($_SESSION['flash'] as $type => $message): ?>
                <div class="alert alert-<?= $type ?> alert-dismissible fade show">
                    <?= htmlspecialchars($message) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['flash'][$type]); ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="content-card">
            <div class="table-responsive">
                <table id="usersTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user->id ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle me-2" 
                                             style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                            <?= strtoupper(substr($user->first_name, 0, 1)) ?>
                                        </div>
                                        <div>
                                            <strong><?= htmlspecialchars($user->getFullName()) ?></strong>
                                            <?php if (!empty($user->affiliation)): ?>
                                                <br><small class="text-muted"><?= htmlspecialchars($user->affiliation) ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($user->email) ?></td>
                                <td><?= htmlspecialchars($user->username) ?></td>
                                <td>
                                    <span class="role-badge <?= getRoleColor($user->role) ?>">
                                        <?= ucfirst($user->role) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($user->is_active): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('M d, Y', strtotime($user->created_at)) ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button onclick="viewUser(<?= $user->id ?>)" 
                                                class="btn btn-sm btn-outline-primary action-btn" 
                                                title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="editUser(<?= $user->id ?>)" 
                                                class="btn btn-sm btn-outline-secondary action-btn" 
                                                title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="toggleUserStatus(<?= $user->id ?>, <?= $user->is_active ? 'false' : 'true' ?>)" 
                                                class="btn btn-sm btn-outline-warning action-btn" 
                                                title="<?= $user->is_active ? 'Deactivate' : 'Activate' ?>">
                                            <i class="fas fa-<?= $user->is_active ? 'ban' : 'check' ?>"></i>
                                        </button>
                                        <?php if (!$user->isAdmin()): ?>
                                            <button onclick="deleteUser(<?= $user->id ?>)" 
                                                    class="btn btn-sm btn-outline-danger action-btn" 
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="addUserForm" method="POST" action="/admin/users/create">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name *</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name *</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username *</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password *</label>
                                <input type="password" class="form-control" id="password" name="password" required minlength="6">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label">Role *</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="author">Author</option>
                                    <option value="reviewer">Reviewer</option>
                                    <option value="editor">Editor</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="affiliation" class="form-label">Affiliation</label>
                            <input type="text" class="form-control" id="affiliation" name="affiliation">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active User
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                order: [[0, 'desc']],
                pageLength: 25,
                language: {
                    search: "Search users:",
                    lengthMenu: "Show _MENU_ users per page"
                }
            });
        });

        $('#addUserForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/admin/users/create',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('User created successfully!');
                        location.reload();
                    } else {
                        alert(response.message || 'Failed to create user');
                    }
                },
                error: function(xhr) {
                    alert(xhr.responseJSON?.message || 'An error occurred');
                }
            });
        });

        function viewUser(id) {
            window.location.href = '/admin/users/' + id;
        }

        function editUser(id) {
            window.location.href = '/admin/users/' + id + '/edit';
        }

        function toggleUserStatus(id, activate) {
            const action = activate ? 'activate' : 'deactivate';
            if (confirm('Are you sure you want to ' + action + ' this user?')) {
                $.ajax({
                    url: '/admin/users/' + id + '/toggle-status',
                    method: 'POST',
                    data: { is_active: activate },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message || 'Failed to update user status');
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            }
        }

        function deleteUser(id) {
            if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                $.ajax({
                    url: '/admin/users/' + id + '/delete',
                    method: 'POST',
                    data: { _method: 'DELETE' },
                    success: function(response) {
                        if (response.success) {
                            alert('User deleted successfully');
                            location.reload();
                        } else {
                            alert(response.message || 'Failed to delete user');
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
// Get the buffered content
$content = ob_get_clean();

// Include the main layout
include __DIR__ . '/../layouts/main.php';
?>
