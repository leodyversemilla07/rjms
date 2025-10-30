<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Research Journal Management System</title>
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
            padding: 20px;
        }

        .auth-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
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

        .form-control {
            padding: 12px 15px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            font-size: 14px;
        }

        .form-control:focus {
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

        .text-end a {
            color: #4F46E5;
            text-decoration: none;
            font-size: 14px;
        }

        .text-end a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h1>Welcome Back</h1>
            <p>Login to your account</p>
        </div>

        <div class="auth-body">
            <?php if (isset($_SESSION['flash']['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['flash']['error']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['flash']['error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['flash']['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['flash']['success']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['flash']['success']); ?>
            <?php endif; ?>

            <form id="loginForm" method="POST" action="/login">
                <div class="mb-3">
                    <label for="username_email" class="form-label">Username or Email</label>
                    <input type="text" class="form-control" id="username_email" name="username_email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                        <label class="form-check-label" for="remember_me">Remember me</label>
                    </div>
                    <div class="text-end">
                        <a href="/forgot-password">Forgot Password?</a>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>

        <div class="auth-footer">
            <p class="mb-0">Don't have an account? <a href="/register">Create Account</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Logging in...';
            
            try {
                const response = await fetch('/login', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    window.location.href = data.redirect || '/';
                } else {
                    alert(data.message || 'Login failed. Please try again.');
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
