<?php
// Incluir el archivo de conexión
require '../conexionphp/conexion.php';

// Función para generar usuarios aleatorios
function generarUsuario() {
    $usuarios = ['admin', 'juan', 'kate', 'itadori', 'sksku', 'admin123', 'root', 'webadmin', 'lefty', 'demo'];
    return $usuarios[array_rand($usuarios)];
}

// Función para generar contraseñas aleatorias
function generarContrasena() {
    // Puedes personalizar la lógica para generar contraseñas según tus requisitos
    return password_hash("password" . rand(1, 1000000), PASSWORD_DEFAULT);
}

// Desactivar triggers
$queryDesactivarTriggers = "ALTER TABLE bd_hospital.usuarios DISABLE TRIGGER ALL";
pg_query($conexion, $queryDesactivarTriggers);

// Función para generar registros de usuarios en lotes
function generarRegistrosUsuarios($conexion, $batchSize = 1000) {
    for ($i = 1; $i <= 1000000; $i += $batchSize) {
        $registros = [];
        for ($j = 0; $j < $batchSize; $j++) {
            $registros[] = [
                'usuario' => generarUsuario(),
                'contrasena' => generarContrasena(),
            ];
        }

        // Construir la consulta de inserción
        $values = implode(', ', array_map(function ($registro) {
            return "('" . $registro['usuario'] . "', '" . $registro['contrasena'] . "')";
        }, $registros));

        $query = "INSERT INTO bd_hospital.usuarios (usuario, contrasena) VALUES $values";
        $result = pg_query($conexion, $query);

        if (!$result) {
            die("Error al insertar el lote de registros: " . pg_last_error($conexion));
        }
    }
}

// Verificar si se presionó el botón para insertar registros
if (isset($_POST['insertar_registros_usuarios'])) {
    // Generar registros
    generarRegistrosUsuarios($conexion);
    echo "Registros de usuarios insertados exitosamente.";
}

// Activar triggers nuevamente
$queryActivarTriggers = "ALTER TABLE bd_hospital.usuarios ENABLE TRIGGER ALL";
pg_query($conexion, $queryActivarTriggers);

// Cerrar la conexión
pg_close($conexion);
?>