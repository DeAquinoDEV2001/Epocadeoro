<?php
include 'includes/db.php';
include 'includes/navbar.php';
include(__DIR__ . '/includes/chatbot.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Sitio</title>
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" href="estilos/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js" defer></script>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        .mapsite {
            margin: 0 auto;
            text-align: center;
            max-width: 80%;
        }
        .img-sitio {
            width: 100%;
            max-width: 800px;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        p {
            font-size: 1rem;
            color: #555;
        }
    </style>
</head>
<body>
    <div id="map-container">
        <iframe
            width="100%"
            height="450"
            style="border:0"
            loading="lazy"
            allowfullscreen
            referrerpolicy="no-referrer-when-downgrade"
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAioQLhQYZbthvW1NoSBuBfm-U1EC2HkLc
                &q=18.618341790804088,-92.22544661854756">
        </iframe>
    </div>
    <div class="mapsite">
        <h2>Mapa del sitio</h2>
        <img src="images/mapadesitio.jpg" alt="Mapa del sitio" class="img-sitio">
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
</html>