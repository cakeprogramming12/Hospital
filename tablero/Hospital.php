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

            <!-- Agregar Hospital -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Agregar Hospital</h3>
                    </div>
                    <div class="card-body">

                        <form action="Hospital_alta.php" method="post">
                            <div class="form-group">
                                <label for="rfc_hospital">RFC Hospital</label>
                                <input type="text" name="rfc_hospital" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" name="direccion" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Agregar Hospital</button>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Eliminar Hospital -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h3 class="card-title">Eliminar Hospital</h3>
                    </div>
                    <div class="card-body">
                        <form action="Hospital_delete.php" method="post">
                            <div class="form-group">
                                <label for="rfc_hospital">Nombre del hospital</label>
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
                            <button type="submit" class="btn btn-danger">Eliminar Hospital</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modificar Hospital -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h3 class="card-title">Modificar Hospital</h3>
                    </div>
                    <div class="card-body">
                        <form action="Hospital_modificar.php" method="post">
                            <div class="form-group">
                                <label for="id_hospital_modificar">Nombre del hospital</label>
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
                            <div class="form-group">
                                <label for="nombre_modificado">Nuevo Nombre:</label>
                                <input type="text" name="nombre_modificado" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email_modificado">Nuevo Email:</label>
                                <input type="email" name="email_modificado" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="direccion_modificada">Nueva Dirección:</label>
                                <input type="text" name="direccion_modificada" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-warning text-white">Modificar Hospital</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Consultar Hospital -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Consultar Hospital</h3>
                    </div>
                    <div class="card-body">
                        <form action="Hospital_consultar.php" method="post">
                            <div class="form-group">
                                <label for="id_hospital_consultar">Nombre del hospital</label>
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
                            <div class="form-group">
                                <label>Columnas a Consultar:</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_nombre" value="1">
                                    <label class="form-check-label">Nombre</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_email" value="1">
                                    <label class="form-check-label">Email</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_direccion"
                                        value="1">
                                    <label class="form-check-label">Dirección</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info text-white">Consultar Hospital</button>
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