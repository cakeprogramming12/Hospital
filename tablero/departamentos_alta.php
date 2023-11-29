<?php
require '../conexionphp/conexion.php';

// Query para la inserción
$query = "INSERT INTO departamentos(Nombre, Descripcion)
          VALUES('$_REQUEST[nombre]', '$_REQUEST[descripcion]')";

// Ejecutar la consulta
$consulta = pg_query($conexion, $query);

// Verificar si la consulta se ejecutó correctamente
if ($consulta) {
    // Éxito: Mostrar alerta y redirigir a tablero.php
    echo '<script>alert("Registro dado de alta correctamente"); window.location.href = "tablero.php";</script>';
    exit(); // Asegura que el script se detenga después de mostrar la alerta y redirigir
} else {
    // Error: Mostrar alerta con el mensaje de error y redirigir a tablero.php
    echo '<script>alert("Registro duplicado"); window.location.href = "tablero.php";</script>';
    exit(); // Asegura que el script se detenga después de mostrar la alerta y redirigir
}

// Cerrar la conexión
pg_close($conexion);
?>