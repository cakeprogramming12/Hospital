<?php
require '../conexionphp/conexion.php';

// Deshabilitar triggers antes de la inserción
$disableTriggerQuery = "ALTER TABLE bd_hospital.expediente DISABLE TRIGGER ALL";
$disableTriggerConsulta = pg_query($conexion, $disableTriggerQuery);

if (!$disableTriggerConsulta) {
    echo "Error al deshabilitar los triggers: " . pg_last_error($conexion);
} else {
    // Datos que deseas insertar (asegúrate de escapar los valores para evitar inyecciones SQL)
    $diagnosticos = pg_escape_string($_POST['diagnosticos']);
    $tratamientos = pg_escape_string($_POST['tratamientos']);
    $intervenciones_quirurgicas = pg_escape_string($_POST['intervenciones_quirurgicas']);
    $sintomas = pg_escape_string($_POST['sintomas']);
    $antecedentes = pg_escape_string($_POST['antecedentes']);
    $f_ingreso = pg_escape_string($_POST['f_ingreso']);
    $f_egreso = pg_escape_string($_POST['f_egreso']);
    $descripcion = pg_escape_string($_POST['descripcion']);
    $id_departamento = pg_escape_string($_POST['id_departamento']);
    $id_paciente = pg_escape_string($_POST['id_paciente']);

    // Query para la inserción (no incluimos id_expediente en la lista de columnas y valores)
    $query = "INSERT INTO bd_hospital.expediente (diagnosticos, tratamientos, intervenciones_quirurgicas, sintomas, antecedentes, f_ingreso, f_egreso, descripcion, id_departamento, id_paciente)
              VALUES ('$diagnosticos', '$tratamientos', '$intervenciones_quirurgicas', '$sintomas', '$antecedentes', '$f_ingreso', '$f_egreso', '$descripcion', '$id_departamento', '$id_paciente')";

    // Ejecutar la consulta de inserción
    $consulta = pg_query($conexion, $query);

    // Verificar si la consulta de inserción se ejecutó correctamente
    if (!$consulta) {
        echo "Error al insertar el expediente: " . pg_last_error($conexion);
    } else {
        echo "Expediente insertado correctamente";
    }

    // Habilitar triggers nuevamente
    $enableTriggerQuery = "ALTER TABLE bd_hospital.expediente ENABLE TRIGGER ALL";
    $enableTriggerConsulta = pg_query($conexion, $enableTriggerQuery);

    if (!$enableTriggerConsulta) {
        echo "Error al habilitar los triggers: " . pg_last_error($conexion);
    } else {
        echo "Triggers habilitados correctamente";
    }
}

// Cerrar la conexión
pg_close($conexion);
?>