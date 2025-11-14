<?php
// Set page metadata
$title = 'FAQ - Research Journal Management System';
$description = 'RJMS - Research Journal Management System';
$keywords = 'research, journal, academic publishing';

// Start output buffering
ob_start();
?>


    <!-- Page Header -->
    <div class="bg-slate-800 text-white border-b-4 border-primary-700">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Frequently Asked Questions</h1>
                <p class="text-xl text-slate-200">Find answers to common questions about RJMS</p>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-slate-200">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center text-sm text-slate-600">
                <a href="/" class="hover:text-primary-700"><i class="fas fa-home mr-2"></i>Home</a>
                <i class="fas fa-chevron-right mx-3 text-slate-400"></i>
                <span class="text-slate-800 font-medium">FAQ</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        
        <!-- Search Box -->
        <div class="max-w-2xl mx-auto mb-12">
            <div class="relative">
                <input 
                    type="text" 
                    id="faqSearch"
                    placeholder="Search for answers..." 
                    class="w-full px-6 py-4 pr-12 border-2 border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                >
                <i class="fas fa-search absolute right-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
            </div>
        </div>

        <!-- FAQ Categories -->
        <div class="max-w-4xl mx-auto">
            
            <!-- General Questions -->
            <div class="mb-8">
                <h2 class="text-2xl font-serif font-bold text-slate-800 mb-6 flex items-center">
                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-info-circle text-primary-700"></i>
                    </div>
                    General Questions
                </h2>

                <div class="space-y-4" x-data="{ open: null }">
                    <!-- FAQ Item 1 -->
                    <div class="bg-white rounded-lg shadow-card border border-slate-200 overflow-hidden">
                        <button 
                            @click="open = open === 1 ? null : 1"
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 transition-colors"
                        >
                            <span class="font-semibold text-slate-800 pr-4">What is RJMS?</span>
                            <i class="fas fa-chevron-down text-primary-700 transition-transform" :class="{ 'rotate-180': open === 1 }"></i>
                        </button>
                        <div x-show="open === 1" x-collapse class="px-6 pb-4">
                            <p class="text-slate-600 leading-relaxed">
                                RJMS (Research Journal Management System) is a comprehensive platform designed to streamline 
                                the entire scholarly publishing workflow. It facilitates manuscript submission, peer review, 
                                editorial management, and publication processes for academic journals.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="bg-white rounded-lg shadow-card border border-slate-200 overflow-hidden">
                        <button 
                            @click="open = open === 2 ? null : 2"
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 transition-colors"
                        >
                            <span class="font-semibold text-slate-800 pr-4">Who can use RJMS?</span>
                            <i class="fas fa-chevron-down text-primary-700 transition-transform" :class="{ 'rotate-180': open === 2 }"></i>
                        </button>
                        <div x-show="open === 2" x-collapse class="px-6 pb-4">
                            <p class="text-slate-600 leading-relaxed">
                                RJMS is designed for authors, reviewers, editors, and academic institutions. Authors can 
                                submit manuscripts, reviewers can evaluate submissions, editors can manage the review process, 
                                and institutions can manage their journal operations.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="bg-white rounded-lg shadow-card border border-slate-200 overflow-hidden">
                        <button 
                            @click="open = open === 3 ? null : 3"
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 transition-colors"
                        >
                            <span class="font-semibold text-slate-800 pr-4">Is there a fee to use RJMS?</span>
                            <i class="fas fa-chevron-down text-primary-700 transition-transform" :class="{ 'rotate-180': open === 3 }"></i>
                        </button>
                        <div x-show="open === 3" x-collapse class="px-6 pb-4">
                            <p class="text-slate-600 leading-relaxed">
                                Creating an account and submitting manuscripts is free for authors. Some journals may charge 
                                article processing charges (APCs) for publication. Contact the specific journal for their fee structure.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submission Questions -->
            <div class="mb-8">
                <h2 class="text-2xl font-serif font-bold text-slate-800 mb-6 flex items-center">
                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-file-upload text-primary-700"></i>
                    </div>
                    Submission Process
                </h2>

                <div class="space-y-4" x-data="{ open: null }">
                    <!-- FAQ Item 4 -->
                    <div class="bg-white rounded-lg shadow-card border border-slate-200 overflow-hidden">
                        <button 
                            @click="open = open === 4 ? null : 4"
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 transition-colors"
                        >
                            <span class="font-semibold text-slate-800 pr-4">How do I submit a manuscript?</span>
                            <i class="fas fa-chevron-down text-primary-700 transition-transform" :class="{ 'rotate-180': open === 4 }"></i>
                        </button>
                        <div x-show="open === 4" x-collapse class="px-6 pb-4">
                            <p class="text-slate-600 leading-relaxed mb-3">
                                To submit a manuscript:
                            </p>
                            <ol class="list-decimal list-inside space-y-2 text-slate-600">
                                <li>Create an account or log in</li>
                                <li>Click "Submit Article" from the dashboard</li>
                                <li>Fill in the submission form with manuscript details</li>
                                <li>Upload your manuscript and supplementary files</li>
                                <li>Review and confirm your submission</li>
                            </ol>
                        </div>
                    </div>

                    <!-- FAQ Item 5 -->
                    <div class="bg-white rounded-lg shadow-card border border-slate-200 overflow-hidden">
                        <button 
                            @click="open = open === 5 ? null : 5"
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 transition-colors"
                        >
                            <span class="font-semibold text-slate-800 pr-4">What file formats are accepted?</span>
                            <i class="fas fa-chevron-down text-primary-700 transition-transform" :class="{ 'rotate-180': open === 5 }"></i>
                        </button>
                        <div x-show="open === 5" x-collapse class="px-6 pb-4">
                            <p class="text-slate-600 leading-relaxed">
                                We accept manuscripts in Microsoft Word (.doc, .docx), PDF (.pdf), and LaTeX formats. 
                                Supplementary materials can be uploaded in various formats including images (JPEG, PNG), 
                                data files (CSV, Excel), and code files.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 6 -->
                    <div class="bg-white rounded-lg shadow-card border border-slate-200 overflow-hidden">
                        <button 
                            @click="open = open === 6 ? null : 6"
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 transition-colors"
                        >
                            <span class="font-semibold text-slate-800 pr-4">How can I track my submission?</span>
                            <i class="fas fa-chevron-down text-primary-700 transition-transform" :class="{ 'rotate-180': open === 6 }"></i>
                        </button>
                        <div x-show="open === 6" x-collapse class="px-6 pb-4">
                            <p class="text-slate-600 leading-relaxed">
                                Log in to your account and navigate to "My Submissions" to view the current status of all 
                                your manuscripts. You'll receive email notifications at each stage of the review process.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review Process -->
            <div class="mb-8">
                <h2 class="text-2xl font-serif font-bold text-slate-800 mb-6 flex items-center">
                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-user-check text-primary-700"></i>
                    </div>
                    Review Process
                </h2>

                <div class="space-y-4" x-data="{ open: null }">
                    <!-- FAQ Item 7 -->
                    <div class="bg-white rounded-lg shadow-card border border-slate-200 overflow-hidden">
                        <button 
                            @click="open = open === 7 ? null : 7"
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 transition-colors"
                        >
                            <span class="font-semibold text-slate-800 pr-4">How long does the review process take?</span>
                            <i class="fas fa-chevron-down text-primary-700 transition-transform" :class="{ 'rotate-180': open === 7 }"></i>
                        </button>
                        <div x-show="open === 7" x-collapse class="px-6 pb-4">
                            <p class="text-slate-600 leading-relaxed">
                                The review timeline varies by journal, but typically takes 4-8 weeks from submission to 
                                initial decision. This includes peer review and editorial evaluation. You can check the 
                                specific journal's average review time on their page.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 8 -->
                    <div class="bg-white rounded-lg shadow-card border border-slate-200 overflow-hidden">
                        <button 
                            @click="open = open === 8 ? null : 8"
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 transition-colors"
                        >
                            <span class="font-semibold text-slate-800 pr-4">What is double-blind peer review?</span>
                            <i class="fas fa-chevron-down text-primary-700 transition-transform" :class="{ 'rotate-180': open === 8 }"></i>
                        </button>
                        <div x-show="open === 8" x-collapse class="px-6 pb-4">
                            <p class="text-slate-600 leading-relaxed">
                                In double-blind peer review, both the author and reviewer identities are kept anonymous. 
                                This helps ensure an unbiased evaluation based solely on the manuscript's merit. Please 
                                ensure your manuscript does not contain any identifying information.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Technical Support -->
            <div class="mb-8">
                <h2 class="text-2xl font-serif font-bold text-slate-800 mb-6 flex items-center">
                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-cog text-primary-700"></i>
                    </div>
                    Technical Support
                </h2>

                <div class="space-y-4" x-data="{ open: null }">
                    <!-- FAQ Item 9 -->
                    <div class="bg-white rounded-lg shadow-card border border-slate-200 overflow-hidden">
                        <button 
                            @click="open = open === 9 ? null : 9"
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 transition-colors"
                        >
                            <span class="font-semibold text-slate-800 pr-4">I forgot my password. What should I do?</span>
                            <i class="fas fa-chevron-down text-primary-700 transition-transform" :class="{ 'rotate-180': open === 9 }"></i>
                        </button>
                        <div x-show="open === 9" x-collapse class="px-6 pb-4">
                            <p class="text-slate-600 leading-relaxed">
                                Click the "Forgot Password" link on the login page. Enter your email address, and we'll 
                                send you instructions to reset your password. If you don't receive the email within a few 
                                minutes, check your spam folder or contact support.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 10 -->
                    <div class="bg-white rounded-lg shadow-card border border-slate-200 overflow-hidden">
                        <button 
                            @click="open = open === 10 ? null : 10"
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 transition-colors"
                        >
                            <span class="font-semibold text-slate-800 pr-4">My file upload keeps failing. What can I do?</span>
                            <i class="fas fa-chevron-down text-primary-700 transition-transform" :class="{ 'rotate-180': open === 10 }"></i>
                        </button>
                        <div x-show="open === 10" x-collapse class="px-6 pb-4">
                            <p class="text-slate-600 leading-relaxed mb-3">
                                Common solutions for upload issues:
                            </p>
                            <ul class="list-disc list-inside space-y-2 text-slate-600">
                                <li>Ensure your file is under the maximum size limit (usually 25MB)</li>
                                <li>Check that you're using an accepted file format</li>
                                <li>Try a different browser or clear your browser cache</li>
                                <li>Ensure you have a stable internet connection</li>
                                <li>Contact technical support if the problem persists</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Still Have Questions -->
        <div class="max-w-4xl mx-auto mt-12">
            <div class="bg-primary-800 rounded-xl shadow-xl p-8 md:p-12 text-center text-white">
                <h2 class="text-2xl md:text-3xl font-serif font-bold mb-4">Still Have Questions?</h2>
                <p class="text-primary-100 mb-6 max-w-2xl mx-auto">
                    Can't find the answer you're looking for? Our support team is here to help you.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/contact" class="inline-flex items-center justify-center bg-white text-primary-700 hover:bg-primary-50 font-semibold py-3 px-8 rounded-lg transition-colors">
                        <i class="fas fa-envelope mr-2"></i>Contact Support
                    </a>
                    <a href="/help" class="inline-flex items-center justify-center border-2 border-white text-white hover:bg-white hover:text-primary-700 font-semibold py-3 px-8 rounded-lg transition-colors">
                        <i class="fas fa-life-ring mr-2"></i>Help Center
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
