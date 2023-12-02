<?php
require '../conexionphp/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_piso_modificar = pg_escape_string($_POST['no_piso_modificar']);
    $hab_cama_modificada = pg_escape_string($_POST['hab_cama_modificada']);
    $especialidad_modificada = pg_escape_string($_POST['especialidad_modificada']);

    // Deshabilitar los triggers antes de la modificación
    $disableTriggersQuery = "ALTER TABLE bd_hospital.pisos DISABLE TRIGGER ALL";
    $disableTriggersResult = pg_query($conexion, $disableTriggersQuery);

    if (!$disableTriggersResult) {
        // Manejar el error si la deshabilitación de triggers falla
        echo "Error al deshabilitar los triggers: " . pg_last_error($conexion);
        exit();
    }

    // Query para la modificación
    $query_modificacion = "UPDATE bd_hospital.pisos 
                           SET hab_cama = '$hab_cama_modificada', especialidad = '$especialidad_modificada'
                           WHERE no_piso = '$no_piso_modificar'";

    // Ejecutar la consulta de modificación
    $consulta_modificacion = pg_query($conexion, $query_modificacion);

    // Habilitar los triggers después de la modificación
    $enableTriggersQuery = "ALTER TABLE bd_hospital.pisos ENABLE TRIGGER ALL";
    $enableTriggersResult = pg_query($conexion, $enableTriggersQuery);

    if (!$enableTriggersResult) {
        // Manejar el error si la habilitación de triggers falla
        echo "Error al habilitar los triggers: " . pg_last_error($conexion);
        exit();
    }

    // Redirigir a mensaje.php con el resultado de la consulta de modificación
    if ($consulta_modificacion) {
        // Éxito: Redirigir a mensaje.php con mensaje de éxito y consulta
        $mensaje_exito = 'Registro modificado correctamente';
        header("Location: mensaje.php?mensaje=success&mensaje_text=$mensaje_exito&consulta=".urlencode($query_modificacion));
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        // Error: Redirigir a mensaje.php con mensaje de error y consulta
        $mensaje_error = 'Error al modificar el registro. Consulta no válida';
        header("Location: mensaje.php?mensaje=error&mensaje_text=$mensaje_error&consulta=".urlencode($query_modificacion));
        exit(); // Asegura que el script se detenga después de la redirección
    }
} else {
    // Si no es una solicitud POST, redirige a algún lugar o muestra un mensaje de error
    header("Location: mensaje.php?mensaje=error&mensaje_text=Acceso no permitido");
    exit();
}

// Cerrar la conexión
pg_close($conexion);
?>