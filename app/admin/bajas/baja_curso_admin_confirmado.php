<?php
/* Elimino el curso que ha sido seleccionado y luego tambien elimino de las tablas de DB 
su tipo de contenido. */

include "../../../functions/function.php";
include "../../../functions/dis_erros.php";
include "../../../functions/conex_academia.php";
$link = conectarse();
print_r($_GET);
$codigoCu = $_GET['codigoCu'];
$tipoCurso = $_GET['tipo_curso'];
$tipoContenido = $_GET['tipo_contenido'];
$eliminarCurso = "DELETE  FROM cursos where codigoCu=$codigoCu";


// Pregunto que tipo de curso es.
if($tipoCurso == 'programacion'){

    $eProgramacion = "DELETE FROM Programacion where CodigoCu=$codigoCu";
    $borrar = mysqli_query($link, $eProgramacion);
}
else if($tipoCurso == 'basededatos'){
    $eBdatos = "DELETE FROM basededatos where CodigoCu=$codigoCu";
    $borrar2 = mysqli_query($link, $eBdatos);
}
// Pregunto su tipo de contenido //
if($tipoContenido == 'Videos'){
    $eYoutube = "DELETE FROM youtube where codigoCu=$codigoCu";
    $borrar3 = mysqli_query($link, $eYoutube);

}
else if($tipoContenido == 'Pdf'){
    $ePdf = "DELETE FROM pdf where CodigoCu=$codigoCu";
    $borrar4 = mysqli_query($link, $ePdf);
}


//Elimino el curso
$eliminarSql= mysqli_query($link, $eliminarCurso);
 if(!$eliminarSql){
     echo "Error: revisar.".   $eliminarSql ." sintax";
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