<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'author') {
    // If not logged in, redirect to the login page
    header("Location: ../auth/login.php");
    exit; // Stop further execution
}

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set in session.";
    exit();
}

// Include database connection
require_once '../includes/db_connection.php';

$conn = connectDB();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Author Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" />
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="../index.php">MinSU Research Journal</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">Author Elements</li>
                    <li class="sidebar-item">
                        <a href="index.php" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#user-management"
                            data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-file-edit pe-2"></i>
                            Submit Manuscript
                        </a>
                        <ul id="user-management" class="sidebar-dropdown list-unstyled collapse ps-3"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="submit-articles.php" class="sidebar-link">
                                    <i class="fa-solid fa-file-edit pe-2"></i> New Submission Form
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#manuscript-management"
                            data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-file-lines pe-2"></i>
                            My Submissions
                        </a>
                        <ul id="manuscript-management" class="sidebar-dropdown list-unstyled collapse ps-3"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="manage-articles.php" class="sidebar-link">
                                    <i class="fa-solid fa-inbox pe-2"></i>
                                    Submitted Manuscripts
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-tasks pe-2"></i>
                                    In Review
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-edit pe-2"></i>
                                    Revisions Requested
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-check pe-2"></i>
                                    Accepted
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-times pe-2"></i>
                                    Rejected
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#review-process"
                            data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-book-open pe-2"></i>
                            Guidelines and Policies
                        </a>
                        <ul id="review-process" class="sidebar-dropdown list-unstyled collapse ps-3"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-user-check pe-2"></i>
                                    Submission Guidelines
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-info-circle pe-2"></i>
                                    Ethical Standards
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#publication-management"
                            data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-comments pe-2"></i>
                            Communication
                        </a>
                        <ul id="publication-management" class="sidebar-dropdown list-unstyled collapse ps-3"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-bell pe-2"></i>
                                    Notifications
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-envelope pe-2"></i>
                                    Editor Correspondence
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#content-management"
                            data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-money-bill-wave pe-2"></i>
                            Payment
                        </a>
                        <ul id="content-management" class="sidebar-dropdown list-unstyled collapse ps-3"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-file-alt pe-2"></i>
                                    Payment History
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-credit-card pe-2"></i>
                                    Make a Payment
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="image/profile.jpg" class="avatar img-fluid rounded" alt="Profile Picture" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Profile</a>
                                <a href="#" class="dropdown-item">Settings</a>
                                <a href="../logout.php" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>