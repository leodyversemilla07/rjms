<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RJMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="/resources/css/app.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .register-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            max-width: 1000px;
            margin: 0 auto;
        }
        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }
        .register-header h1 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .register-body {
            padding: 40px;
        }
        .form-section {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
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
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 16px;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        .required-field::after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <div class="register-header">
                <i class="fas fa-user-plus fa-3x mb-3"></i>
                <h1>Create Your Account</h1>
                <p class="mb-0">Join Mindoro State University Research Journal Management System</p>
            </div>

            <div class="register-body">
                <?php if (isset($_SESSION['flash']['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?= htmlspecialchars($_SESSION['flash']['error']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['flash']['error']); ?>
                <?php endif; ?>

                <form id="registerForm" method="POST" action="/register">
                    <!-- Account Information -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-user-circle me-2"></i>Account Information
                        </h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label required-field">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required 
                                       pattern="[a-zA-Z0-9]+" title="Only letters and numbers allowed" minlength="3">
                                <small class="text-muted">Only letters and numbers, min 3 characters</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label required-field">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <small class="text-muted">We'll use this for notifications</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label required-field">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required minlength="6">
                                <small class="text-muted">Minimum 6 characters</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirm_password" class="form-label required-field">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                <small class="text-muted">Must match password</small>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-id-card me-2"></i>Personal Information
                        </h3>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="first_name" class="form-label required-field">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name">
                                <small class="text-muted">Optional</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="last_name" class="form-label required-field">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="affiliation" class="form-label">Affiliation/Institution</label>
                                <input type="text" class="form-control" id="affiliation" name="affiliation">
                                <small class="text-muted">University or organization</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="country" class="form-label required-field">Country</label>
                                <select class="form-control" id="country" name="country" required>
                                    <option value="">Select Country</option>
                                    <option value="Philippines" selected>Philippines</option>
                                    <option value="United States">United States</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Japan">Japan</option>
                                    <option value="China">China</option>
                                    <option value="India">India</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="form-section">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the <a href="/terms" target="_blank">Terms and Conditions</a> and 
                                <a href="/privacy" target="_blank">Privacy Policy</a>
                            </label>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-register btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Create Account
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <p class="mb-0">Already have an account? 
                            <a href="/login" class="text-decoration-none fw-bold">Login Here</a>
                        </p>
                    </div>

                    <div class="text-center mt-3">
                        <a href="/" class="text-decoration-none">
                            <i class="fas fa-home me-2"></i>Back to Home
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Password match validation
            $('#confirm_password').on('input', function() {
                if ($(this).val() !== $('#password').val()) {
                    this.setCustomValidity('Passwords do not match');
                } else {
                    this.setCustomValidity('');
                }
            });

            $('#registerForm').on('submit', function(e) {
                e.preventDefault();

                // Validate passwords match
                if ($('#password').val() !== $('#confirm_password').val()) {
                    alert('Passwords do not match!');
                    return;
                }

                const $btn = $(this).find('button[type="submit"]');
                const originalText = $btn.html();
                $btn.html('<i class="fas fa-spinner fa-spin me-2"></i>Creating Account...').prop('disabled', true);

                $.ajax({
                    url: '/register',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $btn.html('<i class="fas fa-check me-2"></i>Success!').removeClass('btn-primary').addClass('btn-success');
                            alert(response.message || 'Registration successful!');
                            setTimeout(function() {
                                window.location.href = response.redirect || '/login';
                            }, 500);
                        } else {
                            alert(response.message || 'Registration failed');
                            $btn.html(originalText).prop('disabled', false);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
                        alert(response?.message || 'An error occurred. Please try again.');
                        $btn.html(originalText).prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html>
