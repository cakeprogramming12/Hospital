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

            <!-- Agregar Paciente -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Agregar Paciente</h3>
                    </div>
                    <div class="card-body">
                        <form action="Paciente_alta.php" method="post">
                            <!-- Los campos del formulario -->
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" name="apellido" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="fec_nac">Fecha de Nacimiento</label>
                                <input type="date" name="fec_nac" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="sexo">Sexo</label>
                                <select name="sexo" class="form-control" required>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" name="telefono" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" name="direccion" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="no_piso">Número de Piso</label>
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

                            <div class="form-group">
                                <label for="rfc_hospital">RFC del Hospital</label>
                                <select name="rfc_hospital" class="form-control" required>
                                    <?php  
                            require '../conexionphp/conexion.php';
                            $query = "SELECT  rfc_hospital, nombre FROM bd_hospital.hospital";
                            $consulta = pg_query($conexion, $query);

                            while($obj = pg_fetch_object($consulta)) { 
                        ?>
                                    <option value="<?php echo $obj->rfc_hospital ?>"><?php echo $obj->nombre ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Agregar Paciente</button>
                        </form>
                    </div>
                </div>
            </div>



            <!-- Eliminar Paciente -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h3 class="card-title">Eliminar Paciente</h3>
                    </div>
                    <div class="card-body">
                        <form action="Paciente_delete.php" method="post">
                            <div class="form-group">
                                <label for="id_paciente">Nombre del Paciente</label>
                                <select name="id_paciente" class="form-control" required>
                                    <?php  
                        require '../conexionphp/conexion.php';
                        $query = "SELECT id_paciente, CONCAT(nombre, ' ', apellido) AS nombre_completo FROM bd_hospital.pacientes";
                        $consulta = pg_query($conexion, $query);

                        while($obj = pg_fetch_object($consulta)) { 
                        ?>
                                    <option value="<?php echo $obj->id_paciente ?>"><?php echo $obj->nombre_completo ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">Eliminar Paciente</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modificar Paciente -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h3 class="card-title">Modificar Paciente</h3>
                    </div>
                    <div class="card-body">
                        <form action="Paciente_modificar.php" method="post">
                            <div class="form-group">
                                <label for="id_paciente_modificar">Nombre del Paciente</label>
                                <select name="id_paciente_modificar" class="form-control" required>
                                    <?php  
                            require '../conexionphp/conexion.php';
                            $query = "SELECT id_paciente, CONCAT(nombre, ' ', apellido) AS nombre_completo FROM bd_hospital.pacientes";
                            $consulta = pg_query($conexion, $query);

                            while($obj = pg_fetch_object($consulta)) { 
                            ?>
                                    <option value="<?php echo $obj->id_paciente ?>">
                                        <?php echo $obj->nombre_completo ?></option>
                                    <?php } ?>
                                </select>
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
                                <label for="fec_nac_modificada">Nueva Fecha de Nacimiento:</label>
                                <input type="date" name="fec_nac_modificada" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="sexo_modificado">Nuevo Sexo:</label>
                                <select name="sexo_modificado" class="form-control" required>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="telefono_modificado">Nuevo Teléfono:</label>
                                <input type="text" name="telefono_modificado" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="direccion_modificada">Nueva Dirección:</label>
                                <input type="text" name="direccion_modificada" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-warning text-white">Modificar Paciente</button>
                        </form>
                    </div>
                </div>
            </div>



            <!-- Consultar Paciente -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Consultar Paciente</h3>
                    </div>
                    <div class="card-body">
                        <form action="Paciente_consultar.php" method="post">
                            <div class="form-group">
                                <label for="id_paciente_consultar">Nombre del paciente</label>
                                <select name="id_paciente_consultar" class="form-control" required>
                                    <?php  
                        require '../conexionphp/conexion.php';
                        $query = "SELECT id_paciente, CONCAT(nombre, ' ', apellido) AS nombre_completo FROM bd_hospital.pacientes";
                        $consulta = pg_query($conexion, $query);

                        while($obj = pg_fetch_object($consulta)) { 
                        ?>
                                    <option value="<?php echo $obj->id_paciente ?>"><?php echo $obj->nombre_completo ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Columnas a Consultar:</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_nombre" value="1">
                                    <label class="form-check-label">Nombre</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_apellido" value="1">
                                    <label class="form-check-label">Apellido</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_fec_nac" value="1">
                                    <label class="form-check-label">Fecha de Nacimiento</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_sexo" value="1">
                                    <label class="form-check-label">Sexo</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_telefono" value="1">
                                    <label class="form-check-label">Teléfono</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_direccion"
                                        value="1">
                                    <label class="form-check-label">Dirección</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_no_piso" value="1">
                                    <label class="form-check-label">Número de Piso</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_rfc_hospital"
                                        value="1">
                                    <label class="form-check-label">RFC del Hospital</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info text-white">Consultar Paciente</button>
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