<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editor Dashboard</title>
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
                    <a href="#">MinSU Research Journal</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">Editor Elements</li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#manuscript-management"
                            data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Manuscript Management
                        </a>
                        <ul id="manuscript-management" class="sidebar-dropdown list-unstyled collapse"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Assigned Submissions</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Revisions</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Decision (Accept/Reject)</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#review-process"
                            data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-sliders pe-2"></i>
                            Review Process
                        </a>
                        <ul id="review-process" class="sidebar-dropdown list-unstyled collapse"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Assign Reviewers</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Review Status</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Reviewer Feedback</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#communication"
                            data-bs-toggle="collapse" aria-expanded="false"><i class="fa-regular fa-user pe-2"></i>
                            Communication
                        </a>
                        <ul id="communication" class="sidebar-dropdown list-unstyled collapse"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Notifications</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Author Correspondence</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#publication-management"
                            data-bs-toggle="collapse" aria-expanded="false"><i class="fa-regular fa-user pe-2"></i>
                            Publication Management
                        </a>
                        <ul id="publication-management" class="sidebar-dropdown list-unstyled collapse"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Editing & Proofreading</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Upcoming Issues</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#reports-analytics"
                            data-bs-toggle="collapse" aria-expanded="false"><i class="fa-regular fa-user pe-2"></i>
                            Reports and Analytics
                        </a>
                        <ul id="reports-analytics" class="sidebar-dropdown list-unstyled collapse"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Submission Statistics</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Review Metrics</a>
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
                                <img src="image/profile.jpg" class="avatar img-fluid rounded" alt="" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Profile</a>
                                <a href="#" class="dropdown-item">Setting</a>
                                <a href="#" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>