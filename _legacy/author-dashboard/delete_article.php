<?php
session_start();

// Check if user is logged in and has the author role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'author') {
    header("Location: login.php");
    exit();
}

// Include database connection
require_once '../includes/db_connection.php';

$conn = connectDB();

// Get the article ID from the URL
$articleId = $_GET['id'];

// Delete the article from the database
$sql = "DELETE FROM submissions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $articleId);
$stmt->execute();
$stmt->close();

// Redirect back to the dashboard
header("Location: manage-articles.php");
exit();
