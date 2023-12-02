<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Hospitales</title>
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
            <a class="navbar-brand" href="#">Administrar Hospitales</a>
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
                        <a class="nav-link active" href="#">Gestor Hospitales</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        <div class="row">

            <!-- Agregar Piso -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Agregar Piso</h3>
                    </div>
                    <div class="card-body">
                        <form action="pisos_alta.php" method="post">

                            <div class="form-group">
                                <label for="no_piso">Número de Piso:</label>
                                <input type="text" name="no_piso" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="hab_cama">Habitaciones y Camas:</label>
                                <input type="text" name="hab_cama" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="especialidad">Especialidad:</label>
                                <input type="text" name="especialidad" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Agregar Piso</button>
                        </form>
                    </div>
                </div>
            </div>



            <!-- Eliminar Piso -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h3 class="card-title">Eliminar Piso</h3>
                    </div>
                    <div class="card-body">
                        <form action="pisos_delete.php" method="post">
                            <div class="form-group">
                                <label for="no_piso_eliminar">Número del Piso</label>
                                <select name="no_piso" class="form-control">
                                    <?php  
                        require '../conexionphp/conexion.php';
                        $query=("SELECT no_piso FROM bd_hospital.pisos");
                        $consulta = pg_query($conexion, $query);

                        while($obj=pg_fetch_object($consulta)){ ?>
                                    <option value="<?php echo $obj->no_piso ?>"><?php echo $obj->no_piso?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">Eliminar Piso</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modificar Piso -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h3 class="card-title">Modificar Piso</h3>
                    </div>
                    <div class="card-body">
                        <form action="pisos_modificar.php" method="post">
                            <div class="form-group">
                                <label for="no_piso_modificar">Número del Piso</label>
                                <select name="no_piso_modificar" class="form-control" required>
                                    <?php  
                        require '../conexionphp/conexion.php';
                        $query = "SELECT no_piso FROM bd_hospital.pisos";
                        $consulta = pg_query($conexion, $query);

                        while($obj = pg_fetch_object($consulta)) { 
                        ?>
                                    <option value="<?php echo $obj->no_piso ?>"><?php echo $obj->no_piso ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="hab_cama_modificada">Nuevas Habitaciones y Camas:</label>
                                <input type="text" name="hab_cama_modificada" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="especialidad_modificada">Nueva Especialidad:</label>
                                <input type="text" name="especialidad_modificada" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-warning text-white">Modificar Piso</button>
                        </form>
                    </div>
                </div>
            </div>



            <!-- Consultar Piso -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Consultar Piso</h3>
                    </div>
                    <div class="card-body">
                        <form action="pisos_consultar.php" method="post">
                            <div class="form-group">
                                <label for="no_piso_consultar">Número del Piso</label>
                                <select name="no_piso_consultar" class="form-control" required>
                                    <?php  
                        require '../conexionphp/conexion.php';
                        $query = "SELECT no_piso FROM bd_hospital.pisos";
                        $consulta = pg_query($conexion, $query);

                        while($obj = pg_fetch_object($consulta)) { 
                        ?>
                                    <option value="<?php echo $obj->no_piso ?>"><?php echo $obj->no_piso ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Habilitar columnas a Consultar:</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_hab_cama" value="1">
                                    <label class="form-check-label">Habitaciones y Camas</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_especialidad"
                                        value="1">
                                    <label class="form-check-label">Especialidad</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info text-white">Consultar Piso</button>
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