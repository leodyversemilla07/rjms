<?php
include 'templates/header.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve form data
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $keywords = $_POST['keywords'];

    // File upload handling
    $uploadDir = '../uploads/'; // Directory where uploaded files will be saved
    $uploadFile = $uploadDir . basename($_FILES['articleFile']['name']); // Get the file name

    if (move_uploaded_file($_FILES['articleFile']['tmp_name'], $uploadFile)) {
        // File uploaded successfully, continue with database insertion
        $file_path = $uploadFile;

        // Retrieve author's user ID from session
        if (isset($_SESSION['user_id'])) {
            $author_user_id = $_SESSION['user_id'];

            // Insert the article into the database
            $conn = connectDB();
            $sql = "INSERT INTO submissions (author_user_id, title, abstract, status, submission_date, file_path, keywords) VALUES (?, ?, ?, 'pending', NOW(), ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issss", $author_user_id, $title, $abstract, $file_path, $keywords);
            $stmt->execute();

            // Set success message
            $message = 'Article submitted successfully.';
        } else {
            // Set error message if user_id session variable is not set
            $message = 'User ID not found. Please log in again.';
        }
    } else {
        // File upload failed
        $message = 'Sorry, there was an error uploading your file.';
    }
}

?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="card border-0">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title">Submit Manuscripts</h5>
                <h6 class="card-subtitle text-white">Submit your manuscripts now.</h6>
            </div>
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label text-light">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="abstract" class="form-label text-light">Abstract</label>
                        <textarea class="form-control" id="abstract" name="abstract" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="keywords" class="form-label text-light">Keywords</label>
                        <input type="text" class="form-control" id="keywords" name="keywords" required>
                    </div>
                    <div class="mb-3">
                        <label for="articleFile" class="form-label text-light">Article File</label>
                        <input type="file" class="form-control-file" id="articleFile" name="articleFile" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="messageModalLabel">Submission Status</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo $message; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function () {
        <?php if (!empty($message)): ?>
            $('#messageModal').modal('show');
        <?php endif; ?>
    });
</script>

<?php include 'templates/footer.php'; ?>