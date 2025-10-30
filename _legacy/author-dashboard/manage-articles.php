<?php
include 'templates/header.php';

// Get the logged-in user's ID
$userId = $_SESSION['user_id'];

// Fetch submissions made by the logged-in author
$sql = "SELECT * FROM submissions WHERE author_user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$submissions = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title mb-0">Manage Submissions</h5>
                <h6 class="card-subtitle text-muted">List of all submitted manuscripts.</h6>
            </div>
            <div class="card-body">
                <?php if (count($submissions) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Submission Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($submissions as $submission): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($submission['title']); ?></td>
                                        <td><?php echo htmlspecialchars($submission['status']); ?></td>
                                        <td><?php echo htmlspecialchars($submission['submission_date']); ?></td>
                                        <td>
                                            <a href="view_article.php?id=<?php echo $submission['id']; ?>"
                                                class="btn btn-primary btn-sm me-1">View</a>
                                            <a href="edit_article.php?id=<?php echo $submission['id']; ?>"
                                                class="btn btn-secondary btn-sm me-1">Edit</a>
                                            <a href="delete_article.php?id=<?php echo $submission['id']; ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this article?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info mt-4" role="alert">
                        No articles found. <a href="submit_articles.php" class="alert-link">Submit your first article</a>.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php include 'templates/footer.php'; ?>