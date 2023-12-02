<?php
require '../conexionphp/conexion.php';

// Deshabilitar triggers
$disableTriggerQuery = "ALTER TABLE bd_hospital.pacientes DISABLE TRIGGER ALL";
$disableTriggerConsulta = pg_query($conexion, $disableTriggerQuery);

// Verificar si la consulta para deshabilitar los triggers se ejecutó correctamente
if (!$disableTriggerConsulta) {
    echo "Error al deshabilitar los triggers: " . pg_last_error($conexion);
} else {
    // Datos que deseas insertar (asegúrate de escapar los valores para evitar inyecciones SQL)
    $nombre = pg_escape_string($_REQUEST['nombre']);
    $apellido = pg_escape_string($_REQUEST['apellido']);
    $fec_nac = pg_escape_string($_REQUEST['fec_nac']);
    $sexo = pg_escape_string($_REQUEST['sexo']);
    $telefono = pg_escape_string($_REQUEST['telefono']);
    $direccion = pg_escape_string($_REQUEST['direccion']);
    $no_piso = pg_escape_string($_REQUEST['no_piso']);
    $rfc_hospital = pg_escape_string($_REQUEST['rfc_hospital']);

    // Query para la inserción (utiliza comillas simples para los valores de cadena y ajusta las columnas según tu estructura de tabla)
    $query = "INSERT INTO bd_hospital.pacientes (nombre, apellido, fec_nac, sexo, telefono, direccion, no_piso, rfc_hospital)
              VALUES ('$nombre', '$apellido', '$fec_nac', '$sexo', '$telefono', '$direccion', '$no_piso', '$rfc_hospital')";

    // Ejecutar la consulta de inserción
    $consulta = pg_query($conexion, $query);

    // Verificar si la consulta de inserción se ejecutó correctamente
    if (!$consulta) {
        echo "Error al insertar el registro: " . pg_last_error($conexion);
    } else {
        echo "Registro insertado correctamente";
    }

    // Habilitar triggers nuevamente
    $enableTriggerQuery = "ALTER TABLE bd_hospital.pacientes ENABLE TRIGGER ALL";
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