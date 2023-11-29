<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar departamentos</title>
    <!-- Agregamos la hoja de estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrar departamentos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="tablero.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestor departamentos</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Agregar Departamento -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Agregar Departamentos</h3>
                        </div>
                        <div class="card-body">

                            <form action="departamentos_alta.php" method="post">

                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <!-- name: nombre -->
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="descripcion">Descripción:</label>
                                    <!-- name: descripcion -->
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
                        <div class="card-header">
                            <h3 class="card-title">Eliminar Departamento</h3>
                        </div>
                        <div class="card-body">
                            <form action="departamentos_delete.php" method="post">
                                <div class="form-group">

                                    <label for="id_departamento_eliminar">ID del Departamento a eliminar:</label>
                                    <select name="id_departamento">

                                        <?php  

                                require '../conexionphp/conexion.php';
                                $query=("SELECT id_departamento,nombre FROM departamentos");
                                // Ejecutar la consulta
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
            </div>

            <!-- Modificar Departamento -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Modificar Departamento</h3>
                    </div>
                    <div class="card-body">
                        <form action="departamentos_modificar.php" method="post">
                            <div class="form-group">
                                <label for="id_departamento_modificar">ID del Departamento a modificar:</label>
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
                            <button type="submit" class="btn btn-primary">Modificar Departamento</button>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Consultar Departamento -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Consultar Departamento</h3>
                    </div>
                    <div class="card-body">
                        <form action="departamentos_consulta.php" method="post">
                            <div class="form-group">
                                <label for="id_departamento_consultar">ID del Departamento a consultar:</label>
                                <input type="number" name="id_departamento_consultar" class="form-control" required>
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
                            <button type="submit" class="btn btn-primary">Consultar Departamento</button>
                        </form>

                    </div>
                </div>
            </div>



    </section>

    <!-- Agregamos los scripts de Bootstrap al final del cuerpo para mejorar el rendimiento de la página -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>





</body>

</html>