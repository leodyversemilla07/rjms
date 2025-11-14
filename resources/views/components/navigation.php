<nav class="bg-white border-b-2 border-primary-700 sticky top-0 z-50 shadow-sm">
    <div class="container mx-auto px-4">
        <!-- Top bar with branding -->
        <div class="border-b border-slate-200 py-3">
            <div class="flex justify-between items-center">
                <!-- Brand/Logo -->
                <a class="flex items-center space-x-3" href="/">
                    <div class="h-12 w-12 bg-primary-700 rounded flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                    <div>
                        <strong class="block text-lg font-serif text-slate-800">Research Journal</strong>
                        <small class="text-slate-600 text-xs tracking-wide">Management System</small>
                    </div>
                </a>
                
                <!-- Top right actions -->
                <div class="hidden md:flex items-center space-x-4 text-sm">
                    <a href="/help" class="text-slate-600 hover:text-primary-700 flex items-center">
                        <i class="fas fa-question-circle mr-1"></i> Help
                    </a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <span class="text-slate-400">|</span>
                        <div class="flex items-center space-x-2 text-slate-600">
                            <i class="fas fa-user-circle"></i>
                            <span><?= htmlspecialchars($_SESSION['username'] ?? 'User') ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Mobile menu button -->
                <button @click="open = !open" class="md:hidden p-2 rounded text-slate-700 hover:bg-slate-100" x-data="{ open: false }">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Main navigation -->
        <div class="hidden md:flex items-center justify-between py-3">
            <div class="flex items-center space-x-8">
                <a class="text-slate-700 hover:text-primary-700 font-medium transition-colors" href="/">
                    <i class="fas fa-home mr-1"></i> Home
                </a>
                
                <!-- Browse Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseleave="open = false">
                    <button @mouseenter="open = true" class="text-slate-700 hover:text-primary-700 font-medium transition-colors flex items-center">
                        <i class="fas fa-book-open mr-1"></i> Browse
                        <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" @mouseenter="open = true" x-cloak class="absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-slate-200 z-50">
                        <div class="py-1">
                            <a class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary-700" href="/current-issues">
                                <i class="fas fa-newspaper mr-2 w-4"></i> Current Issues
                            </a>
                            <a class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary-700" href="/archives">
                                <i class="fas fa-archive mr-2 w-4"></i> Archives
                            </a>
                            <a class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary-700" href="/search">
                                <i class="fas fa-search mr-2 w-4"></i> Search Articles
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- About Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseleave="open = false">
                    <button @mouseenter="open = true" class="text-slate-700 hover:text-primary-700 font-medium transition-colors flex items-center">
                        <i class="fas fa-info-circle mr-1"></i> About
                        <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" @mouseenter="open = true" x-cloak class="absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-slate-200 z-50">
                        <div class="py-1">
                            <a class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary-700" href="/about">
                                <i class="fas fa-building mr-2 w-4"></i> About Journal
                            </a>
                            <a class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary-700" href="/editorial-board">
                                <i class="fas fa-users mr-2 w-4"></i> Editorial Board
                            </a>
                            <a class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary-700" href="/submission-guidelines">
                                <i class="fas fa-file-alt mr-2 w-4"></i> Submission Guidelines
                            </a>
                        </div>
                    </div>
                </div>
                
                <a class="text-slate-700 hover:text-primary-700 font-medium transition-colors" href="/faq">
                    <i class="far fa-question-circle mr-1"></i> FAQ
                </a>
                <a class="text-slate-700 hover:text-primary-700 font-medium transition-colors" href="/contact">
                    <i class="fas fa-envelope mr-1"></i> Contact
                </a>
            </div>
            
            <!-- Right Side Navigation -->
            <div class="flex items-center space-x-3">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Logged in user -->
                    <div class="relative" x-data="{ open: false }" @mouseleave="open = false">
                        <button @click="open = !open" class="flex items-center space-x-2 text-slate-700 hover:text-primary-700 font-medium px-3 py-2 rounded-md hover:bg-slate-50 transition-colors">
                            <i class="fas fa-user-circle text-lg"></i>
                            <span class="hidden lg:inline"><?= htmlspecialchars($_SESSION['username'] ?? 'User') ?></span>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-cloak class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-slate-200 z-50">
                            <div class="py-1">
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
                                <a class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary-700" href="<?= $dashboardUrl ?>">
                                    <i class="fas fa-tachometer-alt mr-2 w-4"></i> Dashboard
                                </a>
                                <a class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary-700" href="/profile">
                                    <i class="fas fa-user mr-2 w-4"></i> Profile
                                </a>
                                <a class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary-700" href="/settings">
                                    <i class="fas fa-cog mr-2 w-4"></i> Settings
                                </a>
                                <div class="border-t border-slate-200 my-1"></div>
                                <a class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50" href="/logout">
                                    <i class="fas fa-sign-out-alt mr-2 w-4"></i> Logout
                                </a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Guest user -->
                    <a class="text-slate-700 hover:text-primary-700 font-medium transition-colors" href="/login">
                        <i class="fas fa-sign-in-alt mr-1"></i> Login
                    </a>
                    <a class="btn-primary text-sm" href="/register">
                        <i class="fas fa-file-upload mr-1"></i> Submit Article
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</nav>
