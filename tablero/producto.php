<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Productos</title>
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
            <a class="navbar-brand" href="#">Administrar Productos</a>
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
                        <a class="nav-link active" href="#">Gestor Productos</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        <div class="row">

            <!-- Agregar Producto -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Agregar Producto</h3>
                    </div>
                    <div class="card-body">

                        <form action="producto_alta.php" method="post">

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="precio">Precio:</label>
                                <input type="text" name="precio" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="tipo">Tipo:</label>
                                <textarea name="tipo" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="marca">Marca:</label>
                                <textarea name="marca" class="form-control" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Agregar Producto</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Eliminar Producto -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h3 class="card-title">Eliminar Producto</h3>
                    </div>
                    <div class="card-body">
                        <form action="producto_delete.php" method="post">


                            <div class="form-group">
                                <label for="id_producto_eliminar">Nombre del Producto</label>
                                <select name="id_producto" class="form-control">

                                    <?php  
                                require '../conexionphp/conexion.php';
                                $query=("SELECT id_producto, nombre FROM hospital.producto");
                                $consulta = pg_query($conexion, $query);

                                while($obj=pg_fetch_object($consulta)){ ?>

                                    <option value="<?php echo $obj->id_producto?>"><?php echo $obj->nombre?>
                                    </option>
                                    <?php
                                }
                                ?>
                                </select>
                            </div>


                            <button type="submit" class="btn btn-danger">Eliminar Producto</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modificar Producto -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h3 class="card-title">Modificar Producto</h3>
                    </div>
                    <div class="card-body">
                        <form action="producto_modificar.php" method="post">
                            <div class="form-group">
                                <label for="id_producto_modificar">Nombre del Producto</label>
                                <select name="id_producto_modificar" class="form-control" required>
                                    <?php  
                            require '../conexionphp/conexion.php';
                            $query = "SELECT id_producto, nombre FROM hospital.producto";
                            $consulta = pg_query($conexion, $query);

                            while($obj = pg_fetch_object($consulta)) { 
                        ?>
                                    <option value="<?php echo $obj->id_producto?>"><?php echo $obj->nombre ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nombre_modificado">Nuevo Nombre:</label>
                                <input type="text" name="nombre_modificado" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="precio_modificada">Nuevo Precio:</label>
                                <textarea name="precio_modificada" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tipo_modificada">Nuevo Tipo:</label>
                                <textarea name="tipo_modificada" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="marca_modificada">Nueva Marca:</label>
                                <textarea name="marca_modificada" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning text-white">Modificar Producto</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Consultar Producto -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Consultar Producto</h3>
                    </div>
                    <div class="card-body">
                        <form action="producto_consultar.php" method="post">
                            <div class="form-group">
                                <label for="id_producto_consultar">Nombre del Producto</label>
                                <select name="id_producto_consultar" class="form-control" required>
                                    <?php  
                        require '../conexionphp/conexion.php';
                        $query = "SELECT id_producto, nombre FROM hospital.producto";
                        $consulta = pg_query($conexion, $query);

                        while($obj = pg_fetch_object($consulta)) { 
                        ?>
                                    <option value="<?php echo $obj->id_producto ?>"><?php echo $obj->nombre ?>
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
                                    <input class="form-check-input" type="checkbox" name="consultar_precio"
                                    value="1">
                                    <label class="form-check-label">Precio</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_tipo"
                                    value="1">
                                    <label class="form-check-label">Tipo</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="consultar_marca"
                                    value="1">
                                    <label class="form-check-label">Marca</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info text-white">Consultar Marca</button>
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