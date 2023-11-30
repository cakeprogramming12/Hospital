<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de la Base de Datos</title>
    <!-- Agrega tus enlaces a las hojas de estilo o scripts necesarios aquí -->
</head>

<body>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Resumen de la base de datos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="tablero.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Configuración</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <!-- Tabla de Resumen -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Resumen de Tablas</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tabla</th>
                                        <th>Número de Registros</th>
                                        <th>Descargar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Aquí puedes agregar filas para cada tabla -->
                                    <tr>
                                        <td>departamentos</td>
                                        <td><?php  
  require '../conexionphp/conexion.php';

    $query = "SELECT COUNT(*) AS total_registros FROM departamentos";
    $consulta = pg_query($conexion, $query);

    if ($consulta) {
        $resultado = pg_fetch_assoc($consulta);
        $total_registros = $resultado['total_registros'];
        echo "Total de registros: $total_registros";
    } else {
        echo "Error al ejecutar la consulta.";
    }

    pg_close($conexion);
    ?></td>
                                        <td><a href="reportes.php?tabla=departamentos" class="btn btn-primary">Descargar
                                                Reporte</a></td>

                                    </tr>





                                    <tr>
                                        <td>Tabla 2</td>
                                        <td>valor de registros</td>
                                        <td></td>
                                    </tr>
                                    <!-- Agrega más filas según tus tablas -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Agrega tus scripts al final del cuerpo si es necesario -->

</body>

</html>