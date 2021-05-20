<?php
/* Este documento redirige al php correspondiente abarcando las 4 posibilidades entre tipo de curso y tipo 
de contenido. */
include("../functions/functions.php");
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
}
// Recibimos los datos por header. 
$id = $_GET['id'];
$edad = $_GET['edad'];
$tipo_curso = $_GET['tipo'];
$nombre = $_GET['nombre'];
$desc = $_GET['desc'];
$tipo_contenido = $_GET['tipo_contenido'];
echo $tipo_curso;

// Discrimino por Tipo de curso < Programacion o base de datos. > //

if($tipo_curso == 'programacion'){

    if($tipo_contenido == 'Videos'){
        // enviar a alta_curso2.php con todos los datos. // 
        echo 'Alta curso2.php';
        header("Location: alta_curso2.php?id=$id&edad=$edad&tipo_curso=$tipo_curso&tipo_contenido=$tipo_contenido&nombre=$nombre&desc=$desc");
    }
    else if($tipo_contenido == 'Pdf'){
        echo 'Alta curso3.php';
        // enviar a alta_curso3.php con todos los datos.// 
        header("Location: alta_curso3.php?id=$id&edad=$edad&tipo_curso=$tipo_curso&tipo_contenido=$tipo_contenido&nombre=$nombre&desc=$desc");
    }
    
}
else if($tipo_curso == 'basededatos'){

    if($tipo_contenido == 'Videos'){
        // enviar a alta_curso4.php con todos los datos. // 
        echo 'Alta curso4.php';
        header("Location: alta_curso4.php?id=$id&edad=$edad&tipo_curso=$tipo_curso&tipo_contenido=$tipo_contenido&nombre=$nombre&desc=$desc");
    }
    else if($tipo_contenido == 'Pdf'){
        echo 'Alta curso5.php';
        // enviar a alta_curso5.php con todos los datos.// 
        header("Location: alta_curso5.php?id=$id&edad=$edad&tipo_curso=$tipo_curso&tipo_contenido=$tipo_contenido&nombre=$nombre&desc=$desc");
    }
}


