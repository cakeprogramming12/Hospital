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

            <!-- Agregar Departamento -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Agregar Departamento</h3>
                    </div>
                    <div class="card-body">

                        <form action="departamentos_alta.php" method="post">

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea name="descripcion" class="form-control" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Agregar Departamento</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Eliminar Departamento -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h3 class="card-title">Eliminar Departamento</h3>
                    </div>
                    <div class="card-body">
                        <form action="departamentos_delete.php" method="post">
                            <div class="form-group">
                                <label for="id_departamento_eliminar">Nombre del departamento</label>
                                <select name="id_departamento" class="form-control">

                                    <?php  
                                require '../conexionphp/conexion.php';
                                $query=("SELECT id_departamento, nombre FROM departamentos");
                                $consulta = pg_query($conexion, $query);

                                while($obj=pg_fetch_object($consulta)){ ?>

                                    <option value="<?php echo $obj->id_departamento ?>"><?php echo $obj->nombre?>
                                    </option>
                                    <?php
                                }
                                ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">Eliminar Departamento</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modificar Departamento -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h3 class="card-title">Modificar Departamento</h3>
                    </div>
                    <div class="card-body">
                        <form action="departamentos_modificar.php" method="post">
                            <div class="form-group">
                                <label for="id_departamento_modificar">Nombre del departamento</label>
                                <select name="id_departamento_modificar" class="form-control" required>
                                    <?php  
                            require '../conexionphp/conexion.php';
                            $query = "SELECT id_departamento, nombre FROM departamentos";
                            $consulta = pg_query($conexion, $query);

                            while($obj = pg_fetch_object($consulta)) { 
                        ?>
                                    <option value="<?php echo $obj->id_departamento ?>"><?php echo $obj->nombre ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nombre_modificado">Nuevo Nombre:</label>
                                <input type="text" name="nombre_modificado" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion_modificada">Nueva Descripción:</label>
                                <textarea name="descripcion_modificada" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning text-white">Modificar Departamento</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Consultar Departamento -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Consultar Departamento</h3>
                    </div>
                    <div class="card-body">
                        <form action="departamentos_consultar.php" method="post">
                            <div class="form-group">
                                <label for="id_departamento_consultar">Nombre del departamento</label>
                                <select name="id_departamento_consultar" class="form-control" required>
                                    <?php  
                        require '../conexionphp/conexion.php';
                        $query = "SELECT id_departamento, nombre FROM departamentos";
                        $consulta = pg_query($conexion, $query);

                        while($obj = pg_fetch_object($consulta)) { 
                        ?>
                                    <option value="<?php echo $obj->id_departamento ?>"><?php echo $obj->nombre ?>
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
                                    <input class="form-check-input" type="checkbox" name="consultar_descripcion"
                                        value="1">
                                    <label class="form-check-label">Descripción</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info text-white">Consultar Departamento</button>
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