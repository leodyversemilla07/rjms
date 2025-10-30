<?php
include 'templates/header.php';

// Get the article ID from the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $articleId = $_GET['id'];
} else {
    echo "Invalid article ID.";
    exit();
}

// Fetch the article details from the database
$sql = "SELECT * FROM submissions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $articleId);
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$article) {
    echo "Article not found.";
    exit();
}
?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="card mt-4 border-0 shadow">
            <div class="card-header bg-dark text-white">
                <h2 class="card-title mb-0"><?php echo htmlspecialchars($article['title']); ?></h2>
            </div>
            <div class="card-body">
                <p class="card-text mb-4"><strong>Status:</strong> <?php echo htmlspecialchars($article['status']); ?>
                </p>
                <p class="card-text mb-4"><strong>Submission Date:</strong>
                    <?php echo htmlspecialchars($article['submission_date']); ?></p>
                <p class="card-text mb-4"><strong>Abstract:</strong><br>
                    <?php echo nl2br(htmlspecialchars($article['abstract'])); ?></p>
                <p class="card-text mb-4"><strong>Keywords:</strong>
                    <?php echo htmlspecialchars($article['keywords']); ?></p>
            </div>
        </div>

        <div class="card mt-4 border-0 shadow">
            <div class="card-header bg-dark text-white">
                <h3 class="card-title mb-0">Article PDF</h3>
            </div>
            <div class="card-body">
                <div class="pdf-container">
                    <embed src="<?php echo htmlspecialchars($article['file_path']); ?>" type="application/pdf"
                        width="100%" height="600px">
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'templates/footer.php'; ?>