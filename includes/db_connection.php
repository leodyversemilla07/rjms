<?php
// Legacy database connection function - DEPRECATED
// Use App\Core\Database instead for new code

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/bootstrap.php';

use App\Core\Database;

function connectDB()
{
    // Return PDO instance instead of mysqli for better compatibility
    return Database::getInstance();
}

