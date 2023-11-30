<?php
// Conexión a la base de datos
require '../conexionphp/conexion.php';

// Función para generar el archivo CSV y descargarlo
function generarYDescargarCSV($nombre_tabla, $conexion) {
    // Nombre del archivo CSV
    $nombre_archivo = $nombre_tabla . '_reporte.csv';

    // Consulta para obtener los datos de la tabla actual
    $query_datos = "SELECT * FROM $nombre_tabla";
    
    // Ejecutar la consulta
    $resultado_datos = pg_query($conexion, $query_datos);

    // Crear el archivo CSV
    $archivo = fopen($nombre_archivo, 'w');

    // Encabezados del CSV (nombre de las columnas)
    $encabezados = pg_fetch_assoc(pg_query("SELECT column_name FROM information_schema.columns WHERE table_name = '$nombre_tabla'"));

    // Escribir encabezados al archivo CSV
    fputcsv($archivo, $encabezados);

    // Agregar los registros al CSV
    while ($fila = pg_fetch_assoc($resultado_datos)) {
        fputcsv($archivo, $fila);
    }

    // Cerrar el archivo y la conexión a la base de datos
    fclose($archivo);

    // Descargar el archivo CSV
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . $nombre_archivo . '"');
    readfile($nombre_archivo);

    // Eliminar el archivo CSV después de descargarlo (opcional)
    unlink($nombre_archivo);
}

// Comprobar si se ha enviado una solicitud para generar un informe
if (isset($_GET['tabla'])) {
    $tabla_seleccionada = $_GET['tabla'];
    generarYDescargarCSV($tabla_seleccionada, $conexion);
}
?>