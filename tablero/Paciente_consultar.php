<?php
require '../conexionphp/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paciente_consultar = pg_escape_string($_POST['id_paciente_consultar']);
    $consultar_nombre = isset($_POST['consultar_nombre']) ? true : false;
    $consultar_apellido = isset($_POST['consultar_apellido']) ? true : false;
    $consultar_fec_nac = isset($_POST['consultar_fec_nac']) ? true : false;
    $consultar_sexo = isset($_POST['consultar_sexo']) ? true : false;
    $consultar_telefono = isset($_POST['consultar_telefono']) ? true : false;
    $consultar_direccion = isset($_POST['consultar_direccion']) ? true : false;
    $consultar_no_piso = isset($_POST['consultar_no_piso']) ? true : false;
    $consultar_rfc_hospital = isset($_POST['consultar_rfc_hospital']) ? true : false;

    // Deshabilitar los triggers antes de la consulta
    $disableTriggersQuery = "ALTER TABLE bd_hospital.pacientes DISABLE TRIGGER ALL";
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
    if ($consultar_fec_nac) {
        $columnas_seleccionadas[] = 'fec_nac';
    }
    if ($consultar_sexo) {
        $columnas_seleccionadas[] = 'sexo';
    }
    if ($consultar_telefono) {
        $columnas_seleccionadas[] = 'telefono';
    }
    if ($consultar_direccion) {
        $columnas_seleccionadas[] = 'direccion';
    }
    if ($consultar_no_piso) {
        $columnas_seleccionadas[] = 'no_piso';
    }
    if ($consultar_rfc_hospital) {
        $columnas_seleccionadas[] = 'rfc_hospital';
    }

    // Si no se selecciona ninguna columna, mostrar todas
    if (empty($columnas_seleccionadas)) {
        $columnas_seleccionadas = ['id_paciente', 'nombre', 'apellido', 'fec_nac', 'sexo', 'telefono', 'direccion', 'no_piso', 'rfc_hospital'];
    }

    // Construir la consulta
    $columnas_query = implode(", ", $columnas_seleccionadas);
    $query = "SELECT $columnas_query FROM bd_hospital.pacientes WHERE id_paciente = '$id_paciente_consultar'";

    // Ejecutar la consulta
    $consulta = pg_query($conexion, $query);

    // Habilitar los triggers después de la consulta
    $enableTriggersQuery = "ALTER TABLE bd_hospital.pacientes ENABLE TRIGGER ALL";
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

    // Redirigir a mensajeConsultas.php con el resultado de la consulta
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