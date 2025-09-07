<?php
/**
 * Database Configuration for RJMS
 * 
 * This file contains database configuration settings for different environments.
 * Copy this file to 'db_config.php' and modify as needed.
 */

// Environment configuration
$environment = 'development'; // Options: development, testing, production

$db_config = [
    'development' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'rjdb',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'port' => 3306,
        'debug' => true
    ],
    
    'testing' => [
        'host' => 'localhost',
        'username' => 'test_user',
        'password' => 'test_password',
        'database' => 'rjdb_test',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'port' => 3306,
        'debug' => true
    ],
    
    'production' => [
        'host' => 'localhost', // Change to your production host
        'username' => 'prod_user', // Change to your production username
        'password' => 'secure_password', // Change to your production password
        'database' => 'rjdb_prod', // Change to your production database
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'port' => 3306,
        'debug' => false
    ]
];

// Get current environment configuration
$current_config = $db_config[$environment] ?? $db_config['development'];

/**
 * Enhanced database connection function with environment support
 */
function connectDB($config = null)
{
    global $current_config;
    
    if ($config === null) {
        $config = $current_config;
    }
    
    // Create connection
    $conn = new mysqli(
        $config['host'],
        $config['username'],
        $config['password'],
        $config['database'],
        $config['port']
    );
    
    // Check connection
    if ($conn->connect_error) {
        if ($config['debug']) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            die("Database connection failed. Please contact the administrator.");
        }
    }
    
    // Set charset
    $conn->set_charset($config['charset']);
    
    // Set SQL mode for better compatibility
    $conn->query("SET SQL_MODE = 'STRICT_TRANS_TABLES,NO_ZERO_DATE,NO_ZERO_IN_DATE,ERROR_FOR_DIVISION_BY_ZERO'");
    
    return $conn;
}

/**
 * Get database configuration for current environment
 */
function getDBConfig()
{
    global $current_config;
    return $current_config;
}

/**
 * Switch environment (useful for testing)
 */
function setEnvironment($env)
{
    global $environment, $current_config, $db_config;
    
    if (isset($db_config[$env])) {
        $environment = $env;
        $current_config = $db_config[$env];
        return true;
    }
    
    return false;
}

/**
 * Check if database exists
 */
function databaseExists($dbName = null)
{
    global $current_config;
    
    if ($dbName === null) {
        $dbName = $current_config['database'];
    }
    
    try {
        $conn = new mysqli(
            $current_config['host'],
            $current_config['username'],
            $current_config['password'],
            '',
            $current_config['port']
        );
        
        if ($conn->connect_error) {
            return false;
        }
        
        $result = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbName'");
        $exists = $result && $result->num_rows > 0;
        
        $conn->close();
        return $exists;
        
    } catch (Exception $e) {
        return false;
    }
}

/**
 * Create database if it doesn't exist
 */
function createDatabase($dbName = null)
{
    global $current_config;
    
    if ($dbName === null) {
        $dbName = $current_config['database'];
    }
    
    try {
        $conn = new mysqli(
            $current_config['host'],
            $current_config['username'],
            $current_config['password'],
            '',
            $current_config['port']
        );
        
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
        
        $charset = $current_config['charset'];
        $collation = $current_config['collation'];
        
        $sql = "CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET $charset COLLATE $collation";
        
        if ($conn->query($sql)) {
            $conn->close();
            return true;
        } else {
            throw new Exception("Error creating database: " . $conn->error);
        }
        
    } catch (Exception $e) {
        if ($current_config['debug']) {
            throw $e;
        } else {
            return false;
        }
    }
}
