<?php
include 'templates/header.php';

?>

<main class="content px-3 py-2">
  <div class="container-fluid">
    <div class="mb-3">
      <h4>Author Dashboard</h4>
    </div>
    <div class="row mb-4">
      <div class="col-12 col-md-6 d-flex">
        <div class="card flex-fill border-0 illustration bg-dark shadow-sm">
          <div class="card-body p-0 d-flex flex-fill">
            <div class="row g-0 w-100">
              <div class="col-6">
                <div class="p-3 m-1">
                  <h4>Welcome Back, Author</h4>
                  <p class="mb-0">Manage your submissions efficiently.</p>
                </div>
              </div>
              <div class="col-6 align-self-end text-end">
                <img src="image/customer-support.jpg" class="img-fluid illustration-img" alt="Welcome Illustration" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 d-flex">
        <div class="card flex-fill border-0 bg-info text-white shadow-sm">
          <div class="card-body py-4">
            <div class="d-flex align-items-start">
              <div class="flex-grow-1">
                <h4 class="mb-2">Total Submissions</h4>
                <?php
                // Fetch the total number of submissions for this author
                $sql_total_submissions = "SELECT COUNT(*) AS total_submissions FROM submissions WHERE author_user_id = ?";
                $stmt_total_submissions = $conn->prepare($sql_total_submissions);
                $stmt_total_submissions->bind_param("i", $author_user_id);
                $stmt_total_submissions->execute();
                $result_total_submissions = $stmt_total_submissions->get_result();
                $total_submissions = $result_total_submissions->fetch_assoc()['total_submissions'];
                ?>
                <p class="mb-2"><?php echo htmlspecialchars($total_submissions); ?></p>
                <div class="mb-0">
                  <span class="badge bg-light text-info me-2"> +10% </span>
                  <span class="text-light"> Since Last Month </span>
                </div>
              </div>
              <div class="ms-auto">
                <i class="fas fa-file-alt fa-3x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
      <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Pending Reviews</h5>
            <?php
            // Fetch the number of pending reviews for this author
            $sql_pending_reviews = "SELECT COUNT(*) AS pending_reviews FROM submissions WHERE author_user_id = ? AND status = 'Under Review'";
            $stmt_pending_reviews = $conn->prepare($sql_pending_reviews);
            $stmt_pending_reviews->bind_param("i", $author_user_id);
            $stmt_pending_reviews->execute();
            $result_pending_reviews = $stmt_pending_reviews->get_result();
            $pending_reviews = $result_pending_reviews->fetch_assoc()['pending_reviews'];
            ?>
            <p class="card-text"><?php echo htmlspecialchars($pending_reviews); ?></p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Accepted Papers</h5>
            <?php
            // Fetch the number of accepted papers for this author
            $sql_accepted_papers = "SELECT COUNT(*) AS accepted_papers FROM submissions WHERE author_user_id = ? AND status = 'Accepted'";
            $stmt_accepted_papers = $conn->prepare($sql_accepted_papers);
            $stmt_accepted_papers->bind_param("i", $author_user_id);
            $stmt_accepted_papers->execute();
            $result_accepted_papers = $stmt_accepted_papers->get_result();
            $accepted_papers = $result_accepted_papers->fetch_assoc()['accepted_papers'];
            ?>
            <p class="card-text"><?php echo htmlspecialchars($accepted_papers); ?></p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Total Submissions</h5>
            <p class="card-text"><?php echo htmlspecialchars($total_submissions); ?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Table Element -->
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-dark text-white">
        <h5 class="card-title">Recent Submissions</h5>
        <h6 class="card-subtitle text-muted">
          Overview of your latest manuscript submissions.
        </h6>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Title</th>
              <th scope="col">Status</th>
              <th scope="col">Submission Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Fetch recent submissions with author names
            $sql = "SELECT s.id, s.title, CONCAT(u.first_name, ' ', u.last_name) AS author_name, s.status, s.submission_date
                    FROM submissions s
                    JOIN users u ON s.author_user_id = u.id
                    ORDER BY s.submission_date DESC
                    LIMIT 10";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              // Output data of each row
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<th scope='row'>" . htmlspecialchars($row['id']) . "</th>";
                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['author_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                echo "<td>" . htmlspecialchars($row['submission_date']) . "</td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='5' class='text-center'>No submissions found</td></tr>";
            }

            // Close connection
            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<?php include 'templates/footer.php'; ?>