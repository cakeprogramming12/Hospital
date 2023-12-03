<?php
require '../conexionphp/conexion.php';

// Deshabilitar triggers (ejemplo para el trigger nombre_nuevo_hospital)
$disableTriggerQuery = "ALTER TABLE bd_hospital.hospital DISABLE TRIGGER ALL";

// Ejecutar la consulta para deshabilitar el trigger
$disableTriggerConsulta = pg_query($conexion, $disableTriggerQuery);

// Verificar si la consulta para deshabilitar el trigger se ejecutó correctamente
if (!$disableTriggerConsulta) {
    echo "Error al deshabilitar el trigger: " . pg_last_error($conexion);
} else {
    // Datos que deseas insertar (asegúrate de escapar los valores para evitar inyecciones SQL)
    $fecha = pg_escape_string($_REQUEST['fecha']);
    $subtotal = pg_escape_string($_REQUEST['subtotal']);
    $cfdi = pg_escape_string($_REQUEST['cfdi']);
    $id_cuenta_prod = pg_escape_string($_REQUEST['id_cuenta_prod']);
    $id_cuenta_serv = pg_escape_string($_REQUEST['id_cuenta_serv']);
    $id_responsable = pg_escape_string($_REQUEST['id_responsable']);

    // Query para la inserción (utiliza comillas simples para los valores de cadena)
    $query = "INSERT INTO bd_hospital.facturacion (fecha, subtotal, cfdi, id_cuenta_prod, id_cuenta_serv, id_responsable)
              VALUES ('$fecha', '$subtotal', '$cfdi', '$id_cuenta_prod', '$id_cuenta_serv', '$id_responsable')";

    // Ejecutar la consulta de inserción
    $consulta = pg_query($conexion, $query);

    // Verificar si la consulta de inserción se ejecutó correctamente
    if (!$consulta) {
        echo "Error al insertar el registro: " . pg_last_error($conexion);
    } else {
        echo "Registro insertado correctamente";
    }

    // Habilitar triggers nuevamente
    $enableTriggerQuery = "ALTER TABLE bd_hospital.hospital ENABLE TRIGGER ALL";

    // Ejecutar la consulta para habilitar el trigger
    $enableTriggerConsulta = pg_query($conexion, $enableTriggerQuery);

    // Verificar si la consulta para habilitar el trigger se ejecutó correctamente
    if (!$enableTriggerConsulta) {
        echo "Error al habilitar el trigger: " . pg_last_error($conexion);
    } else {
        echo "Trigger habilitado correctamente";
    }
}

// Cerrar la conexión
pg_close($conexion);
?>