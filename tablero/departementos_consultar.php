<?php
require '../conexionphp/conexion.php';

$id_consultar = $_POST['id_departamento_consultar'];

// Obtener las columnas a consultar
$consultar_nombre = isset($_POST['consultar_nombre']) ? true : false;
$consultar_descripcion = isset($_POST['consultar_descripcion']) ? true : false;

// Construir la consulta SQL dinámicamente basada en las opciones seleccionadas
$columnas = array();
if ($consultar_nombre) {
    $columnas[] = 'nombre';
}
if ($consultar_descripcion) {
    $columnas[] = 'descripcion';
}

$columnas_str = implode(', ', $columnas);

$query = "SELECT $columnas_str FROM departamentos WHERE id_departamento = $id_consultar";

// Ejecutar la consulta
$consulta = pg_query($conexion, $query);

// Mostrar los resultados en un div
echo '<div class="mt-2">';
while ($resultado = pg_fetch_assoc($consulta)) {
    foreach ($resultado as $clave => $valor) {
        echo "<p><strong>$clave:</strong> $valor</p>";
    }
}
echo '</div>';

// Cerrar la conexión
pg_close($conexion);
?>