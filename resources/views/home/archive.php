<!-- Archive Page -->
<div class="bg-primary-800 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full mb-4 border-2 border-white/20">
                <i class="fas fa-archive text-3xl"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold font-serif mb-4">Journal Archives</h1>
            <p class="text-xl text-primary-100 max-w-2xl mx-auto">
                Browse our complete collection of published research articles organized by year and volume
            </p>
        </div>
    </div>
</div>

<!-- Breadcrumb -->
<div class="bg-slate-100 border-b border-slate-200">
    <div class="container mx-auto px-4 py-3">
        <nav class="flex items-center space-x-2 text-sm">
            <a href="/" class="text-primary-600 hover:text-primary-800 hover:underline">
                <i class="fas fa-home"></i> Home
            </a>
            <i class="fas fa-chevron-right text-slate-400 text-xs"></i>
            <span class="text-slate-600 font-medium">Archives</span>
        </nav>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto px-4 py-12">
    <div class="max-w-6xl mx-auto">
        
        <!-- Filter & Search Section -->
        <div class="bg-white rounded-lg shadow-md border border-slate-200 p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search Box -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        <i class="fas fa-search mr-1"></i> Search Archives
                    </label>
                    <input type="text" 
                           placeholder="Search by title, author, or keywords..."
                           class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                </div>
                
                <!-- Year Filter -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        <i class="fas fa-calendar-alt mr-1"></i> Filter by Year
                    </label>
                    <select class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                        <option value="">All Years</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Archive Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-primary-700 rounded-lg p-6 text-white shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-primary-100 text-sm mb-1">Total Articles</p>
                        <p class="text-3xl font-bold"><?= $stats['total_articles'] ?? 0 ?></p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-file-alt text-2xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-secondary-700 rounded-lg p-6 text-white shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-secondary-100 text-sm mb-1">Total Issues</p>
                        <p class="text-3xl font-bold"><?= $stats['total_issues'] ?? 0 ?></p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-book text-2xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-emerald-700 rounded-lg p-6 text-white shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm mb-1">Authors</p>
                        <p class="text-3xl font-bold"><?= $stats['total_authors'] ?? 0 ?></p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-amber-700 rounded-lg p-6 text-white shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-sm mb-1">Years Active</p>
                        <p class="text-3xl font-bold"><?= $stats['years_active'] ?? 5 ?></p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-calendar text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Archive by Year -->
        <?php 
        $archiveYears = [
            ['year' => 2024, 'volumes' => 2, 'articles' => 24],
            ['year' => 2023, 'volumes' => 4, 'articles' => 48],
            ['year' => 2022, 'volumes' => 4, 'articles' => 45],
            ['year' => 2021, 'volumes' => 4, 'articles' => 42],
            ['year' => 2020, 'volumes' => 4, 'articles' => 38],
        ];
        ?>

        <?php foreach ($archiveYears as $archive): ?>
        <div class="bg-white rounded-lg shadow-md border border-slate-200 mb-6 overflow-hidden">
            <!-- Year Header -->
            <div class="bg-slate-50 border-b-2 border-primary-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-primary-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800 font-serif"><?= $archive['year'] ?></h2>
                            <p class="text-sm text-slate-600">
                                <?= $archive['volumes'] ?> Volume<?= $archive['volumes'] > 1 ? 's' : '' ?> • 
                                <?= $archive['articles'] ?> Article<?= $archive['articles'] > 1 ? 's' : '' ?>
                            </p>
                        </div>
                    </div>
                    <button class="text-primary-600 hover:text-primary-800 font-semibold flex items-center space-x-2" 
                            onclick="this.querySelector('.fa-chevron-down').classList.toggle('rotate-180'); this.closest('.bg-white').querySelector('.year-content').classList.toggle('hidden')">
                        <span>View Volumes</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                </div>
            </div>

            <!-- Year Content -->
            <div class="year-content hidden">
                <div class="p-6 space-y-4">
                    <?php for ($i = 1; $i <= $archive['volumes']; $i++): ?>
                    <div class="border-l-4 border-primary-500 bg-slate-50 rounded-r-lg p-5 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-slate-800 mb-2">
                                    <i class="fas fa-book-open text-primary-600 mr-2"></i>
                                    Volume <?= $i ?>, Issue <?= $i ?>
                                </h3>
                                <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-slate-600 mb-3">
                                    <span><i class="fas fa-calendar text-slate-400 mr-1"></i> Published: <?= date('F', mktime(0, 0, 0, $i * 3, 1)) ?> <?= $archive['year'] ?></span>
                                    <span><i class="fas fa-file-alt text-slate-400 mr-1"></i> <?= rand(8, 15) ?> Articles</span>
                                    <span><i class="fas fa-download text-slate-400 mr-1"></i> <?= rand(100, 500) ?> Downloads</span>
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">Computer Science</span>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Engineering</span>
                                    <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-medium">Technology</span>
                                </div>
                            </div>
                            <div class="flex flex-col space-y-2 ml-4">
                                <a href="/issue/<?= $archive['year'] ?>/<?= $i ?>" 
                                   class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors text-sm font-medium text-center whitespace-nowrap">
                                    <i class="fas fa-eye mr-1"></i> View Issue
                                </a>
                                <a href="/download/<?= $archive['year'] ?>/<?= $i ?>" 
                                   class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 transition-colors text-sm font-medium text-center whitespace-nowrap">
                                    <i class="fas fa-download mr-1"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- Call to Action -->
        <div class="bg-primary-800 rounded-lg shadow-xl p-8 text-white text-center mt-12">
            <div class="max-w-2xl mx-auto">
                <i class="fas fa-file-upload text-5xl mb-4 opacity-90"></i>
                <h3 class="text-2xl font-bold mb-3">Submit Your Research</h3>
                <p class="text-primary-100 mb-6">
                    Join our growing community of researchers and contribute to the advancement of knowledge
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="/submission-guidelines" class="px-6 py-3 bg-white text-primary-700 rounded-lg font-semibold hover:bg-primary-50 transition-colors">
                        <i class="fas fa-book-open mr-2"></i> Submission Guidelines
                    </a>
                    <a href="/register" class="px-6 py-3 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-500 transition-colors border-2 border-white/30">
                        <i class="fas fa-user-plus mr-2"></i> Create Account
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Alpine.js for interactivity -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
