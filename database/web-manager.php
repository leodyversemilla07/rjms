<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RJMS Database Migration Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .migration-status {
            font-family: 'Courier New', monospace;
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin: 10px 0;
        }
        .executed {
            color: #198754;
        }
        .pending {
            color: #ffc107;
        }
        .warning-box {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4><i class="fas fa-database"></i> RJMS Database Migration Manager</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        require_once '../vendor/autoload.php';
                        require_once '../src/bootstrap.php';
                        require_once 'Migration.php';

                        use App\Core\Database;

                        $action = $_GET['action'] ?? 'status';
                        $output = '';
                        $alertClass = 'info';

                        try {
                            $conn = Database::getConnection();
                            $migration = new Migration($conn);

                            switch ($action) {
                                case 'migrate':
                                    ob_start();
                                    $migration->migrate();
                                    $output = ob_get_clean();
                                    $alertClass = 'success';
                                    break;

                                case 'status':
                                    ob_start();
                                    $migration->status();
                                    $output = ob_get_clean();
                                    break;

                                default:
                                    $output = "Unknown action: $action";
                                    $alertClass = 'warning';
                                    break;
                            }
                        } catch (Exception $e) {
                            $output = "Error: " . $e->getMessage();
                            $alertClass = 'danger';
                        }
                        ?>

                        <!-- Action Buttons -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="d-grid gap-2">
                                    <a href="?action=status" class="btn btn-outline-primary">
                                        <i class="fas fa-list"></i> Check Migration Status
                                    </a>
                                    <a href="?action=migrate" class="btn btn-success">
                                        <i class="fas fa-play"></i> Run Migrations
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="warning-box">
                                    <h6><i class="fas fa-exclamation-triangle"></i> Important Notes:</h6>
                                    <ul class="mb-0 small">
                                        <li>Always backup your database before running migrations</li>
                                        <li>Test migrations in development first</li>
                                        <li>For advanced operations, use the command line interface</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Output Display -->
                        <?php if ($output): ?>
                        <div class="alert alert-<?php echo $alertClass; ?>">
                            <h6><i class="fas fa-terminal"></i> Output:</h6>
                            <div class="migration-status">
                                <pre><?php echo htmlspecialchars($output); ?></pre>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Database Connection Info -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h6><i class="fas fa-info-circle"></i> Database Information</h6>
                            </div>
                            <div class="card-body">
                                <?php
                                try {
                                    $conn = connectDB();
                                    $dbInfo = $conn->query("SELECT DATABASE() as db_name, VERSION() as version")->fetch_assoc();
                                    echo "<p><strong>Database:</strong> " . htmlspecialchars($dbInfo['db_name']) . "</p>";
                                    echo "<p><strong>MySQL Version:</strong> " . htmlspecialchars($dbInfo['version']) . "</p>";
                                    echo "<p><strong>Status:</strong> <span class='text-success'>Connected</span></p>";
                                    
                                    // Check if tables exist
                                    $tablesResult = $conn->query("SHOW TABLES");
                                    $tableCount = $tablesResult ? $tablesResult->num_rows : 0;
                                    echo "<p><strong>Tables:</strong> $tableCount found</p>";
                                    
                                } catch (Exception $e) {
                                    echo "<p class='text-danger'><strong>Connection Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h6><i class="fas fa-tools"></i> Quick Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h6>Command Line Interface</h6>
                                        <p class="small">For advanced operations, use the CLI:</p>
                                        <code>php migrate.php migrate</code><br>
                                        <code>php migrate.php status</code><br>
                                        <code>php migrate.php create &lt;name&gt;</code>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Setup Scripts</h6>
                                        <p class="small">Use setup scripts for initial database setup:</p>
                                        <ul class="small">
                                            <li><code>setup.bat</code> (Windows)</li>
                                            <li><code>setup.sh</code> (Unix/Linux)</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Manual Setup</h6>
                                        <p class="small">Import the complete schema directly:</p>
                                        <code>mysql -u root -p rjdb &lt; schema.sql</code>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Default Users Info -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h6><i class="fas fa-users"></i> Default Users</h6>
                            </div>
                            <div class="card-body">
                                <p class="small">After migration, the following default users will be available:</p>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Role</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><code>admin</code></td>
                                                <td><code>admin123</code></td>
                                                <td>Administrator</td>
                                                <td>admin@rjms.com</td>
                                            </tr>
                                            <tr>
                                                <td><code>editor</code></td>
                                                <td><code>editor123</code></td>
                                                <td>Editor</td>
                                                <td>editor@rjms.com</td>
                                            </tr>
                                            <tr>
                                                <td><code>reviewer</code></td>
                                                <td><code>reviewer123</code></td>
                                                <td>Reviewer</td>
                                                <td>reviewer@rjms.com</td>
                                            </tr>
                                            <tr>
                                                <td><code>author</code></td>
                                                <td><code>author123</code></td>
                                                <td>Author</td>
                                                <td>author@rjms.com</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="alert alert-warning mt-2">
                                    <small><i class="fas fa-exclamation-triangle"></i> <strong>Security Warning:</strong> Change these default passwords before deploying to production!</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
