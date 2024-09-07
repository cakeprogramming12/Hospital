<?php
require '../conexionphp/conexion.php';

$id = $_POST['id_producto_consultar'];
$consultar_nombre = isset($_POST['consultar_nombre']) ? true : false;
$consultar_precio = isset($_POST['consultar_precio']) ? true : false;
$consultar_tipo = isset($_POST['consultar_tipo']) ? true : false;
$consultar_marca = isset($_POST['consultar_marca']) ? true : false;

// Construir la lista de columnas a seleccionar
$columnas_seleccionadas = [];
if ($consultar_nombre) {
    $columnas_seleccionadas[] = 'nombre';
}
if ($consultar_precio) {
    $columnas_seleccionadas[] = 'precio';
}
if ($consultar_tipo) {
    $columnas_seleccionadas[] = 'tipo';
}
if ($consultar_marca) {
    $columnas_seleccionadas[] = 'marca';
}
// Si no se selecciona ninguna columna, mostrar todas
if (empty($columnas_seleccionadas)) {
    $columnas_seleccionadas = ['id_producto', 'nombre', 'precio', 'tipo', 'marca'];
}

// Construir la consulta
$columnas_query = implode(", ", $columnas_seleccionadas);
$query = "SELECT $columnas_query FROM hospital.producto WHERE id_producto = $id";

// Ejecutar la consulta
$consulta = pg_query($conexion, $query);

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

// Cerrar la conexión
pg_close($conexion);
?>