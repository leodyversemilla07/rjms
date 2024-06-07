<?php
include 'templates/header.php';

// Get the article ID from the URL
$articleId = ($_GET['id'] ?? '');
if (!is_numeric($articleId)) {
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $abstract = $_POST['abstract'] ?? '';
    $keywords = $_POST['keywords'] ?? '';

    // Check if a new PDF file is uploaded
    if ($_FILES['pdfFile']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['pdfFile']['name']);
        if (move_uploaded_file($_FILES['pdfFile']['tmp_name'], $uploadFile)) {
            // Remove the previous file
            if (!empty($article['file_path'])) {
                unlink($article['file_path']);
            }

            // Update the file path in the database
            $file_path = $uploadFile;
            $sql = "UPDATE submissions SET title = ?, abstract = ?, keywords = ?, file_path = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $title, $abstract, $keywords, $file_path, $articleId);
            $stmt->execute();
            $stmt->close();
        } else {
            // File upload failed
            echo "<script>alert('Sorry, there was an error uploading your PDF file.');</script>";
        }
    } else {
        // No new PDF file uploaded, update other details
        $sql = "UPDATE submissions SET title = ?, abstract = ?, keywords = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $abstract, $keywords, $articleId);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: manage_articles.php");
    exit();
}
?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5 class="card-title mb-0">Edit Article</h5>
                    </div>
                    <div class="card-body">
                        <form action="edit_article.php?id=<?php echo $articleId; ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="<?php echo htmlspecialchars($article['title']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="abstract" class="form-label">Abstract</label>
                                <textarea class="form-control" id="abstract" name="abstract" rows="5"
                                    required><?php echo htmlspecialchars($article['abstract']); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="keywords" class="form-label">Keywords</label>
                                <input type="text" class="form-control" id="keywords" name="keywords"
                                    value="<?php echo htmlspecialchars($article['keywords']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="pdfFile" class="form-label">Upload New PDF File (Optional)</label>
                                <input type="file" class="form-control-file" id="pdfFile" name="pdfFile">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Update</button>
                            <a href="manage-articles.php" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include 'templates/footer.php'; ?>