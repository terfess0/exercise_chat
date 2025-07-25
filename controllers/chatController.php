<?php
class ChatController {
    private $messageModel;

    public function __construct() {
        require_once '../models/messageModel.php';
        $this->messageModel = new MessageModel();
    }

    public function sendMessage($senderId, $receiverId, $message) {
        if (!empty($message)) {
            $this->messageModel->createMessage($senderId, $receiverId, $message);
            return json_encode(['status' => 'success', 'message' => 'Message sent']);
        }
        return json_encode(['status' => 'error', 'message' => 'Message cannot be empty']);
    }

    public function getMessages($userId, $chatWithId) {
        $messages = $this->messageModel->getChatHistory($userId, $chatWithId);
        return json_encode($messages);
    }

    public function loadChatHistory($userId, $chatWithId) {
        $chatHistory = $this->getMessages($userId, $chatWithId);
        echo $chatHistory;
    }
}
?>