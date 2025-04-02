<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $ip = $_SERVER['REMOTE_ADDR'];
    $captcha = $_POST['g-recaptcha-response'];
    $secretkey = '6Lcrd8gqAAAAAM6004R9bewKBgi8woY7AvJCJOM6';

    $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");
    $atributos = json_decode($respuesta, TRUE);

    if (intval($atributos['success']) !== 1) {
        $error = "Por favor, verifica que no eres un robot.";
    } else {
        $query = $conn->query("SELECT * FROM usuarios WHERE email = '$email'");
        if ($query->num_rows > 0) {
            $user = $query->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user'] = $user;
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Contraseña incorrecta.";
            }
        } else {
            $error = "Usuario no encontrado.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" href="estilos/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js" defer></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        .small-alert {
            font-size: 0.875em; /* Tamaño de texto más pequeño */
            padding: 0.5em; /* Espaciado interno más pequeño */
        }
        body{
            background-color: #f8f9fa;
        }

    </style>
</head>
<body>
    <div class="container" >
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6">
            <div class="text-center mb-4">
                <img src="images/logo.png" alt="Logo" class="img-fluid" style="max-width: 100px;">
            </div>
                <div class="card shadow" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.32)">
                    <div class="card-body">
                        <h3 class="text-center text-primary">Iniciar Sesión</h3>
                        <?php if (isset($error)) { echo "<div class='alert alert-danger small-alert'>$error</div>"; } ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" name="email" class="form-control" required placeholder="example@email.com">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" required placeholder="*********">
                            </div>
                            <div class="mb-3 text-center">
                                <div class="d-flex justify-content-center">
                                    <div class="g-recaptcha" data-sitekey="6Lcrd8gqAAAAAGckWlUAzRGuvqgQogppSTJ0T-7I"></div>
                                </div>
                            </div>
                            <center><button class="btn btn-primary w-50">Ingresar</button></center>
                        </form>
                        <p class="text-center mt-3">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
                        <p class="text-center mt-3"><a href="rest-pass.php">¿Olvidaste tu Contraseña?</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <div class="containerfooter py-4 text-center" >
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