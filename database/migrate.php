#!/usr/bin/env php
<?php
/**
 * RJMS Migration CLI Tool
 * 
 * Usage:
 *   php migrate.php migrate          - Run all pending migrations
 *   php migrate.php status           - Show migration status
 *   php migrate.php reset            - Reset database (WARNING: Drops all tables!)
 *   php migrate.php create <name>    - Create a new migration file
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/Migration.php';

use App\Core\Database;

// Get command line arguments
$command = $argv[1] ?? 'help';
$name = $argv[2] ?? null;

try {
    // Connect to database
    $conn = Database::getConnection();
    $migration = new Migration($conn);
    
    switch ($command) {
        case 'migrate':
            echo "Running database migrations...\n";
            $migration->migrate();
            break;
            
        case 'status':
            $migration->status();
            break;
            
        case 'reset':
            $migration->reset();
            break;
            
        case 'create':
            if (!$name) {
                echo "Please provide a name for the migration.\n";
                echo "Usage: php migrate.php create <migration_name>\n";
                exit(1);
            }
            $migration->createMigration($name);
            break;
            
        case 'help':
        default:
            echo "RJMS Migration Tool\n\n";
            echo "Available commands:\n";
            echo "  migrate          Run all pending migrations\n";
            echo "  status           Show migration status\n";
            echo "  reset            Reset database (WARNING: Drops all tables!)\n";
            echo "  create <name>    Create a new migration file\n";
            echo "  help             Show this help message\n\n";
            echo "Examples:\n";
            echo "  php migrate.php migrate\n";
            echo "  php migrate.php status\n";
            echo "  php migrate.php create create_users_table\n";
            break;
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
