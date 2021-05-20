<?php
/* Obtengo los datos enviados por POST y elimino al docente y su perfil de base de datos. */

include "../../../functions/function.php";
include "../../../functions/dis_erros.php";
include "../../../functions/conex_academia.php";
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../../../index.php");
   echo "SESSION NO INICIADA";
}

$link = conectarse();
$id_perfil = $_GET['id_perfil'];
$eliminarDocente = "DELETE  FROM Docente where id_perfil=$id_perfil";
$eliminarPerfil = "DELETE  FROM perfil where id=$id_perfil";

$eliminarSql= mysqli_query($link, $eliminarDocente);
$eliminarSql2 =   mysqli_query($link, $eliminarPerfil);

if($eliminarSql){
    echo "se pudo eliminar el alumno";

}
else{
    echo "ERROR: ". $eliminarDocente . " revisar sintax";
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
    <div class="container">
        <p class="display-4 lead">Se ha eliminado correctamente</p>
    </div>
    <div class="container">
        <a class="btn btn-primary" href="../admin.php">Volver</a>

    </div>
</body>

</html>