<?php
// Usar la conexión
require '../conexionphp/conexion.php';

// Iniciar sesión (por si se ocupa)
session_start();

// Validar y sanar los datos
$nombre = isset($_REQUEST['nombre']) ? pg_escape_string($conexion, $_REQUEST['nombre']) : '';
$descripcion = isset($_REQUEST['descripcion']) ? pg_escape_string($conexion, $_REQUEST['descripcion']) : '';

// Variable para almacenar el mensaje
$mensaje = '';

// Verificar si los campos obligatorios están presentes
if (empty($nombre) || empty($descripcion)) {
    $mensaje = 'Por favor, complete todos los campos.';
} else {
    // Preparar la consulta SQL para insertar datos en la tabla departamentos
    $query = "INSERT INTO departamentos (Nombre, Descripcion) VALUES ('$nombre', '$descripcion')";

    // Ejecutar la consulta
    $consulta = pg_query($conexion, $query);

    // Verificar el resultado y manejar errores
    if ($consulta) {
        $mensaje = 'El departamento fue dado de alta con éxito.';
    } else {
        $mensaje = 'Error al dar de alta el departamento: ' . pg_last_error($conexion);
    }

    // Cerrar la conexión
    pg_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <!-- Agrega cualquier otro estilo o script que necesites -->
</head>

<body>

    <script>
    // Mostrar ventana emergente con el mensaje
    alert('<?php echo $mensaje; ?>');
    </script>

    <!-- Puedes agregar más contenido HTML aquí si es necesario -->

</body>

</html>