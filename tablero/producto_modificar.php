<?php
require '../conexionphp/conexion.php';

$id_modificar = $_POST['id_producto_modificar'];
$nombre_modificado = $_POST['nombre_modificado'];
$precio_modificada = $_POST['precio_modificada'];
$tipo_modificada = $_POST['tipo_modificada'];
$marca_modificada = $_POST['marca_modificada'];

// Query para la modificación
$query = "set search_path to hospital; UPDATE producto SET nombre = '$nombre_modificado', precio = '$precio_modificada', tipo = '$tipo_modificada',marca = '$marca_modificada' WHERE id_producto = '$id_modificar'";

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