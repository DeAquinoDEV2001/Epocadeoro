<?php
include 'includes/db.php';
include 'includes/navbar.php';
include(__DIR__ . '/includes/chatbot.php');

// Iniciar sesión al principio (solo una vez)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
$user_name = $_SESSION['user']['nombre']; // Asegúrate de que el nombre del usuario esté en la sesión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $id = bin2hex(random_bytes(16)); // Generate a unique ID for the reservation
    $id_usuario = $user_id;
    $nombre = $_POST['nombre']; // Obtener el nombre del formulario
    $id_restaurante = $_POST['id_restaurante'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $numero_personas = $_POST['numero_personas'];
    $creado_en = date('Y-m-d H:i:s'); // Fecha y hora actual

    // Preparar la consulta SQL
    $stmt = $conn->prepare("INSERT INTO reservaciones (id, id_usuario, nombre, id_restaurante, fecha, hora, numero_personas, creado_en) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssis", $id, $id_usuario, $nombre, $id_restaurante, $fecha, $hora, $numero_personas, $creado_en);

    if ($stmt->execute()) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                const modalHtml = `
                    <div class='modal fade' id='confirmationModal' tabindex='-1' aria-labelledby='confirmationModalLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='confirmationModalLabel'>Confirmación de Reservación</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <p>Tu reservación ha sido creada exitosamente.</p>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                document.body.insertAdjacentHTML('beforeend', modalHtml);
                const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                confirmationModal.show();
            });
        </script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                const ticketHtml = `
                    <div class='modal fade' id='ticketModal' tabindex='-1' aria-labelledby='ticketModalLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='ticketModalLabel'>Ticket de Reservación</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <p><strong>Nombre: </strong> {$user_name}</p>
                                    <p><strong>ID de Reservación:</strong> {$id}</p>
                                    <p><strong>Restaurante:</strong> {$_POST['id_restaurante']}</p>
                                    <p><strong>Fecha:</strong> {$_POST['fecha']}</p>
                                    <p><strong>Hora:</strong> {$_POST['hora']}</p>
                                    <p><strong>Número de Personas:</strong> {$_POST['numero_personas']}</p>
                                    <p><strong>Creado en:</strong> {$creado_en}</p>
                                </div>
                                <div class='modal-footer'>
                                    <p>Toma captura a esta pantalla como comprobante de tu reservación.</p>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                document.body.insertAdjacentHTML('beforeend', ticketHtml);
                const ticketModal = new bootstrap.Modal(document.getElementById('ticketModal'));
                ticketModal.show();

                document.getElementById('captureTicket').addEventListener('click', function() {
                    html2canvas(document.querySelector('#ticketModal .modal-body')).then(canvas => {
                        const link = document.createElement('a');
                        link.href = canvas.toDataURL('image/png');
                        link.download = 'ticket_reservacion.png';
                        link.click();
                    });
                });
            });
        </script>";
    } else {
        echo "Error: {$stmt->error}";
    }

    $stmt->close();
}

// Array de restaurantes sin menús
$restaurantes = [
    [
        'id' => 1,
        'nombre' => 'Restaurante El Buen Sabor',
        'imagen' => 'images/restaurant.png',
        'telefono' => '123-456-7890',
        'direccion' => 'Calle Falsa 123, Ciudad, País',
    ],
    [
        'id' => 2,
        'nombre' => 'Restaurante La Delicia',
        'imagen' => 'images/restaurant.png',
        'telefono' => '987-654-3210',
        'direccion' => 'Avenida Siempre Viva 742, Ciudad, País',
    ],
    // Puedes agregar más restaurantes aquí
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservaciones</title>
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" href="estilos/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js" defer></script>
    <style>
        .form-container {
            display: flex;
            justify-content: space-between;
            margin-left: 20%;
            margin-right: 20%;
            color: black;
        }
        .form-container .form-section {
            flex: 1;
            color: black;
            margin-right: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .form-container .info-section {
            flex: 1;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container py-5" style="background-color:rgba(248, 249, 250, 0.08); color:#00000; box-shadow: 0 0 0 5px rgba(248, 249, 250, 0.19);">
        <h2 class="text-center">Reservaciones</h2>
        <p class="text-center">Hola <?php echo htmlspecialchars($user_name); ?> selecciona un restaurante y completa el formulario para hacer tu reservación.</p>
        <div class="form-container mt-4">
            <form method="POST" class="form-section">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="id_restaurante" class="form-label">Restaurante</label>
                        <select name="id_restaurante" class="form-select" required>
                            <option value="">Selecciona un restaurante</option>
                            <?php
                            foreach ($restaurantes as $restaurante) {
                                echo "<option value='{$restaurante['id']}'>{$restaurante['nombre']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $user_name; ?>" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="hora" class="form-label">Hora</label>
                        <input type="time" name="hora" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="numero_personas" class="form-label">Número de Personas</label>
                        <select name="numero_personas" class="form-select" required>
                            <option value="">Selecciona el número de personas</option>
                            <option value="1">1 persona</option>
                            <option value="2">2 personas</option>
                            <option value="3">3 personas</option>
                            <option value="4">4 personas</option>
                            <option value="5">5 personas</option>
                            <option value="6">6 personas</option>
                        </select>
                    </div>
                </div>
                <center><button type="submit" class="btn btn-success w-50">Reservar</button></center>
            </form>
            <div class="info-section" id="infoRestaurante"></div>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const restaurantes = <?php echo json_encode($restaurantes); ?>;
        const selectRestaurante = document.querySelector('select[name="id_restaurante"]');
        const infoRestaurante = document.getElementById('infoRestaurante');

        selectRestaurante.addEventListener('change', function() {
            const selectedId = this.value;
            const restaurante = restaurantes.find(r => r.id == selectedId);
            if (restaurante) {
                infoRestaurante.innerHTML = `
                    <h4>${restaurante.nombre}</h4>
                    <br><img src="${restaurante.imagen}" alt="${restaurante.nombre}" class="img-fluid">
                    <p><strong>Teléfono:</strong> ${restaurante.telefono}</p>
                    <p><strong>Dirección:</strong> ${restaurante.direccion}</p>
                `;
            } else {
                infoRestaurante.innerHTML = '';
            }
        });
    });
</script>
