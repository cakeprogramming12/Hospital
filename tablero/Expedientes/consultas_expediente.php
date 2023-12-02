<!DOCTYPE html>
<!--[if lte IE 9]>
<html lang="en" class="oldie">
<![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Simple Toggle Navigation</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" media="all" href="style.css" />
    <!-- Agrega un estilo personalizado para los enlaces -->
    <style>
    .card-title a,
    .card-text a {
        color: #28a745;
        /* Cambia el color a verde */
    }
    </style>
</head>
<?php
session_start();

// Verifica si la sesión está iniciada
if (!isset($_SESSION['nombre_usuario'])) {
    // Si no hay una sesión activa, redirige a la página de inicio de sesión
    header('Location: ../ruta/a/tu/pagina/de/inicio/de/sesion.php');
    exit();
}

// Obtiene el nombre de usuario de la sesión
$nombreUsuario = $_SESSION['nombre_usuario'];
?>

<body>
    <header>
        <nav id="mainnav" role="navigation">
            <ul>
                <li>
                    <a href="home.php"><i class="fa fa-home"></i><span>Home</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-smile-o"></i><span>About</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-globe"></i><span>Clients</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-envelope-o"></i><span>Contact Us</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bars"></i></a>
                </li>
            </ul>
        </nav>
    </header>

    <section>
        <!-- Menú con enlaces bonitos -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a class="text-success">Expediente</a></h5>
                            <p class="card-text"><a class="text-success">Descripción del enlace 1</a></p>
                            <a href="#" class="btn btn-success">Ir al Enlace 1</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#" class="text-success">Enlace 2</a></h5>
                            <p class="card-text"><a href="#" class="text-success">Descripción del enlace 2</a></p>
                            <a href="#" class="btn btn-success">Ir al Enlace 2</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#" class="text-success">Enlace 3</a></h5>
                            <p class="card-text"><a href="#" class="text-success">Descripción del enlace 3</a></p>
                            <a href="#" class="btn btn-success">Ir al Enlace 3</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>