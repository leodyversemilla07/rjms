<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Research Journal Management System' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/vendor/fortawesome/font-awesome/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/resources/css/style.css" rel="stylesheet">
    
    <?= $additionalCss ?? '' ?>
</head>
<body>
    <!-- Navigation -->
    <?php include __DIR__ . '/../components/navigation.php'; ?>
    
    <!-- Flash Messages -->
    <?php if (isset($_SESSION['flash'])): ?>
        <?php foreach ($_SESSION['flash'] as $key => $message): ?>
            <?php if ($key !== 'old' && $key !== 'errors'): ?>
                <div class="alert alert-<?= $key === 'error' ? 'danger' : $key ?> alert-dismissible fade show m-3" role="alert">
                    <?= htmlspecialchars($message) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['flash'][$key]); ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- Main Content -->
    <main>
        <?= $content ?? '' ?>
    </main>
    
    <!-- Footer -->
    <?php include __DIR__ . '/../components/footer.php'; ?>
    
    <!-- Bootstrap JS -->
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (if needed) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <?= $additionalJs ?? '' ?>
</body>
</html>
