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

            <!-- Agregar Expediente -->
            <!-- Agregar Expediente -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Agregar Expediente</h3>
                    </div>
                    <div class="card-body">
                        <form action="Expediente_altas.php" method="post">
                            <!-- Los campos del formulario -->
                            <div class="form-group">
                                <label for="diagnosticos">Diagnósticos</label>
                                <input type="text" name="diagnosticos" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="tratamientos">Tratamientos</label>
                                <input type="text" name="tratamientos" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="intervenciones_quirurgicas">Intervenciones Quirúrgicas</label>
                                <input type="text" name="intervenciones_quirurgicas" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="sintomas">Síntomas</label>
                                <input type="text" name="sintomas" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="antecedentes">Antecedentes</label>
                                <input type="text" name="antecedentes" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="f_ingreso">Fecha de Ingreso</label>
                                <input type="date" name="f_ingreso" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="f_egreso">Fecha de Egreso</label>
                                <input type="date" name="f_egreso" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input type="text" name="descripcion" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="id_departamento">ID del Departamento</label>
                                <select name="id_departamento" class="form-control">
                                    <?php
                        require '../conexionphp/conexion.php';
                        $query = "SELECT id_departamento, nombre FROM bd_hospital.departamentos";
                        $consulta = pg_query($conexion, $query);

                        while ($obj = pg_fetch_object($consulta)) {
                        ?>
                                    <option value="<?php echo $obj->id_departamento ?>">
                                        <?php echo $obj->nombre ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_paciente">ID del Paciente</label>
                                <select name="id_paciente" class="form-control" required>
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

                            <button type="submit" class="btn btn-primary">Agregar Expediente</button>
                        </form>
                    </div>
                </div>
            </div>



            <!-- Eliminar Expediente -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h3 class="card-title">Eliminar Expediente</h3>
                    </div>
                    <div class="card-body">
                        <form action="Expediente_delete.php" method="post">
                            <div class="form-group">
                                <label for="id_expediente">ID del Expediente</label>
                                <select name="id_expediente" class="form-control" required>
                                    <?php  
                        require '../conexionphp/conexion.php';
                        $query = "SELECT id_expediente, descripcion FROM bd_hospital.expediente";
                        $consulta = pg_query($conexion, $query);

                        while($obj = pg_fetch_object($consulta)) { 
                        ?>
                                    <option value="<?php echo $obj->id_expediente ?>"><?php echo $obj->descripcion ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">Eliminar Expediente</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modificar Expediente -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h3 class="card-title">Modificar Expediente</h3>
                    </div>
                    <div class="card-body">
                        <form action="Expediente_modificar.php" method="post">
                            <div class="form-group">
                                <label for="id_expediente_modificar">ID del Expediente</label>
                                <select name="id_expediente" class="form-control" required>
                                    <?php  
                        require '../conexionphp/conexion.php';
                        $query = "SELECT id_expediente, descripcion FROM bd_hospital.expediente";
                        $consulta = pg_query($conexion, $query);

                        while($obj = pg_fetch_object($consulta)) { 
                        ?>
                                    <option value="<?php echo $obj->id_expediente ?>"><?php echo $obj->descripcion ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="diagnosticos_modificados">Nuevos Diagnósticos:</label>
                                <input type="text" name="diagnosticos_modificados" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tratamientos_modificados">Nuevos Tratamientos:</label>
                                <input type="text" name="tratamientos_modificados" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="intervenciones_modificadas">Nuevas Intervenciones Quirúrgicas:</label>
                                <input type="text" name="intervenciones_modificadas" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="sintomas_modificados">Nuevos Síntomas:</label>
                                <input type="text" name="sintomas_modificados" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="antecedentes_modificados">Nuevos Antecedentes:</label>
                                <input type="text" name="antecedentes_modificados" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="f_ingreso_modificada">Nueva Fecha de Ingreso:</label>
                                <input type="date" name="f_ingreso_modificada" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="f_egreso_modificada">Nueva Fecha de Egreso:</label>
                                <input type="date" name="f_egreso_modificada" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion_modificada">Nueva Descripción:</label>
                                <input type="text" name="descripcion_modificada" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-warning text-white">Modificar Expediente</button>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Consultar Expediente -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Consultar Expediente</h3>
                    </div>
                    <div class="card-body">
                        <form action="Expedientes_consultas.php" method="post">
                            <div class="form-group">
                                <label for="id_expediente_consultas">ID del Expediente</label>
                                <select name="id_expediente" class="form-control" required>
                                    <?php  
                        require '../conexionphp/conexion.php';
                        $query = "SELECT id_expediente, descripcion FROM bd_hospital.expediente";
                        $consulta = pg_query($conexion, $query);

                        while($obj = pg_fetch_object($consulta)) { 
                        ?>
                                    <option value="<?php echo $obj->id_expediente ?>"><?php echo $obj->descripcion ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Columnas a Consultar:</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_diagnosticos"
                                        value="1">
                                    <label class="form-check-label">Diagnósticos</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_tratamientos"
                                        value="1">
                                    <label class="form-check-label">Tratamientos</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_intervenciones"
                                        value="1">
                                    <label class="form-check-label">Intervenciones Quirúrgicas</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_sintomas" value="1">
                                    <label class="form-check-label">Síntomas</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_antecedentes"
                                        value="1">
                                    <label class="form-check-label">Antecedentes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_f_ingreso"
                                        value="1">
                                    <label class="form-check-label">Fecha de Ingreso</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_f_egreso" value="1">
                                    <label class="form-check-label">Fecha de Egreso</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_descripcion"
                                        value="1">
                                    <label class="form-check-label">Descripción</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info text-white">Consultar Expediente</button>
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