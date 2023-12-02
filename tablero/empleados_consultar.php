<?php
require '../conexionphp/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_empleado_consultar = pg_escape_string($_POST['id_empleado_consultar']);
    $consultar_nombre = isset($_POST['consultar_nombre']) ? true : false;
    $consultar_apellido = isset($_POST['consultar_apellido']) ? true : false;
    $consultar_puesto = isset($_POST['consultar_puesto']) ? true : false;
    $consultar_turno = isset($_POST['consultar_turno']) ? true : false;
    $consultar_id_departamento = isset($_POST['consultar_id_departamento']) ? true : false;

    // Deshabilitar los triggers antes de la consulta
    $disableTriggersQuery = "ALTER TABLE bd_hospital.empleado DISABLE TRIGGER ALL";
    $disableTriggersResult = pg_query($conexion, $disableTriggersQuery);

    if (!$disableTriggersResult) {
        // Manejar el error si la deshabilitación de triggers falla
        echo "Error al deshabilitar los triggers: " . pg_last_error($conexion);
        exit();
    }

    // Construir la lista de columnas a seleccionar
    $columnas_seleccionadas = [];
    if ($consultar_nombre) {
        $columnas_seleccionadas[] = 'nombre';
    }
    if ($consultar_apellido) {
        $columnas_seleccionadas[] = 'apellido';
    }
    if ($consultar_puesto) {
        $columnas_seleccionadas[] = 'puesto';
    }
    if ($consultar_turno) {
        $columnas_seleccionadas[] = 'turno';
    }
    if ($consultar_id_departamento) {
        $columnas_seleccionadas[] = 'id_departamento';
    }

    // Si no se selecciona ninguna columna, mostrar todas
    if (empty($columnas_seleccionadas)) {
        $columnas_seleccionadas = ['id_empleado', 'nombre', 'apellido', 'puesto', 'turno', 'id_departamento'];
    }

    // Construir la consulta
    $columnas_query = implode(", ", $columnas_seleccionadas);
    $query = "SELECT $columnas_query FROM bd_hospital.empleado WHERE id_empleado = '$id_empleado_consultar'";

    // Ejecutar la consulta
    $consulta = pg_query($conexion, $query);

    // Habilitar los triggers después de la consulta
    $enableTriggersQuery = "ALTER TABLE bd_hospital.empleado ENABLE TRIGGER ALL";
    $enableTriggersResult = pg_query($conexion, $enableTriggersQuery);

    if (!$enableTriggersResult) {
        // Manejar el error si la habilitación de triggers falla
        echo "Error al habilitar los triggers: " . pg_last_error($conexion);
        exit();
    }

    // Almacenar el contenido de la tabla en una variable
    $tabla_resultado = '<table border="1">';
    $tabla_resultado .= '<tr>';
    foreach ($columnas_seleccionadas as $columna) {
        $tabla_resultado .= '<th>' . ucfirst($columna) . '</th>';
    }
    $tabla_resultado .= '</tr>';

    $resultadoConsulta = pg_fetch_assoc($consulta);
    $tabla_resultado .= '<tr>';
    foreach ($columnas_seleccionadas as $columna) {
        $tabla_resultado .= '<td>' . $resultadoConsulta[$columna] . '</td>';
    }
    $tabla_resultado .= '</tr>';
    $tabla_resultado .= '</table>';

    // Redirigir a mensaje.php con el resultado de la consulta
    header("Location: mensajeConsultas.php?mensaje=success&mensaje_text=Consulta realizada con éxito&consulta=".urlencode($query)."&tabla_resultado=".urlencode($tabla_resultado));
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    // Si no es una solicitud POST, redirige a algún lugar o muestra un mensaje de error
    header("Location: mensaje.php?mensaje=error&mensaje_text=Acceso no permitido");
    exit();
}

// Cerrar la conexión
pg_close($conexion);
?>