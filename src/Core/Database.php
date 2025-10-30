<?php

namespace App\Core;

use PDO;
use PDOException;
use RuntimeException;

class Database
{
    private static ?PDO $instance = null;
    private static array $config = [];

    /**
     * Initialize database configuration
     */
    public static function init(): void
    {
        self::$config = [
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_NAME', 'rjdb'),
            'username' => env('DB_USER', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        ];
    }

    /**
     * Get database connection instance (Singleton pattern)
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            self::init();
            self::connect();
        }

        return self::$instance;
    }

    /**
     * Establish database connection
     */
    private static function connect(): void
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            self::$config['host'],
            self::$config['port'],
            self::$config['database'],
            self::$config['charset']
        );

        try {
            self::$instance = new PDO(
                $dsn,
                self::$config['username'],
                self::$config['password'],
                self::$config['options']
            );
        } catch (PDOException $e) {
            Logger::error('Database connection failed: ' . $e->getMessage());
            throw new RuntimeException('Database connection failed. Please check your configuration.');
        }
    }

    /**
     * Execute a query and return the result
     */
    public static function query(string $sql, array $params = []): \PDOStatement
    {
        $pdo = self::getInstance();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * Fetch all results
     */
    public static function fetchAll(string $sql, array $params = []): array
    {
        return self::query($sql, $params)->fetchAll();
    }

    /**
     * Fetch single row
     */
    public static function fetchOne(string $sql, array $params = []): ?array
    {
        $result = self::query($sql, $params)->fetch();
        return $result ?: null;
    }

    /**
     * Execute an insert/update/delete query
     */
    public static function execute(string $sql, array $params = []): bool
    {
        return self::query($sql, $params)->rowCount() > 0;
    }

    /**
     * Get last inserted ID
     */
    public static function lastInsertId(): string
    {
        return self::getInstance()->lastInsertId();
    }

    /**
     * Begin transaction
     */
    public static function beginTransaction(): bool
    {
        return self::getInstance()->beginTransaction();
    }

    /**
     * Commit transaction
     */
    public static function commit(): bool
    {
        return self::getInstance()->commit();
    }

    /**
     * Rollback transaction
     */
    public static function rollback(): bool
    {
        return self::getInstance()->rollBack();
    }

    /**
     * Close the connection
     */
    public static function close(): void
    {
        self::$instance = null;
    }
}
