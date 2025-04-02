<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanitizar los datos de entrada
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Validar correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Correo electrónico no válido.";
    } elseif (strlen($password) < 8) {
        $error = "La contraseña debe tener al menos 8 caracteres.";
    } else {
        // Hash de la contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Consulta preparada para evitar inyecciones SQL
        $query = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
        $query->bind_param("sss", $nombre, $email, $passwordHash);

        if ($query->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Error al registrar. Por favor, inténtalo de nuevo.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" href="estilos/styles.css">
</head>
<style>
    body {
        background-color: #f8f9fa;
    }
</style>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <img src="images/logo.png" alt="Logo" class="img-fluid" style="max-width: 100px;">
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center text-success">Registro</h3>
                        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required placeholder="Tu nombre completo aquí">
                            </div>
                            <div class="mb-3"></div>
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" name="email" class="form-control" required placeholder="example@email.com">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" required placeholder="********">
                            </div>
                            <center><button class="btn btn-success w-50">Registrar</button></center>
                        </form>
                        <p class="text-center mt-3">¿Ya tienes cuenta? <a href="index.php">Inicia Sesión</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <div class="containerfooter py-4 text-center">
        <div class="row">
            <div class="col-md-6 text-center text-md-start"></div>
                <p class="mb-0">&copy; <?php echo date('Y'); ?> Todos los derechos reservados. | Sistema de Reservación</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="privacy-policy.php" class="text-decoration-none me-3">Política de Privacidad</a>
                <a href="terms-of-service.php" class="text-decoration-none">Términos de Servicio</a>
            </div>
        </div>
    </div>
</footer>
</html>
</div>
