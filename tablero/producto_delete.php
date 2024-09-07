<?php
require '../conexionphp/conexion.php';

// Obtener el ID del departamento a eliminar
$id = $_REQUEST['id_producto'];

// Utilizar consultas preparadas para evitar inyecciones SQL
$query = "set search_path to hospital; DELETE FROM hospital.producto WHERE id_producto = '$id'";

// Preparar la consulta
$consulta = pg_query($conexion, $query);

// Redirigir a mensaje.php con el resultado de la consulta
if ($consulta) {
    // Éxito: Redirigir a mensaje.php con mensaje de éxito y consulta
    $mensaje_exito = 'Registro eliminado correctamente';
    header("Location: mensaje.php?mensaje=success&mensaje_text=$mensaje_exito&consulta=".urlencode($query));
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    // Error: Redirigir a mensaje.php con mensaje de error y consulta
    $mensaje_error = 'Error al eliminar el registro.';
    header("Location: mensaje.php?mensaje=error&mensaje_text=$mensaje_error&consulta=".urlencode($query));
    exit(); // Asegura que el script se detenga después de la redirección
}

// Cerrar la conexión
pg_close($conexion);
?>