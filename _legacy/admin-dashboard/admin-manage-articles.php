<?php

include 'templates/header.php';
include '../includes/db_connection.php';

$conn = connectDB();

// Update the SQL query to include the author information by joining with the users table
$sql = "SELECT submissions.id, CONCAT(users.first_name, ' ', users.last_name) AS author, submissions.title, submissions.abstract, submissions.status, submissions.submission_date, submissions.file_path, submissions.keywords 
        FROM submissions 
        JOIN users ON submissions.author_user_id = users.id";
$result = $conn->query($sql);
$articles = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="container mt-5">
    <h2>Manage Articles</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Abstract</th>
                <th>Author</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?php echo htmlspecialchars($article['title']); ?></td>
                    <td><?php echo htmlspecialchars($article['abstract']); ?></td>
                    <td><?php echo htmlspecialchars($article['author']); ?></td>
                    <td><?php echo htmlspecialchars($article['status']); ?></td>
                    <td>
                        <?php if ($article['status'] != 'Published'): ?>
                            <form action="publish-article.php" method="post" style="display:inline;">
                                <input type="hidden" name="article_id" value="<?php echo $article['id']; ?>">
                                <button type="submit" class="btn btn-success btn-sm">Publish</button>
                            </form>
                        <?php else: ?>
                            <span class="text-success">Published</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'templates/footer.php'; ?>