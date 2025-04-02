<?php
// Configuración del correo
$to = "rauldeaquinogarcia@gmail.com"; // Reemplaza con tu correo de Gmail
$subject = "Nuevo mensaje del buzón de comentarios";

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['message']);

    // Validar que los campos no estén vacíos
    if (!empty($nombre) && !empty($email) && !empty($mensaje)) {
        // Crear el cuerpo del correo
        $body = "Nombre: $nombre\n";
        $body .= "Correo: $email\n\n";
        $body .= "Mensaje:\n$mensaje\n";

        // Encabezados del correo
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Enviar el correo
        if (mail($to, $subject, $body, $headers)) {
            echo "El mensaje se envió correctamente.";
        } else {
            echo "Hubo un error al enviar el mensaje.";
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>