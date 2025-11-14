<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Research Journal Management System' ?></title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?= $description ?? 'Research Journal Management System - A comprehensive platform for managing scholarly publications, peer reviews, and editorial workflows' ?>">
    <meta name="keywords" content="<?= $keywords ?? 'research, journal, academic publishing, peer review, scholarly communication' ?>">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Tailwind CSS v4 - Compiled -->
    <link href="/css/tailwind.css" rel="stylesheet">
    
    <?= $additionalCss ?? '' ?>
</head>
<body class="bg-slate-50 font-sans">
    <!-- Navigation -->
    <?php include __DIR__ . '/../components/navigation.php'; ?>
    
    <!-- Flash Messages -->
    <?php if (isset($_SESSION['flash'])): ?>
        <div class="container mx-auto px-4 mt-4">
            <?php foreach ($_SESSION['flash'] as $key => $message): ?>
                <?php if ($key !== 'old' && $key !== 'errors'): ?>
                    <?php 
                    $alertClass = 'bg-blue-50 border-blue-400 text-blue-800';
                    $iconClass = 'fa-info-circle text-blue-600';
                    if ($key === 'error' || $key === 'danger') {
                        $alertClass = 'bg-red-50 border-red-400 text-red-800';
                        $iconClass = 'fa-exclamation-circle text-red-600';
                    } elseif ($key === 'success') {
                        $alertClass = 'bg-green-50 border-green-400 text-green-800';
                        $iconClass = 'fa-check-circle text-green-600';
                    } elseif ($key === 'warning') {
                        $alertClass = 'bg-amber-50 border-amber-400 text-amber-800';
                        $iconClass = 'fa-exclamation-triangle text-amber-600';
                    }
                    ?>
                    <div class="border-l-4 p-4 mb-3 rounded-r-lg <?= $alertClass ?> shadow-sm" role="alert" x-data="{ show: true }" x-show="show" x-transition>
                        <div class="flex items-start justify-between">
                            <div class="flex items-start">
                                <i class="fas <?= $iconClass ?> mr-3 mt-0.5"></i>
                                <p class="font-medium"><?= htmlspecialchars($message) ?></p>
                            </div>
                            <button @click="show = false" class="ml-4 text-lg font-bold opacity-50 hover:opacity-100 transition-opacity">&times;</button>
                        </div>
                    </div>
                    <?php unset($_SESSION['flash'][$key]); ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <!-- Main Content -->
    <main class="min-h-screen">
        <?= $content ?? '' ?>
    </main>
    
    <!-- Footer -->
    <?php include __DIR__ . '/../components/footer.php'; ?>
    
    <!-- Alpine.js for interactive components -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <?= $additionalJs ?? '' ?>
</body>
</html>
