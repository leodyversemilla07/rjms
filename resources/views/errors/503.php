<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>503 - Service Unavailable | Research Journal Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="/css/tailwind.css" rel="stylesheet">
</head>
<body class="bg-slate-50 font-sans min-h-screen flex items-center justify-center p-4">
    <div class="max-w-2xl w-full">
        <!-- Error Card -->
        <div class="bg-white rounded-xl shadow-2xl border-2 border-slate-200 overflow-hidden">
            <!-- Header -->
            <div class="bg-slate-800 text-white px-8 py-12 text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-white/10 backdrop-blur-sm rounded-full mb-6 border-4 border-white/20">
                    <i class="fas fa-wrench text-5xl"></i>
                </div>
                <h1 class="text-7xl md:text-8xl font-bold mb-4 font-serif">503</h1>
                <p class="text-2xl text-slate-200">Service Temporarily Unavailable</p>
            </div>

            <!-- Content -->
            <div class="p-8 md:p-12 text-center">
                <div class="mb-8">
                    <p class="text-lg text-slate-700 mb-4 leading-relaxed">
                        We're currently performing scheduled maintenance to improve your experience. 
                        The system will be back online shortly.
                    </p>
                    <div class="bg-primary-50 border-l-4 border-primary-600 rounded-r-lg p-4 text-left">
                        <p class="text-sm text-slate-600">
                            <i class="fas fa-clock text-primary-700 mr-2"></i>
                            <strong>Maintenance in Progress:</strong> We appreciate your patience. Normal service will resume soon.
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                    <button onclick="location.reload()" class="inline-flex items-center justify-center bg-primary-700 hover:bg-primary-800 text-white font-semibold py-3 px-8 rounded-lg transition-colors">
                        <i class="fas fa-redo mr-2"></i>Refresh Page
                    </button>
                    <a href="/" class="inline-flex items-center justify-center border-2 border-primary-700 text-primary-700 hover:bg-primary-50 font-semibold py-3 px-8 rounded-lg transition-colors">
                        <i class="fas fa-home mr-2"></i>Homepage
                    </a>
                </div>

                <!-- Status Info -->
                <div class="border-t border-slate-200 pt-8">
                    <div class="bg-slate-50 rounded-lg p-6">
                        <div class="flex items-center justify-center mb-4">
                            <div class="w-3 h-3 bg-amber-500 rounded-full animate-pulse mr-3"></div>
                            <p class="text-sm font-semibold text-slate-700">System Status: Under Maintenance</p>
                        </div>
                        <p class="text-xs text-slate-600">
                            For updates, please check back in a few minutes or 
                            <a href="/contact" class="text-primary-700 hover:text-primary-800 font-medium">contact support</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="text-center mt-8 text-sm text-slate-600">
            <p>Research Journal Management System</p>
        </div>
    </div>
</body>
</html>
