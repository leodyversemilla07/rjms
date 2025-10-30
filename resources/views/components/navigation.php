<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
    <div class="container">
        <!-- Brand/Logo -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="/resources/images/logo.svg" alt="RJMS Logo" height="40" class="me-2">
            <div class="brand-text">
                <strong class="d-block">Research Journal</strong>
                <small class="text-muted d-none d-md-block" style="font-size: 0.75rem;">Management System</small>
            </div>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Main Navigation -->
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="browseDropdown" role="button" data-bs-toggle="dropdown">
                        Browse
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/current-issues">Current Issues</a></li>
                        <li><a class="dropdown-item" href="/archives">Archives</a></li>
                        <li><a class="dropdown-item" href="/search">Search Articles</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown">
                        About
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/about">About Journal</a></li>
                        <li><a class="dropdown-item" href="/editorial-board">Editorial Board</a></li>
                        <li><a class="dropdown-item" href="/submission-guidelines">Submission Guidelines</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/faq">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>
            </ul>
            
            <!-- Right Side Navigation -->
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Logged in user -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
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
                            <li><a class="dropdown-item" href="<?= $dashboardUrl ?>">Dashboard</a></li>
                            <li><a class="dropdown-item" href="/profile">Profile</a></li>
                            <li><a class="dropdown-item" href="/settings">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/logout">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- Guest user -->
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm ms-2" href="/register">Submit Article</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
