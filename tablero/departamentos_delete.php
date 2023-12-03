<?php
require '../conexionphp/conexion.php';

// Obtener el ID del departamento a eliminar
$id = $_REQUEST['id_departamento'];

// Utilizar consultas preparadas para evitar inyecciones SQL
$query = "DELETE FROM bd_hospital.departamentos WHERE Id_departamento = $1";

// Preparar la consulta
$consulta = pg_prepare($conexion, "eliminar_departamento", $query);

// Ejecutar la consulta con el ID como parámetro
$resultado = pg_execute($conexion, "eliminar_departamento", array($id));

// Redirigir a mensaje.php con el resultado de la consulta
if ($resultado) {
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