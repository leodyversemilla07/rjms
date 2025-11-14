<?php
// Set page metadata
$title = 'Contact Us - Research Journal Management System';
$description = 'RJMS - Research Journal Management System';
$keywords = 'research, journal, academic publishing';

// Start output buffering
ob_start();
?>

<!-- Page Header -->
    <div class="bg-slate-800 text-white border-b-4 border-primary-700">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Contact Us</h1>
                <p class="text-xl text-slate-200">We're here to help and answer any questions you might have</p>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-slate-200">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center text-sm text-slate-600">
                <a href="/" class="hover:text-primary-700"><i class="fas fa-home mr-2"></i>Home</a>
                <i class="fas fa-chevron-right mx-3 text-slate-400"></i>
                <span class="text-slate-800 font-medium">Contact</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Contact Cards -->
            <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-envelope text-primary-700 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">Email Us</h3>
                <p class="text-slate-600 text-sm mb-4">For general inquiries and support</p>
                <a href="mailto:info@rjms.org" class="text-primary-700 hover:text-primary-800 font-medium">
                    info@rjms.org
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-phone text-primary-700 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">Call Us</h3>
                <p class="text-slate-600 text-sm mb-4">Mon-Fri, 9AM-5PM EST</p>
                <a href="tel:+1234567890" class="text-primary-700 hover:text-primary-800 font-medium">
                    +1 (234) 567-8900
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-map-marker-alt text-primary-700 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">Visit Us</h3>
                <p class="text-slate-600 text-sm mb-4">Our main office</p>
                <p class="text-slate-700 text-sm">
                    123 Academic Street<br>
                    University City, ST 12345
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            <!-- Contact Form -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-8">
                    <h2 class="text-2xl font-serif font-bold text-slate-800 mb-6">Send Us a Message</h2>
                    
                    <form id="contactForm" method="POST" action="/contact" class="space-y-5">
                        <!-- Name Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-slate-700 mb-2">
                                    First Name <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="first_name" 
                                    name="first_name" 
                                    required
                                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="John"
                                >
                            </div>

                            <div>
                                <label for="last_name" class="block text-sm font-medium text-slate-700 mb-2">
                                    Last Name <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="last_name" 
                                    name="last_name" 
                                    required
                                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="Doe"
                                >
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                required
                                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                placeholder="john.doe@university.edu"
                            >
                        </div>

                        <!-- Subject -->
                        <div>
                            <label for="subject" class="block text-sm font-medium text-slate-700 mb-2">
                                Subject <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="subject" 
                                name="subject" 
                                required
                                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                            >
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="submission">Submission Question</option>
                                <option value="review">Review Process</option>
                                <option value="technical">Technical Support</option>
                                <option value="partnership">Partnership Opportunity</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-slate-700 mb-2">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="message" 
                                name="message" 
                                required
                                rows="6"
                                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all resize-none"
                                placeholder="Please provide details about your inquiry..."
                            ></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-primary-700 hover:bg-primary-800 text-white font-semibold py-3 px-6 rounded-lg transition-colors flex items-center justify-center"
                        >
                            <i class="fas fa-paper-plane mr-2"></i>
                            <span>Send Message</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Quick Links -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4">Quick Links</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="/faq" class="flex items-center text-slate-700 hover:text-primary-700 transition-colors">
                                <i class="fas fa-question-circle mr-3 text-slate-400"></i>
                                Frequently Asked Questions
                            </a>
                        </li>
                        <li>
                            <a href="/submission-guidelines" class="flex items-center text-slate-700 hover:text-primary-700 transition-colors">
                                <i class="fas fa-file-alt mr-3 text-slate-400"></i>
                                Submission Guidelines
                            </a>
                        </li>
                        <li>
                            <a href="/help" class="flex items-center text-slate-700 hover:text-primary-700 transition-colors">
                                <i class="fas fa-life-ring mr-3 text-slate-400"></i>
                                Help Center
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Office Hours -->
                <div class="bg-primary-50 border-l-4 border-primary-600 rounded-r-lg p-6">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4">
                        <i class="fas fa-clock mr-2 text-primary-700"></i>
                        Office Hours
                    </h3>
                    <ul class="space-y-2 text-sm">
                        <li class="flex justify-between">
                            <span class="text-slate-600">Monday - Friday:</span>
                            <span class="font-medium text-slate-800">9:00 AM - 5:00 PM</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-slate-600">Saturday:</span>
                            <span class="font-medium text-slate-800">10:00 AM - 2:00 PM</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-slate-600">Sunday:</span>
                            <span class="font-medium text-slate-800">Closed</span>
                        </li>
                    </ul>
                    <p class="text-xs text-slate-600 mt-4">
                        <i class="fas fa-info-circle mr-1"></i>
                        All times in Eastern Standard Time (EST)
                    </p>
                </div>

                <!-- Response Time -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-800">We Respond Quickly</h3>
                    </div>
                    <p class="text-sm text-slate-600">
                        We typically respond to all inquiries within <span class="font-semibold text-slate-800">24-48 hours</span> during business days.
                    </p>
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
