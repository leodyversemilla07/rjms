<?php

namespace App\Models;

use App\Core\Model;

/**
 * User Model
 */
class User extends Model
{
    protected string $table = 'users';
    protected string $primaryKey = 'id';
    
    protected array $fillable = [
        'username',
        'email',
        'password',
        'role',
        'first_name',
        'middle_name',
        'last_name',
        'affiliation',
        'country',
        'bio',
        'is_active',
        'email_verified'
    ];

    protected array $hidden = ['password'];

    /**
     * Get user's full name
     */
    public function getFullName(): string
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Find user by username
     */
    public function findByUsername(string $username): ?static
    {
        return $this->firstWhere('username', $username);
    }

    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?static
    {
        return $this->firstWhere('email', $email);
    }

    /**
     * Find user by username or email
     */
    public function findByUsernameOrEmail(string $identifier): ?static
    {
        $sql = "SELECT * FROM {$this->table} WHERE username = ? OR email = ? LIMIT 1";
        $result = $this->query($sql, [$identifier, $identifier]);
        return !empty($result) ? $result[0] : null;
    }

    /**
     * Find user by username or email with password (for authentication)
     */
    public function findByUsernameOrEmailWithPassword(string $identifier): ?static
    {
        $sql = "SELECT * FROM {$this->table} WHERE username = ? OR email = ? LIMIT 1";
        $result = Database::fetchOne($sql, [$identifier, $identifier]);
        return $result ? new static($result) : null;
    }

    /**
     * Get users by role
     */
    public function getByRole(string $role): array
    {
        return $this->where('role', $role);
    }

    /**
     * Get active users
     */
    public function getActive(): array
    {
        return $this->where('is_active', 1);
    }

    /**
     * Create user with hashed password
     */
    public function createUser(array $data): int
    {
        // Hash password if provided
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $this->create($data);
    }

    /**
     * Update user password
     */
    public function updatePassword(int $userId, string $newPassword): bool
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        return $this->update($userId, ['password' => $hashedPassword]);
    }

    /**
     * Verify user password
     */
    public function verifyPassword(string $plainPassword, string $hashedPassword): bool
    {
        return password_verify($plainPassword, $hashedPassword);
    }
}
