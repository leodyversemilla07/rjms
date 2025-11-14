<!-- Page Header -->
<div class="bg-slate-800 text-white border-b-4 border-primary-700">
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Submission Guidelines</h1>
            <p class="text-xl text-slate-200">Comprehensive guide for manuscript preparation and submission</p>
        </div>
    </div>
</div>

<!-- Breadcrumb -->
<div class="bg-white border-b border-slate-200">
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center text-sm text-slate-600">
            <a href="/" class="hover:text-primary-700"><i class="fas fa-home mr-2"></i>Home</a>
            <i class="fas fa-chevron-right mx-3 text-slate-400"></i>
            <span class="text-slate-800 font-medium">Submission Guidelines</span>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 sticky top-24" x-data="{ activeSection: 'overview' }">
                <h3 class="font-bold text-lg mb-4 text-slate-800">Quick Navigation</h3>
                <nav class="space-y-2">
                    <a href="#overview" @click="activeSection = 'overview'" 
                       :class="activeSection === 'overview' ? 'bg-primary-50 text-primary-700 border-primary-700' : 'text-slate-600 hover:bg-slate-50 border-transparent'"
                       class="flex items-center space-x-2 px-3 py-2 rounded-lg border-l-2 transition-all">
                        <i class="fas fa-eye w-4"></i>
                        <span class="text-sm font-medium">Overview</span>
                    </a>
                    <a href="#manuscript" @click="activeSection = 'manuscript'" 
                       :class="activeSection === 'manuscript' ? 'bg-primary-50 text-primary-700 border-primary-700' : 'text-slate-600 hover:bg-slate-50 border-transparent'"
                       class="flex items-center space-x-2 px-3 py-2 rounded-lg border-l-2 transition-all">
                        <i class="fas fa-file-word w-4"></i>
                        <span class="text-sm font-medium">Manuscript Prep</span>
                    </a>
                    <a href="#formatting" @click="activeSection = 'formatting'" 
                       :class="activeSection === 'formatting' ? 'bg-primary-50 text-primary-700 border-primary-700' : 'text-slate-600 hover:bg-slate-50 border-transparent'"
                       class="flex items-center space-x-2 px-3 py-2 rounded-lg border-l-2 transition-all">
                        <i class="fas fa-align-left w-4"></i>
                        <span class="text-sm font-medium">Formatting</span>
                    </a>
                    <a href="#figures" @click="activeSection = 'figures'" 
                       :class="activeSection === 'figures' ? 'bg-primary-50 text-primary-700 border-primary-700' : 'text-slate-600 hover:bg-slate-50 border-transparent'"
                       class="flex items-center space-x-2 px-3 py-2 rounded-lg border-l-2 transition-all">
                        <i class="fas fa-image w-4"></i>
                        <span class="text-sm font-medium">Figures & Tables</span>
                    </a>
                    <a href="#references" @click="activeSection = 'references'" 
                       :class="activeSection === 'references' ? 'bg-primary-50 text-primary-700 border-primary-700' : 'text-slate-600 hover:bg-slate-50 border-transparent'"
                       class="flex items-center space-x-2 px-3 py-2 rounded-lg border-l-2 transition-all">
                        <i class="fas fa-quote-right w-4"></i>
                        <span class="text-sm font-medium">References</span>
                    </a>
                    <a href="#ethics" @click="activeSection = 'ethics'" 
                       :class="activeSection === 'ethics' ? 'bg-primary-50 text-primary-700 border-primary-700' : 'text-slate-600 hover:bg-slate-50 border-transparent'"
                       class="flex items-center space-x-2 px-3 py-2 rounded-lg border-l-2 transition-all">
                        <i class="fas fa-balance-scale w-4"></i>
                        <span class="text-sm font-medium">Ethics</span>
                    </a>
                    <a href="#submission" @click="activeSection = 'submission'" 
                       :class="activeSection === 'submission' ? 'bg-primary-50 text-primary-700 border-primary-700' : 'text-slate-600 hover:bg-slate-50 border-transparent'"
                       class="flex items-center space-x-2 px-3 py-2 rounded-lg border-l-2 transition-all">
                        <i class="fas fa-paper-plane w-4"></i>
                        <span class="text-sm font-medium">Submission Process</span>
                    </a>
                </nav>

                <!-- Quick Actions -->
                <div class="mt-6 pt-6 border-t border-slate-200 space-y-2">
                    <a href="/register" class="block w-full bg-primary-700 hover:bg-primary-800 text-white text-center py-2.5 px-4 rounded-lg transition-colors font-semibold text-sm">
                        <i class="fas fa-user-plus mr-2"></i>Create Account
                    </a>
                    <a href="/contact" class="block w-full border-2 border-primary-700 text-primary-700 hover:bg-primary-50 text-center py-2.5 px-4 rounded-lg transition-colors font-semibold text-sm">
                        <i class="fas fa-question-circle mr-2"></i>Get Help
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="lg:col-span-3 space-y-8">
            
            <?php include __DIR__ . '/sections/overview.php'; ?>
            <?php include __DIR__ . '/sections/manuscript.php'; ?>
            <?php include __DIR__ . '/sections/formatting.php'; ?>
            <?php include __DIR__ . '/sections/figures.php'; ?>
            <?php include __DIR__ . '/sections/references.php'; ?>
            <?php include __DIR__ . '/sections/ethics.php'; ?>
            <?php include __DIR__ . '/sections/submission-process.php'; ?>

            <!-- Call to Action -->
            <div class="bg-primary-800 rounded-xl shadow-xl p-8 md:p-12 text-center text-white">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                        <i class="fas fa-rocket text-4xl"></i>
                    </div>
                </div>
                <h2 class="text-2xl md:text-3xl font-serif font-bold mb-4">Ready to Submit?</h2>
                <p class="text-primary-100 mb-6 max-w-2xl mx-auto">
                    Join our community of researchers and contribute to advancing scientific knowledge. 
                    Our streamlined submission process makes it easy to share your work.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/register" class="inline-flex items-center justify-center bg-white text-primary-700 hover:bg-primary-50 font-semibold py-3 px-8 rounded-lg transition-colors">
                        <i class="fas fa-user-plus mr-2"></i>Create Account
                    </a>
                    <a href="/login" class="inline-flex items-center justify-center border-2 border-white text-white hover:bg-white hover:text-primary-700 font-semibold py-3 px-8 rounded-lg transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login to Submit
                    </a>
                </div>
                <p class="mt-6 text-sm text-primary-100">
                    <i class="fas fa-question-circle mr-1"></i>
                    Have questions? <a href="/contact" class="underline hover:text-white">Contact our editorial office</a>
                </p>
            </div>

        </div>
    </div>
</div>

<!-- Additional JavaScript -->
<?php $additionalJs = <<<'JS'
<script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Update active section on scroll
    const sections = document.querySelectorAll('section[id]');
    
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            if (pageYOffset >= (sectionTop - 100)) {
                current = section.getAttribute('id');
            }
        });
    });
</script>
JS;
?>
