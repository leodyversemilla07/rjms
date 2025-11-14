<?php
// Set page metadata
$title = 'Editorial Board - Research Journal Management System';
$description = 'RJMS - Research Journal Management System';
$keywords = 'research, journal, academic publishing';

// Start output buffering
ob_start();
?>


    <!-- Page Header -->
    <div class="bg-slate-800 text-white border-b-4 border-primary-700">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 backdrop-blur-sm rounded-full border-4 border-white/20 mb-6">
                    <i class="fas fa-users text-4xl"></i>
                </div>
                <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Editorial Board</h1>
                <p class="text-xl text-slate-200">Distinguished scholars leading our academic mission</p>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-slate-200">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center text-sm text-slate-600">
                <a href="/" class="hover:text-primary-700"><i class="fas fa-home mr-2"></i>Home</a>
                <i class="fas fa-chevron-right mx-3 text-slate-400"></i>
                <span class="text-slate-800 font-medium">Editorial Board</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">

        <!-- Introduction -->
        <div class="max-w-4xl mx-auto mb-12">
            <div class="bg-primary-50 rounded-xl shadow-card border-l-4 border-primary-700 p-8">
                <h2 class="text-2xl font-serif font-bold text-slate-800 mb-4">
                    <i class="fas fa-book-reader text-primary-700 mr-3"></i>
                    About Our Editorial Board
                </h2>
                <p class="text-slate-700 leading-relaxed mb-3">
                    Our Editorial Board comprises distinguished scholars and researchers from leading institutions 
                    worldwide. These experts bring decades of combined experience in peer review, academic publishing, 
                    and their respective fields of study.
                </p>
                <p class="text-slate-700 leading-relaxed">
                    They are committed to maintaining the highest standards of academic excellence, ensuring rigorous 
                    peer review processes, and advancing scholarly communication across all disciplines.
                </p>
            </div>
        </div>

        <!-- Editor-in-Chief -->
        <div class="max-w-5xl mx-auto mb-12">
            <div class="bg-white rounded-xl shadow-xl border-2 border-primary-200 overflow-hidden">
                <div class="bg-primary-800 text-white px-8 py-6">
                    <h2 class="text-2xl font-serif font-bold flex items-center">
                        <i class="fas fa-crown mr-3"></i>
                        Editor-in-Chief
                    </h2>
                </div>
                
                <div class="p-8">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Photo -->
                        <div class="shrink-0">
                            <div class="w-48 h-48 bg-slate-200 rounded-lg border-4 border-primary-100 flex items-center justify-center overflow-hidden">
                                <i class="fas fa-user-tie text-7xl text-slate-400"></i>
                            </div>
                        </div>
                        
                        <!-- Info -->
                        <div class="flex-1">
                            <h3 class="text-2xl font-serif font-bold text-slate-800 mb-2">
                                Dr. Elizabeth M. Harrison
                            </h3>
                            <p class="text-primary-700 font-semibold text-lg mb-4">
                                Editor-in-Chief
                            </p>
                            
                            <div class="space-y-3 mb-6">
                                <div class="flex items-start">
                                    <i class="fas fa-university text-primary-700 mt-1 mr-3 w-5"></i>
                                    <div>
                                        <p class="font-semibold text-slate-800">Institution</p>
                                        <p class="text-slate-600">Massachusetts Institute of Technology</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-flask text-primary-700 mt-1 mr-3 w-5"></i>
                                    <div>
                                        <p class="font-semibold text-slate-800">Research Interests</p>
                                        <p class="text-slate-600">Computational Biology, Machine Learning, Genomics</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-graduation-cap text-primary-700 mt-1 mr-3 w-5"></i>
                                    <div>
                                        <p class="font-semibold text-slate-800">Education</p>
                                        <p class="text-slate-600">Ph.D. in Computational Biology, Stanford University</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-envelope text-primary-700 mt-1 mr-3 w-5"></i>
                                    <div>
                                        <p class="font-semibold text-slate-800">Contact</p>
                                        <p class="text-slate-600">harrison@mit.edu</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-slate-200 pt-6">
                                <p class="text-slate-700 leading-relaxed">
                                    Dr. Harrison is a distinguished professor with over 20 years of experience in academic 
                                    publishing and research. She has authored more than 150 peer-reviewed articles and has 
                                    served on numerous editorial boards. Her expertise in computational methods has shaped 
                                    modern approaches to biological research.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Associate Editors -->
        <div class="max-w-6xl mx-auto mb-12">
            <div class="mb-8">
                <h2 class="text-3xl font-serif font-bold text-slate-800 mb-2 flex items-center">
                    <i class="fas fa-user-friends text-primary-700 mr-3"></i>
                    Associate Editors
                </h2>
                <p class="text-slate-600">Our associate editors oversee specific subject areas and guide the peer review process</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Associate Editor 1 -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-primary-700 text-white px-6 py-3">
                        <p class="text-sm font-semibold opacity-90">Computer Science & AI</p>
                    </div>
                    <div class="p-6">
                        <div class="flex gap-4 mb-4">
                            <div class="w-24 h-24 bg-slate-200 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-user text-4xl text-slate-400"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-serif font-bold text-slate-800 mb-1">
                                    Prof. David Chen
                                </h3>
                                <p class="text-primary-700 font-semibold mb-2">Associate Editor</p>
                                <p class="text-sm text-slate-600">
                                    <i class="fas fa-university mr-2"></i>Stanford University
                                </p>
                            </div>
                        </div>
                        
                        <div class="space-y-2 text-sm mb-4">
                            <p class="text-slate-700">
                                <strong>Expertise:</strong> Artificial Intelligence, Deep Learning, Neural Networks
                            </p>
                            <p class="text-slate-700">
                                <strong>Publications:</strong> 120+ peer-reviewed articles
                            </p>
                            <p class="text-slate-700">
                                <strong>Email:</strong> <a href="mailto:chen@stanford.edu" class="text-primary-700 hover:text-primary-800">chen@stanford.edu</a>
                            </p>
                        </div>

                        <p class="text-slate-600 text-sm leading-relaxed">
                            Leading expert in machine learning with focus on neural network architectures and 
                            their applications in computer vision and natural language processing.
                        </p>
                    </div>
                </div>

                <!-- Associate Editor 2 -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-green-700 text-white px-6 py-3">
                        <p class="text-sm font-semibold opacity-90">Biotechnology & Life Sciences</p>
                    </div>
                    <div class="p-6">
                        <div class="flex gap-4 mb-4">
                            <div class="w-24 h-24 bg-slate-200 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-user text-4xl text-slate-400"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-serif font-bold text-slate-800 mb-1">
                                    Dr. Sarah Martinez
                                </h3>
                                <p class="text-green-700 font-semibold mb-2">Associate Editor</p>
                                <p class="text-sm text-slate-600">
                                    <i class="fas fa-university mr-2"></i>Oxford University
                                </p>
                            </div>
                        </div>
                        
                        <div class="space-y-2 text-sm mb-4">
                            <p class="text-slate-700">
                                <strong>Expertise:</strong> Climate Change, Sustainability, Environmental Policy
                            </p>
                            <p class="text-slate-700">
                                <strong>Publications:</strong> 95+ peer-reviewed articles
                            </p>
                            <p class="text-slate-700">
                                <strong>Email:</strong> <a href="mailto:martinez@oxford.ac.uk" class="text-green-700 hover:text-green-800">martinez@oxford.ac.uk</a>
                            </p>
                        </div>

                        <p class="text-slate-600 text-sm leading-relaxed">
                            Renowned environmental scientist specializing in climate modeling and sustainable 
                            development strategies with extensive field research experience.
                        </p>
                    </div>
                </div>

                <!-- Associate Editor 3 -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-red-700 text-white px-6 py-3">
                        <p class="text-sm font-semibold opacity-90">Engineering & Materials Science</p>
                    </div>
                    <div class="p-6">
                        <div class="flex gap-4 mb-4">
                            <div class="w-24 h-24 bg-slate-200 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-user text-4xl text-slate-400"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-serif font-bold text-slate-800 mb-1">
                                    Prof. Michael Zhang
                                </h3>
                                <p class="text-red-700 font-semibold mb-2">Associate Editor</p>
                                <p class="text-sm text-slate-600">
                                    <i class="fas fa-university mr-2"></i>Johns Hopkins University
                                </p>
                            </div>
                        </div>
                        
                        <div class="space-y-2 text-sm mb-4">
                            <p class="text-slate-700">
                                <strong>Expertise:</strong> Oncology, Immunotherapy, Clinical Trials
                            </p>
                            <p class="text-slate-700">
                                <strong>Publications:</strong> 180+ peer-reviewed articles
                            </p>
                            <p class="text-slate-700">
                                <strong>Email:</strong> <a href="mailto:zhang@jhu.edu" class="text-red-700 hover:text-red-800">zhang@jhu.edu</a>
                            </p>
                        </div>

                        <p class="text-slate-600 text-sm leading-relaxed">
                            Distinguished oncologist with groundbreaking research in cancer immunotherapy and 
                            personalized medicine approaches to treatment.
                        </p>
                    </div>
                </div>

                <!-- Associate Editor 4 -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-purple-700 text-white px-6 py-3">
                        <p class="text-sm font-semibold opacity-90">Social Sciences & Humanities</p>
                    </div>
                    <div class="p-6">
                        <div class="flex gap-4 mb-4">
                            <div class="w-24 h-24 bg-slate-200 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-user text-4xl text-slate-400"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-serif font-bold text-slate-800 mb-1">
                                    Dr. Emily Roberts
                                </h3>
                                <p class="text-purple-700 font-semibold mb-2">Associate Editor</p>
                                <p class="text-sm text-slate-600">
                                    <i class="fas fa-university mr-2"></i>Harvard University
                                </p>
                            </div>
                        </div>
                        
                        <div class="space-y-2 text-sm mb-4">
                            <p class="text-slate-700">
                                <strong>Expertise:</strong> Social Psychology, Behavioral Economics, Public Policy
                            </p>
                            <p class="text-slate-700">
                                <strong>Publications:</strong> 110+ peer-reviewed articles
                            </p>
                            <p class="text-slate-700">
                                <strong>Email:</strong> <a href="mailto:roberts@harvard.edu" class="text-purple-700 hover:text-purple-800">roberts@harvard.edu</a>
                            </p>
                        </div>

                        <p class="text-slate-600 text-sm leading-relaxed">
                            Leading researcher in social psychology with expertise in decision-making processes 
                            and their implications for public policy development.
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Editorial Board Members -->
        <div class="max-w-6xl mx-auto mb-12">
            <div class="mb-8">
                <h2 class="text-3xl font-serif font-bold text-slate-800 mb-2 flex items-center">
                    <i class="fas fa-users-cog text-primary-700 mr-3"></i>
                    Editorial Board Members
                </h2>
                <p class="text-slate-600">Expert reviewers and advisors across various disciplines</p>
            </div>

            <!-- Board Members Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Member 1 -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-user text-2xl text-primary-700"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-800">Dr. James Wilson</h3>
                            <p class="text-sm text-slate-600">Cambridge University</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-700 mb-2">
                        <strong>Field:</strong> Physics & Engineering
                    </p>
                    <p class="text-sm text-slate-600">
                        Quantum computing, Nanotechnology
                    </p>
                </div>

                <!-- Member 2 -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-user text-2xl text-green-700"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-800">Prof. Lisa Anderson</h3>
                            <p class="text-sm text-slate-600">Yale University</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-700 mb-2">
                        <strong>Field:</strong> Biology & Genetics
                    </p>
                    <p class="text-sm text-slate-600">
                        Molecular biology, Gene therapy
                    </p>
                </div>

                <!-- Member 3 -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-user text-2xl text-amber-700"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-800">Dr. Robert Kim</h3>
                            <p class="text-sm text-slate-600">UC Berkeley</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-700 mb-2">
                        <strong>Field:</strong> Chemistry
                    </p>
                    <p class="text-sm text-slate-600">
                        Organic synthesis, Materials science
                    </p>
                </div>

                <!-- Member 4 -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-user text-2xl text-blue-700"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-800">Prof. Maria Garcia</h3>
                            <p class="text-sm text-slate-600">Princeton University</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-700 mb-2">
                        <strong>Field:</strong> Mathematics
                    </p>
                    <p class="text-sm text-slate-600">
                        Applied mathematics, Statistics
                    </p>
                </div>

                <!-- Member 5 -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-user text-2xl text-indigo-700"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-800">Dr. Ahmed Hassan</h3>
                            <p class="text-sm text-slate-600">ETH Zurich</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-700 mb-2">
                        <strong>Field:</strong> Data Science
                    </p>
                    <p class="text-sm text-slate-600">
                        Big data analytics, AI applications
                    </p>
                </div>

                <!-- Member 6 -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-user text-2xl text-pink-700"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-800">Prof. Jennifer Lee</h3>
                            <p class="text-sm text-slate-600">Columbia University</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-700 mb-2">
                        <strong>Field:</strong> Neuroscience
                    </p>
                    <p class="text-sm text-slate-600">
                        Cognitive neuroscience, Brain imaging
                    </p>
                </div>

                <!-- Member 7 -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-user text-2xl text-teal-700"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-800">Dr. Thomas Brown</h3>
                            <p class="text-sm text-slate-600">Imperial College London</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-700 mb-2">
                        <strong>Field:</strong> Economics
                    </p>
                    <p class="text-sm text-slate-600">
                        Macroeconomics, Financial markets
                    </p>
                </div>

                <!-- Member 8 -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-user text-2xl text-orange-700"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-800">Prof. Anna Kowalski</h3>
                            <p class="text-sm text-slate-600">University of Toronto</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-700 mb-2">
                        <strong>Field:</strong> Education
                    </p>
                    <p class="text-sm text-slate-600">
                        Educational technology, Learning sciences
                    </p>
                </div>

                <!-- Member 9 -->
                <div class="bg-white rounded-xl shadow-card border border-slate-200 p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-user text-2xl text-cyan-700"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-800">Dr. Carlos Silva</h3>
                            <p class="text-sm text-slate-600">University of São Paulo</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-700 mb-2">
                        <strong>Field:</strong> Public Health
                    </p>
                    <p class="text-sm text-slate-600">
                        Epidemiology, Global health policy
                    </p>
                </div>

            </div>
        </div>

        <!-- Join Our Board CTA -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-primary-800 rounded-xl shadow-xl p-8 md:p-12 text-white text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full border-4 border-white/30 mb-6">
                    <i class="fas fa-handshake text-3xl"></i>
                </div>
                <h2 class="text-3xl font-serif font-bold mb-4">Interested in Joining Our Editorial Board?</h2>
                <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
                    We're always looking for distinguished scholars to join our editorial team and help advance 
                    academic publishing excellence.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/contact" class="inline-flex items-center justify-center bg-white text-primary-700 hover:bg-primary-50 font-semibold py-3 px-8 rounded-lg transition-colors">
                        <i class="fas fa-envelope mr-2"></i>Contact Us
                    </a>
                    <a href="/about" class="inline-flex items-center justify-center border-2 border-white text-white hover:bg-white hover:text-primary-700 font-semibold py-3 px-8 rounded-lg transition-colors">
                        <i class="fas fa-info-circle mr-2"></i>Learn More
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
