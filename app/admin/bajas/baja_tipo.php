<?php
include "../../../functions/functions.php";
include "../../../functions/dis_errors.php";
include "../../../functions/conex_academia.php"; 
// Pantalla principal de altas.


session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../../../index.php");
   echo "SESSION NO INICIADA";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $target= $_POST['target'];
    bajaUsuario($target);
    
   
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
                <li class="nav-item">
                    <a class="nav-link" href="https://www.webducacion.com">Webducacion</a>
                </li>



            </ul>
            <p class="welcome">Bienvenida/o, Administrador Preferido! </p>


        </div>
        <form action="cerrar_sesion.php" method="POST">
            <div class="container">
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Cerrar sesion</button>
                </div>
            </div>
        </form>
    </nav>
    <br>

    <div class="w-100 p-3" style="background-color: #eee;">

        <div class="container">
            <h3 class="display-7">Que quieres dar de baja</h3>
            <!-- Content here -->
            <div class="container">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="altas">
                        <select name="target" id="">
                            <option value="alumno">Alumno</option>
                            <option value="docente">Docente</option>
                            <option value="curso">Curso</option>
                        </select>
                    </div>
                    <br>
                    <button class="btn btn-success">Crear</button>
                </form>
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