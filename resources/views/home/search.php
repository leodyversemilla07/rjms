<?php
// Set page metadata
$title = 'Search - Research Journal Management System';
$description = 'RJMS - Research Journal Management System';
$keywords = 'research, journal, academic publishing';

// Start output buffering
ob_start();
?>


    <!-- Page Header -->
    <div class="bg-slate-800 text-white border-b-4 border-primary-700">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Search Articles</h1>
                <p class="text-xl text-slate-200">Discover research across all disciplines</p>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-slate-200">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center text-sm text-slate-600">
                <a href="/" class="hover:text-primary-700"><i class="fas fa-home mr-2"></i>Home</a>
                <i class="fas fa-chevron-right mx-3 text-slate-400"></i>
                <span class="text-slate-800 font-medium">Search</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">

        <!-- Search Box -->
        <div class="max-w-4xl mx-auto mb-12">
            <div class="bg-white rounded-xl shadow-xl border-2 border-slate-200 p-8">
                <form action="/search" method="GET" class="space-y-4">
                    <!-- Main Search Input -->
                    <div class="relative">
                        <input 
                            type="text" 
                            name="q"
                            placeholder="Search by title, author, keywords, or abstract..." 
                            class="w-full px-6 py-4 pr-32 text-lg border-2 border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                        >
                        <button 
                            type="submit"
                            class="absolute right-2 top-2 bg-primary-700 hover:bg-primary-800 text-white font-semibold px-6 py-2 rounded-lg transition-colors"
                        >
                            <i class="fas fa-search mr-2"></i>Search
                        </button>
                    </div>

                    <!-- Advanced Search Toggle -->
                    <div class="flex items-center justify-between">
                        <button 
                            type="button"
                            @click="showFilters = !showFilters"
                            class="text-primary-700 hover:text-primary-800 font-medium text-sm flex items-center"
                        >
                            <i class="fas fa-sliders-h mr-2"></i>
                            <span x-text="showFilters ? 'Hide Advanced Filters' : 'Show Advanced Filters'"></span>
                            <i class="fas fa-chevron-down ml-2 transition-transform" :class="{ 'rotate-180': showFilters }"></i>
                        </button>
                        <a href="/search" class="text-slate-500 hover:text-slate-700 text-sm">
                            <i class="fas fa-redo mr-1"></i>Clear All
                        </a>
                    </div>

                    <!-- Advanced Filters -->
                    <div x-show="showFilters" x-collapse class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-slate-200">
                        <!-- Author -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Author</label>
                            <input 
                                type="text" 
                                name="author"
                                placeholder="Author name"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            >
                        </div>

                        <!-- Year -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Publication Year</label>
                            <div class="grid grid-cols-2 gap-2">
                                <input 
                                    type="number" 
                                    name="year_from"
                                    placeholder="From"
                                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                >
                                <input 
                                    type="number" 
                                    name="year_to"
                                    placeholder="To"
                                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                >
                            </div>
                        </div>

                        <!-- Subject -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Subject Area</label>
                            <select 
                                name="subject"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            >
                                <option value="">All Subjects</option>
                                <option>Computer Science</option>
                                <option>Engineering</option>
                                <option>Medicine</option>
                                <option>Social Sciences</option>
                                <option>Natural Sciences</option>
                                <option>Humanities</option>
                            </select>
                        </div>

                        <!-- Article Type -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Article Type</label>
                            <select 
                                name="type"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            >
                                <option value="">All Types</option>
                                <option>Research Article</option>
                                <option>Review Article</option>
                                <option>Case Study</option>
                                <option>Short Communication</option>
                                <option>Editorial</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Search Tips -->
            <div class="mt-6 bg-primary-50 border-l-4 border-primary-600 rounded-r-lg p-4">
                <h4 class="text-sm font-semibold text-slate-800 mb-2">
                    <i class="fas fa-lightbulb text-primary-700 mr-2"></i>Search Tips
                </h4>
                <ul class="text-sm text-slate-600 space-y-1">
                    <li>• Use quotes for exact phrases: "machine learning"</li>
                    <li>• Use AND, OR, NOT for boolean searches</li>
                    <li>• Use * as a wildcard: comput* finds computer, computing, etc.</li>
                </ul>
            </div>
        </div>

        <!-- Sample Results Section -->
        <div class="max-w-6xl mx-auto">
            
            <!-- Results Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-serif font-bold text-slate-800 mb-1">Search Results</h2>
                    <p class="text-slate-600">Showing recent articles • Use search above to filter</p>
                </div>
                <div>
                    <select class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <option>Most Relevant</option>
                        <option>Most Recent</option>
                        <option>Most Cited</option>
                        <option>Title A-Z</option>
                    </select>
                </div>
            </div>

            <!-- Result Card 1 -->
            <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 mb-6 hover:shadow-lg transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <span class="inline-block bg-primary-100 text-primary-800 text-xs font-semibold px-3 py-1 rounded-full mb-2">
                            Research Article
                        </span>
                        <h3 class="text-xl font-serif font-bold text-slate-800 mb-2 hover:text-primary-700 cursor-pointer">
                            <a href="/article/123">
                                Advances in Machine Learning for Medical Diagnosis: A Comprehensive Review
                            </a>
                        </h3>
                        <p class="text-sm text-slate-600 mb-3">
                            <i class="fas fa-user mr-1"></i>
                            <strong>Authors:</strong> Dr. Sarah Johnson, Prof. Michael Chen, Dr. Emily Rodriguez
                        </p>
                    </div>
                    <button class="text-slate-400 hover:text-primary-700 ml-4">
                        <i class="far fa-bookmark text-xl"></i>
                    </button>
                </div>

                <p class="text-slate-700 mb-4 leading-relaxed">
                    This comprehensive review examines recent developments in machine learning algorithms applied to medical 
                    diagnostics, highlighting their impact on early disease detection and treatment planning...
                </p>

                <div class="flex flex-wrap gap-4 text-sm text-slate-600 mb-4">
                    <span><i class="far fa-calendar mr-1"></i>Published: Oct 2024</span>
                    <span><i class="fas fa-folder mr-1"></i>Computer Science, Medicine</span>
                    <span><i class="fas fa-eye mr-1"></i>1,245 views</span>
                    <span><i class="fas fa-quote-right mr-1"></i>23 citations</span>
                </div>

                <div class="flex gap-3">
                    <a href="/article/123" class="inline-flex items-center text-primary-700 hover:text-primary-800 font-semibold text-sm">
                        <i class="fas fa-file-pdf mr-2"></i>View PDF
                    </a>
                    <a href="/article/123/abstract" class="inline-flex items-center text-primary-700 hover:text-primary-800 font-semibold text-sm">
                        <i class="fas fa-info-circle mr-2"></i>Abstract
                    </a>
                    <a href="/article/123/cite" class="inline-flex items-center text-primary-700 hover:text-primary-800 font-semibold text-sm">
                        <i class="fas fa-quote-left mr-2"></i>Cite
                    </a>
                </div>
            </div>

            <!-- Result Card 2 -->
            <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 mb-6 hover:shadow-lg transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full mb-2">
                            Review Article
                        </span>
                        <h3 class="text-xl font-serif font-bold text-slate-800 mb-2 hover:text-primary-700 cursor-pointer">
                            <a href="/article/124">
                                Sustainable Development Goals: Progress, Challenges, and Future Directions
                            </a>
                        </h3>
                        <p class="text-sm text-slate-600 mb-3">
                            <i class="fas fa-user mr-1"></i>
                            <strong>Authors:</strong> Prof. James Anderson, Dr. Maria Santos
                        </p>
                    </div>
                    <button class="text-primary-700 ml-4">
                        <i class="fas fa-bookmark text-xl"></i>
                    </button>
                </div>

                <p class="text-slate-700 mb-4 leading-relaxed">
                    An in-depth analysis of global progress toward the United Nations Sustainable Development Goals, 
                    examining both achievements and persistent challenges in environmental sustainability...
                </p>

                <div class="flex flex-wrap gap-4 text-sm text-slate-600 mb-4">
                    <span><i class="far fa-calendar mr-1"></i>Published: Sep 2024</span>
                    <span><i class="fas fa-folder mr-1"></i>Social Sciences, Environment</span>
                    <span><i class="fas fa-eye mr-1"></i>2,890 views</span>
                    <span><i class="fas fa-quote-right mr-1"></i>45 citations</span>
                </div>

                <div class="flex gap-3">
                    <a href="/article/124" class="inline-flex items-center text-primary-700 hover:text-primary-800 font-semibold text-sm">
                        <i class="fas fa-file-pdf mr-2"></i>View PDF
                    </a>
                    <a href="/article/124/abstract" class="inline-flex items-center text-primary-700 hover:text-primary-800 font-semibold text-sm">
                        <i class="fas fa-info-circle mr-2"></i>Abstract
                    </a>
                    <a href="/article/124/cite" class="inline-flex items-center text-primary-700 hover:text-primary-800 font-semibold text-sm">
                        <i class="fas fa-quote-left mr-2"></i>Cite
                    </a>
                </div>
            </div>

            <!-- Result Card 3 -->
            <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 mb-6 hover:shadow-lg transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <span class="inline-block bg-amber-100 text-amber-800 text-xs font-semibold px-3 py-1 rounded-full mb-2">
                            Case Study
                        </span>
                        <h3 class="text-xl font-serif font-bold text-slate-800 mb-2 hover:text-primary-700 cursor-pointer">
                            <a href="/article/125">
                                Blockchain Technology in Supply Chain Management: Real-World Implementation
                            </a>
                        </h3>
                        <p class="text-sm text-slate-600 mb-3">
                            <i class="fas fa-user mr-1"></i>
                            <strong>Authors:</strong> Dr. Robert Kim, Prof. Lisa Martinez
                        </p>
                    </div>
                    <button class="text-slate-400 hover:text-primary-700 ml-4">
                        <i class="far fa-bookmark text-xl"></i>
                    </button>
                </div>

                <p class="text-slate-700 mb-4 leading-relaxed">
                    This case study presents a detailed examination of blockchain implementation in a multinational 
                    supply chain, documenting challenges, solutions, and measurable outcomes...
                </p>

                <div class="flex flex-wrap gap-4 text-sm text-slate-600 mb-4">
                    <span><i class="far fa-calendar mr-1"></i>Published: Aug 2024</span>
                    <span><i class="fas fa-folder mr-1"></i>Business, Technology</span>
                    <span><i class="fas fa-eye mr-1"></i>892 views</span>
                    <span><i class="fas fa-quote-right mr-1"></i>12 citations</span>
                </div>

                <div class="flex gap-3">
                    <a href="/article/125" class="inline-flex items-center text-primary-700 hover:text-primary-800 font-semibold text-sm">
                        <i class="fas fa-file-pdf mr-2"></i>View PDF
                    </a>
                    <a href="/article/125/abstract" class="inline-flex items-center text-primary-700 hover:text-primary-800 font-semibold text-sm">
                        <i class="fas fa-info-circle mr-2"></i>Abstract
                    </a>
                    <a href="/article/125/cite" class="inline-flex items-center text-primary-700 hover:text-primary-800 font-semibold text-sm">
                        <i class="fas fa-quote-left mr-2"></i>Cite
                    </a>
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

<?php
// Get the buffered content
$content = ob_get_clean();

// Include the main layout
include __DIR__ . '/../layouts/main.php';
?>
