<?php
// Incluir el archivo de conexión
require '../conexionphp/conexion.php';

// Función para generar nombres aleatorios
function generarNombre() {
    $nombres = ['Juan', 'María', 'Carlos', 'Laura', 'Alejandro', 'Sofía', 'Daniel', 'Isabella', 'Miguel', 'Valentina'];
    return $nombres[array_rand($nombres)];
}

// Función para generar apellidos aleatorios
function generarApellido() {
    $apellidos = ['Gómez', 'Pérez', 'Martínez', 'Rodríguez', 'García', 'Fernández', 'López', 'Díaz', 'Hernández', 'Torres'];
    return $apellidos[array_rand($apellidos)];
}

// Función para generar puestos aleatorios
function generarPuesto() {
    $puestos = ['Analista', 'Ingeniero', 'Técnico', 'Coordinador', 'Asistente'];
    return $puestos[array_rand($puestos)];
}

// Función para generar turnos aleatorios
function generarTurno() {
    $turnos = ['Matutino', 'Vespertino', 'Nocturno', 'Diurno'];
    return $turnos[array_rand($turnos)];
}

// Función para generar un millón de registros
function generarRegistros($conexion) {
    for ($i = 1; $i <= 1000000; $i++) {
        $registro = [
            'nombre' => generarNombre(),
            'apellido' => generarApellido(),
            'puesto' => generarPuesto(),
            'turno' => generarTurno(),
            'id_departamento' => rand(3, 6),
        ];

        // Insertar el registro en la base de datos
        $query = "INSERT INTO hospital.empleado (nombre, apellido, puesto, turno, id_departamento) VALUES ('$registro[nombre]', '$registro[apellido]', '$registro[puesto]', '$registro[turno]', $registro[id_departamento])";
        $result = pg_query($conexion, $query);

        if (!$result) {
            die("Error al insertar el registro: " . pg_last_error($conexion));
        }
    }
}

// Verificar si se presionó el botón para insertar registros
if (isset($_POST['insertar_registros'])) {
    // Generar registros
    generarRegistros($conexion);
    echo "Registros insertados exitosamente.";
}

// Cerrar la conexión
pg_close($conexion);
?>