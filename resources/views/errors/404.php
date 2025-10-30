<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | RJMS</title>
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/fortawesome/font-awesome/css/all.min.css" rel="stylesheet">
    <style>
        .error-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .error-content {
            text-align: center;
        }
        .error-code {
            font-size: 120px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .error-message {
            font-size: 24px;
            margin-bottom: 30px;
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
            <p class="mb-4">The page you are looking for doesn't exist or has been moved.</p>
            <a href="/" class="btn btn-light btn-lg">
                <i class="fas fa-home me-2"></i>Go Home
            </a>
        </div>
    </div>
</body>
</html>
