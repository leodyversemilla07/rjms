<?php include 'templates/header.php'; ?>

<div class="contact">
    <h2><b>Contact Us</b></h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-block">Submit</button>
    </form>
    <?php
    // Database connection configuration
    require_once 'includes/db_connection.php';
    $conn = connectDB();

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO inbox (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        // Execute SQL statement
        if ($stmt->execute()) {
            echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            $('#messageModal .modal-body').text('Message sent successfully!');
                            $('#messageModal').modal('show');
                        });
                      </script>";
        } else {
            echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            $('#messageModal .modal-body').text('Sorry, there was an error sending your message.');
                            $('#messageModal').modal('show');
                        });
                      </script>";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
    ?>
</div>

<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Success or error message will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>