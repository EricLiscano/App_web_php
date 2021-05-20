<?php
/* Pagina principal del docente
Funciones:  Crear un curso
cerrar la sesion
enviar datos a alta_curso.
 */
include ("../functions/conex_academia.php");
include ("../functions/dis_errors.php");
//Obtengo id y edad en caso de crear un curso.
$id = $_GET['id'];
$edad = $_GET['edad'];
$email = $_GET['email'];
session_start();
$_SESSION['email'] = $email;
//Si la sesion no esta iniciada, reenvia a index.php para ingresar credenciales.
if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php">Webducacion</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mis clases
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <div class="dropdown-divider"></div>
                        <?php
echo "<a class='dropdown-item'href='./crear_curso/alta_curso.php?edad=$edad&id=$id' >Crear curso</a> "; // envio el id y la edad
 ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="1" aria-disabled="true">Soporte</a>
                </li>
            </ul>
            <p class="welcome">Bienvenida/o, <?php echo $_SESSION['email']; ?> </p>
            <br>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ir</button>
            </form>
            <form action="cerrar_sesion.php" method="POST">
                <div class="container">
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Cerrar sesion</button>
                    </div>
                </div>
            </form>
        </div>
    </nav>


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