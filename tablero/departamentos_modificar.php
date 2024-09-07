<?php
require '../conexionphp/conexion.php';

$id_modificar = $_POST['id_departamento_modificar'];
$nombre_modificado = $_POST['nombre_modificado'];
$descripcion_modificada = $_POST['descripcion_modificada'];

// Deshabilitar triggers antes de la consulta
$queryDisableTriggers = "ALTER TABLE hospital.departamentos DISABLE TRIGGER ALL";
$disableTriggers = pg_query($conexion, $queryDisableTriggers);

// Verificar si se deshabilitaron los triggers correctamente
if (!$disableTriggers) {
    // Manejar el error
    $mensaje_error = 'Error al deshabilitar triggers: ' . pg_last_error($conexion);
    echo $mensaje_error;
    exit();
}

// Query para la modificación
$query = "UPDATE hospital.departamentos SET nombre = '$nombre_modificado', descripcion = '$descripcion_modificada' WHERE id_departamento = $id_modificar";

// Habilitar triggers después de la consulta
$queryEnableTriggers = "ALTER TABLE hospital.departamentos ENABLE TRIGGER ALL";
$enableTriggers = pg_query($conexion, $queryEnableTriggers);

// Verificar si se habilitaron los triggers correctamente
if (!$enableTriggers) {
    // Manejar el error
    $mensaje_error = 'Error al habilitar triggers: ' . pg_last_error($conexion);
    echo $mensaje_error;
    exit();
}

// Ejecutar la consulta
$consulta = pg_query($conexion, $query);

// Imprimir el resultado de la consulta
if ($consulta) {
    // Éxito: Redirigir a mensaje.php con mensaje de éxito y consulta
    $mensaje_exito = 'Registro dado de alta correctamente';
    header("Location: mensaje.php?mensaje=success&mensaje_text=$mensaje_exito&consulta=".urlencode($query));
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    $mensaje_error = 'Error al dar de alta el registro. Registro duplicado';
    header("Location: mensaje.php?mensaje=error&mensaje_text=$mensaje_error&consulta=".urlencode($query));
    exit(); // Asegura que el script se detenga después de la redirección
}

// Cerrar la conexión
pg_close($conexion);
?>