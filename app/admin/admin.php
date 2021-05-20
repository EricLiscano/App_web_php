<?php

// Pantalla principal de Administrador.
/* Funciones: 1. Dar alta, baja y modificacion de todos los tipos de usuario.
2. Dar alta, baja t modificacion de todos los cursos.
3. Obtener la realcion de un alumno y un curso.
4. idem anterior pero en caso de docente.  */


include "../../functions/functions.php";
include "../../functions/dis_errors.php";
include "../../functions/conex_academia.php";
$email = $_GET['email'];
session_start();
$_SESSION['email'] = $email;
if (!isset($_SESSION['email'])) {
    header("Location: ../../index.php");
   echo "SESSION NO INICIADA";
}

?>

<html>

<head>
    <style>
    body {
        background-image: url("./img/admin.jpg");

    }

    div {
        margin-left: auto;
        margin-right: auto;
    }
    </style>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Administrador</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <!-- Menu de actividades -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actividades
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./altas/alta_tipo.php">Altas</a>
                        <a class="dropdown-item" href="./bajas/baja_tipo.php">Bajas</a>
                        <a class="dropdown-item" href="./modificaciones/modificacion_tipo.php">Modificaciones</a>
                        <div class="dropdown-divider"></div>

                    </div>
                </li>


            </ul>
            <p class="welcome">Bienvenida/o, Administrador </p>


        </div>
        <form action="../cerrar_sesion.php" method="POST">
            <div class="container">
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Cerrar sesion</button>
                </div>
            </div>
        </form>
    </nav>

    <div class="w-100 p-3" style="background-color: #eee;">
        <div class="container">
            <!-- Content here -->


        </div>


    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>


</body>

</html>