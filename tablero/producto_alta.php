<?php
require '../conexionphp/conexion.php';


// Query para la inserción
$query = "set search_path to hospital; INSERT INTO producto(nombre, precio,tipo,marca)
          VALUES('$_REQUEST[nombre]','$_REQUEST[precio]', '$_REQUEST[tipo]','$_REQUEST[marca]');";

// Ejecutar la consulta
$consulta = pg_query($conexion, $query);

// Redirigir a mensaje.php con el resultado de la consulta
if ($consulta) {
    // Éxito: Redirigir a mensaje.php con mensaje de éxito y consulta
    $mensaje_exito = 'Registro dado de alta correctamente';
    header("Location: mensaje.php?mensaje=success&mensaje_text=$mensaje_exito&consulta=".urlencode($query));
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    // Error: Redirigir a mensaje.php con mensaje de error y consulta
    $mensaje_error = 'Error al dar de alta el registro.';
    header("Location: mensaje.php?mensaje=error&mensaje_text=$mensaje_error&consulta=".urlencode($query));
    exit(); // Asegura que el script se detenga después de la redirección
}

// Cerrar la conexión
pg_close($conexion);
?>