<?php
class MessageModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function sendMessage($senderId, $receiverId, $message) {
        $stmt = $this->db->prepare("INSERT INTO messages (sender_id, receiver_id, message, timestamp) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $senderId, $receiverId, $message);
        return $stmt->execute();
    }

    public function getMessages($userId1, $userId2) {
        $stmt = $this->db->prepare("SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC");
        $stmt->bind_param("iiii", $userId1, $userId2, $userId2, $userId1);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getChatHistory($userId) {
        $stmt = $this->db->prepare("SELECT DISTINCT receiver_id FROM messages WHERE sender_id = ? UNION SELECT DISTINCT sender_id FROM messages WHERE receiver_id = ?");
        $stmt->bind_param("ii", $userId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>