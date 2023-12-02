<?php
require '../conexionphp/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_expediente_consultar = pg_escape_string($_POST['id_expediente']);
    $consultar_diagnosticos = isset($_POST['consultar_diagnosticos']) ? true : false;
    $consultar_tratamientos = isset($_POST['consultar_tratamientos']) ? true : false;
    $consultar_intervenciones = isset($_POST['consultar_intervenciones']) ? true : false;
    $consultar_sintomas = isset($_POST['consultar_sintomas']) ? true : false;
    $consultar_antecedentes = isset($_POST['consultar_antecedentes']) ? true : false;
    $consultar_f_ingreso = isset($_POST['consultar_f_ingreso']) ? true : false;
    $consultar_f_egreso = isset($_POST['consultar_f_egreso']) ? true : false;
    $consultar_descripcion = isset($_POST['consultar_descripcion']) ? true : false;

    // Deshabilitar los triggers antes de la consulta
    $disableTriggersQuery = "ALTER TABLE bd_hospital.expediente DISABLE TRIGGER ALL";
    $disableTriggersResult = pg_query($conexion, $disableTriggersQuery);

    if (!$disableTriggersResult) {
        // Manejar el error si la deshabilitación de triggers falla
        echo "Error al deshabilitar los triggers: " . pg_last_error($conexion);
        exit();
    }

    // Construir la lista de columnas a seleccionar
    $columnas_seleccionadas = [];
    if ($consultar_diagnosticos) {
        $columnas_seleccionadas[] = 'diagnosticos';
    }
    if ($consultar_tratamientos) {
        $columnas_seleccionadas[] = 'tratamientos';
    }
    if ($consultar_intervenciones) {
        $columnas_seleccionadas[] = 'intervenciones_quirurgicas';
    }
    if ($consultar_sintomas) {
        $columnas_seleccionadas[] = 'sintomas';
    }
    if ($consultar_antecedentes) {
        $columnas_seleccionadas[] = 'antecedentes';
    }
    if ($consultar_f_ingreso) {
        $columnas_seleccionadas[] = 'f_ingreso';
    }
    if ($consultar_f_egreso) {
        $columnas_seleccionadas[] = 'f_egreso';
    }
    if ($consultar_descripcion) {
        $columnas_seleccionadas[] = 'descripcion';
    }

    // Si no se selecciona ninguna columna, mostrar todas
    if (empty($columnas_seleccionadas)) {
        $columnas_seleccionadas = ['diagnosticos', 'tratamientos', 'intervenciones_quirurgicas', 'sintomas', 'antecedentes', 'f_ingreso', 'f_egreso', 'descripcion'];
    }

    // Construir la consulta
    $columnas_query = implode(", ", $columnas_seleccionadas);
    $query = "SELECT $columnas_query FROM bd_hospital.expediente WHERE id_expediente = '$id_expediente_consultar'";

    // Ejecutar la consulta
    $consulta = pg_query($conexion, $query);

    // Habilitar los triggers después de la consulta
    $enableTriggersQuery = "ALTER TABLE bd_hospital.expediente ENABLE TRIGGER ALL";
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