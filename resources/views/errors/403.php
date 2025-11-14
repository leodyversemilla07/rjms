<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Forbidden | Research Journal Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="/css/tailwind.css" rel="stylesheet">
</head>
<body class="bg-slate-50 font-sans min-h-screen flex items-center justify-center p-4">
    <div class="max-w-2xl w-full">
        <!-- Error Card -->
        <div class="bg-white rounded-xl shadow-2xl border-2 border-slate-200 overflow-hidden">
            <!-- Header -->
            <div class="bg-red-800 text-white px-8 py-12 text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-white/10 backdrop-blur-sm rounded-full mb-6 border-4 border-white/20">
                    <i class="fas fa-lock text-5xl"></i>
                </div>
                <h1 class="text-7xl md:text-8xl font-bold mb-4 font-serif">403</h1>
                <p class="text-2xl text-red-100">Access Forbidden</p>
            </div>

            <!-- Content -->
            <div class="p-8 md:p-12 text-center">
                <div class="mb-8">
                    <p class="text-lg text-slate-700 mb-4 leading-relaxed">
                        You don't have permission to access this resource. This could be because you're not logged in 
                        or your account doesn't have the required privileges.
                    </p>
                    <div class="bg-red-50 border-l-4 border-red-600 rounded-r-lg p-4 text-left">
                        <p class="text-sm text-slate-600">
                            <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                            <strong>Access Denied:</strong> If you believe you should have access to this page, please contact your administrator.
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                    <a href="/" class="inline-flex items-center justify-center bg-primary-700 hover:bg-primary-800 text-white font-semibold py-3 px-8 rounded-lg transition-colors">
                        <i class="fas fa-home mr-2"></i>Go to Homepage
                    </a>
                    <a href="/login" class="inline-flex items-center justify-center border-2 border-primary-700 text-primary-700 hover:bg-primary-50 font-semibold py-3 px-8 rounded-lg transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                </div>

                <!-- Quick Links -->
                <div class="border-t border-slate-200 pt-8">
                    <p class="text-sm text-slate-600 mb-4 font-medium">Need Help?</p>
                    <div class="flex flex-wrap justify-center gap-3">
                        <a href="/contact" class="text-sm text-primary-700 hover:text-primary-800 hover:underline">
                            <i class="fas fa-envelope mr-1"></i>Contact Support
                        </a>
                        <span class="text-slate-300">•</span>
                        <a href="/faq" class="text-sm text-primary-700 hover:text-primary-800 hover:underline">
                            <i class="fas fa-question-circle mr-1"></i>FAQ
                        </a>
                        <span class="text-slate-300">•</span>
                        <a href="/help" class="text-sm text-primary-700 hover:text-primary-800 hover:underline">
                            <i class="fas fa-life-ring mr-1"></i>Help Center
                        </a>
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
