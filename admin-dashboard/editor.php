<?php
require_once '../includes/db_connection.php';
$conn = connectDB();

// Check if the form is submitted for adding a new editor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_editor'])) {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstName = $_POST['first_name'];
    $middleName = $_POST['middle_name'];
    $lastName = $_POST['last_name'];
    $affiliation = $_POST['affiliation'];
    $country = $_POST['country'];
    $bio = $_POST['bio'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and execute the SQL statement to insert a new editor
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, first_name, middle_name, last_name, affiliation, country, bio, role) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'editor')");
    $stmt->bind_param("sssssssss", $username, $hashedPassword, $email, $firstName, $middleName, $lastName, $affiliation, $country, $bio);
    if ($stmt->execute()) {
        // Success message
        $successMessage = "New editor added successfully.";
    } else {
        // Error message
        $errorMessage = "Error: " . $conn->error;
    }
}

// Check if the form is submitted for editing an editor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_editor'])) {
    // Retrieve form data
    $editorId = $_POST['editor_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $firstName = $_POST['first_name'];
    $middleName = $_POST['middle_name'];
    $lastName = $_POST['last_name'];
    $affiliation = $_POST['affiliation'];
    $country = $_POST['country'];
    $bio = $_POST['bio'];

    // Prepare and execute the SQL statement to update the editor
    $stmt = $conn->prepare("UPDATE users SET username=?, email=?, first_name=?, middle_name=?, last_name=?, affiliation=?, country=?, bio=? WHERE id=?");
    $stmt->bind_param("ssssssssi", $username, $email, $firstName, $middleName, $lastName, $affiliation, $country, $bio, $editorId);

    if ($stmt->execute()) {
        // Success message
        $successMessage = "Editor updated successfully.";
    } else {
        // Error message
        $errorMessage = "Error: " . $conn->error;
    }
}

// Check if the delete request is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_editor'])) {
    $editorId = $_GET['delete_editor'];

    // Prepare and execute the SQL statement to delete the editor
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $editorId);

    if ($stmt->execute()) {
        // Success message
        $successMessage = "Editor deleted successfully.";
    } else {
        // Error message
        $errorMessage = "Error: " . $conn->error;
    }
}

// SQL query to retrieve all editors
$sql = "SELECT * FROM users WHERE role = 'editor'";
$result = $conn->query($sql);

// SQL query to count total editors
$sql2 = "SELECT COUNT(*) AS total_editor FROM users WHERE role = 'editor'";
$result2 = $conn->query($sql2);

// Include header template
include 'templates/header.php';
?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Admin Dashboard</h4>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 d-flex">
                <div class="card flex-fill border-0 illustration">
                    <div class="card-body p-0 d-flex flex-fill">
                        <div class="row g-0 w-100">
                            <div class="col-6">
                                <div class="p-3 m-1">
                                    <h4>Welcome Back, Admin</h4>
                                    <p class="mb-0">Manage your editors efficiently.</p>
                                </div>
                            </div>
                            <div class="col-6 align-self-end text-end">
                                <img src="image/customer-support.jpg" class="img-fluid illustration-img"
                                    alt="Welcome Illustration" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex">
                <div class="card flex-fill border-0">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <?php while ($editor2 = $result2->fetch_assoc()): ?>
                                    <h4 class="mb-2"><?php echo htmlspecialchars($editor2['total_editor']); ?></h4>
                                <?php endwhile; ?>
                                <p class="mb-2">Total Editors</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Element -->
        <div class="card border-0">
            <div class="card-header">
                <h5 class="card-title">Managing Editors</h5>
                <h6 class="card-subtitle text-muted">
                    List of all editors.
                </h6>
                <div class="mb-3 text-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEditorModal">Add New
                        Editor</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Affiliation</th>
                            <th scope="col">Country</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($editor = $result->fetch_assoc()): ?>
                            <tr>
                                <th scope="row"><?php echo htmlspecialchars($editor['id']); ?></th>
                                <td><?php echo htmlspecialchars($editor['username']); ?></td>
                                <td><?php echo htmlspecialchars($editor['first_name']) ?></td>
                                <td><?php echo htmlspecialchars($editor['last_name']) ?></td>
                                <td><?php echo htmlspecialchars($editor['affiliation']) ?></td>
                                <td><?php echo htmlspecialchars($editor['country']) ?></td>
                                <td><?php echo htmlspecialchars($editor['email']) ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editEditorModal">Edit</a>
                                    <a href=" #" class="btn btn-danger btn-sm"
                                        onclick="deleteEditor(<?php echo $editor['id']; ?>)">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add New Editor Modal -->
        <div class="modal fade" id="addEditorModal" tabindex="-1" aria-labelledby="addEditorModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEditorModalLabel">Add New Editor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name">
                            </div>
                            <div class="mb-3">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name">
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>
                            <div class="mb-3">
                                <label for="affiliation" class="form-label">Affiliation</label>
                                <input type="text" class="form-control" id="affiliation" name="affiliation">
                            </div>
                            <div class="mb-3">
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
                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" name="bio" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Editor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Editor Modal -->
        <div class="modal fade" id="editEditorModal" tabindex="-1" aria-labelledby="editEditorModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEditorModalLabel">Edit Editor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?php echo $_SERVER['PHP_SELF'] && isset($_POST['edit_editor']); ?>" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name">
                            </div>
                            <div class="mb-3">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name">
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>
                            <div class="mb-3">
                                <label for="affiliation" class="form-label">Affiliation</label>
                                <input type="text" class="form-control" id="affiliation" name="affiliation">
                            </div>
                            <div class="mb-3">
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
                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" name="bio" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Edit Editor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<a href="#" class="theme-toggle">
    <i class="fa-regular fa-moon"></i>
    <i class="fa-regular fa-sun"></i>
</a>
<script>
    function deleteEditor(editorId) {
        // Prompt user for confirmation
        if (confirm("Are you sure you want to delete this editor?")) {
            // Redirect to the same page with editor ID as a query parameter for deletion
            window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>?delete_editor=" + editorId;
        }
    }
</script>
<?php include 'templates/footer.php'; ?>