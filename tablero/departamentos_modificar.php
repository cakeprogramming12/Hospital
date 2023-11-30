<?php
require '../conexionphp/conexion.php';

$id_modificar = $_POST['id_departamento_modificar'];
$nombre_modificado = $_POST['nombre_modificado'];
$descripcion_modificada = $_POST['descripcion_modificada'];

// Query para la modificación
$query = "UPDATE departamentos SET nombre = '$nombre_modificado', descripcion = '$descripcion_modificada' WHERE id_departamento = $id_modificar";

// Ejecutar la consulta
$consulta = pg_query($conexion, $query);

// Redirigir a mensaje.php con el resultado de la consulta
if ($consulta) {
    // Éxito: Redirigir a mensaje.php con mensaje de éxito y consulta
    $mensaje_exito = 'Registro modificado correctamente';
    header("Location: mensaje.php?mensaje=success&mensaje_text=$mensaje_exito&consulta=".urlencode($query));
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    // Error: Redirigir a mensaje.php con mensaje de error y consulta
    $mensaje_error = 'Error al modificar el registro. Consulta no válida';
    header("Location: mensaje.php?mensaje=error&mensaje_text=$mensaje_error&consulta=".urlencode($query));
    exit(); // Asegura que el script se detenga después de la redirección
}

// Cerrar la conexión
pg_close($conexion);
?>