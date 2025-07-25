<?php
class UserController {
    private $userModel;

    public function __construct() {
        require_once '../models/userModel.php';
        $this->userModel = new UserModel();
    }

    public function searchUser($username) {
        $result = $this->userModel->findUserByUsername($username);
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['message' => 'User not found']);
        }
    }

    public function getUserProfile($userId) {
        $profile = $this->userModel->getUserById($userId);
        if ($profile) {
            echo json_encode($profile);
        } else {
            echo json_encode(['message' => 'Profile not found']);
        }
    }
}
?>