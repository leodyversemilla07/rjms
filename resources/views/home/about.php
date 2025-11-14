<?php
// Set page metadata
$title = 'About Us - Research Journal Management System';
$description = 'RJMS - Research Journal Management System';
$keywords = 'research, journal, academic publishing';

// Start output buffering
ob_start();
?>


    <!-- Page Header -->
    <div class="bg-slate-800 text-white border-b-4 border-primary-700">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">About RJMS</h1>
                <p class="text-xl text-slate-200">Advancing Scholarly Communication Through Innovation</p>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-slate-200">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center text-sm text-slate-600">
                <a href="/" class="hover:text-primary-700"><i class="fas fa-home mr-2"></i>Home</a>
                <i class="fas fa-chevron-right mx-3 text-slate-400"></i>
                <span class="text-slate-800 font-medium">About</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        
        <!-- Mission Statement -->
        <div class="max-w-4xl mx-auto mb-16">
            <div class="bg-white rounded-xl shadow-card border-2 border-primary-200 p-8 md:p-12">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-100 rounded-full mb-4">
                        <i class="fas fa-bullseye text-primary-700 text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-serif font-bold text-slate-800 mb-4">Our Mission</h2>
                </div>
                <p class="text-lg text-slate-700 leading-relaxed mb-4">
                    The Research Journal Management System (RJMS) is dedicated to revolutionizing the way academic 
                    research is submitted, reviewed, and published. We provide a comprehensive platform that streamlines 
                    the entire scholarly publishing workflow while maintaining the highest standards of academic integrity.
                </p>
                <p class="text-lg text-slate-700 leading-relaxed">
                    Our commitment is to foster transparent, efficient, and accessible scholarly communication that 
                    advances knowledge across all disciplines.
                </p>
            </div>
        </div>

        <!-- Core Values -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-serif font-bold text-slate-800 mb-3">Our Core Values</h2>
                <p class="text-slate-600">Principles that guide everything we do</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Value 1 -->
                <div class="bg-white rounded-lg border-2 border-slate-200 p-6 hover:border-primary-600 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-shield-alt text-primary-700 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-2">Integrity</h3>
                    <p class="text-sm text-slate-600">Upholding the highest standards of academic honesty and ethical research practices.</p>
                </div>

                <!-- Value 2 -->
                <div class="bg-white rounded-lg border-2 border-slate-200 p-6 hover:border-primary-600 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-users text-primary-700 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-2">Collaboration</h3>
                    <p class="text-sm text-slate-600">Fostering partnerships between authors, reviewers, and editors worldwide.</p>
                </div>

                <!-- Value 3 -->
                <div class="bg-white rounded-lg border-2 border-slate-200 p-6 hover:border-primary-600 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-lightbulb text-primary-700 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-2">Innovation</h3>
                    <p class="text-sm text-slate-600">Continuously improving our platform with cutting-edge technology.</p>
                </div>

                <!-- Value 4 -->
                <div class="bg-white rounded-lg border-2 border-slate-200 p-6 hover:border-primary-600 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-globe text-primary-700 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-2">Accessibility</h3>
                    <p class="text-sm text-slate-600">Making scholarly publishing accessible to researchers everywhere.</p>
                </div>
            </div>
        </div>

        <!-- What We Offer -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-serif font-bold text-slate-800 mb-3">What We Offer</h2>
                <p class="text-slate-600">Comprehensive solutions for the entire publishing lifecycle</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- For Authors -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-primary-700 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-pen-fancy text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-serif font-bold text-slate-800">For Authors</h3>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Easy manuscript submission and tracking</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Real-time status updates and notifications</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Transparent peer review process</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Comprehensive submission guidelines</span>
                        </li>
                    </ul>
                </div>

                <!-- For Reviewers -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-primary-700 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-user-check text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-serif font-bold text-slate-800">For Reviewers</h3>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Efficient review workflow management</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Structured review forms and templates</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Double-blind peer review support</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Recognition for valuable contributions</span>
                        </li>
                    </ul>
                </div>

                <!-- For Editors -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-primary-700 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-user-tie text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-serif font-bold text-slate-800">For Editors</h3>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Comprehensive editorial dashboard</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Automated reviewer assignment tools</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Decision tracking and analytics</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Communication management system</span>
                        </li>
                    </ul>
                </div>

                <!-- For Institutions -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-primary-700 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-university text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-serif font-bold text-slate-800">For Institutions</h3>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Complete journal management solution</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Customizable branding and workflows</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Advanced reporting and metrics</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-slate-700">Dedicated support and training</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="bg-primary-800 rounded-2xl shadow-2xl p-12 mb-16">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-serif font-bold text-white mb-2">Our Impact</h2>
                <p class="text-primary-100">Supporting research excellence worldwide</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-white mb-2">500+</div>
                    <div class="text-primary-100 text-sm">Published Articles</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-white mb-2">200+</div>
                    <div class="text-primary-100 text-sm">Active Authors</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-white mb-2">50+</div>
                    <div class="text-primary-100 text-sm">Expert Reviewers</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-white mb-2">30+</div>
                    <div class="text-primary-100 text-sm">Countries</div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="max-w-4xl mx-auto text-center">
            <div class="bg-white rounded-xl shadow-card border border-slate-200 p-8 md:p-12">
                <h2 class="text-3xl font-serif font-bold text-slate-800 mb-4">Join Our Community</h2>
                <p class="text-lg text-slate-600 mb-8">
                    Become part of a growing network of researchers, reviewers, and institutions 
                    committed to advancing scholarly communication.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/register" class="inline-flex items-center justify-center bg-primary-700 hover:bg-primary-800 text-white font-semibold py-3 px-8 rounded-lg transition-colors">
                        <i class="fas fa-user-plus mr-2"></i>Create Account
                    </a>
                    <a href="/contact" class="inline-flex items-center justify-center border-2 border-primary-700 text-primary-700 hover:bg-primary-50 font-semibold py-3 px-8 rounded-lg transition-colors">
                        <i class="fas fa-envelope mr-2"></i>Contact Us
                    </a>
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
