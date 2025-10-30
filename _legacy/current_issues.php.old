<?php include 'templates/header.php';

require_once 'includes/db_connection.php';

$conn = connectDB();

$sql = "SELECT title, abstract, date_published FROM submissions WHERE is_published = 1 ORDER BY date_published DESC";
$result = $conn->query($sql);
$articles = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();

?>

<section class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="text-center mb-4">Published Articles</h2>
            <?php foreach ($articles as $article): ?>
                <div class="article mb-4">
                    <h3 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h3>
                    <p class="article-summary"><?php echo htmlspecialchars($article['abstract']); ?></p>
                    <p class="article-date">Published on:
                        <?php echo date('F j, Y', strtotime($article['date_published'])); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'templates/footer.php'; ?>