<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // If not logged in, redirect to the login page
    header("Location: ../auth/login.php");
    exit; // Stop further execution
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $article_id = $_POST['article_id'];

    require_once '../includes/db_connection.php';
    
    $conn = connectDB();

    $sql = "UPDATE submissions SET is_published = 1, date_published = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $article_id);

    if ($stmt->execute()) {
        header("Location: admin-manage-articles.php?success=Article published successfully");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
