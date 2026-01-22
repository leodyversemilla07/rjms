<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard - Research Journal Management System' ?></title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?= $description ?? 'Research Journal Management System - Dashboard' ?>">
    <meta name="keywords" content="<?= $keywords ?? 'research, journal, dashboard, admin' ?>">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Tailwind CSS v4 - Compiled -->
    <link href="/css/tailwind.css" rel="stylesheet">
    
    <?= $additionalCss ?? '' ?>
</head>
<body class="bg-slate-50">
    <?php 
    // Helper function for active menu state
    if (!function_exists('isActive')) {
        function isActive($path, $currentPath) {
            // Exact match or starts with path
            $isActive = ($currentPath === $path || strpos($currentPath, $path . '/') === 0);
            return $isActive ? 'bg-linear-to-r from-indigo-600 to-purple-600 text-white' : 'text-gray-700 hover:bg-gray-100';
        }
    }
    
    $role = $_SESSION['role'] ?? 'user';
    $currentPath = $_SERVER['REQUEST_URI'] ?? '';
    ?>
    
    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false, mobileSidebarOpen: false }">
        
        <!-- Sidebar -->
        <aside class="hidden lg:flex lg:flex-col lg:w-64 bg-white border-r border-gray-200">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-center h-16 px-4 bg-linear-to-r from-indigo-600 to-purple-600">
                <a href="/" class="flex items-center space-x-2 text-white">
                    <i class="fas fa-graduation-cap text-2xl"></i>
                    <span class="font-bold text-xl">RJMS</span>
                </a>
            </div>

            <!-- User Info -->
            <div class="p-4 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-linear-to-r from-indigo-600 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                        <?= strtoupper(substr($_SESSION['username'] ?? 'U', 0, 1)) ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-800 truncate"><?= htmlspecialchars($_SESSION['username'] ?? 'User') ?></p>
                        <p class="text-xs text-gray-500 capitalize"><?= htmlspecialchars($_SESSION['role'] ?? 'user') ?></p>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 overflow-y-auto p-4 space-y-1">
                <?php 
                // Role-based navigation
                if ($role === 'admin'): ?>
                    <a href="/admin/dashboard" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/admin/dashboard', $currentPath) ?>">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a href="/admin/users" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/admin/users', $currentPath) ?>">
                        <i class="fas fa-users w-5"></i>
                        <span class="font-medium">Users</span>
                    </a>
                    <a href="/admin/submissions" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/admin/submissions', $currentPath) ?>">
                        <i class="fas fa-file-alt w-5"></i>
                        <span class="font-medium">Submissions</span>
                    </a>
                    <a href="/admin/categories" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/admin/categories', $currentPath) ?>">
                        <i class="fas fa-folder w-5"></i>
                        <span class="font-medium">Categories</span>
                    </a>
                <?php elseif ($role === 'editor'): ?>
                    <a href="/editor/dashboard" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/editor/dashboard', $currentPath) ?>">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a href="/editor/submissions" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/editor/submissions', $currentPath) ?>">
                        <i class="fas fa-file-alt w-5"></i>
                        <span class="font-medium">Submissions</span>
                    </a>
                    <a href="/editor/reviewers" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/editor/reviewers', $currentPath) ?>">
                        <i class="fas fa-user-check w-5"></i>
                        <span class="font-medium">Reviewers</span>
                    </a>
                <?php elseif ($role === 'reviewer'): ?>
                    <a href="/reviewer/dashboard" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/reviewer/dashboard', $currentPath) ?>">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a href="/reviewer/submissions" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/reviewer/submissions', $currentPath) ?>">
                        <i class="fas fa-file-alt w-5"></i>
                        <span class="font-medium">Assigned Papers</span>
                    </a>
                    <a href="/reviewer/history" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/reviewer/history', $currentPath) ?>">
                        <i class="fas fa-history w-5"></i>
                        <span class="font-medium">Review History</span>
                    </a>
                <?php elseif ($role === 'author'): ?>
                    <a href="/author/dashboard" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/author/dashboard', $currentPath) ?>">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a href="/author/submit" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/author/submit', $currentPath) ?>">
                        <i class="fas fa-plus-circle w-5"></i>
                        <span class="font-medium">Submit Article</span>
                    </a>
                    <a href="/author/manage" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/author/manage', $currentPath) ?>">
                        <i class="fas fa-file-alt w-5"></i>
                        <span class="font-medium">My Articles</span>
                    </a>
                <?php endif; ?>
                
                <!-- Common Links -->
                <div class="pt-4 mt-4 border-t border-gray-200">
                    <a href="/profile" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/profile', $currentPath) ?>">
                        <i class="fas fa-user-circle w-5"></i>
                        <span class="font-medium">Profile</span>
                    </a>
                    <a href="/settings" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/settings', $currentPath) ?>">
                        <i class="fas fa-cog w-5"></i>
                        <span class="font-medium">Settings</span>
                    </a>
                    <a href="/logout" class="sidebar-link flex items-center space-x-3 px-4 py-3 text-red-600 rounded-lg hover:bg-red-50 transition">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span class="font-medium">Logout</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Mobile Sidebar Overlay -->
        <div x-show="mobileSidebarOpen" 
             @click="mobileSidebarOpen = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"></div>

        <!-- Mobile Sidebar -->
        <aside x-show="mobileSidebarOpen"
               @click.away="mobileSidebarOpen = false"
               x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="-translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition ease-in duration-200"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="-translate-x-full"
               class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 z-50 lg:hidden transform">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-4 bg-linear-to-r from-indigo-600 to-purple-600">
                <a href="/" class="flex items-center space-x-2 text-white">
                    <i class="fas fa-graduation-cap text-2xl"></i>
                    <span class="font-bold text-xl">RJMS</span>
                </a>
                <button @click="mobileSidebarOpen = false" class="text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- User Info -->
            <div class="p-4 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-linear-to-r from-indigo-600 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                        <?= strtoupper(substr($_SESSION['username'] ?? 'U', 0, 1)) ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-800 truncate"><?= htmlspecialchars($_SESSION['username'] ?? 'User') ?></p>
                        <p class="text-xs text-gray-500 capitalize"><?= htmlspecialchars($_SESSION['role'] ?? 'user') ?></p>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation (same as desktop) -->
            <nav class="overflow-y-auto p-4 space-y-1" style="height: calc(100vh - 180px);">
                <?php if ($role === 'admin'): ?>
                    <a href="/admin/dashboard" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/admin/dashboard', $currentPath) ?>">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a href="/admin/users" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/admin/users', $currentPath) ?>">
                        <i class="fas fa-users w-5"></i>
                        <span class="font-medium">Users</span>
                    </a>
                    <a href="/admin/submissions" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/admin/submissions', $currentPath) ?>">
                        <i class="fas fa-file-alt w-5"></i>
                        <span class="font-medium">Submissions</span>
                    </a>
                    <a href="/admin/categories" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/admin/categories', $currentPath) ?>">
                        <i class="fas fa-folder w-5"></i>
                        <span class="font-medium">Categories</span>
                    </a>
                <?php elseif ($role === 'editor'): ?>
                    <a href="/editor/dashboard" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/editor/dashboard', $currentPath) ?>">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a href="/editor/submissions" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/editor/submissions', $currentPath) ?>">
                        <i class="fas fa-file-alt w-5"></i>
                        <span class="font-medium">Submissions</span>
                    </a>
                    <a href="/editor/reviewers" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/editor/reviewers', $currentPath) ?>">
                        <i class="fas fa-user-check w-5"></i>
                        <span class="font-medium">Reviewers</span>
                    </a>
                <?php elseif ($role === 'reviewer'): ?>
                    <a href="/reviewer/dashboard" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/reviewer/dashboard', $currentPath) ?>">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a href="/reviewer/submissions" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/reviewer/submissions', $currentPath) ?>">
                        <i class="fas fa-file-alt w-5"></i>
                        <span class="font-medium">Assigned Papers</span>
                    </a>
                    <a href="/reviewer/history" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/reviewer/history', $currentPath) ?>">
                        <i class="fas fa-history w-5"></i>
                        <span class="font-medium">Review History</span>
                    </a>
                <?php elseif ($role === 'author'): ?>
                    <a href="/author/dashboard" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/author/dashboard', $currentPath) ?>">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a href="/author/submit" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/author/submit', $currentPath) ?>">
                        <i class="fas fa-plus-circle w-5"></i>
                        <span class="font-medium">Submit Article</span>
                    </a>
                    <a href="/author/manage" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/author/manage', $currentPath) ?>">
                        <i class="fas fa-file-alt w-5"></i>
                        <span class="font-medium">My Articles</span>
                    </a>
                <?php endif; ?>
                
                <div class="pt-4 mt-4 border-t border-gray-200">
                    <a href="/profile" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/profile', $currentPath) ?>">
                        <i class="fas fa-user-circle w-5"></i>
                        <span class="font-medium">Profile</span>
                    </a>
                    <a href="/settings" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg transition <?= isActive('/settings', $currentPath) ?>">
                        <i class="fas fa-cog w-5"></i>
                        <span class="font-medium">Settings</span>
                    </a>
                    <a href="/logout" class="sidebar-link flex items-center space-x-3 px-4 py-3 text-red-600 rounded-lg hover:bg-red-50 transition">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span class="font-medium">Logout</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation Bar -->
            <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-4 lg:px-6">
                <!-- Mobile Menu Button -->
                <button @click="mobileSidebarOpen = !mobileSidebarOpen" class="lg:hidden text-gray-600 hover:text-gray-800">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Page Title (optional, can be overridden) -->
                <div class="flex-1 lg:ml-0 ml-4">
                    <h1 class="text-xl font-semibold text-gray-800 capitalize">
                        <?= ucfirst($_SESSION['role'] ?? 'User') ?> Dashboard
                    </h1>
                </div>

                <!-- Right Side - Notifications & User -->
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <button class="relative p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition" title="Notifications">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span>
                    </button>

                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                            <div class="w-8 h-8 bg-linear-to-r from-indigo-600 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                <?= strtoupper(substr($_SESSION['username'] ?? 'U', 0, 1)) ?>
                            </div>
                            <span class="hidden md:inline font-medium text-gray-700"><?= htmlspecialchars($_SESSION['username'] ?? 'User') ?></span>
                            <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-200">
                            <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                                <i class="fas fa-user-circle mr-2"></i>Profile
                            </a>
                            <a href="/settings" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                                <i class="fas fa-cog mr-2"></i>Settings
                            </a>
                            <hr class="my-2">
                            <a href="/logout" class="block px-4 py-2 text-red-600 hover:bg-red-50 transition">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Flash Messages -->
            <?php if (isset($_SESSION['flash'])): ?>
                <div class="px-4 lg:px-6 mt-4">
                    <?php foreach ($_SESSION['flash'] as $key => $message): ?>
                        <?php if ($key !== 'old' && $key !== 'errors'): ?>
                            <?php 
                            $alertClass = 'bg-blue-50 border-blue-400 text-blue-800';
                            $iconClass = 'fa-info-circle text-blue-600';
                            if ($key === 'error' || $key === 'danger') {
                                $alertClass = 'bg-red-50 border-red-400 text-red-800';
                                $iconClass = 'fa-exclamation-circle text-red-600';
                            } elseif ($key === 'success') {
                                $alertClass = 'bg-green-50 border-green-400 text-green-800';
                                $iconClass = 'fa-check-circle text-green-600';
                            } elseif ($key === 'warning') {
                                $alertClass = 'bg-amber-50 border-amber-400 text-amber-800';
                                $iconClass = 'fa-exclamation-triangle text-amber-600';
                            }
                            ?>
                            <div class="border-l-4 p-4 mb-3 rounded-r-lg <?= $alertClass ?> shadow-sm" role="alert" x-data="{ show: true }" x-show="show" x-transition>
                                <div class="flex items-start justify-between">
                                    <div class="flex items-start">
                                        <i class="fas <?= $iconClass ?> mr-3 mt-0.5"></i>
                                        <p class="font-medium"><?= htmlspecialchars($message) ?></p>
                                    </div>
                                    <button @click="show = false" class="ml-4 text-lg font-bold opacity-50 hover:opacity-100 transition-opacity">&times;</button>
                                </div>
                            </div>
                            <?php unset($_SESSION['flash'][$key]); ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-slate-50">
                <?= $content ?? '' ?>
            </main>
            
            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4 px-4 lg:px-6">
                <div class="flex flex-col sm:flex-row justify-between items-center text-sm text-gray-600 space-y-2 sm:space-y-0">
                    <p>&copy; <?= date('Y') ?> Research Journal Management System. All rights reserved.</p>
                    <p class="text-gray-500">Version 1.0.0</p>
                </div>
            </footer>
        </div>
    </div>
    
    <!-- Alpine.js for interactive components -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <?= $additionalJs ?? '' ?>
</body>
</html>
