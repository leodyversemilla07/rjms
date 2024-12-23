<?php
// Start the session
session_start();

// Get the current file name
$currentPage = basename($_SERVER['PHP_SELF']);

// Check if user is logged in
$isLoggedIn = isset($_SESSION['username']) && isset($_SESSION['role']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MinSU Research Journal</title>
    <link rel="shortcut icon" href="https://www.minsu.edu.ph/template/images/logo.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* Custom styles using provided color palette and Poppins font */
        body {
            background-color: #ebede6;
            /* Light grayish background */
            color: #593d2c;
            /* Dark brown text */
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #0e5c2d;
            /* Dark green */
            color: #fff;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hero-section {
            background-image: url("https://www.minsu.edu.ph/template/images/slides/slides_1.jpg");
            /* Placeholder image */
            background-size: cover;
            background-position: center;
            color: #fff;
            padding: 100px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 48px;
            margin-bottom: 20px;
            font-weight: 700;
            line-height: 1.2;
        }

        .hero-section p {
            font-size: 18px;
            margin-bottom: 20px;
            font-weight: 500;
            line-height: 1.5;
        }

        footer {
            background-color: #0e5c2d;
            /* Dark green */
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .navbar {
            background-color: #f0c02f;
            /* Yellow */
        }

        .nav-link {
            color: #593d2c !important;
            /* Dark brown */
            font-size: 18px;
            font-weight: bold;
        }

        .nav-link:hover {
            color: #000 !important;
            /* Black */
        }

        .nav-item.active .nav-link {
            color: #0e5c2d !important;
            /* Dark green */
            font-weight: bold;
        }

        .dropdown-menu {
            background-color: #f0c02f;
            /* Yellow */
            border: none;
        }

        .dropdown-item {
            color: #593d2c !important;
            /* Dark brown */
        }

        .dropdown-item:hover {
            color: #fff !important;
            /* Black */
            background-color: #0e5c2d !important;
        }

        .dropdown-item.active {
            color: #fff !important;
            /* Dark green */
            font-weight: bold;
            background-color: #0e5c2d !important;
        }

        section {
            margin-top: 100px;
            margin-bottom: 100px;
            padding: 40px 0;
            background-color: #ebede6;
            /* Light grayish background */
            font-size: larger;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .article {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #399f3a;
            /* Bright green */
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .article-title {
            font-weight: bold;
            color: #0e5c2d;
            /* Dark green */
        }

        .article-summary {
            color: #ebede6;
            /* Light grayish text */
        }

        .footer-social {
            margin-top: 20px;
        }

        .footer-social a {
            color: #fff;
            font-size: 20px;
            margin-right: 10px;
        }

        .footer-social a:hover {
            color: #ccc;
            /* Light gray */
        }

        .contact {
            max-width: 500px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #0e5c2d;
        }

        .form-group label {
            font-weight: bold;
            color: #0e5c2d;
        }

        .form-control:focus {
            border-color: #0e5c2d;
            box-shadow: none;
        }

        button {
            background-color: #399f3a;
            border: none;
            color: #ffffff;
        }

        button:hover {
            background-color: #0e5c2d;
            color: #ffffff;
        }

        .faq {
            max-width: 1000px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .faq-section {
            margin-bottom: 30px;
        }

        .faq-item {
            margin-bottom: 30px;
        }

        .question {
            font-weight: 600;
            color: #0e5c2d;
            font-size: 1.2em;
        }

        .answer {
            margin-top: 10px;
            color: #593d2c;
            font-size: 1em;
        }

        .question::before {
            content: "Q: ";
            font-weight: bold;
        }

        .answer::before {
            content: "A: ";
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <img src="https://www.minsu.edu.ph/template/images/logo.png" alt="MinSU Research Journal"
            style="max-width: 200px;">
    </header>

    <?php
    // Get the current file name
    $currentPage = basename($_SERVER['PHP_SELF']);
    ?>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item <?php if ($currentPage == 'index.php') {
                        echo 'active';
                    } ?>">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown <?php if (in_array($currentPage, ['overview.php', 'editorial_board.php', 'members.php', 'policies_responsibilities.php'])) {
                        echo 'active';
                    } ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAbout" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            About Us
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownAbout">
                            <a class="dropdown-item <?php if ($currentPage == 'about-overview.php') {
                                echo 'active';
                            } ?>" href="about-overview.php">Overview</a>
                            <a class="dropdown-item <?php if ($currentPage == 'about-editorial-board.php') {
                                echo 'active';
                            } ?>" href="about-editorial-board.php">Editorial Board</a>
                            <a class="dropdown-item <?php if ($currentPage == 'about-members.php') {
                                echo 'active';
                            } ?>" href="about-members.php">Members</a>
                            <a class="dropdown-item <?php if ($currentPage == 'about-policies-responsibilities.php') {
                                echo 'active';
                            } ?>" href="about-policies-responsibilities.php">Policies and Responsibilities</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown <?php if (in_array($currentPage, ['submission_guidelines.php', 'submission_form.php'])) {
                        echo 'active';
                    } ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSubmissions" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Submissions
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownSubmissions">
                            <a class="dropdown-item <?php if ($currentPage == 'submission_guidelines.php') {
                                echo 'active';
                            } ?>" href="submission_guidelines.php">Submission Guidelines</a>
                            <a class="dropdown-item <?php if ($currentPage == 'submission_form.php') {
                                echo 'active';
                            } ?>" href="submission_form.php">Submission Form</a>
                        </div>
                    </li>
                    <li class="
                    <li class=" nav-item dropdown <?php if (in_array($currentPage, ['review_process_overview.php', 'reviewer_guidelines.php'])) {
                        echo 'active';
                    } ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownReview" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Peer Review Process
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownReview">
                            <a class="dropdown-item <?php if ($currentPage == 'review_process_overview.php') {
                                echo 'active';
                            } ?>" href="review_process_overview.php">Overview</a>
                            <a class="dropdown-item <?php if ($currentPage == 'reviewer_guidelines.php') {
                                echo 'active';
                            } ?>" href="reviewer_guidelines.php">Reviewer Guidelines</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown <?php if (in_array($currentPage, ['current_issues.php', 'archives.php', 'by_year.php', 'by_topic.php'])) {
                        echo 'active';
                    } ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPublications" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Publications
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownPublications">
                            <a class="dropdown-item <?php if ($currentPage == 'current_issues.php') {
                                echo 'active';
                            } ?>" href="current_issues.php">Current Issues</a>
                            <a class="dropdown-item <?php if ($currentPage == 'archives.php') {
                                echo 'active';
                            } ?>" href="archives.php">Archives</a>
                            <a class="dropdown-item <?php if ($currentPage == 'by_year.php') {
                                echo 'active';
                            } ?>" href="by_year.php">By Year</a>
                            <a class="dropdown-item <?php if ($currentPage == 'by_topic.php') {
                                echo 'active';
                            } ?>" href="by_topic.php">By Topic</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown <?php if (in_array($currentPage, ['contact.php', 'FAQ.php'])) {
                        echo 'active';
                    } ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownContact" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Contact Us
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownContact">
                            <a class="dropdown-item <?php if ($currentPage == 'contact.php') {
                                echo 'active';
                            } ?>" href="contact.php">Contact Form</a>
                            <a class="dropdown-item <?php if ($currentPage == 'FAQ.php') {
                                echo 'active';
                            } ?>" href="FAQ.php">FAQ</a>
                        </div>
                    </li>
                    <?php if ($isLoggedIn) {
                        switch ($_SESSION['role']) {
                            case 'author':
                                $dashboardLink = 'author-dashboard/index.php';
                                break;
                            case 'editor':
                                $dashboardLink = 'editor-dashboard/index.php';
                                break;
                            case 'admin':
                                $dashboardLink = 'admin-dashboard/index.php';
                                break;
                            case 'reviewer':
                                $dashboardLink = 'reviewer-dashboard/index.php';
                                break;
                            default:
                                $dashboardLink = 'auth/login.php';
                                break;
                        }
                        ?>
                        <li class="nav-item <?php if ($currentPage == $dashboardLink) {
                            echo 'active';
                        } ?>">
                            <a class="nav-link" href="<?php echo $dashboardLink; ?>">Dashboard</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item <?php if ($currentPage == 'auth/login.php') {
                            echo 'active';
                        } ?>">
                            <a class="nav-link" href="auth/login.php">Login</a>
                        </li>
                        <li class="nav-item <?php if ($currentPage == 'auth/register.php') {
                            echo 'active';
                        } ?>">
                            <a class="nav-link" href="auth/register.php">Register</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>