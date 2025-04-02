<?php
session_start(); // Inicia la sesión si no está ya iniciada
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirige al usuario a la página de inicio
header("Location: index.php");
exit();
?>
