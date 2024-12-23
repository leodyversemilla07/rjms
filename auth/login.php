<?php
session_start();
require_once '../includes/db_connection.php';

$conn = connectDB();

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_email = $_POST['username_email'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    if (filter_var($username_email, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM users WHERE email = ?";
    } else {
        $sql = "SELECT * FROM users WHERE username = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_id'] = $row['id'];

            if ($row['role'] == 'author') {
                header("Location: ../author-dashboard/index.php");
            } elseif ($row['role'] == 'admin') {
                header("Location: ../admin-dashboard/index.php");
            } elseif ($row['role'] == 'editor') {
                header("Location: ../editor-dashboard/index.php");
            } elseif ($row['role'] == 'reviewer') {
                header("Location: ../reviewer-dashboard/index.php");
            } else {
                // Redirect to other role dashboards if necessary
                $error_message = "Invalid role!";
            }
            exit();
        } else {
            $error_message = "Invalid username or password!";
        }
    } else {
        $error_message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MinSU Research Journal</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-color: #ebede6;
            color: #593d2c;
            font-family: "Poppins", sans-serif;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            max-width: 400px;
            position: relative;
        }

        .form-control {
            border-color: #399f3a;
            border-radius: 5px;
            font-size: 16px;
            padding: 10px;
            margin-bottom: 15px;
        }

        .form-control:focus {
            border-color: #0e5c2d;
            box-shadow: none;
        }

        .form-group label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #399f3a;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #0e5c2d;
            color: #ffffff;
        }

        .register-link {
            color: #399f3a;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .form-header {
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }

        .back-button {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #0e5c2d;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .back-button img {
            margin-right: 8px;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 300px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="../index.php" class="back-button">
            <img src="https://img.icons8.com/ios-filled/50/000000/left.png" alt="Back" width="24" height="24">
            Back
        </a>
        <h2 class="form-header">Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="username_email">Username or Email:</label>
                <input type="text" class="form-control" id="username_email" name="username_email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
        <p class="mt-3">Don't have an account? <a href="register.php" class="register-link">Register here</a>.</p>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('errorModal').style.display='none'">&times;</span>
            <p id="errorMessage"></p>
        </div>
    </div>

    <script>
        // Show the modal if there is an error message
        <?php if (!empty($error_message)) { ?>
            document.getElementById('errorMessage').innerText = "<?php echo $error_message; ?>";
            document.getElementById('errorModal').style.display = 'block';
        <?php } ?>
    </script>
</body>

</html>