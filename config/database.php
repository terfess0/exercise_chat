<?php
$host = '162.241.60.182'; // Cambia esto si tu base de datos está en otro servidor
$dbname = 'colminds_chat_example'; // Nombre de tu base de datos
$username = 'colminds_student'; // Tu nombre de usuario de la base de datos
$password = 'Estudent22.'; // Tu contraseña de la base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>