<?php
// Set page metadata
$title = 'Current Issues - Research Journal Management System';
$description = 'RJMS - Research Journal Management System';
$keywords = 'research, journal, academic publishing';

// Start output buffering
ob_start();
?>


    <!-- Page Header -->
    <div class="bg-slate-800 text-white border-b-4 border-primary-700">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Current Issues</h1>
                <p class="text-xl text-slate-200">Browse the latest published research articles</p>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-slate-200">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center text-sm text-slate-600">
                <a href="/" class="hover:text-primary-700"><i class="fas fa-home mr-2"></i>Home</a>
                <i class="fas fa-chevron-right mx-3 text-slate-400"></i>
                <span class="text-slate-800 font-medium">Current Issues</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">

        <!-- Latest Issue Banner -->
        <div class="bg-primary-800 rounded-xl shadow-xl p-8 md:p-12 mb-12 text-white">
            <div class="flex items-center justify-between flex-wrap gap-6">
                <div class="flex-1">
                    <div class="inline-block bg-white/20 backdrop-blur-sm px-4 py-1 rounded-full text-sm font-semibold mb-3">
                        Latest Issue
                    </div>
                    <h2 class="text-3xl font-serif font-bold mb-2">Volume 5, Issue 2</h2>
                    <p class="text-primary-100 mb-4">October 2024 • 12 Articles</p>
                    <div class="flex gap-3">
                        <a href="/issues/current" class="inline-flex items-center bg-white text-primary-700 hover:bg-primary-50 font-semibold py-2 px-6 rounded-lg transition-colors">
                            <i class="fas fa-book-open mr-2"></i>View Issue
                        </a>
                        <a href="/issues/current/download" class="inline-flex items-center border-2 border-white text-white hover:bg-white hover:text-primary-700 font-semibold py-2 px-6 rounded-lg transition-colors">
                            <i class="fas fa-download mr-2"></i>Download PDF
                        </a>
                    </div>
                </div>
                <div class="text-center">
                    <div class="w-32 h-40 bg-white/10 backdrop-blur-sm rounded-lg border-2 border-white/30 flex items-center justify-center">
                        <div>
                            <i class="fas fa-book text-6xl mb-2 opacity-50"></i>
                            <p class="text-xs">Cover Image</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Sidebar Filters -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 sticky top-6">
                    <h3 class="text-lg font-semibold text-slate-800 mb-6 flex items-center">
                        <i class="fas fa-filter text-primary-700 mr-2"></i>
                        Filter Issues
                    </h3>

                    <!-- Year Filter -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Year</label>
                        <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            <option>All Years</option>
                            <option selected>2024</option>
                            <option>2023</option>
                            <option>2022</option>
                            <option>2021</option>
                        </select>
                    </div>

                    <!-- Volume Filter -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Volume</label>
                        <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            <option>All Volumes</option>
                            <option selected>Volume 5</option>
                            <option>Volume 4</option>
                            <option>Volume 3</option>
                            <option>Volume 2</option>
                            <option>Volume 1</option>
                        </select>
                    </div>

                    <!-- Quick Stats -->
                    <div class="border-t border-slate-200 pt-6">
                        <h4 class="text-sm font-semibold text-slate-700 mb-3">Publication Stats</h4>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-600">Total Issues:</span>
                                <span class="font-semibold text-slate-800">18</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-600">Total Articles:</span>
                                <span class="font-semibold text-slate-800">342</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-600">This Year:</span>
                                <span class="font-semibold text-slate-800">48</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Issues List -->
            <div class="lg:col-span-3">
                
                <!-- Issue Card -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 md:p-8 mb-6 hover:shadow-lg transition-shadow">
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Cover Thumbnail -->
                        <div class="shrink-0">
                            <div class="w-full md:w-32 h-40 bg-primary-100 rounded-lg border-2 border-primary-300 flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-book text-primary-700 text-4xl mb-2"></i>
                                    <p class="text-xs text-primary-700 font-semibold">Vol 5, No 2</p>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full mb-2">
                                        Latest Issue
                                    </span>
                                    <h3 class="text-2xl font-serif font-bold text-slate-800 mb-2">
                                        Volume 5, Issue 2 (2024)
                                    </h3>
                                    <p class="text-slate-600 mb-3">
                                        <i class="far fa-calendar mr-2"></i>Published: October 15, 2024
                                    </p>
                                </div>
                            </div>

                            <p class="text-slate-700 mb-4 leading-relaxed">
                                This issue features groundbreaking research across multiple disciplines, including 
                                advances in artificial intelligence, sustainable development, and medical innovations.
                            </p>

                            <!-- Stats -->
                            <div class="flex flex-wrap gap-6 mb-4 text-sm">
                                <div class="flex items-center text-slate-600">
                                    <i class="fas fa-file-alt text-primary-700 mr-2"></i>
                                    <span><strong class="text-slate-800">12</strong> Articles</span>
                                </div>
                                <div class="flex items-center text-slate-600">
                                    <i class="fas fa-users text-primary-700 mr-2"></i>
                                    <span><strong class="text-slate-800">28</strong> Authors</span>
                                </div>
                                <div class="flex items-center text-slate-600">
                                    <i class="fas fa-eye text-primary-700 mr-2"></i>
                                    <span><strong class="text-slate-800">1,245</strong> Views</span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex flex-wrap gap-3">
                                <a href="/issues/5/2" class="inline-flex items-center bg-primary-700 hover:bg-primary-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                                    <i class="fas fa-book-open mr-2"></i>View Articles
                                </a>
                                <a href="/issues/5/2/download" class="inline-flex items-center border-2 border-primary-700 text-primary-700 hover:bg-primary-50 font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                                    <i class="fas fa-download mr-2"></i>Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Issue Card 2 -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 md:p-8 mb-6 hover:shadow-lg transition-shadow">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="shrink-0">
                            <div class="w-full md:w-32 h-40 bg-slate-100 rounded-lg border-2 border-slate-300 flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-book text-slate-600 text-4xl mb-2"></i>
                                    <p class="text-xs text-slate-700 font-semibold">Vol 5, No 1</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h3 class="text-2xl font-serif font-bold text-slate-800 mb-2">
                                        Volume 5, Issue 1 (2024)
                                    </h3>
                                    <p class="text-slate-600 mb-3">
                                        <i class="far fa-calendar mr-2"></i>Published: July 15, 2024
                                    </p>
                                </div>
                            </div>

                            <p class="text-slate-700 mb-4 leading-relaxed">
                                Featuring comprehensive studies on climate change mitigation, data science applications, 
                                and educational technology innovations.
                            </p>

                            <div class="flex flex-wrap gap-6 mb-4 text-sm">
                                <div class="flex items-center text-slate-600">
                                    <i class="fas fa-file-alt text-primary-700 mr-2"></i>
                                    <span><strong class="text-slate-800">15</strong> Articles</span>
                                </div>
                                <div class="flex items-center text-slate-600">
                                    <i class="fas fa-users text-primary-700 mr-2"></i>
                                    <span><strong class="text-slate-800">32</strong> Authors</span>
                                </div>
                                <div class="flex items-center text-slate-600">
                                    <i class="fas fa-eye text-primary-700 mr-2"></i>
                                    <span><strong class="text-slate-800">2,890</strong> Views</span>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-3">
                                <a href="/issues/5/1" class="inline-flex items-center bg-primary-700 hover:bg-primary-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                                    <i class="fas fa-book-open mr-2"></i>View Articles
                                </a>
                                <a href="/issues/5/1/download" class="inline-flex items-center border-2 border-primary-700 text-primary-700 hover:bg-primary-50 font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                                    <i class="fas fa-download mr-2"></i>Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Issue Card 3 -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 md:p-8 mb-6 hover:shadow-lg transition-shadow">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="shrink-0">
                            <div class="w-full md:w-32 h-40 bg-slate-100 rounded-lg border-2 border-slate-300 flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-book text-slate-600 text-4xl mb-2"></i>
                                    <p class="text-xs text-slate-700 font-semibold">Vol 4, No 4</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h3 class="text-2xl font-serif font-bold text-slate-800 mb-2">
                                        Volume 4, Issue 4 (2023)
                                    </h3>
                                    <p class="text-slate-600 mb-3">
                                        <i class="far fa-calendar mr-2"></i>Published: December 15, 2023
                                    </p>
                                </div>
                            </div>

                            <p class="text-slate-700 mb-4 leading-relaxed">
                                Year-end special issue highlighting the most impactful research of 2023 across all domains.
                            </p>

                            <div class="flex flex-wrap gap-6 mb-4 text-sm">
                                <div class="flex items-center text-slate-600">
                                    <i class="fas fa-file-alt text-primary-700 mr-2"></i>
                                    <span><strong class="text-slate-800">18</strong> Articles</span>
                                </div>
                                <div class="flex items-center text-slate-600">
                                    <i class="fas fa-users text-primary-700 mr-2"></i>
                                    <span><strong class="text-slate-800">41</strong> Authors</span>
                                </div>
                                <div class="flex items-center text-slate-600">
                                    <i class="fas fa-eye text-primary-700 mr-2"></i>
                                    <span><strong class="text-slate-800">3,512</strong> Views</span>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-3">
                                <a href="/issues/4/4" class="inline-flex items-center bg-primary-700 hover:bg-primary-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                                    <i class="fas fa-book-open mr-2"></i>View Articles
                                </a>
                                <a href="/issues/4/4/download" class="inline-flex items-center border-2 border-primary-700 text-primary-700 hover:bg-primary-50 font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                                    <i class="fas fa-download mr-2"></i>Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-8">
                    <nav class="flex items-center gap-2">
                        <button class="px-4 py-2 border-2 border-slate-300 text-slate-400 rounded-lg cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-4 py-2 bg-primary-700 text-white font-semibold rounded-lg">1</button>
                        <button class="px-4 py-2 border-2 border-slate-300 text-slate-700 hover:bg-slate-50 rounded-lg">2</button>
                        <button class="px-4 py-2 border-2 border-slate-300 text-slate-700 hover:bg-slate-50 rounded-lg">3</button>
                        <button class="px-4 py-2 border-2 border-slate-300 text-slate-700 hover:bg-primary-50 hover:border-primary-700 rounded-lg">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>
                </div>

            </div>
        </div>

    </div>

<?php
// Get the buffered content
$content = ob_get_clean();

// Include the main layout
include __DIR__ . '/../layouts/main.php';
?>
