<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // If not logged in, redirect to the login page
    header("Location: ../auth/login.php");
    exit; // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
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
                    <li class="sidebar-header">Admin Elements</li>
                    <li class="sidebar-item">
                        <a href="index.php" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#user-management"
                            data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-users pe-2"></i>
                            User Management
                        </a>
                        <ul id="user-management" class="sidebar-dropdown list-unstyled collapse ps-3"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="editor.php" class="sidebar-link">
                                    <i class="fa-solid fa-user-tie pe-2"></i> Editors
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="reviewer.php" class="sidebar-link">
                                    <i class="fa-solid fa-user-check pe-2"></i> Reviewers
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="author.php" class="sidebar-link">
                                    <i class="fa-solid fa-user-pen pe-2"></i> Authors
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#manuscript-management"
                            data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-file-lines pe-2"></i>
                            Manuscript Management
                        </a>
                        <ul id="manuscript-management" class="sidebar-dropdown list-unstyled collapse ps-3"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-inbox pe-2"></i> Submissions
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-tasks pe-2"></i> Assignments
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-edit pe-2"></i> Revisions
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#review-process"
                            data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-sliders pe-2"></i>
                            Review Process
                        </a>
                        <ul id="review-process" class="sidebar-dropdown list-unstyled collapse ps-3"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-user-check pe-2"></i> Reviewer Assignment
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-info-circle pe-2"></i> Review Status
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-thumbs-up pe-2"></i> Decisions
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#publication-management"
                            data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-book-open pe-2"></i>
                            Publication Management
                        </a>
                        <ul id="publication-management" class="sidebar-dropdown list-unstyled collapse ps-3"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-calendar-alt pe-2"></i> Upcoming Issues
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-check-circle pe-2"></i> Published Issues
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-spell-check pe-2"></i> Proofreading
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-edit pe-2"></i> Editing & Formatting
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#content-management"
                            data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-folder-open pe-2"></i>
                            Content Management
                        </a>
                        <ul id="content-management" class="sidebar-dropdown list-unstyled collapse ps-3"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="admin-manage-articles.php" class="sidebar-link">
                                    <i class="fa-solid fa-file-alt pe-2"></i> Articles
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-star pe-2"></i> Special Issues
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-archive pe-2"></i> Archives
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#communication"
                            data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-comments pe-2"></i>
                            Communication
                        </a>
                        <ul id="communication" class="sidebar-dropdown list-unstyled collapse ps-3"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-bullhorn pe-2"></i> Announcements
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-bell pe-2"></i> Notifications
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-envelope pe-2"></i> Email Templates
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#system-administration"
                            data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-cogs pe-2"></i>
                            System Administration
                        </a>
                        <ul id="system-administration" class="sidebar-dropdown list-unstyled collapse ps-3"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-sliders-h pe-2"></i> Settings
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-tools pe-2"></i> System Maintenance
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-paint-brush pe-2"></i> Customization
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#analytics" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-chart-line pe-2"></i>
                            Reports and Analytics
                        </a>
                        <ul id="analytics" class="sidebar-dropdown list-unstyled collapse ps-3"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-chart-bar pe-2"></i> Submission Statistics
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-chart-pie pe-2"></i> Review Process Metrics
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-chart-area pe-2"></i> Publication Metrics
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#compliance-ethics"
                            data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-gavel pe-2"></i>
                            Compliance and Ethics
                        </a>
                        <ul id="compliance-ethics" class="sidebar-dropdown list-unstyled collapse ps-3"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-chart-bar pe-2"></i> Submission Statistics
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-chart-pie pe-2"></i> Review Process Metrics
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-chart-area pe-2"></i> Publication Metrics
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#financial-management"
                            data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-money-bill-wave pe-2"></i>
                            Financial Management
                        </a>
                        <ul id="financial-management" class="sidebar-dropdown list-unstyled collapse ps-3"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-chart-line pe-2"></i> Budgeting
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <i class="fa-solid fa-credit-card pe-2"></i> Payments
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