<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar empleados</title>
    <!-- Agregamos la hoja de estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
    .card-body {
        max-height: 400px;
        /* Establece la altura máxima del contenedor del formulario */
        overflow-y: auto;
        /* Hace que el contenido sea desplazable verticalmente si excede la altura máxima */
    }
    </style>
</head>

<body>
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Administrar Departamentos</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="tablero.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Gestor departamentos</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        <div class="row">
            <!-- Agregar Empleado -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Agregar Empleado</h3>
                    </div>
                    <div class="card-body">
                        <form action="empleados_alta.php" method="post">

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="apellido">Apellido:</label>
                                <input type="text" name="apellido" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="puesto">Puesto:</label>
                                <input type="text" name="puesto" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="turno">Turno:</label>
                                <input type="text" name="turno" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="id_departamento">ID Departamento:</label>
                                <div id="departamento-container">
                                    <input type="text" name="id_departamento" class="form-control">
                                </div>
                                <!-- Agregar enlaces para cargar más resultados -->
                                <?php
                                require '../conexionphp/conexion.php';
                                $registrosPorPagina = 10;
                                $queryTotal = "SELECT COUNT(*) FROM bd_hospital.departamentos";
                                $totalRegistros = pg_fetch_row(pg_query($conexion, $queryTotal))[0];
                                $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

                                for ($i = 1; $i <= $totalPaginas; $i++) {
                                    echo "<a href='tu_pagina.php?pagina=$i'>$i</a> ";
                                }
                                ?>
                            </div>

                            <button type="submit" class="btn btn-primary">Agregar Empleado</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Eliminar Empleado -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h3 class="card-title">Eliminar Empleado</h3>
                    </div>
                    <div class="card-body">
                        <form action="empleados_delete.php" method="post">
                            <div class="form-group">
                                <label for="id_empleado_eliminar">Nombre del empleado</label>
                                <div id="eliminar-empleado-container">
                                    <input type="text" name="id_empleado" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger">Eliminar Empleado</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modificar Empleado -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h3 class="card-title">Modificar Empleado</h3>
                    </div>
                    <div class="card-body">
                        <form action="empleados_modificar.php" method="post">
                            <div class="form-group">
                                <label for="id_empleado_modificar">ID del empleado</label>
                                <div id="modificar-empleado-container">
                                    <input type="text" name="id_empleado_modificar" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre_modificado">Nuevo Nombre:</label>
                                <input type="text" name="nombre_modificado" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido_modificado">Nuevo Apellido:</label>
                                <input type="text" name="apellido_modificado" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="puesto_modificado">Nuevo Puesto:</label>
                                <input type="text" name="puesto_modificado" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="turno_modificado">Nuevo Turno:</label>
                                <input type="text" name="turno_modificado" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="id_departamento_modificado">Nuevo ID Departamento:</label>
                                <input type="text" name="id_departamento_modificado" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-warning text-white">Modificar Empleado</button>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Consultar Empleado -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Consultar Empleado</h3>
                    </div>
                    <div class="card-body">
                        <form action="empleados_consultar.php" method="post">
                            <div class="form-group">
                                <label for="id_empleado_consultar">ID del empleado</label>
                                <div id="consultar-empleado-container">
                                    <input type="text" name="id_empleado_consultar" class="form-control" required>
                                </div>
                            </div>
                            <!-- (otras entradas para consultar) -->
                            <button type="submit" class="btn btn-info text-white">Consultar Empleado</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Agregamos los scripts de Bootstrap al final del cuerpo para mejorar el rendimiento de la página -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>