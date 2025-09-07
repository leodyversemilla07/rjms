<?php
/**
 * Database Migration System for RJMS
 * 
 * This class handles database migrations for the Research Journal Management System.
 * It provides functionality to run, rollback, and manage database schema changes.
 */

class Migration
{
    private $conn;
    private $migrationsPath;
    
    public function __construct($connection)
    {
        $this->conn = $connection;
        $this->migrationsPath = __DIR__ . '/migrations/';
        $this->createMigrationsTable();
    }
    
    /**
     * Create migrations tracking table if it doesn't exist
     */
    private function createMigrationsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255) NOT NULL,
            executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_migration (migration)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        
        $this->conn->query($sql);
    }
    
    /**
     * Run all pending migrations
     */
    public function migrate()
    {
        $migrations = $this->getPendingMigrations();
        
        if (empty($migrations)) {
            echo "No pending migrations found.\n";
            return;
        }
        
        foreach ($migrations as $migration) {
            echo "Running migration: {$migration}\n";
            
            if ($this->runMigration($migration)) {
                $this->markAsExecuted($migration);
                echo "✓ Migration {$migration} completed successfully.\n";
            } else {
                echo "✗ Migration {$migration} failed!\n";
                break;
            }
        }
    }
    
    /**
     * Get list of pending migrations
     */
    private function getPendingMigrations()
    {
        // Get executed migrations
        $executedQuery = "SELECT migration FROM migrations ORDER BY id";
        $result = $this->conn->query($executedQuery);
        
        $executed = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $executed[] = $row['migration'];
            }
        }
        
        // Get all migration files
        $allMigrations = [];
        $files = scandir($this->migrationsPath);
        
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                $allMigrations[] = pathinfo($file, PATHINFO_FILENAME);
            }
        }
        
        sort($allMigrations);
        
        // Return pending migrations
        return array_diff($allMigrations, $executed);
    }
    
    /**
     * Run a specific migration
     */
    private function runMigration($migration)
    {
        $filePath = $this->migrationsPath . $migration . '.sql';
        
        if (!file_exists($filePath)) {
            echo "Migration file not found: {$filePath}\n";
            return false;
        }
        
        $sql = file_get_contents($filePath);
        
        // Split by semicolon and execute each statement
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        
        $this->conn->begin_transaction();
        
        try {
            foreach ($statements as $statement) {
                if (!empty($statement)) {
                    if (!$this->conn->query($statement)) {
                        throw new Exception("Error executing statement: " . $this->conn->error);
                    }
                }
            }
            
            $this->conn->commit();
            return true;
            
        } catch (Exception $e) {
            $this->conn->rollback();
            echo "Migration failed: " . $e->getMessage() . "\n";
            return false;
        }
    }
    
    /**
     * Mark migration as executed
     */
    private function markAsExecuted($migration)
    {
        $stmt = $this->conn->prepare("INSERT INTO migrations (migration) VALUES (?)");
        $stmt->bind_param("s", $migration);
        $stmt->execute();
        $stmt->close();
    }
    
    /**
     * Get migration status
     */
    public function status()
    {
        $executed = [];
        $pending = $this->getPendingMigrations();
        
        // Get executed migrations
        $executedQuery = "SELECT migration, executed_at FROM migrations ORDER BY id";
        $result = $this->conn->query($executedQuery);
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $executed[] = $row;
            }
        }
        
        echo "=== Migration Status ===\n\n";
        
        if (!empty($executed)) {
            echo "Executed Migrations:\n";
            foreach ($executed as $migration) {
                echo "✓ {$migration['migration']} (executed: {$migration['executed_at']})\n";
            }
            echo "\n";
        }
        
        if (!empty($pending)) {
            echo "Pending Migrations:\n";
            foreach ($pending as $migration) {
                echo "○ {$migration}\n";
            }
        } else {
            echo "No pending migrations.\n";
        }
    }
    
    /**
     * Reset all migrations (WARNING: This will drop all tables!)
     */
    public function reset()
    {
        echo "WARNING: This will drop all tables and reset the database!\n";
        echo "Type 'yes' to continue: ";
        
        $handle = fopen("php://stdin", "r");
        $confirmation = trim(fgets($handle));
        fclose($handle);
        
        if ($confirmation === 'yes') {
            // Get all tables
            $result = $this->conn->query("SHOW TABLES");
            $tables = [];
            
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_array()) {
                    $tables[] = $row[0];
                }
            }
            
            // Disable foreign key checks
            $this->conn->query("SET FOREIGN_KEY_CHECKS = 0");
            
            // Drop all tables
            foreach ($tables as $table) {
                $this->conn->query("DROP TABLE IF EXISTS `{$table}`");
                echo "Dropped table: {$table}\n";
            }
            
            // Re-enable foreign key checks
            $this->conn->query("SET FOREIGN_KEY_CHECKS = 1");
            
            echo "Database reset completed.\n";
        } else {
            echo "Reset cancelled.\n";
        }
    }
    
    /**
     * Create a new migration file
     */
    public function createMigration($name)
    {
        $timestamp = date('Y_m_d_His');
        $filename = "{$timestamp}_{$name}.sql";
        $filepath = $this->migrationsPath . $filename;
        
        $template = "-- Migration: {$name}
-- Created: " . date('Y-m-d H:i:s') . "

-- Add your SQL statements here
-- Example:
-- CREATE TABLE example (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(255) NOT NULL,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
";
        
        file_put_contents($filepath, $template);
        echo "Created migration file: {$filename}\n";
        
        return $filename;
    }
}
