<?php
include 'includes/db.php';
include 'includes/navbar.php';
include(__DIR__ . '/includes/chatbot.php');

// Array de restaurantes con sus respectivos menús y datos adicionales
$restaurantes = [
    [
        'nombre' => 'Restaurante El Buen Sabor',
        'imagen' => 'images/restaurant.png',
        'telefono' => '123-456-7890',
        'direccion' => 'Calle Falsa 123, Ciudad, País',
        'menu' => [
            'comida' => [
                ['nombre' => 'Ensalada César', 'precio' => 5.99],
                ['nombre' => 'Sopa de Pollo', 'precio' => 4.99],
                ['nombre' => 'Filete de Res', 'precio' => 12.99],
            ],
            'bebida' => [
                ['nombre' => 'Jugo de Naranja', 'precio' => 2.99],
                ['nombre' => 'Café', 'precio' => 1.99],
                ['nombre' => 'Vino Tinto', 'precio' => 6.99],
            ],
        ],
    ],
    [
        'nombre' => 'Restaurante La Delicia',
        'imagen' => 'images/restaurant.png',
        'telefono' => '987-654-3210',
        'direccion' => 'Avenida Siempre Viva 742, Ciudad, País',
        'menu' => [
            'comida' => [
                ['nombre' => 'Pizza Margarita', 'precio' => 8.99],
                ['nombre' => 'Pasta Alfredo', 'precio' => 10.99],
                ['nombre' => 'Tiramisu', 'precio' => 5.99],
            ],
            'bebida' => [
                ['nombre' => 'Refresco', 'precio' => 1.99],
                ['nombre' => 'Té Helado', 'precio' => 2.49],
                ['nombre' => 'Cerveza', 'precio' => 3.99],
            ],
        ],
    ],
    // Puedes agregar más restaurantes aquí
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú de Restaurantes</title>
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" href="estilos/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js" defer></script>
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: #343a40;
        }

        .form-select {
            width: auto;
            padding: .375rem 1.75rem .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .menu-section {
            margin-bottom: 30px;
        }

        .menu-section h4 {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.2s ease;
        }

        .menu-section h4:hover {
            background-color: #0056b3;
        }

        .menu-section table {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .menu-section table:hover {
            transform: scale(1.02);
        }

        .menu-section th {
            background-color: #343a40;
            color: white;
        }

        .menu-section td {
            background-color: #ffffff;
        }

        .menu-section img {
            border-radius: 5px;
        }

        .text-center {
            text-align: center;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }

        .fade-in {
            animation: fadeIn 0.2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .containermenu{
            margin-left: 10%;
            margin-right: 30%;
        }
        footer{
            margin-top: 30%;
        }
    </style>
</head>
<body>
    <div class="containermenu py-5">
        <h2 class="text-center" style="color: #007bff;">Selecciona un Restaurante</h2>

        <!-- Lista desplegable para seleccionar el restaurante -->
        <center>
        <select id="restaurantSelect" class="form-select mb-4" onchange="showMenu()">
            <option value="" disabled selected>Elige un restaurante</option>
            <?php foreach ($restaurantes as $index => $restaurante): ?>
                <option value="<?php echo $index; ?>"><?php echo $restaurante['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        </center>

        <div id="menuContent" class="mt-4 fade-in">
            <!-- El menú se mostrará aquí -->
            <p class="text-center">Selecciona un restaurante de la lista desplegable para ver su menú y detalles de contacto. Cada restaurante ofrece una variedad de comidas y bebidas para satisfacer todos los gustos. ¡Disfruta de tu experiencia gastronómica!</p>
        </div>
    </div>

    <script>
        // Datos de los restaurantes (esto podría ser una variable PHP en un archivo JSON o similar)
        const restaurantes = <?php echo json_encode($restaurantes); ?>;

        function showMenu() {
            const select = document.getElementById('restaurantSelect');
            const index = select.value;
            
            if (index === "") {
                document.getElementById('menuContent').innerHTML = "";
                return;
            }
            
            const restaurante = restaurantes[index];
            let menuHtml = `<h3 class="text-center">${restaurante.nombre}</h3>`;
            menuHtml += `<img src="${restaurante.imagen}" class="img-fluid d-block mx-auto" alt="${restaurante.nombre}">`;
            menuHtml += `<p class="text-center"><strong>Teléfono:</strong> ${restaurante.telefono}</p>`;
            menuHtml += `<p class="text-center"><strong>Dirección:</strong> ${restaurante.direccion}</p>`;

            // Mostrar comida
            menuHtml += '<div class="menu-section"><h4 class="text-center">Comida</h4><div class="table-container"><table class="table">';
            menuHtml += '<thead><tr><th>Imagen</th><th>Nombre</th><th>Precio</th></tr></thead><tbody>';
            restaurante.menu.comida.forEach(item => {
                menuHtml += `
                    <tr>
                        <td><img src="images/comida.png" alt="${item.nombre}" class="img-fluid" style="width: 50px; height: 50px;"></td>
                        <td>${item.nombre}</td>
                        <td>$${item.precio.toFixed(2)} MXN</td>
                    </tr>
                `;
            });
            menuHtml += '</tbody></table></div></div>';

            // Mostrar bebida
            menuHtml += '<div class="menu-section"><h4 class="text-center">Bebida</h4><div class="table-container"><table class="table">';
            menuHtml += '<thead><tr><th>Imagen</th><th>Nombre</th><th>Precio</th></thead><tbody>';
            restaurante.menu.bebida.forEach(item => {
                menuHtml += `
                    <tr>
                        <td><img src="images/bebida.jpeg" alt="${item.nombre}" class="img-fluid" style="width: 50px; height: 50px;"></td>
                        <td>${item.nombre}</td>
                        <td>$${item.precio.toFixed(2)} MXN</td>
                    </tr>
                `;
            });
            menuHtml += '</tbody></table></div></div>';

            document.getElementById('menuContent').innerHTML = menuHtml;
        }
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
