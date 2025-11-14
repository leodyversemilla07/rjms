<?php
$title = 'Research Journal Management System - Advancing Scholarly Communication';
$description = 'A comprehensive platform for managing scholarly publications, peer reviews, and editorial workflows';
$keywords = 'research, journal, academic publishing, peer review, scholarly communication, manuscript submission';

ob_start();
?>

<!-- Hero Section -->
    <div class="bg-slate-800 text-white">
        <div class="container mx-auto px-4 py-20">
            <div class="max-w-4xl mx-auto text-center">
                <div class="mb-6">
                    <span class="inline-block px-4 py-1 bg-primary-600/20 border border-primary-400/30 rounded-full text-sm font-medium text-primary-100 mb-6">
                        Peer-Reviewed Academic Journal Platform
                    </span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6 leading-tight text-white">
                    Research Journal<br/>Management System
                </h1>
                <p class="text-xl md:text-2xl text-slate-200 mb-8 leading-relaxed">
                    A comprehensive platform for managing scholarly publications, peer reviews, and editorial workflows
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/register" class="inline-flex items-center justify-center bg-white text-primary-700 font-semibold py-4 px-8 rounded-lg hover:bg-slate-100 transition-all shadow-lg hover:shadow-xl">
                        <i class="fas fa-file-upload mr-2"></i>Submit Your Research
                    </a>
                    <a href="/current-issues" class="inline-flex items-center justify-center border-2 border-white text-white font-semibold py-4 px-8 rounded-lg hover:bg-white hover:text-slate-800 transition-all">
                        <i class="fas fa-book-open mr-2"></i>Browse Publications
                    </a>
                </div>
                
                <!-- Quick Stats -->
                <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20">
                        <div class="text-3xl font-bold text-white mb-1">500+</div>
                        <div class="text-sm text-slate-300">Published Articles</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20">
                        <div class="text-3xl font-bold text-white mb-1">200+</div>
                        <div class="text-sm text-slate-300">Active Authors</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20">
                        <div class="text-3xl font-bold text-white mb-1">50+</div>
                        <div class="text-sm text-slate-300">Expert Reviewers</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20">
                        <div class="text-3xl font-bold text-white mb-1">95%</div>
                        <div class="text-sm text-slate-300">Satisfaction Rate</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcement Bar -->
    <div class="bg-primary-700 text-white py-3">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-center text-sm">
                <i class="fas fa-bullhorn mr-2"></i>
                <span class="font-medium">Latest Issue:</span>
                <span class="ml-2">Volume 12, Issue 3 (2024) now available</span>
                <a href="/current-issues" class="ml-4 underline hover:text-primary-100">Read now →</a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-16">
        
        <!-- About Section -->
        <div class="max-w-4xl mx-auto mb-20 text-center">
            <h2 class="text-3xl md:text-4xl font-serif font-bold mb-6">
                Advancing Scholarly Communication
            </h2>
            <p class="text-lg text-slate-600 leading-relaxed">
                Our platform provides researchers, authors, and academic institutions with a robust system for 
                managing the complete lifecycle of scholarly publications—from initial submission through 
                peer review to final publication.
            </p>
        </div>

        <!-- Key Features -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-serif font-bold mb-3">Platform Features</h2>
                <p class="text-slate-600">Comprehensive tools for every stakeholder in the publishing process</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="bg-white rounded-lg border-2 border-slate-200 p-8 hover:border-primary-600 hover:shadow-lg transition-all group">
                    <div class="w-14 h-14 bg-primary-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-primary-600 transition-colors">
                        <i class="fas fa-file-upload text-2xl text-primary-700 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-3">Streamlined Submission</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Easy-to-use manuscript submission system with real-time tracking and automated workflows for efficient processing.
                    </p>
                </div>

                <!-- Feature Card 2 -->
                <div class="bg-white rounded-lg border-2 border-slate-200 p-8 hover:border-primary-600 hover:shadow-lg transition-all group">
                    <div class="w-14 h-14 bg-primary-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-primary-600 transition-colors">
                        <i class="fas fa-user-friends text-2xl text-primary-700 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-3">Expert Peer Review</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Rigorous double-blind peer review process with qualified reviewers ensuring quality and integrity.
                    </p>
                </div>

                <!-- Feature Card 3 -->
                <div class="bg-white rounded-lg border-2 border-slate-200 p-8 hover:border-primary-600 hover:shadow-lg transition-all group">
                    <div class="w-14 h-14 bg-primary-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-primary-600 transition-colors">
                        <i class="fas fa-tasks text-2xl text-primary-700 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-3">Editorial Management</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Comprehensive dashboard for editors to manage submissions, assign reviewers, and make decisions.
                    </p>
                </div>

                <!-- Feature Card 4 -->
                <div class="bg-white rounded-lg border-2 border-slate-200 p-8 hover:border-primary-600 hover:shadow-lg transition-all group">
                    <div class="w-14 h-14 bg-primary-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-primary-600 transition-colors">
                        <i class="fas fa-chart-line text-2xl text-primary-700 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-3">Analytics & Metrics</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Detailed insights on submissions, review times, acceptance rates, and publication metrics.
                    </p>
                </div>

                <!-- Feature Card 5 -->
                <div class="bg-white rounded-lg border-2 border-slate-200 p-8 hover:border-primary-600 hover:shadow-lg transition-all group">
                    <div class="w-14 h-14 bg-primary-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-primary-600 transition-colors">
                        <i class="fas fa-bell text-2xl text-primary-700 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-3">Smart Notifications</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Automated email alerts and in-system notifications keep everyone informed throughout the process.
                    </p>
                </div>

                <!-- Feature Card 6 -->
                <div class="bg-white rounded-lg border-2 border-slate-200 p-8 hover:border-primary-600 hover:shadow-lg transition-all group">
                    <div class="w-14 h-14 bg-primary-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-primary-600 transition-colors">
                        <i class="fas fa-shield-alt text-2xl text-primary-700 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-3">Secure & Compliant</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Bank-grade security with GDPR compliance ensuring confidentiality and data protection.
                    </p>
                </div>
            </div>
        </div>

        <!-- Submission Process -->
        <div class="bg-white rounded-xl shadow-card border border-slate-200 p-8 md:p-12 mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-serif font-bold mb-3">Publication Process</h2>
                <p class="text-slate-600">From submission to publication in four simple steps</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="relative text-center">
                    <div class="w-20 h-20 bg-primary-700 text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-4 shadow-lg">
                        1
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-2">Submit Manuscript</h4>
                    <p class="text-sm text-slate-600">Upload your research paper and complete the submission form</p>
                    <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-primary-700 -ml-4"></div>
                </div>

                <div class="relative text-center">
                    <div class="w-20 h-20 bg-primary-700 text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-4 shadow-lg">
                        2
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-2">Initial Review</h4>
                    <p class="text-sm text-slate-600">Editorial team conducts preliminary assessment</p>
                    <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-primary-700 -ml-4"></div>
                </div>

                <div class="relative text-center">
                    <div class="w-20 h-20 bg-primary-700 text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-4 shadow-lg">
                        3
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-2">Peer Review</h4>
                    <p class="text-sm text-slate-600">Expert reviewers evaluate and provide feedback</p>
                    <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-primary-700 -ml-4"></div>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-primary-700 text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-4 shadow-lg">
                        4
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-2">Publication</h4>
                    <p class="text-sm text-slate-600">Accepted papers are published and indexed</p>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-primary-800 rounded-2xl shadow-2xl p-8 md:p-12 text-white text-center">
            <h2 class="text-3xl md:text-4xl font-serif font-bold mb-4 text-white">Ready to Publish Your Research?</h2>
            <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
                Join hundreds of researchers worldwide who trust our platform for their scholarly publications
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/register" class="inline-flex items-center justify-center bg-white text-primary-800 font-semibold py-4 px-8 rounded-lg hover:bg-primary-50 transition-all shadow-lg">
                    <i class="fas fa-user-plus mr-2"></i>Create Account
                </a>
                <a href="/submission-guidelines" class="inline-flex items-center justify-center border-2 border-white text-white font-semibold py-4 px-8 rounded-lg hover:bg-white hover:text-primary-800 transition-all">
                    <i class="fas fa-book mr-2"></i>View Guidelines
                </a>
            </div>
        </div>
    </div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
