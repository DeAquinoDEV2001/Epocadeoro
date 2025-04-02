
<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "sistemareservaciones";

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Configuración de caracteres para evitar problemas con caracteres especiales
$conn->set_charset("utf8");
?>

