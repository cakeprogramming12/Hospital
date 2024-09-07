<?php
require '../conexionphp/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paciente_modificar = pg_escape_string($_POST['id_paciente_modificar']);
    $nombre_modificado = pg_escape_string($_POST['nombre_modificado']);
    $apellido_modificado = pg_escape_string($_POST['apellido_modificado']);
    $fec_nac_modificada = pg_escape_string($_POST['fec_nac_modificada']);
    $sexo_modificado = pg_escape_string($_POST['sexo_modificado']);
    $telefono_modificado = pg_escape_string($_POST['telefono_modificado']);
    $direccion_modificada = pg_escape_string($_POST['direccion_modificada']);

    // Query para la modificación
    $query_modificacion = "UPDATE hospital.pacientes 
                           SET nombre = '$nombre_modificado', 
                               apellido = '$apellido_modificado', 
                               fec_nac = '$fec_nac_modificada', 
                               sexo = '$sexo_modificado', 
                               telefono = '$telefono_modificado', 
                               direccion = '$direccion_modificada'
                           WHERE id_paciente = '$id_paciente_modificar'";

    // Ejecutar la consulta de modificación
    $consulta_modificacion = pg_query($conexion, $query_modificacion);

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