<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']); // obtiene el nombre del archivo actual
?>

<style>

    .navbar {
        background-color:rgb(36, 36, 36);
        color: #ccc;
    }

    .navbar-nav .nav-link {
        position: relative;
        transition: all 0.3s ease-in-out;
    }

    /* Efecto hover: cambia el color y subraya con una línea dorada */
    .navbar-nav .nav-link:hover {
        color: gold !important;
        transform: scale(1.05);
    }

    /* Línea dorada animada al hacer hover */
    .navbar-nav .nav-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -3px;
        width: 0;
        height: 2px;
        background-color: gold;
        transition: width 0.3s ease-in-out;
    }

    .navbar-nav .nav-link:hover::after {
        width: 100%;
    }

    /* Estilos para el enlace activo */
    .navbar-nav .nav-link.active {
        font-weight: bold;
        border-bottom: 2px solid gold;
        color: gold !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php" style="color: goldenrod; font-family: 'Tahoma';">
            <img src="images/logo.png" style="width:50px;"> Epoca de oro
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?>" href="dashboard.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'restaurantes.php' ? 'active' : ''; ?>" href="restaurantes.php">Restaurantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'reservaciones.php' ? 'active' : ''; ?>" href="reservaciones.php">Reservaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'mapadesitio.php' ? 'active' : ''; ?>" href="mapadesitio.php">Mapa de sitio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'about.php' ? 'active' : ''; ?>" href="about.php">Acerca de</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php" onclick="return confirmLogout();">Salir</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    // Aplica el efecto fade-in cuando la página carga
    document.addEventListener("DOMContentLoaded", function () {
        document.body.classList.add("loaded");
    });

    // Agrega el efecto fade-out al cambiar de página
    document.querySelectorAll(".nav-link").forEach(link => {
        link.addEventListener("click", function (event) {
            if (!this.href.includes("logout.php")) {
                event.preventDefault(); // Evita la carga inmediata
                document.body.style.opacity = 0; // Aplica fade-out
                setTimeout(() => {
                    window.location.href = this.href; // Redirige después del efecto
                }, 500);
            }
        });
    });

    // Función para confirmar el cierre de sesión
    function confirmLogout() {
        return confirm("¿Estás seguro de que quieres salir?");
    }
</script>

