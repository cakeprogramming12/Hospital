<?php
// Incluir el archivo de conexión
require '../conexionphp/conexion.php';

// Función para generar nombres de empresas aleatorias
function generarEmpresa() {
    $empresas = ['Distribuciones Médicas S.A.', 'Suministros Hospitalarios C.A.', 'Farmacias Unidos', 'Proveedora de Insumos Médicos', 'Salud y Bienestar Ltda.', 'Comercializadora Farmacéutica'];
    return $empresas[array_rand($empresas)];
}

// Función para obtener un ID de producto existente
function obtenerIdProducto($conexion) {
    // Realiza una consulta para obtener un ID de producto existente
    $query = "SELECT id_producto FROM hospital.producto ORDER BY RANDOM() LIMIT 1";
    $result = pg_query($conexion, $query);

    if ($row = pg_fetch_assoc($result)) {
        return $row['id_producto'];
    }

    // Si no se encuentra ningún producto, retorna un valor predeterminado
    return 1;
}

// Desactivar triggers
$queryDesactivarTriggers = "ALTER TABLE hospital.proveedores DISABLE TRIGGER ALL";
pg_query($conexion, $queryDesactivarTriggers);

// Función para generar un millón de registros
function generarRegistrosProveedores($conexion) {
    for ($i = 1; $i <= 1000000; $i++) {
        $registro = [
            'empresa' => generarEmpresa(),
            'id_producto' => obtenerIdProducto($conexion),
        ];

        // Insertar el registro en la base de datos
        $query = "INSERT INTO hospital.proveedores (empresa, id_producto) VALUES ('$registro[empresa]', $registro[id_producto])";
        $result = pg_query($conexion, $query);

        if (!$result) {
            die("Error al insertar el registro: " . pg_last_error($conexion));
        }
    }
}

// Verificar si se presionó el botón para insertar registros
if (isset($_POST['insertar_registros_proveedores'])) {
    // Generar registros
    generarRegistrosProveedores($conexion);
    echo "Registros de proveedores insertados exitosamente.";
}

// Activar triggers nuevamente
$queryActivarTriggers = "ALTER TABLE hospital.proveedores ENABLE TRIGGER ALL";
pg_query($conexion, $queryActivarTriggers);

// Cerrar la conexión
pg_close($conexion);
?>