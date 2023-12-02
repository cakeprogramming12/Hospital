<?php
require '../conexionphp/conexion.php';

$id = pg_escape_string($_REQUEST['rfc_hospital']);

// Deshabilitar triggers antes de la eliminación
$disableTriggerQuery = "ALTER TABLE bd_hospital.hospital DISABLE TRIGGER ALL";

// Ejecutar la consulta para deshabilitar los triggers
$disableTriggerConsulta = pg_query($conexion, $disableTriggerQuery);

// Verificar si la consulta para deshabilitar los triggers se ejecutó correctamente
if (!$disableTriggerConsulta) {
    echo "Error al deshabilitar los triggers: " . pg_last_error($conexion);
} else {
    // Query para la eliminación
    $query = "DELETE FROM bd_hospital.hospital WHERE rfc_hospital = '$id'";

    // Ejecutar la consulta de eliminación
    $consulta = pg_query($conexion, $query);

    // Verificar si la consulta de eliminación se ejecutó correctamente
    if (!$consulta) {
        echo "Error al eliminar el registro: " . pg_last_error($conexion);
    } else {
        echo "Registro eliminado correctamente";
    }

    // Habilitar triggers nuevamente
    $enableTriggerQuery = "ALTER TABLE bd_hospital.hospital ENABLE TRIGGER ALL";

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