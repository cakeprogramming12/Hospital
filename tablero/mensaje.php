<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje</title>
    <!-- Agregar el enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <?php
        if (isset($_GET['mensaje']) && isset($_GET['mensaje_text']) && isset($_GET['consulta'])) {
            $tipo_mensaje = $_GET['mensaje'];
            $mensaje_text = urldecode($_GET['mensaje_text']);
            $consulta_ejecutada = urldecode($_GET['consulta']);

            // Utilizar clases de Bootstrap para los mensajes
            $alert_class = ($tipo_mensaje === 'success') ? 'alert-success' : 'alert-danger';

            // Mostrar mensaje utilizando el componente de alerta de Bootstrap
            echo '<div class="alert ' . $alert_class . '">';
            echo '<strong>' . ucfirst($tipo_mensaje) . ':</strong> ' . $mensaje_text;
            echo '<br><strong>Consulta ejecutada:</strong> ' . $consulta_ejecutada;
            echo '</div>';
        } else {
            // Mensaje no especificado
            echo '<div class="alert alert-danger">';
            echo '<strong>Error:</strong> Mensaje no especificado. Consulta no se pudo realizar.';
            echo '</div>';
        }
        ?>

        <!-- Botón para volver a departamentos.php -->
        <a href="tablero.php" class="btn btn-primary mt-3">Volver al menu</a>
    </div>

    <!-- Agregar el enlace al archivo JS de Bootstrap y a la biblioteca jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>