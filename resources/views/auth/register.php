<?php
// Set page metadata
$title = 'Register - Research Journal Management System';
$description = 'Create an account to submit and manage your research publications';
$keywords = 'register, sign up, create account, research journal, academic publishing';

// Additional CSS for register page styling
$additionalCss = <<<'CSS'
<style>
.register-container {
    min-height: calc(100vh - 200px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
}
</style>
CSS;

// Start output buffering
ob_start();
?>

<!-- Registration Page Content -->
<div class="register-container">
    <div class="w-full max-w-2xl">
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-700 rounded-full mb-4">
                <i class="fas fa-graduation-cap text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-serif font-bold text-slate-800 mb-2">Research Journal</h1>
            <p class="text-slate-600">Management System</p>
        </div>

        <!-- Registration Card -->
        <div class="bg-white rounded-xl shadow-lg border-2 border-slate-200">
            <!-- Card Header -->
            <div class="bg-slate-800 text-white px-8 py-6 rounded-t-xl">
                <h2 class="text-2xl font-semibold mb-1">Create Your Account</h2>
                <p class="text-slate-200 text-sm">Join our academic publishing platform</p>
            </div>

            <!-- Card Body -->
            <div class="p-8">
                <!-- Registration Form -->
                <form id="registerForm" method="POST" action="/register" class="space-y-5">
                    <!-- Role Selection -->
                    <div class="bg-primary-50 border-l-4 border-primary-600 p-4 rounded-r">
                        <label class="block text-sm font-medium text-slate-800 mb-3">
                            <i class="fas fa-user-tag mr-2 text-primary-700"></i>I want to register as:
                        </label>
                        <div class="max-w-2xl mx-auto">
            <form method="POST" action="/register" class="space-y-6">
                <?= \App\Core\CSRF::field() ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <label class="flex items-center p-3 border-2 border-slate-200 rounded-lg cursor-pointer hover:border-primary-600 hover:bg-white transition-all">
                                <input type="radio" name="role" value="author" required class="w-4 h-4 text-primary-600 border-slate-300 focus:ring-primary-500">
                                <div class="ml-3">
                                    <span class="block font-medium text-slate-800">Author</span>
                                    <span class="block text-xs text-slate-600">Submit research papers</span>
                                </div>
                            </label>
                            <label class="flex items-center p-3 border-2 border-slate-200 rounded-lg cursor-pointer hover:border-primary-600 hover:bg-white transition-all">
                                <input type="radio" name="role" value="reviewer" class="w-4 h-4 text-primary-600 border-slate-300 focus:ring-primary-500">
                                <div class="ml-3">
                                    <span class="block font-medium text-slate-800">Reviewer</span>
                                    <span class="block text-xs text-slate-600">Review submissions</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-slate-700 mb-2">
                                <i class="fas fa-user mr-2 text-slate-500"></i>First Name
                            </label>
                            <input 
                                type="text" 
                                id="first_name" 
                                name="first_name" 
                                required
                                class="input-field"
                                placeholder="John"
                            >
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-slate-700 mb-2">
                                Last Name
                            </label>
                            <input 
                                type="text" 
                                id="last_name" 
                                name="last_name" 
                                required
                                class="input-field"
                                placeholder="Doe"
                            >
                        </div>
                    </div>

                    <!-- Account Details -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fas fa-at mr-2 text-slate-500"></i>Username
                        </label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            required
                            class="input-field"
                            placeholder="johndoe"
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-slate-500"></i>Email Address
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            required
                            class="input-field"
                            placeholder="john.doe@university.edu"
                        >
                        <p class="mt-1 text-xs text-slate-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Use your institutional email for verification
                        </p>
                    </div>

                    <!-- Password Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                                <i class="fas fa-lock mr-2 text-slate-500"></i>Password
                            </label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required
                                minlength="8"
                                class="input-field"
                                placeholder="••••••••"
                            >
                            <p class="mt-1 text-xs text-slate-500">Minimum 8 characters</p>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">
                                Confirm Password
                            </label>
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                required
                                minlength="8"
                                class="input-field"
                                placeholder="••••••••"
                            >
                        </div>
                    </div>

                    <!-- Affiliation -->
                    <div>
                        <label for="affiliation" class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fas fa-university mr-2 text-slate-500"></i>Institutional Affiliation
                        </label>
                        <input 
                            type="text" 
                            id="affiliation" 
                            name="affiliation" 
                            class="input-field"
                            placeholder="University Name, Department"
                        >
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">
                        <label class="flex items-start">
                            <input type="checkbox" name="terms" required class="w-4 h-4 mt-1 text-primary-600 border-slate-300 rounded focus:ring-primary-500">
                            <span class="ml-3 text-sm text-slate-700">
                                I agree to the <a href="/terms" class="text-primary-700 hover:text-primary-800 font-medium">Terms of Service</a> 
                                and <a href="/privacy" class="text-primary-700 hover:text-primary-800 font-medium">Privacy Policy</a>
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-primary w-full text-lg">
                        <i class="fas fa-user-plus mr-2"></i>
                        <span>Create Account</span>
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-slate-500">Already have an account?</span>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <a href="/login" class="inline-flex items-center text-primary-700 hover:text-primary-800 font-medium">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Sign in instead
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

// Additional JavaScript for register page
$additionalJs = <<<'JS'
<script>
    document.getElementById('registerForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Validate password match
        const password = document.getElementById('password').value;
        const confirmation = document.getElementById('password_confirmation').value;
        
        if (password !== confirmation) {
            alert('Passwords do not match!');
            return;
        }
        
        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        const btnText = submitBtn.querySelector('span');
        const originalText = btnText.innerHTML;
        
        submitBtn.disabled = true;
        btnText.innerHTML = 'Creating account...';
        
        try {
            const response = await fetch('/register', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                btnText.innerHTML = 'Success! Redirecting...';
                window.location.href = data.redirect || '/login';
            } else {
                alert(data.message || 'Registration failed. Please try again.');
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
