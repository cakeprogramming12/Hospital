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
    <link rel="stylesheet" media="all" href="style.css" />
    <style>
    h1 {
        overflow: hidden;
        /* Para ocultar el contenido que excede el ancho del contenedor */
        white-space: nowrap;
        /* Para evitar el salto de línea */
        margin: 0;
        /* Elimina el margen predeterminado del encabezado */
        animation: typing 4s steps(40, end);
        /* Duración y pasos de la animación */
        border-right: 2px solid;
        /* Efecto de cursor */
    }

    @keyframes typing {
        from {
            width: 0;
            /* Ancho inicial del texto */
        }

        to {
            width: 100%;
            /* Ancho final del texto */
        }
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
                    <a href="tablero.php"><i class="fa fa-home"></i><span>Vista de administrador</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-smile-o"></i><span>Ordendes de estudio</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-globe"></i><span>facturacion</span></a>
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
        <h1>Hola! <?php echo $nombreUsuario; ?></h1>
    </section>

</body>

</html>