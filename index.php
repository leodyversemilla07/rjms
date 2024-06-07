<?php include 'templates/header.php';

require_once 'includes/db_connection.php';

$conn = connectDB();

$sql = "SELECT title, abstract, date_published FROM submissions WHERE is_published = 1 ORDER BY date_published DESC";
$result = $conn->query($sql);
$articles = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();

?>

<div class="hero-section">
    <div class="container">
        <h1>Welcome to MinSU Research Journal</h1>
        <p>Explore the latest research articles published by our community.</p>
    </div>
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-4"><b>About Us</b></h2>
                <p class="text-center">Welcome to the MinSU Research Journal Management System. We provide a platform
                    for researchers to publish and access high-quality academic journals. Whether you're a seasoned
                    academic or just starting your research journey, our system offers a user-friendly interface to
                    submit, browse, and access the latest research in your field.</p>
            </div>
        </div>
    </div>
</section>

<section class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="text-center mb-4">Published Articles</h2>
            <?php foreach ($articles as $article): ?>
                <div class="article mb-4">
                    <h3 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h3>
                    <p class="article-summary"><?php echo htmlspecialchars($article['abstract']); ?></p>
                    <p class="article-date">Published on:
                        <?php echo date('F j, Y', strtotime($article['date_published'])); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'templates/footer.php'; ?>