<?php
session_start();
require_once '../includes/db_connection.php';

// Set content type to JSON
header('Content-Type: application/json');

$response = ['success' => false, 'message' => '', 'redirect' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectDB();
    
    // Get form data
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = trim($_POST['email']);
    $role = $_POST['role'];
    $first_name = trim($_POST['first_name']);
    $middle_name = trim($_POST['middle_name']);
    $last_name = trim($_POST['last_name']);
    $affiliation = trim($_POST['affiliation']);
    $country = $_POST['country'];
    $bio = trim($_POST['bio']);

    // Validation
    if (empty($username) || empty($password) || empty($email) || empty($role) || empty($first_name) || empty($last_name) || empty($country)) {
        $response['message'] = 'Please fill in all required fields.';
        echo json_encode($response);
        exit();
    }

    // Password confirmation check
    if ($password !== $confirm_password) {
        $response['message'] = 'Passwords do not match.';
        echo json_encode($response);
        exit();
    }

    // Password strength check
    if (strlen($password) < 6) {
        $response['message'] = 'Password must be at least 6 characters long.';
        echo json_encode($response);
        exit();
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Please enter a valid email address.';
        echo json_encode($response);
        exit();
    }

    // Check if username already exists
    $check_username = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check_username->bind_param("s", $username);
    $check_username->execute();
    $result = $check_username->get_result();
    
    if ($result->num_rows > 0) {
        $response['message'] = 'Username already exists. Please choose a different username.';
        echo json_encode($response);
        exit();
    }
    $check_username->close();

    // Check if email already exists
    $check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $result = $check_email->get_result();
    
    if ($result->num_rows > 0) {
        $response['message'] = 'Email already exists. Please use a different email address.';
        echo json_encode($response);
        exit();
    }
    $check_email->close();

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into database
    $sql = "INSERT INTO users (username, password, email, role, first_name, middle_name, last_name, affiliation, country, bio) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $username, $hashed_password, $email, $role, $first_name, $middle_name, $last_name, $affiliation, $country, $bio);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Registration successful! You can now log in with your credentials.';
        $response['redirect'] = 'index.php';
    } else {
        $response['message'] = 'Registration failed. Please try again.';
    }

    $stmt->close();
    $conn->close();
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
