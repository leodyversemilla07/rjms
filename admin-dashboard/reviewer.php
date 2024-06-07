<?php include 'templates/header.php';

require_once '../includes/db_connection.php';
$conn = connectDB();

// SQL query to retrieve all user data
$sql = "SELECT * FROM users WHERE role = 'reviewer' ";

// Execute the query
$result = $conn->query($sql);

$sql2 = "SELECT COUNT(*) AS total_reviewer FROM users WHERE role = 'reviewer' ";

// Execute the query
$result2 = $conn->query($sql2);
?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Admin Dashboard</h4>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 d-flex">
                <div class="card flex-fill border-0 illustration">
                    <div class="card-body p-0 d-flex flex-fill">
                        <div class="row g-0 w-100">
                            <div class="col-6">
                                <div class="p-3 m-1">
                                    <h4>Welcome Back, Admin</h4>
                                    <p class="mb-0">Manage your reviewers efficiently.</p>
                                </div>
                            </div>
                            <div class="col-6 align-self-end text-end">
                                <img src="image/customer-support.jpg" class="img-fluid illustration-img"
                                    alt="Welcome Illustration" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex">
                <div class="card flex-fill border-0">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <?php while ($reviewer2 = $result2->fetch_assoc()): ?>
                                    <h4 class="mb-2"><?php echo htmlspecialchars($reviewer2['total_reviewer']); ?></h4>
                                <?php endwhile; ?>
                                <p class="mb-2">Total Editors</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Element -->
        <div class="card border-0">
            <div class="card-header">
                <h5 class="card-title">Managing Reviewers</h5>
                <h6 class="card-subtitle text-muted">
                    List of all reviewers.
                </h6>
                <div class="mb-3 text-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEditorModal">Add New
                        Reviewer</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Affiliation</th>
                            <th scope="col">Country</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($reviewer = $result->fetch_assoc()): ?>
                            <tr>
                                <th scope="row"><?php echo htmlspecialchars($reviewer['id']); ?></th>
                                <td><?php echo htmlspecialchars($reviewer['username']); ?></td>
                                <td><?php echo htmlspecialchars($reviewer['first_name']) ?></td>
                                <td><?php echo htmlspecialchars($reviewer['last_name']) ?></td>
                                <td><?php echo htmlspecialchars($reviewer['affiliation']) ?></td>
                                <td><?php echo htmlspecialchars($reviewer['country']) ?></td>
                                <td><?php echo htmlspecialchars($reviewer['email']) ?></td>
                                <td>
                                    <a href="edit_editor.php?id=<?= $reviewer['id'] ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_editor.php?id=<?= $reviewer['id'] ?>"
                                        class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Add more cards for other sections like Review Process, Analytics, etc. -->
    </div>
</main>
<a href="#" class="theme-toggle">
    <i class="fa-regular fa-moon"></i>
    <i class="fa-regular fa-sun"></i>
</a>

<?php include 'templates/footer.php'; ?>