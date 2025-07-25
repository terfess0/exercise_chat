<?php
session_start();
require_once '../models/userModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function register($username, $password) {
        if ($this->userModel->userExists($username)) {
            return "El nombre de usuario ya está en uso.";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->userModel->createUser($username, $hashedPassword);
        return "Registro exitoso.";
    }

    public function login($username, $password) {
        $user = $this->userModel->getUserByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return "Inicio de sesión exitoso.";
        }
        return "Credenciales incorrectas.";
    }

    public function logout() {
        session_destroy();
        return "Has cerrado sesión.";
    }
}
?>