<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Formulario de Facturación</title>
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

    /* Estilos para centrar el formulario */
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    form {
        width: 100%;
        max-width: 400px;
        padding: 15px;
        margin: auto;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
    }

    label {
        font-weight: bold;
    }

    .btn-success {
        width: 100%;
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
        <!-- Formulario de facturación centrado -->
        <div class="form-container">
            <form action="factura_alta.php" method="post">
                <h2 class="mb-4 text-success">Formulario de Facturación</h2>

                <div class="form-group">
                    <label for="fecha" class="text-success">Fecha:</label>
                    <input type="date" class="form-control" name="fecha" required>
                </div>

                <div class="form-group">
                    <label for="subtotal" class="text-success">Subtotal:</label>
                    <input type="number" step="0.01" class="form-control" name="subtotal" required>
                </div>

                <div class="form-group">
                    <label for="cfdi" class="text-success">CFDI:</label>
                    <input type="text" class="form-control" name="cfdi" required>
                </div>

                <div class="form-group">
                    <label for="id_cuenta_prod" class="text-success">ID Cuenta de Producto:</label>
                    <input type="number" class="form-control" name="id_cuenta_prod">
                </div>

                <div class="form-group">
                    <label for="id_cuenta_serv" class="text-success">ID Cuenta de Servicio:</label>
                    <input type="number" class="form-control" name="id_cuenta_serv">
                </div>

                <div class="form-group">
                    <label for="id_responsable" class="text-success">ID Responsable:</label>
                    <input type="number" class="form-control" name="id_responsable">
                </div>

                <button type="submit" class="btn btn-success">Generar Factura</button>
            </form>
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