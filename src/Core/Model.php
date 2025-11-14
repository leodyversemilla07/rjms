<?php

namespace App\Core;

/**
 * Model Base Class
 * All models should extend this class
 */
abstract class Model
{
    protected string $table;
    protected string $primaryKey = 'id';
    protected array $fillable = [];
    protected array $hidden = [];
    protected static ?\PDO $db = null;

    public function __construct()
    {
        if (self::$db === null) {
            self::$db = Database::getInstance();
        }
    }

    /**
     * Find record by ID
     */
    public function find(int $id): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?";
        $result = Database::fetchOne($sql, [$id]);
        return $result ? $this->hideAttributes($result) : null;
    }

    /**
     * Find all records
     */
    public function all(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        $results = Database::fetchAll($sql);
        return array_map([$this, 'hideAttributes'], $results);
    }

    /**
     * Find records with WHERE clause
     */
    public function where(string $column, $value, string $operator = '='): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} ?";
        $results = Database::fetchAll($sql, [$value]);
        return array_map([$this, 'hideAttributes'], $results);
    }

    /**
     * Find first record matching WHERE clause
     */
    public function firstWhere(string $column, $value, string $operator = '='): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} ? LIMIT 1";
        $result = Database::fetchOne($sql, [$value]);
        return $result ? $this->hideAttributes($result) : null;
    }

    /**
     * Create a new record
     */
    public function create(array $data): int
    {
        // Filter to only fillable fields
        $data = $this->filterFillable($data);

        $columns = array_keys($data);
        $placeholders = array_fill(0, count($columns), '?');

        $sql = "INSERT INTO {$this->table} (" . implode(', ', $columns) . ") 
                VALUES (" . implode(', ', $placeholders) . ")";

        Database::execute($sql, array_values($data));
        return (int) self::$db->lastInsertId();
    }

    /**
     * Update a record
     */
    public function update(int $id, array $data): bool
    {
        // Filter to only fillable fields
        $data = $this->filterFillable($data);

        $columns = array_keys($data);
        $setClause = implode(', ', array_map(fn($col) => "{$col} = ?", $columns));

        $sql = "UPDATE {$this->table} SET {$setClause} WHERE {$this->primaryKey} = ?";

        $values = array_values($data);
        $values[] = $id;

        return Database::execute($sql, $values);
    }

    /**
     * Delete a record
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return Database::execute($sql, [$id]);
    }

    /**
     * Get paginated results
     */
    public function paginate(int $perPage = 15, int $page = 1): array
    {
        $offset = ($page - 1) * $perPage;
        
        // Get total count
        $countSql = "SELECT COUNT(*) as total FROM {$this->table}";
        $countResult = Database::fetchOne($countSql);
        $total = $countResult['total'] ?? 0;

        // Get paginated data
        $sql = "SELECT * FROM {$this->table} LIMIT {$perPage} OFFSET {$offset}";
        $data = Database::fetchAll($sql);
        $data = array_map([$this, 'hideAttributes'], $data);

        return [
            'data' => $data,
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil($total / $perPage)
        ];
    }

    /**
     * Order results
     */
    public function orderBy(string $column, string $direction = 'ASC'): array
    {
        // Validate column name to prevent SQL injection
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $column)) {
            throw new \Exception('Invalid column name for ordering');
        }
        
        $direction = strtoupper($direction);
        if (!in_array($direction, ['ASC', 'DESC'])) {
            $direction = 'ASC';
        }

        $sql = "SELECT * FROM {$this->table} ORDER BY {$column} {$direction}";
        $results = Database::fetchAll($sql);
        return array_map([$this, 'hideAttributes'], $results);
    }

    /**
     * Count records
     */
    public function count(): int
    {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $result = Database::fetchOne($sql);
        return $result['total'] ?? 0;
    }

    /**
     * Execute raw SQL query
     */
    public function query(string $sql, array $params = []): array
    {
        return Database::fetchAll($sql, $params);
    }

    /**
     * Filter data to only fillable fields
     */
    private function filterFillable(array $data): array
    {
        if (empty($this->fillable)) {
            return $data;
        }

        return array_filter($data, function ($key) {
            return in_array($key, $this->fillable);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Hide attributes from result
     */
    private function hideAttributes(array $data): array
    {
        if (empty($this->hidden)) {
            return $data;
        }

        foreach ($this->hidden as $attribute) {
            unset($data[$attribute]);
        }

        return $data;
    }

    /**
     * Begin transaction
     */
    public static function beginTransaction(): bool
    {
        return Database::beginTransaction();
    }

    /**
     * Commit transaction
     */
    public static function commit(): bool
    {
        return Database::commit();
    }

    /**
     * Rollback transaction
     */
    public static function rollback(): bool
    {
        return Database::rollback();
    }
}
