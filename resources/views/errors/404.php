<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | RJMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/fortawesome/font-awesome/css/all.min.css" rel="stylesheet">
    <style>
        .error-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #F3F4F6;
            color: #1E293B;
            font-family: 'Inter', sans-serif;
        }
        .error-content {
            text-align: center;
            background: white;
            padding: 60px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .error-code {
            font-size: 120px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #4F46E5;
        }
        .error-message {
            font-size: 24px;
            margin-bottom: 30px;
            color: #1E293B;
        }
        .btn-primary {
            background: #4F46E5;
            border: none;
        }
        .btn-primary:hover {
            background: #4338CA;
        }
    </style>
</head>
<body>
    <div class="error-page">
        <div class="error-content">
            <div class="error-code">404</div>
            <div class="error-message">
                <i class="fas fa-exclamation-triangle"></i>
                Page Not Found
            </div>
            <p class="mb-4 text-muted">The page you are looking for doesn't exist or has been moved.</p>
            <a href="/" class="btn btn-primary btn-lg">
                <i class="fas fa-home me-2"></i>Go Home
            </a>
        </div>
    </div>
</body>
</html>
