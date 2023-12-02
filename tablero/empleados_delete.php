<?php
require '../conexionphp/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID del empleado a eliminar
    $id_empleado_eliminar = pg_escape_string($_POST['id_empleado']);

    // Deshabilitar triggers antes de la eliminación
    $disableTriggerQuery = "ALTER TABLE bd_hospital.empleado DISABLE TRIGGER ALL";
    $disableTriggerConsulta = pg_query($conexion, $disableTriggerQuery);

    // Verificar si la consulta para deshabilitar los triggers se ejecutó correctamente
    if (!$disableTriggerConsulta) {
        echo "Error al deshabilitar los triggers: " . pg_last_error($conexion);
        exit();
    }

    // Query para la eliminación
    $query = "DELETE FROM bd_hospital.empleado WHERE id_empleado = '$id_empleado_eliminar'";

    // Ejecutar la consulta de eliminación
    $consulta = pg_query($conexion, $query);

    // Verificar si la consulta de eliminación se ejecutó correctamente
    if (!$consulta) {
        echo "Error al eliminar el registro: " . pg_last_error($conexion);
    } else {
        echo "Registro eliminado correctamente";
    }

    // Habilitar triggers nuevamente
    $enableTriggerQuery = "ALTER TABLE bd_hospital.empleado ENABLE TRIGGER ALL";
    $enableTriggerConsulta = pg_query($conexion, $enableTriggerQuery);

    // Verificar si la consulta para habilitar los triggers se ejecutó correctamente
    if (!$enableTriggerConsulta) {
        echo "Error al habilitar los triggers: " . pg_last_error($conexion);
    } else {
        echo "Triggers habilitados correctamente";
    }
} else {
    // Si no es una solicitud POST, redirige a algún lugar o muestra un mensaje de error
    header("Location: mensaje.php?mensaje=error&mensaje_text=Acceso no permitido");
    exit();
}

// Cerrar la conexión
pg_close($conexion);
?>