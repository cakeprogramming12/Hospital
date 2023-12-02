<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar departamentos</title>
    <!-- Agregamos la hoja de estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
    body {
        background-color: #f4f4f4;
        /* Cambia el color de fondo según tus preferencias */
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
            <!-- Agregar Responsable -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Agregar Responsable</h3>
                    </div>
                    <div class="card-body">
                        <form action="responsable_alta.php" method="post">

                            <div class="form-group">
                                <label for="nombre">ID:</label>
                                <input type="text" name="id_responsable" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="apellido">Apellido:</label>
                                <input type="text" name="apellido" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="fec_nac">Fecha de Nacimiento:</label>
                                <input type="date" name="fec_nac" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="sexo">Sexo:</label>
                                <input type="text" name="sexo" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="telefono">Teléfono:</label>
                                <input type="text" name="telefono" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección:</label>
                                <textarea name="direccion" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="rfc">RFC:</label>
                                <input type="text" name="rfc" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="id_paciente">ID del Paciente:</label>
                                <input type="text" name="id_paciente" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Agregar Responsable</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Eliminar Responsable -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h3 class="card-title">Eliminar Responsable</h3>
                    </div>
                    <div class="card-body">
                        <form action="responsable_delete.php" method="post">
                            <div class="form-group">
                                <label for="id_responsable_eliminar">ID del Responsable</label>
                                <select name="id_responsable" class="form-control">
                                    <?php  
                        require '../conexionphp/conexion.php';
                        $query=("SELECT id_responsable, nombre FROM hospital.responsable");
                        $consulta = pg_query($conexion, $query);

                        while($obj=pg_fetch_object($consulta)){ ?>
                                    <option value="<?php echo $obj->id_responsable ?>"><?php echo $obj->nombre ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">Eliminar Responsable</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modificar Responsable -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h3 class="card-title">Modificar Responsable</h3>
                    </div>
                    <div class="card-body">
                        <form action="responsable_modificar.php" method="post">
                            <div class="form-group">
                                <label for="id_responsable_modificar">ID del Responsable</label>
                                <select name="id_responsable_modificar" class="form-control" required>
                                    <?php  
                        require '../conexionphp/conexion.php';
                        $query = "SELECT id_responsable, nombre FROM hospital.responsable";
                        $consulta = pg_query($conexion, $query);

                        while($obj = pg_fetch_object($consulta)) { 
                        ?>
                                    <option value="<?php echo $obj->id_responsable ?>"><?php echo $obj->nombre ?>
                                    </option>
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
                            <!-- Agregar los campos adicionales que deseas modificar -->
                            <button type="submit" class="btn btn-warning text-white">Modificar Responsable</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Consultar Responsable -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Consultar Responsable</h3>
                    </div>
                    <div class="card-body">
                        <form action="responsable_consultar.php" method="post">
                            <div class="form-group">
                                <label for="id_responsable_consultar">ID del Responsable</label>
                                <select name="id_responsable_consultar" class="form-control" required>
                                    <?php  
                        require '../conexionphp/conexion.php';
                        $query = "SELECT id_responsable, nombre FROM hospital.responsable";
                        $consulta = pg_query($conexion, $query);

                        while($obj = pg_fetch_object($consulta)) { 
                        ?>
                                    <option value="<?php echo $obj->id_responsable ?>"><?php echo $obj->nombre ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!-- Agregar las columnas adicionales que deseas consultar -->
                            <button type="submit" class="btn btn-info text-white">Consultar Responsable</button>
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