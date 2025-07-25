<?php
$host = 'localhost'; // Cambia esto si tu base de datos está en otro servidor
$dbname = 'chat_app'; // Nombre de tu base de datos
$username = 'root'; // Tu nombre de usuario de la base de datos
$password = ''; // Tu contraseña de la base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>