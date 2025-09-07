<?php
session_start();
require_once '../includes/db_connection.php';

// Set content type to JSON
header('Content-Type: application/json');

$response = ['success' => false, 'message' => '', 'redirect' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectDB();

    $username_email = trim($_POST['username_email']);
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember_me']);

    if (empty($username_email) || empty($password)) {
        $response['message'] = 'Please fill in all fields.';
        echo json_encode($response);
        exit();
    }

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
            // Set session variables
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_id'] = $row['id'];

            // Handle "Remember Me" functionality
            if ($remember_me) {
                $cookie_value = base64_encode($row['username'] . ':' . $row['id']);
                setcookie('remember_login', $cookie_value, time() + (86400 * 30), '/'); // 30 days
            }

            // Determine redirect based on role
            $redirect_url = '';
            switch ($row['role']) {
                case 'author':
                    $redirect_url = 'author-dashboard/index.php';
                    break;
                case 'admin':
                    $redirect_url = 'admin-dashboard/index.php';
                    break;
                case 'editor':
                    $redirect_url = 'editor-dashboard/index.php';
                    break;
                case 'reviewer':
                    $redirect_url = 'reviewer-dashboard/index.php';
                    break;
                default:
                    $redirect_url = 'index.php';
                    break;
            }

            $response['success'] = true;
            $response['message'] = 'Login successful! Redirecting to your dashboard...';
            $response['redirect'] = $redirect_url;
        } else {
            $response['message'] = 'Invalid username or password.';
        }
    } else {
        $response['message'] = 'Invalid username or password.';
    }

    $stmt->close();
    $conn->close();
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
