<?php
require '../conexionphp/conexion.php';

// Obtener el ID del expediente a modificar
$id_expediente = pg_escape_string($_POST['id_expediente']);

// Datos modificados
$diagnosticos_modificados = pg_escape_string($_POST['diagnosticos_modificados']);
$tratamientos_modificados = pg_escape_string($_POST['tratamientos_modificados']);
$intervenciones_modificadas = pg_escape_string($_POST['intervenciones_modificadas']);
$sintomas_modificados = pg_escape_string($_POST['sintomas_modificados']);
$antecedentes_modificados = pg_escape_string($_POST['antecedentes_modificados']);
$f_ingreso_modificada = pg_escape_string($_POST['f_ingreso_modificada']);
$f_egreso_modificada = pg_escape_string($_POST['f_egreso_modificada']);
$descripcion_modificada = pg_escape_string($_POST['descripcion_modificada']);

// Deshabilitar triggers antes de la modificación
$disableTriggerQuery = "ALTER TABLE bd_hospital.expediente DISABLE TRIGGER ALL";
$disableTriggerConsulta = pg_query($conexion, $disableTriggerQuery);

// Verificar si la consulta para deshabilitar los triggers se ejecutó correctamente
if (!$disableTriggerConsulta) {
    echo "Error al deshabilitar los triggers: " . pg_last_error($conexion);
} else {
    // Query para la modificación del expediente
    $query = "UPDATE bd_hospital.expediente SET
              diagnosticos = '$diagnosticos_modificados',
              tratamientos = '$tratamientos_modificados',
              intervenciones_quirurgicas = '$intervenciones_modificadas',
              sintomas = '$sintomas_modificados',
              antecedentes = '$antecedentes_modificados',
              f_ingreso = '$f_ingreso_modificada',
              f_egreso = '$f_egreso_modificada',
              descripcion = '$descripcion_modificada'
              WHERE id_expediente = '$id_expediente'";

    // Ejecutar la consulta de modificación
    $consulta = pg_query($conexion, $query);

    // Verificar si la consulta de modificación se ejecutó correctamente
    if (!$consulta) {
        echo "Error al modificar el expediente: " . pg_last_error($conexion);
    } else {
        echo "Expediente modificado correctamente";
    }

    // Habilitar triggers nuevamente
    $enableTriggerQuery = "ALTER TABLE bd_hospital.expediente ENABLE TRIGGER ALL";
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