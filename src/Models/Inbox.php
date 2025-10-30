<?php

namespace App\Models;

use App\Core\Model;

/**
 * Inbox Model
 * Handles internal messaging
 */
class Inbox extends Model
{
    protected string $table = 'inbox';
    protected string $primaryKey = 'id';
    
    protected array $fillable = [
        'sender_id',
        'receiver_id',
        'subject',
        'message',
        'is_read',
        'sent_date'
    ];

    /**
     * Get messages for user (inbox)
     */
    public function getInbox(int $userId): array
    {
        $sql = "SELECT i.*, u.username as sender_name
                FROM {$this->table} i
                INNER JOIN users u ON i.sender_id = u.id
                WHERE i.receiver_id = ?
                ORDER BY i.sent_date DESC";
        return $this->query($sql, [$userId]);
    }

    /**
     * Get sent messages
     */
    public function getSent(int $userId): array
    {
        $sql = "SELECT i.*, u.username as receiver_name
                FROM {$this->table} i
                INNER JOIN users u ON i.receiver_id = u.id
                WHERE i.sender_id = ?
                ORDER BY i.sent_date DESC";
        return $this->query($sql, [$userId]);
    }

    /**
     * Get unread messages count
     */
    public function getUnreadCount(int $userId): int
    {
        $sql = "SELECT COUNT(*) as count
                FROM {$this->table}
                WHERE receiver_id = ? AND is_read = 0";
        $result = $this->query($sql, [$userId]);
        return $result[0]['count'] ?? 0;
    }

    /**
     * Mark message as read
     */
    public function markAsRead(int $id): bool
    {
        return $this->update($id, ['is_read' => 1]);
    }

    /**
     * Send message
     */
    public function sendMessage(int $senderId, int $receiverId, string $subject, string $message): int
    {
        return $this->create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'subject' => $subject,
            'message' => $message,
            'is_read' => 0,
            'sent_date' => date('Y-m-d H:i:s')
        ]);
    }
}
