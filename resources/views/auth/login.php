<?php
// Set page metadata
$title = 'Login - Research Journal Management System';
$description = 'Login to your Research Journal Management System account';
$keywords = 'login, research journal, sign in, authentication';

// Additional CSS for login page styling
$additionalCss = <<<'CSS'
<style>
.login-container {
    min-height: calc(100vh - 200px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
}
</style>
CSS;

// Start output buffering for the content
ob_start();
?>

<!-- Login Page Content -->
<div class="login-container">
    <div class="w-full max-w-md">
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-700 rounded-full mb-4">
                <i class="fas fa-graduation-cap text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-serif font-bold text-slate-800 mb-2">Research Journal</h1>
            <p class="text-slate-600">Management System</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-xl shadow-lg border-2 border-slate-200">
            <!-- Card Header -->
            <div class="bg-slate-800 text-white px-8 py-6 rounded-t-xl">
                <h2 class="text-2xl font-semibold mb-1">Welcome Back</h2>
                <p class="text-slate-200 text-sm">Sign in to access your account</p>
            </div>

            <!-- Card Body -->
            <div class="p-8">
                <!-- Flash Messages -->
                <?php if (isset($_SESSION['flash']['error'])): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r" x-data="{ show: true }" x-show="show" x-transition>
                        <div class="flex items-start justify-between">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-circle text-red-600 mr-3 mt-0.5"></i>
                                <p class="text-sm text-red-800"><?= htmlspecialchars($_SESSION['flash']['error']) ?></p>
                            </div>
                            <button @click="show = false" class="text-red-600 hover:text-red-800 ml-4">&times;</button>
                        </div>
                    </div>
                    <?php unset($_SESSION['flash']['error']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['flash']['success'])): ?>
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r" x-data="{ show: true }" x-show="show" x-transition>
                        <div class="flex items-start justify-between">
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-600 mr-3 mt-0.5"></i>
                                <p class="text-sm text-green-800"><?= htmlspecialchars($_SESSION['flash']['success']) ?></p>
                            </div>
                            <button @click="show = false" class="text-green-600 hover:text-green-800 ml-4">&times;</button>
                        </div>
                    </div>
                    <?php unset($_SESSION['flash']['success']); ?>
                <?php endif; ?>

                <!-- Login Form -->
                <form id="loginForm" method="POST" action="/login" class="space-y-5">
                    <?= \App\Core\CSRF::field() ?>
                    <!-- Username/Email Field -->
                    <div>
                        <label for="username_email" class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fas fa-user mr-2 text-slate-500"></i>Username or Email
                        </label>
                        <input 
                            type="text" 
                            id="username_email" 
                            name="username_email" 
                            required
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                            placeholder="Enter your username or email"
                        >
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fas fa-lock mr-2 text-slate-500"></i>Password
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required
                                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                placeholder="Enter your password"
                            >
                            <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-700">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember_me" class="w-4 h-4 text-primary-600 border-slate-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-sm text-slate-600">Remember me</span>
                        </label>
                        <a href="/forgot-password" class="text-sm text-primary-700 hover:text-primary-800 font-medium">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-primary-700 hover:bg-primary-800 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        <span>Sign In</span>
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-slate-500">New to the platform?</span>
                    </div>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <a href="/register" class="inline-flex items-center text-primary-700 hover:text-primary-800 font-medium">
                        <i class="fas fa-user-plus mr-2"></i>
                        Create an account
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Links -->
        <div class="mt-8 text-center text-sm text-slate-600">
            <a href="/" class="hover:text-primary-700 mx-2">Home</a>
            <span class="text-slate-400">•</span>
            <a href="/help" class="hover:text-primary-700 mx-2">Help</a>
            <span class="text-slate-400">•</span>
            <a href="/contact" class="hover:text-primary-700 mx-2">Contact</a>
        </div>
    </div>
</div>

<?php
// Get the buffered content
$content = ob_get_clean();

// Additional JavaScript for login page
$additionalJs = <<<'JS'
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    document.getElementById('loginForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        const btnText = submitBtn.querySelector('span');
        const originalText = btnText.innerHTML;
        
        submitBtn.disabled = true;
        btnText.innerHTML = 'Signing in...';
        
        try {
            const response = await fetch('/login', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                btnText.innerHTML = 'Success!';
                window.location.href = data.redirect || '/';
            } else {
                alert(data.message || 'Login failed. Please check your credentials.');
                submitBtn.disabled = false;
                btnText.innerHTML = originalText;
            }
        } catch (error) {
            alert('An error occurred. Please try again.');
            submitBtn.disabled = false;
            btnText.innerHTML = originalText;
        }
    });
</script>
JS;

// Include the main layout
include __DIR__ . '/../layouts/main.php';
?>
