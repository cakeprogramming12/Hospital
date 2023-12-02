<?php
require '../conexionphp/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Deshabilitar triggers
    $disableTriggerQuery = "ALTER TABLE bd_hospital.empleado DISABLE TRIGGER ALL";
    $disableTriggerConsulta = pg_query($conexion, $disableTriggerQuery);

    if (!$disableTriggerConsulta) {
        echo "Error al deshabilitar el trigger: " . pg_last_error($conexion);
        exit();
    }

    // Obtener datos del formulario (asegúrate de escapar los valores para evitar inyecciones SQL)
    $nombre = pg_escape_string($_POST['nombre']);
    $apellido = pg_escape_string($_POST['apellido']);
    $puesto = pg_escape_string($_POST['puesto']);
    $turno = pg_escape_string($_POST['turno']);
    $id_departamento = pg_escape_string($_POST['id_departamento']);

    // Query para la inserción (utiliza comillas simples para los valores de cadena)
    $query = "INSERT INTO bd_hospital.empleado (nombre, apellido, puesto, turno, id_departamento)
              VALUES ('$nombre', '$apellido', '$puesto', '$turno', $id_departamento)";

    // Ejecutar la consulta de inserción
    $consulta = pg_query($conexion, $query);

    if (!$consulta) {
        echo "Error al insertar el empleado: " . pg_last_error($conexion);
    } else {
        echo "Empleado insertado correctamente";
    }

    // Habilitar triggers nuevamente
    $enableTriggerQuery = "ALTER TABLE bd_hospital.empleado ENABLE TRIGGER ALL";
    $enableTriggerConsulta = pg_query($conexion, $enableTriggerQuery);

    if (!$enableTriggerConsulta) {
        echo "Error al habilitar el trigger: " . pg_last_error($conexion);
    } else {
        echo "Trigger habilitado correctamente";
    }
} else {
    // Si no es una solicitud POST, redirige a algún lugar o muestra un mensaje de error
    header("Location: mensaje.php?mensaje=error&mensaje_text=Acceso no permitido");
    exit();
}

// Cerrar la conexión
pg_close($conexion);
?>