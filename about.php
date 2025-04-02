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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de Nosotros</title>
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" href="estilos/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js" defer></script>
    <style>
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
    }

    header h1 {
        color: #343a40;
        text-align: center;
        margin-bottom: 30px;
    }

    main {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
    }

    section {
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    #about {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: #ffffff;
    }

    #values {
        background-color: #e9ecef;
        border-left: 5px solid #007bff;
    }

    #contact {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
    }

    #faq {
        background-color: #ffffff;
        border: 1px solid #ced4da;
    }

    section h2 {
        margin-bottom: 20px;
    }

    #about h2, #about p {
        color: #ffffff;
    }

    #values ul {
        padding-left: 20px;
        list-style-type: square;
    }

    footer {
        background-color: #343a40;
        color: #ffffff;
        text-align: center;
        padding: 15px 0;
        margin-top: 30px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .form-label {
        color: #495057;
    }

    .form-control {
        border-radius: 5px;
    }
    </style>
</head>
<body>
    <div class="container py-5">
        <header>
            <h1>Acerca de Nosotros</h1>
        </header>
        <main>
    <!-- Sección "Acerca de Nosotros" y "Nuestros Valores" -->
    <div class="row mb-4">
        <div class="col-md-6">
            <section id="about" class="h-100">
                <h2>¿Quiénes Somos?</h2>
                <p>Somos una empresa dedicada a brindar un servicio de reservaciones en línea para restaurantes de alta calidad. Nuestro objetivo es facilitar la experiencia de reservar una mesa en tu restaurante favorito, sin importar la hora o el día.</p>
            </section>
        </div>
        <div class="col-md-6">
            <section id="values" class="h-100">
                <h2>Nuestros Valores</h2>
                <ul>
                    <li>Compromiso</li>
                    <li>Calidad</li>
                    <li>Innovación</li>
                    <li>Integridad</li>
                    <li>Servicio al Cliente</li>
                </ul>
            </section>
        </div>
    </div>

    <!-- Buzón de comentarios -->
    <section id="contact" class="mx-auto" style="max-width: 600px;">
        <h2>Buzón de Comentarios</h2>
        <p>Tu opinión es importante para nosotros. Por favor, llena el siguiente formulario para enviarnos tus comentarios o sugerencias.</p>
        <form id="contact-form" method="post" action="send_email.php">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mensaje</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </section>
</main>

    </div>

    <script>
        document.getElementById('contact-form').addEventListener('submit', function(event) {
            event.preventDefault();
            alert('Formulario enviado. Nos pondremos en contacto contigo pronto.');
            this.reset();
        });
    </script>
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
