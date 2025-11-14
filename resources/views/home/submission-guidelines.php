<?php
// Set page metadata
$title = 'Submission Guidelines - Research Journal Management System';
$description = 'RJMS - Research Journal Management System';
$keywords = 'research, journal, academic publishing';

// Start output buffering
ob_start();
?>


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
                
                <!-- Overview Section -->
                <section id="overview" class="bg-white rounded-xl shadow-card border border-slate-200 p-8">
                    <div class="flex items-start space-x-4 mb-6">
                        <div class="bg-primary-100 text-primary-700 p-3 rounded-lg">
                            <i class="fas fa-eye text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800 mb-2">Overview</h2>
                            <p class="text-slate-600">Essential information for prospective authors</p>
                        </div>
                    </div>

                    <div class="prose max-w-none text-slate-700">
                        <p class="text-lg mb-4">
                            Thank you for considering submitting your research to our journal. We welcome original research articles, 
                            review papers, and short communications in all areas of scientific inquiry.
                        </p>

                        <div class="bg-blue-50 border-l-4 border-primary-700 p-6 rounded-r-lg my-6">
                            <h3 class="font-bold text-lg mb-3 text-slate-800 flex items-center">
                                <i class="fas fa-lightbulb mr-2 text-primary-700"></i>
                                Key Points
                            </h3>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-600 mr-2 mt-1"></i>
                                    <span>All submissions undergo rigorous peer review</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-600 mr-2 mt-1"></i>
                                    <span>Average time to first decision: 4-6 weeks</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-600 mr-2 mt-1"></i>
                                    <span>Open access options available</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-600 mr-2 mt-1"></i>
                                    <span>No submission or publication fees</span>
                                </li>
                            </ul>
                        </div>

                        <h3 class="font-bold text-lg mt-6 mb-3 text-slate-800">Article Types</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div class="border border-slate-200 rounded-lg p-4 hover:border-primary-300 transition-colors">
                                <div class="text-primary-700 mb-2">
                                    <i class="fas fa-file-alt text-2xl"></i>
                                </div>
                                <h4 class="font-semibold text-slate-800 mb-1">Research Articles</h4>
                                <p class="text-sm text-slate-600">5,000-8,000 words</p>
                            </div>
                            <div class="border border-slate-200 rounded-lg p-4 hover:border-primary-300 transition-colors">
                                <div class="text-primary-700 mb-2">
                                    <i class="fas fa-book-open text-2xl"></i>
                                </div>
                                <h4 class="font-semibold text-slate-800 mb-1">Review Papers</h4>
                                <p class="text-sm text-slate-600">8,000-12,000 words</p>
                            </div>
                            <div class="border border-slate-200 rounded-lg p-4 hover:border-primary-300 transition-colors">
                                <div class="text-primary-700 mb-2">
                                    <i class="fas fa-comment-alt text-2xl"></i>
                                </div>
                                <h4 class="font-semibold text-slate-800 mb-1">Short Communications</h4>
                                <p class="text-sm text-slate-600">2,000-3,000 words</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Manuscript Preparation -->
                <section id="manuscript" class="bg-white rounded-xl shadow-card border border-slate-200 p-8">
                    <div class="flex items-start space-x-4 mb-6">
                        <div class="bg-green-100 text-green-700 p-3 rounded-lg">
                            <i class="fas fa-file-word text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800 mb-2">Manuscript Preparation</h2>
                            <p class="text-slate-600">Structure and content requirements</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Manuscript Structure -->
                        <div>
                            <h3 class="font-bold text-lg mb-4 text-slate-800">Required Sections</h3>
                            <div class="space-y-3">
                                <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-lg">
                                    <div class="bg-primary-700 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shrink-0">1</div>
                                    <div>
                                        <h4 class="font-semibold text-slate-800 mb-1">Title Page</h4>
                                        <p class="text-sm text-slate-600">Include title, authors, affiliations, corresponding author details, and keywords</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-lg">
                                    <div class="bg-primary-700 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shrink-0">2</div>
                                    <div>
                                        <h4 class="font-semibold text-slate-800 mb-1">Abstract</h4>
                                        <p class="text-sm text-slate-600">250-300 words summarizing background, methods, results, and conclusions</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-lg">
                                    <div class="bg-primary-700 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shrink-0">3</div>
                                    <div>
                                        <h4 class="font-semibold text-slate-800 mb-1">Introduction</h4>
                                        <p class="text-sm text-slate-600">Background, significance, and research objectives</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-lg">
                                    <div class="bg-primary-700 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shrink-0">4</div>
                                    <div>
                                        <h4 class="font-semibold text-slate-800 mb-1">Methods</h4>
                                        <p class="text-sm text-slate-600">Detailed description of research methodology and procedures</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-lg">
                                    <div class="bg-primary-700 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shrink-0">5</div>
                                    <div>
                                        <h4 class="font-semibold text-slate-800 mb-1">Results</h4>
                                        <p class="text-sm text-slate-600">Present findings with appropriate figures and tables</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-lg">
                                    <div class="bg-primary-700 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shrink-0">6</div>
                                    <div>
                                        <h4 class="font-semibold text-slate-800 mb-1">Discussion</h4>
                                        <p class="text-sm text-slate-600">Interpret results, compare with previous work, and state implications</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-lg">
                                    <div class="bg-primary-700 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shrink-0">7</div>
                                    <div>
                                        <h4 class="font-semibold text-slate-800 mb-1">Conclusion</h4>
                                        <p class="text-sm text-slate-600">Summarize key findings and future directions</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-lg">
                                    <div class="bg-primary-700 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shrink-0">8</div>
                                    <div>
                                        <h4 class="font-semibold text-slate-800 mb-1">References</h4>
                                        <p class="text-sm text-slate-600">Complete list of cited works in proper format</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Formatting Guidelines -->
                <section id="formatting" class="bg-white rounded-xl shadow-card border border-slate-200 p-8">
                    <div class="flex items-start space-x-4 mb-6">
                        <div class="bg-purple-100 text-purple-700 p-3 rounded-lg">
                            <i class="fas fa-align-left text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800 mb-2">Formatting Guidelines</h2>
                            <p class="text-slate-600">Technical specifications for manuscript preparation</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border border-slate-200 rounded-lg p-5">
                            <h3 class="font-semibold text-slate-800 mb-3 flex items-center">
                                <i class="fas fa-font mr-2 text-primary-700"></i>Typography
                            </h3>
                            <ul class="space-y-2 text-sm text-slate-700">
                                <li><strong>Font:</strong> Times New Roman, 12pt</li>
                                <li><strong>Line Spacing:</strong> Double-spaced</li>
                                <li><strong>Margins:</strong> 1 inch (2.54 cm) all sides</li>
                                <li><strong>Alignment:</strong> Left-aligned</li>
                            </ul>
                        </div>

                        <div class="border border-slate-200 rounded-lg p-5">
                            <h3 class="font-semibold text-slate-800 mb-3 flex items-center">
                                <i class="fas fa-file mr-2 text-primary-700"></i>File Format
                            </h3>
                            <ul class="space-y-2 text-sm text-slate-700">
                                <li><strong>Preferred:</strong> Microsoft Word (.docx)</li>
                                <li><strong>Alternative:</strong> LaTeX (.tex + PDF)</li>
                                <li><strong>Max Size:</strong> 25 MB per file</li>
                                <li><strong>Page Numbers:</strong> Consecutive, bottom center</li>
                            </ul>
                        </div>

                        <div class="border border-slate-200 rounded-lg p-5">
                            <h3 class="font-semibold text-slate-800 mb-3 flex items-center">
                                <i class="fas fa-heading mr-2 text-primary-700"></i>Headings
                            </h3>
                            <ul class="space-y-2 text-sm text-slate-700">
                                <li><strong>Level 1:</strong> Bold, 14pt, Centered</li>
                                <li><strong>Level 2:</strong> Bold, 12pt, Left-aligned</li>
                                <li><strong>Level 3:</strong> Italic, 12pt, Left-aligned</li>
                                <li><strong>Numbering:</strong> Use decimal system (1, 1.1, 1.1.1)</li>
                            </ul>
                        </div>

                        <div class="border border-slate-200 rounded-lg p-5">
                            <h3 class="font-semibold text-slate-800 mb-3 flex items-center">
                                <i class="fas fa-list-ol mr-2 text-primary-700"></i>Lists & Equations
                            </h3>
                            <ul class="space-y-2 text-sm text-slate-700">
                                <li><strong>Bullet Points:</strong> Use standard bullets</li>
                                <li><strong>Numbered Lists:</strong> Arabic numerals</li>
                                <li><strong>Equations:</strong> Use equation editor</li>
                                <li><strong>Variables:</strong> Italicize variables</li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-6 bg-amber-50 border border-amber-200 rounded-lg p-4">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-exclamation-triangle text-amber-600 mt-1"></i>
                            <div>
                                <h4 class="font-semibold text-amber-900 mb-1">Important Note</h4>
                                <p class="text-sm text-amber-800">Manuscripts not adhering to formatting guidelines may be returned without review. Please use our provided template to ensure compliance.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Figures and Tables -->
                <section id="figures" class="bg-white rounded-xl shadow-card border border-slate-200 p-8">
                    <div class="flex items-start space-x-4 mb-6">
                        <div class="bg-indigo-100 text-indigo-700 p-3 rounded-lg">
                            <i class="fas fa-image text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800 mb-2">Figures and Tables</h2>
                            <p class="text-slate-600">Guidelines for visual elements</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Figures -->
                        <div>
                            <h3 class="font-bold text-lg mb-4 text-slate-800 flex items-center">
                                <i class="fas fa-image mr-2 text-primary-700"></i>Figures
                            </h3>
                            <div class="bg-slate-50 rounded-lg p-5 space-y-3">
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-check text-green-600 mt-1"></i>
                                    <p class="text-sm text-slate-700"><strong>Format:</strong> TIFF, EPS, or high-resolution PNG/JPEG (minimum 300 dpi)</p>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-check text-green-600 mt-1"></i>
                                    <p class="text-sm text-slate-700"><strong>Size:</strong> Fit within journal margins (max width 6.5 inches)</p>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-check text-green-600 mt-1"></i>
                                    <p class="text-sm text-slate-700"><strong>Captions:</strong> Provide descriptive captions below each figure</p>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-check text-green-600 mt-1"></i>
                                    <p class="text-sm text-slate-700"><strong>Labels:</strong> Use clear, readable fonts (minimum 8pt)</p>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-check text-green-600 mt-1"></i>
                                    <p class="text-sm text-slate-700"><strong>Color:</strong> Use color purposefully; ensure figures are interpretable in grayscale</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tables -->
                        <div>
                            <h3 class="font-bold text-lg mb-4 text-slate-800 flex items-center">
                                <i class="fas fa-table mr-2 text-primary-700"></i>Tables
                            </h3>
                            <div class="bg-slate-50 rounded-lg p-5 space-y-3">
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-check text-green-600 mt-1"></i>
                                    <p class="text-sm text-slate-700"><strong>Format:</strong> Use table editor; avoid images of tables</p>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-check text-green-600 mt-1"></i>
                                    <p class="text-sm text-slate-700"><strong>Title:</strong> Place descriptive title above the table</p>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-check text-green-600 mt-1"></i>
                                    <p class="text-sm text-slate-700"><strong>Footnotes:</strong> Use superscript letters for table footnotes</p>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-check text-green-600 mt-1"></i>
                                    <p class="text-sm text-slate-700"><strong>Borders:</strong> Minimal borders; use horizontal lines only</p>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-check text-green-600 mt-1"></i>
                                    <p class="text-sm text-slate-700"><strong>Placement:</strong> Reference all tables in text; number consecutively</p>
                                </div>
                            </div>
                        </div>

                        <!-- Example -->
                        <div class="border-2 border-dashed border-slate-300 rounded-lg p-6">
                            <h4 class="font-semibold text-slate-800 mb-3">Example Table Format</h4>
                            <table class="w-full text-sm">
                                <caption class="text-left font-semibold mb-2 text-slate-800">Table 1: Sample Data Presentation</caption>
                                <thead>
                                    <tr class="border-b-2 border-slate-300">
                                        <th class="text-left py-2 text-slate-700">Parameter</th>
                                        <th class="text-right py-2 text-slate-700">Value</th>
                                        <th class="text-right py-2 text-slate-700">SD</th>
                                    </tr>
                                </thead>
                                <tbody class="text-slate-600">
                                    <tr class="border-b border-slate-200">
                                        <td class="py-2">Sample A</td>
                                        <td class="text-right">45.2</td>
                                        <td class="text-right">±2.1</td>
                                    </tr>
                                    <tr class="border-b border-slate-200">
                                        <td class="py-2">Sample B</td>
                                        <td class="text-right">52.8</td>
                                        <td class="text-right">±3.4</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="text-xs text-slate-500 mt-2"><sup>a</sup>SD = Standard Deviation</p>
                        </div>
                    </div>
                </section>

                <!-- References -->
                <section id="references" class="bg-white rounded-xl shadow-card border border-slate-200 p-8">
                    <div class="flex items-start space-x-4 mb-6">
                        <div class="bg-rose-100 text-rose-700 p-3 rounded-lg">
                            <i class="fas fa-quote-right text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800 mb-2">Reference Style</h2>
                            <p class="text-slate-600">Citation and bibliography formatting</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-slate-50 rounded-lg p-6">
                            <h3 class="font-bold text-lg mb-3 text-slate-800">Citation Style</h3>
                            <p class="text-slate-700 mb-4">We follow the <strong>APA 7th Edition</strong> citation style. All references cited in the text must appear in the reference list, and vice versa.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="font-semibold text-slate-800 mb-2">In-Text Citations</h4>
                                    <div class="bg-white rounded p-3 text-sm text-slate-700 font-mono">
                                        (Smith, 2020)<br>
                                        (Jones & Brown, 2019)<br>
                                        (Davis et al., 2021)
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-800 mb-2">Narrative Citations</h4>
                                    <div class="bg-white rounded p-3 text-sm text-slate-700 font-mono">
                                        Smith (2020) found...<br>
                                        According to Jones and Brown (2019)...<br>
                                        Davis et al. (2021) demonstrated...
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-bold text-lg mb-4 text-slate-800">Reference List Examples</h3>
                            
                            <div class="space-y-4">
                                <!-- Journal Article -->
                                <div class="border-l-4 border-primary-500 pl-4 py-2">
                                    <h4 class="font-semibold text-sm text-slate-600 mb-2">Journal Article</h4>
                                    <p class="text-sm text-slate-700 font-mono bg-slate-50 p-3 rounded">
                                        Smith, J. A., & Johnson, M. B. (2020). The impact of climate change on biodiversity. 
                                        <em>Journal of Environmental Science</em>, 45(3), 234-256. 
                                        https://doi.org/10.1234/jes.2020.45.3.234
                                    </p>
                                </div>

                                <!-- Book -->
                                <div class="border-l-4 border-green-500 pl-4 py-2">
                                    <h4 class="font-semibold text-sm text-slate-600 mb-2">Book</h4>
                                    <p class="text-sm text-slate-700 font-mono bg-slate-50 p-3 rounded">
                                        Brown, R. K. (2019). <em>Advanced research methodologies</em> (2nd ed.). 
                                        Academic Press.
                                    </p>
                                </div>

                                <!-- Book Chapter -->
                                <div class="border-l-4 border-purple-500 pl-4 py-2">
                                    <h4 class="font-semibold text-sm text-slate-600 mb-2">Book Chapter</h4>
                                    <p class="text-sm text-slate-700 font-mono bg-slate-50 p-3 rounded">
                                        Davis, L. M. (2021). Data analysis techniques. In P. Wilson (Ed.), 
                                        <em>Handbook of research methods</em> (pp. 145-178). University Press.
                                    </p>
                                </div>

                                <!-- Conference Paper -->
                                <div class="border-l-4 border-amber-500 pl-4 py-2">
                                    <h4 class="font-semibold text-sm text-slate-600 mb-2">Conference Proceedings</h4>
                                    <p class="text-sm text-slate-700 font-mono bg-slate-50 p-3 rounded">
                                        Martinez, C., & Lee, S. (2022). Machine learning applications in healthcare. 
                                        In <em>Proceedings of the International Conference on AI</em> (pp. 89-102). 
                                        IEEE.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-info-circle text-blue-600 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-blue-900 mb-1">Reference Management</h4>
                                    <p class="text-sm text-blue-800">We recommend using reference management software such as Zotero, Mendeley, or EndNote to ensure consistency and accuracy.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Ethics and Policies -->
                <section id="ethics" class="bg-white rounded-xl shadow-card border border-slate-200 p-8">
                    <div class="flex items-start space-x-4 mb-6">
                        <div class="bg-emerald-100 text-emerald-700 p-3 rounded-lg">
                            <i class="fas fa-balance-scale text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800 mb-2">Ethics & Policies</h2>
                            <p class="text-slate-600">Research integrity and publication ethics</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Authorship -->
                        <div class="border border-slate-200 rounded-lg p-6">
                            <h3 class="font-semibold text-lg text-slate-800 mb-3 flex items-center">
                                <i class="fas fa-user-edit mr-2 text-primary-700"></i>Authorship
                            </h3>
                            <ul class="space-y-2 text-sm text-slate-700">
                                <li class="flex items-start">
                                    <i class="fas fa-circle text-xs text-primary-700 mr-2 mt-1.5"></i>
                                    <span>All listed authors must have made substantial contributions to the research</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-circle text-xs text-primary-700 mr-2 mt-1.5"></i>
                                    <span>Authors must approve the final version and agree to be accountable</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-circle text-xs text-primary-700 mr-2 mt-1.5"></i>
                                    <span>Clearly indicate the corresponding author with complete contact information</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-circle text-xs text-primary-700 mr-2 mt-1.5"></i>
                                    <span>Acknowledge contributors who do not meet authorship criteria</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Conflicts of Interest -->
                        <div class="border border-slate-200 rounded-lg p-6">
                            <h3 class="font-semibold text-lg text-slate-800 mb-3 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2 text-amber-600"></i>Conflicts of Interest
                            </h3>
                            <p class="text-sm text-slate-700 mb-3">
                                Authors must declare any financial or personal relationships that could influence the research or its interpretation.
                            </p>
                            <div class="bg-slate-50 rounded p-4">
                                <p class="text-sm text-slate-700"><strong>Required declaration:</strong> Include a conflict of interest statement even if none exist (e.g., "The authors declare no conflicts of interest").</p>
                            </div>
                        </div>

                        <!-- Research Ethics -->
                        <div class="border border-slate-200 rounded-lg p-6">
                            <h3 class="font-semibold text-lg text-slate-800 mb-3 flex items-center">
                                <i class="fas fa-shield-alt mr-2 text-green-600"></i>Research Ethics
                            </h3>
                            <div class="space-y-3">
                                <div>
                                    <h4 class="font-semibold text-sm text-slate-800 mb-2">Human Subjects Research</h4>
                                    <ul class="space-y-1 text-sm text-slate-700 ml-4">
                                        <li class="flex items-start">
                                            <span class="mr-2">•</span>
                                            <span>Obtain IRB/ethics committee approval before commencing research</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="mr-2">•</span>
                                            <span>Secure informed consent from all participants</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="mr-2">•</span>
                                            <span>Protect participant privacy and confidentiality</span>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-sm text-slate-800 mb-2">Animal Research</h4>
                                    <ul class="space-y-1 text-sm text-slate-700 ml-4">
                                        <li class="flex items-start">
                                            <span class="mr-2">•</span>
                                            <span>Comply with institutional and national guidelines (e.g., ARRIVE guidelines)</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="mr-2">•</span>
                                            <span>Obtain approval from animal ethics committee</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="mr-2">•</span>
                                            <span>Minimize animal suffering and use alternatives when possible</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Plagiarism and Data Integrity -->
                        <div class="border border-slate-200 rounded-lg p-6">
                            <h3 class="font-semibold text-lg text-slate-800 mb-3 flex items-center">
                                <i class="fas fa-ban mr-2 text-red-600"></i>Plagiarism & Data Integrity
                            </h3>
                            <div class="bg-red-50 border border-red-200 rounded p-4 mb-3">
                                <p class="text-sm text-red-800 font-semibold mb-2">Zero Tolerance Policy</p>
                                <p class="text-sm text-red-700">We use plagiarism detection software on all submissions. Manuscripts with significant plagiarism or data fabrication will be rejected and authors may be banned from future submissions.</p>
                            </div>
                            <ul class="space-y-2 text-sm text-slate-700">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-600 mr-2 mt-1"></i>
                                    <span>Properly cite all sources and previous work</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-600 mr-2 mt-1"></i>
                                    <span>Use quotation marks for direct quotes</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-600 mr-2 mt-1"></i>
                                    <span>Report data accurately without manipulation</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-600 mr-2 mt-1"></i>
                                    <span>Make raw data available upon request when possible</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Prior Publication -->
                        <div class="border border-slate-200 rounded-lg p-6">
                            <h3 class="font-semibold text-lg text-slate-800 mb-3 flex items-center">
                                <i class="fas fa-copy mr-2 text-blue-600"></i>Prior Publication
                            </h3>
                            <p class="text-sm text-slate-700 mb-3">
                                Manuscripts must contain original, unpublished work not under consideration elsewhere.
                            </p>
                            <div class="bg-slate-50 rounded p-4 text-sm text-slate-700">
                                <p class="mb-2"><strong>Acceptable:</strong></p>
                                <ul class="space-y-1 ml-4">
                                    <li>• Conference abstracts and posters</li>
                                    <li>• Preprint servers (arXiv, bioRxiv, etc.)</li>
                                    <li>• Thesis/dissertation (with proper citation)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Submission Process -->
                <section id="submission" class="bg-white rounded-xl shadow-card border border-slate-200 p-8">
                    <div class="flex items-start space-x-4 mb-6">
                        <div class="bg-cyan-100 text-cyan-700 p-3 rounded-lg">
                            <i class="fas fa-paper-plane text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800 mb-2">Submission Process</h2>
                            <p class="text-slate-600">Step-by-step guide to submitting your manuscript</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Submission Steps -->
                        <div>
                            <h3 class="font-bold text-lg mb-4 text-slate-800">How to Submit</h3>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-4">
                                    <div class="bg-primary-700 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold shrink-0">1</div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-slate-800 mb-1">Create an Account</h4>
                                        <p class="text-sm text-slate-600 mb-2">Register on our submission portal with your institutional email address.</p>
                                        <a href="/register" class="text-sm text-primary-700 hover:text-primary-800 font-medium">
                                            Register Now <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4">
                                    <div class="bg-primary-700 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold shrink-0">2</div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-slate-800 mb-1">Prepare Your Manuscript</h4>
                                        <p class="text-sm text-slate-600 mb-2">Ensure your manuscript follows all formatting and content guidelines outlined above.</p>
                                        <a href="#" class="text-sm text-primary-700 hover:text-primary-800 font-medium">
                                            Download Template <i class="fas fa-download ml-1"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4">
                                    <div class="bg-primary-700 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold shrink-0">3</div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-slate-800 mb-1">Upload Files</h4>
                                        <p class="text-sm text-slate-600">Upload your manuscript, figures, tables, and supplementary materials.</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4">
                                    <div class="bg-primary-700 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold shrink-0">4</div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-slate-800 mb-1">Complete Metadata</h4>
                                        <p class="text-sm text-slate-600">Enter title, abstract, keywords, author information, and funding details.</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4">
                                    <div class="bg-primary-700 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold shrink-0">5</div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-slate-800 mb-1">Review and Submit</h4>
                                        <p class="text-sm text-slate-600">Review all information, confirm compliance with policies, and submit.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Review Process -->
                        <div class="bg-blue-50 rounded-lg p-6">
                            <h3 class="font-bold text-lg mb-4 text-slate-800">What Happens Next?</h3>
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center shrink-0">
                                        <i class="fas fa-clock text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800">Initial Review (3-5 days)</p>
                                        <p class="text-xs text-slate-600">Editorial office checks for completeness and scope</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center shrink-0">
                                        <i class="fas fa-user-tie text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800">Editor Assignment (1 week)</p>
                                        <p class="text-xs text-slate-600">Associate editor evaluates manuscript</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center shrink-0">
                                        <i class="fas fa-edit text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800">Revision (if required)</p>
                                        <p class="text-xs text-slate-600">Expert reviewers provide detailed feedback</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center shrink-0">
                                        <i class="fas fa-check-circle text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800">Final Decision</p>
                                        <p class="text-xs text-slate-600">Accept, revisions required, or reject</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Checklist -->
                        <div class="border-2 border-primary-200 bg-primary-50 rounded-lg p-6">
                            <h3 class="font-bold text-lg mb-4 text-slate-800 flex items-center">
                                <i class="fas fa-tasks mr-2 text-primary-700"></i>Pre-Submission Checklist
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <label class="flex items-start space-x-2 text-sm text-slate-700">
                                    <input type="checkbox" class="mt-1 rounded border-slate-300 text-primary-700 focus:ring-primary-500">
                                    <span>Manuscript follows formatting guidelines</span>
                                </label>
                                <label class="flex items-start space-x-2 text-sm text-slate-700">
                                    <input type="checkbox" class="mt-1 rounded border-slate-300 text-primary-700 focus:ring-primary-500">
                                    <span>All authors approved final version</span>
                                </label>
                                <label class="flex items-start space-x-2 text-sm text-slate-700">
                                    <input type="checkbox" class="mt-1 rounded border-slate-300 text-primary-700 focus:ring-primary-500">
                                    <span>References formatted in APA style</span>
                                </label>
                                <label class="flex items-start space-x-2 text-sm text-slate-700">
                                    <input type="checkbox" class="mt-1 rounded border-slate-300 text-primary-700 focus:ring-primary-500">
                                    <span>Ethics approval obtained (if applicable)</span>
                                </label>
                                <label class="flex items-start space-x-2 text-sm text-slate-700">
                                    <input type="checkbox" class="mt-1 rounded border-slate-300 text-primary-700 focus:ring-primary-500">
                                    <span>Figures and tables properly formatted</span>
                                </label>
                                <label class="flex items-start space-x-2 text-sm text-slate-700">
                                    <input type="checkbox" class="mt-1 rounded border-slate-300 text-primary-700 focus:ring-primary-500">
                                    <span>Conflicts of interest declared</span>
                                </label>
                                <label class="flex items-start space-x-2 text-sm text-slate-700">
                                    <input type="checkbox" class="mt-1 rounded border-slate-300 text-primary-700 focus:ring-primary-500">
                                    <span>Abstract within word limit</span>
                                </label>
                                <label class="flex items-start space-x-2 text-sm text-slate-700">
                                    <input type="checkbox" class="mt-1 rounded border-slate-300 text-primary-700 focus:ring-primary-500">
                                    <span>Keywords provided (4-6 terms)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </section>

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

<?php
// Get the buffered content
$content = ob_get_clean();

// Include the main layout
include __DIR__ . '/../layouts/main.php';
?>
