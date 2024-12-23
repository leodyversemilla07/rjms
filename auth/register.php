<?php
session_start();
require_once '../includes/db_connection.php';

$conn = connectDB();

// Initialize variables to store user input
$username = $password = $email = $role = $full_name = $affiliation = $country = $bio = $avatar_url = '';
$social_links = [];

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $role = $_POST['role'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $affiliation = $_POST['affiliation'];
    $country = $_POST['country'];
    $bio = $_POST['bio'];

    // Prepare an SQL statement to insert user data into the database
    $sql = "INSERT INTO users (username, password, email, role, first_name, middle_name, last_name, affiliation, country, bio) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind parameters to the statement
    $stmt->bind_param("ssssssssss", $username, $password, $email, $role, $first_name, $middle_name, $last_name, $affiliation, $country, $bio);

    // Execute the statement
    if ($stmt->execute()) {
        // Registration successful, redirect to login page
        header("location: login.php");
        exit();
    } else {
        // Registration failed, display error message
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
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
            margin-bottom: 50px;
            max-width: 600px;
            position: relative;
        }

        .form-control {
            border-color: #399f3a;
        }

        .form-control:focus {
            border-color: #0e5c2d;
            box-shadow: none;
        }

        .btn-register {
            background-color: #399f3a;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            color: #ffffff;
        }

        .btn-register:hover {
            background-color: #0e5c2d;
            color: #ffffff;
        }

        .btn-secondary {
            background-color: #399f3a;
            color: #ebede6;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #0e5c2d;
            color: #ffffff;
        }

        .form-group label {
            font-weight: 500;
        }

        .login-link {
            color: #399f3a;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .form-header {
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
            /* Center the header text */
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
    </style>
</head>

<body>
    <div class="container">
        <a href="../index.php" class="back-button">
            <img src="https://img.icons8.com/ios-filled/50/000000/left.png" alt="Back" width="24" height="24">
            Back
        </a>
        <h2 class="form-header">User Registration</h2>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="author">Author</option>
                    <option value="editor">Editor</option>
                    <option value="reviewer">Reviewer</option>
                </select>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name">
                </div>
                <div class="form-group col-md-4">
                    <label for="middle_name">Middle Name:</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name">
                </div>
                <div class="form-group col-md-4">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>
            </div>
            <div class="form-group">
                <label for="affiliation">Affiliation:</label>
                <input type="text" class="form-control" id="affiliation" name="affiliation">
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <select class="form-control" id="country" name="country" required>
                    <option value="" selected disabled>-- Select Country --</option>
                    <?php
                    // Array of countries
                    $countries = array("Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "North Macedonia", "Norway", "Oman", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe");

                    // Loop through the countries array to create options
                    foreach ($countries as $country) {
                        echo "<option value='$country'>$country</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea class="form-control" id="bio" name="bio" rows="3"></textarea>
            </div>
            <!-- Removed Avatar URL and Social Links fields -->
            <button type="submit" class="btn btn-register">Register</button>
        </form>
        <p class="mt-3">Already have an account? <a href="login.php" class="login-link">Login here</a>.</p>
    </div>
</body>

</html>