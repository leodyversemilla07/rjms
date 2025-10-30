<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Research Journal Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="/resources/css/app.css" rel="stylesheet">
    <style>
        body {
            background: #F3F4F6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            padding: 40px 20px;
        }

        .auth-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 550px;
            border: 1px solid #e0e0e0;
        }

        .auth-header {
            background: #4F46E5;
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .auth-header h1 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .auth-header p {
            margin: 0;
            opacity: 0.95;
            font-size: 14px;
        }

        .auth-body {
            padding: 40px 30px;
        }

        .form-control, .form-select {
            padding: 12px 15px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            font-size: 14px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #4F46E5;
            box-shadow: 0 0 0 0.15rem rgba(79, 70, 229, 0.15);
            outline: none;
        }

        .form-label {
            font-weight: 500;
            color: #1E293B;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .btn-primary {
            background: #4F46E5;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 15px;
            width: 100%;
        }

        .btn-primary:hover {
            background: #4338CA;
        }

        .auth-footer {
            text-align: center;
            padding: 20px 30px 30px;
            background: #F3F4F6;
        }

        .auth-footer a {
            color: #4F46E5;
            text-decoration: none;
            font-weight: 500;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .form-check-label {
            font-size: 14px;
        }

        .form-text {
            font-size: 13px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #1E293B;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 2px solid #4F46E5;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h1>Create Account</h1>
            <p>Join the research community</p>
        </div>

        <div class="auth-body">
            <?php if (isset($_SESSION['flash']['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['flash']['error']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['flash']['error']); ?>
            <?php endif; ?>

            <form id="registerForm" method="POST" action="/register">
                <!-- Account Information -->
                <div class="section-title">Account Information</div>
                
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="form-text">Minimum 8 characters</div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>

                <!-- Personal Information -->
                <div class="section-title">Personal Information</div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="affiliation" class="form-label">Affiliation/Institution</label>
                    <input type="text" class="form-control" id="affiliation" name="affiliation" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">I want to register as</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="">Select role...</option>
                        <option value="author">Author</option>
                        <option value="reviewer">Reviewer</option>
                    </select>
                </div>

                <div class="mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">
                            I agree to the <a href="/terms" target="_blank">Terms and Conditions</a>
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create Account</button>
            </form>
        </div>

        <div class="auth-footer">
            <p class="mb-0">Already have an account? <a href="/login">Login here</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            
            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                return;
            }
            
            if (password.length < 8) {
                alert('Password must be at least 8 characters long!');
                return;
            }
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Creating account...';
            
            try {
                const response = await fetch('/register', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    window.location.href = data.redirect || '/login';
                } else {
                    alert(data.message || 'Registration failed. Please try again.');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            } catch (error) {
                alert('An error occurred. Please try again.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    </script>
</body>
</html>
