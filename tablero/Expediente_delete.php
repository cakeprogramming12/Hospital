<?php
require '../conexionphp/conexion.php';

// Obtener el ID del expediente a eliminar
$id_expediente = pg_escape_string($_POST['id_expediente']);

// Deshabilitar triggers antes de la eliminación
$disableTriggerQuery = "ALTER TABLE bd_hospital.expediente DISABLE TRIGGER ALL";

// Ejecutar la consulta para deshabilitar los triggers
$disableTriggerConsulta = pg_query($conexion, $disableTriggerQuery);

// Verificar si la consulta para deshabilitar los triggers se ejecutó correctamente
if (!$disableTriggerConsulta) {
    echo "Error al deshabilitar los triggers: " . pg_last_error($conexion);
} else {
    // Query para la eliminación del expediente
    $query = "DELETE FROM bd_hospital.expediente WHERE id_expediente = '$id_expediente'";

    // Ejecutar la consulta de eliminación
    $consulta = pg_query($conexion, $query);

    // Verificar si la consulta de eliminación se ejecutó correctamente
    if (!$consulta) {
        echo "Error al eliminar el expediente: " . pg_last_error($conexion);
    } else {
        echo "Expediente eliminado correctamente";
    }

    // Habilitar triggers nuevamente
    $enableTriggerQuery = "ALTER TABLE bd_hospital.expediente ENABLE TRIGGER ALL";

    // Ejecutar la consulta para habilitar los triggers
    $enableTriggerConsulta = pg_query($conexion, $enableTriggerQuery);

    // Verificar si la consulta para habilitar los triggers se ejecutó correctamente
    if (!$enableTriggerConsulta) {
        echo "Error al habilitar los triggers: " . pg_last_error($conexion);
    } else {
        echo "Triggers habilitados correctamente";
    }
}

// Cerrar la conexión
pg_close($conexion);
?>