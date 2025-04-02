<?php
include 'includes/db.php';
include 'includes/navbar.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" href="estilos/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js" defer></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 10px;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .carousel-item img {
            max-height: 350px;
            object-fit: cover;
            border-radius: 10px;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
        }

        .welcome-text {
            color: #343a40;
        }

        .btn-primary, .btn-success {
            border-radius: 50px;
            padding: 10px 20px;
        }
    </style>
</head>
<body>

    <!-- Carrusel de Imágenes -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/carrusel1.jpg" class="d-block w-100" alt="Imagen 1">
            </div>
            <div class="carousel-item">
                <img src="images/carrusel2.jpg" class="d-block w-100" alt="Imagen 2">
            </div>
            <div class="carousel-item">
                <img src="images/carrusel3.jpg" class="d-block w-100" alt="Imagen 3">
            </div>
            <div class="carousel-item">
                <img src="images/carrusel4.jpg" class="d-block w-100" alt="Imagen 4">
            </div>
            <div class="carousel-item">
                <img src="images/carrusel5.jpg" class="d-block w-100" alt="Imagen 5">
            </div>
            <div class="carousel-item">
                <img src="images/carrusel6.jpg" class="d-block w-100" alt="Imagen 6">
            </div>
        </div>
        <!-- Control Carrusel --> 
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <!-- Opción de Bienvenida -->
    <div class="container py-5">
        <h1 class="text-center welcome-text">¡Bienvenido, <?php echo htmlspecialchars($user['nombre']); ?>!</h1>
        <p class="text-center">Selecciona una opción del menú para gestionar restaurantes o realizar reservaciones.</p>
        
        <div class="row mt-4">
            <div class="col-md-6 mb-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title">Restaurantes</h4>
                        <p class="card-text">Consulta restaurantes y sus menús.</p>
                        <a href="restaurantes.php" class="btn btn-primary">Ir a Restaurantes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title">Reservaciones</h4>
                        <p class="card-text">Haz una nueva reservación.</p>
                        <a href="reservaciones.php" class="btn btn-success">Ir a Reservaciones</a>
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
