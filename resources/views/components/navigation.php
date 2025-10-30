<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <i class="fas fa-graduation-cap me-2"></i>
            <strong>RJMS</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/"><i class="fas fa-home me-1"></i>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about"><i class="fas fa-info-circle me-1"></i>About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/current-issues"><i class="fas fa-book me-1"></i>Current Issues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/faq"><i class="fas fa-question-circle me-1"></i>FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact"><i class="fas fa-envelope me-1"></i>Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Logged in user -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            <?= htmlspecialchars($_SESSION['username'] ?? 'User') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php 
                            $role = $_SESSION['role'] ?? '';
                            $dashboardMap = [
                                'admin' => '/admin/dashboard',
                                'editor' => '/editor/dashboard',
                                'reviewer' => '/reviewer/dashboard',
                                'author' => '/author/dashboard'
                            ];
                            $dashboardUrl = $dashboardMap[$role] ?? '/';
                            ?>
                            <li><a class="dropdown-item" href="<?= $dashboardUrl ?>">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/profile">
                                <i class="fas fa-user me-2"></i>Profile
                            </a></li>
                            <li><a class="dropdown-item" href="/settings">
                                <i class="fas fa-cog me-2"></i>Settings
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/logout">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- Guest user -->
                    <li class="nav-item">
                        <a class="nav-link" href="/login">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white ms-2" href="/register">
                            <i class="fas fa-user-plus me-1"></i>Register
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
