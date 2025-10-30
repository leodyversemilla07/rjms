<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RJMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }
        .login-left {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-right {
            padding: 60px 40px;
        }
        .brand-logo {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .brand-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .brand-subtitle {
            font-size: 16px;
            opacity: 0.9;
        }
        .form-title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        .form-subtitle {
            color: #666;
            margin-bottom: 30px;
        }
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        .divider {
            text-align: center;
            margin: 20px 0;
            color: #999;
        }
        .social-login {
            display: flex;
            gap: 10px;
        }
        .social-btn {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
        }
        .social-btn:hover {
            background: #f8f9fa;
            border-color: #667eea;
        }
        .feature-list {
            list-style: none;
            padding: 0;
            margin-top: 30px;
        }
        .feature-list li {
            padding: 10px 0;
            display: flex;
            align-items: center;
        }
        .feature-list i {
            margin-right: 15px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container row g-0">
            <!-- Left Side - Branding -->
            <div class="col-md-5 login-left">
                <div class="brand-logo">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h1 class="brand-title">Research Journal Management System</h1>
                <p class="brand-subtitle">Mindoro State University</p>
                
                <ul class="feature-list">
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Submit & Manage Articles</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Peer Review Workflow</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Publication Management</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Secure & Modern Platform</span>
                    </li>
                </ul>
            </div>

            <!-- Right Side - Login Form -->
            <div class="col-md-7 login-right">
                <h2 class="form-title">Welcome Back!</h2>
                <p class="form-subtitle">Please login to your account</p>

                <?php if (isset($_SESSION['flash']['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?= htmlspecialchars($_SESSION['flash']['error']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['flash']['error']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['flash']['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <?= htmlspecialchars($_SESSION['flash']['success']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['flash']['success']); ?>
                <?php endif; ?>

                <form id="loginForm" method="POST" action="/login">
                    <div class="mb-3">
                        <label for="username_email" class="form-label">
                            <i class="fas fa-user me-2"></i>Username or Email
                        </label>
                        <input type="text" class="form-control" id="username_email" name="username_email" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                        <label class="form-check-label" for="remember_me">
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="btn btn-login btn-primary w-100 mb-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>

                    <div class="text-center">
                        <a href="/forgot-password" class="text-decoration-none">Forgot Password?</a>
                    </div>
                </form>

                <div class="divider">
                    <span>OR</span>
                </div>

                <div class="text-center">
                    <p class="mb-0">Don't have an account? 
                        <a href="/register" class="text-decoration-none fw-bold">Register Now</a>
                    </p>
                </div>

                <div class="text-center mt-3">
                    <a href="/" class="text-decoration-none">
                        <i class="fas fa-home me-2"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                
                const $btn = $(this).find('button[type="submit"]');
                const originalText = $btn.html();
                $btn.html('<i class="fas fa-spinner fa-spin me-2"></i>Logging in...').prop('disabled', true);

                $.ajax({
                    url: '/login',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $btn.html('<i class="fas fa-check me-2"></i>Success!').removeClass('btn-primary').addClass('btn-success');
                            setTimeout(function() {
                                window.location.href = response.redirect || '/';
                            }, 500);
                        } else {
                            alert(response.message || 'Login failed');
                            $btn.html(originalText).prop('disabled', false);
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                        $btn.html(originalText).prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html>
