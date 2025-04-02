<?php
session_start();
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

// Increase MySQL timeout and packet size
$conn->query("SET SESSION wait_timeout = 28800");
$conn->query("SET GLOBAL max_allowed_packet = 67108864");

$mensaje = "";
$mostrar_formulario = false;

// Si el usuario regresa a la página, limpia la sesión para que vuelva a validar sus datos
if (isset($_GET['reiniciar'])) {
    session_unset();
    session_destroy();
    header("Location: recuperar.php"); // Redirigir para evitar que los datos queden en la URL
    exit();
}

// Verifica si se envió el formulario de validación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['validar'])) {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);

    // Verificar si el usuario y el correo existen en la base de datos
    $query = "SELECT id FROM usuarios WHERE nombre = ? AND email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $nombre, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['reset_email'] = $email; // Guarda el email en sesión para el cambio de contraseña
        $_SESSION['reset_nombre'] = $nombre;
        $mostrar_formulario = true;
    } else {
        $mensaje = "<div class='alert alert-danger'>Nombre o correo incorrecto.</div>";
    }

    $stmt->close();
}

// Verifica si se envió el formulario de cambio de contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cambiar'])) {
    if (isset($_SESSION['reset_email']) && isset($_SESSION['reset_nombre'])) {
        $nueva_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_SESSION['reset_email'];

        // Actualizar la contraseña en la base de datos
        $query = "UPDATE usuarios SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $nueva_password, $email);

        if ($stmt->execute()) {
            $mensaje = "<div class='alert alert-success'>Contraseña cambiada con éxito. <a href='index.php'>Inicia sesión aquí</a></div>";
            session_unset(); // Limpia la sesión
            session_destroy();
        } else {
            $mensaje = "<div class='alert alert-danger'>Error al actualizar la contraseña.</div>";
        }

        $stmt->close();
    } else {
        $mensaje = "<div class='alert alert-warning'>Sesión expirada. Intenta nuevamente.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Cuenta</title>
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" href="estilos/styles.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 2rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-green {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-outline-secondary {
            border-color: #6c757d;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }
        .input-group-text {
            background-color: #fff;
            border-left: 0;
        }
        .input-group .form-control {
            border-right: 0;
        }
        .input-group .form-control:focus {
            border-color: #007bff;
        }
        .input-group .btn {
            border-left: 0;
        }
        .alert {
            margin-top: 1rem;
        }
        .text-center img {
            max-width: 120px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center mb-4">
            <img src="images/logo.png" alt="Logo" class="img-fluid">
        </div>
        <div class="card shadow">
            <div class="card-body">
                <h3 class="text-center text-primary">Recuperar Cuenta</h3>
                <?php echo $mensaje; ?>

                <?php if (!$mostrar_formulario && !isset($_SESSION['reset_email'])): ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required placeholder="Tu nombre">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control" required placeholder="example@email.com">
                        </div>
                        <center><button type="submit" name="validar" class="btn btn-primary w-50">Validar Cuenta</button></center>
                    </form>
                <?php elseif (isset($_SESSION['reset_email'])): ?>
                    <form method="POST">
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Nueva Contraseña</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control" required placeholder="********">
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <center><button type="submit" name="cambiar" class="btn btn-green w-50">Cambiar Contraseña</button></center>
                    </form>
                <?php endif; ?>
                <div class="text-center mt-3">
                    <a href="index.php?reiniciar=1" class="btn btn-success">Cancelar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script>
        document.getElementById("togglePassword").addEventListener("click", function () {
            let passwordField = document.getElementById("password");
            let icon = this.querySelector("i");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    </script>
</body>
</script></div>
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