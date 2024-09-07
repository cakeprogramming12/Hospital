<?php
// Incluir el archivo de conexión
require '../conexionphp/conexion.php';

// Función para generar nombres aleatorios
function generarNombre() {
    $nombres = ['Aspirina', 'Paracetamol', 'Ibuprofeno', 'Amoxicilina', 'Omeprazol', 'Vitaminas', 'Jarabe para la tos', 'Analgésico', 'Antiinflamatorio', 'Antibiótico'];
    return $nombres[array_rand($nombres)];
}

// Función para generar precios aleatorios
function generarPrecio() {
    return number_format((float)rand(1, 1000) + (float)rand(0, 99) / 100, 2, '.', '');
}

// Función para generar tipos aleatorios
function generarTipo() {
    $tipos = ['Medicamento', 'Suplemento', 'Vitamina', 'Jarabe', 'Analgesico'];
    return $tipos[array_rand($tipos)];
}

// Función para generar marcas aleatorias
function generarMarca() {
    $marcas = ['Pfizer', 'Bayer', 'Novartis', 'GlaxoSmithKline', 'Roche', 'Johnson & Johnson', 'Merck', 'Sanofi', 'Gilead', 'AstraZeneca'];
    return $marcas[array_rand($marcas)];
}

// Desactivar triggers
$queryDesactivarTriggers = "ALTER TABLE hospital.producto DISABLE TRIGGER ALL";
pg_query($conexion, $queryDesactivarTriggers);

// Función para generar un millón de registros
function generarRegistrosProductos($conexion) {
    for ($i = 1; $i <= 15; $i++) {
        $registro = [
            'nombre' => generarNombre(),
            'precio' => generarPrecio(),
            'tipo' => generarTipo(),
            'marca' => generarMarca()
        ];

        // Insertar el registro en la base de datos
        $query = "INSERT INTO hospital.producto(nombre, precio, tipo, marca) VALUES ('$registro[nombre]', '$registro[precio]', '$registro[tipo]', '$registro[marca]');";
        $result = pg_query($conexion, $query);

        if (!$result) {
            die("Error al insertar el registro: " . pg_last_error($conexion));
        }
    }
}

// Verificar si se presionó el botón para insertar registros
if (isset($_POST['insertar_registros_producto'])) {
    // Generar registros
    generarRegistrosProductos($conexion);
    echo "Registros insertados exitosamente.";
}

// Cerrar la conexión
pg_close($conexion);
?>