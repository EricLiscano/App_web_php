<?php

/*  CORREGIR Y ADAPTAR A ALTA CURSO ADMIN */
/* Este documento redirige al php correspondiente abarcando las 4 posibilidades entre tipo de curso y tipo 
de contenido. */
include "../../../functions/functions.php";
include "../../../functions/dis_errors.php";
include "../../../functions/conex_academia.php";
session_start();


if (!isset($_SESSION['email'])) {
    header("Location: ../../index.php");
   echo "SESSION NO INICIADA";
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
        header("Location: alta_curso_admin2.php?id=$id&edad=$edad&tipo_curso=$tipo_curso&tipo_contenido=$tipo_contenido&nombre=$nombre&desc=$desc");
    }
    else if($tipo_contenido == 'Pdf'){
        echo 'Alta curso3.php';
        // enviar a alta_curso3.php con todos los datos.// 
        header("Location: alta_curso_admin3.php?id=$id&edad=$edad&tipo_curso=$tipo_curso&tipo_contenido=$tipo_contenido&nombre=$nombre&desc=$desc");
    }
    
}
else if($tipo_curso == 'basededatos'){

    if($tipo_contenido == 'Videos'){
        // enviar a alta_curso4.php con todos los datos. // 
        echo 'Alta curso4.php';
        header("Location: alta_curso_admin4.php?id=$id&edad=$edad&tipo_curso=$tipo_curso&tipo_contenido=$tipo_contenido&nombre=$nombre&desc=$desc");
    }
    else if($tipo_contenido == 'Pdf'){
        echo 'Alta curso5.php';
        // enviar a alta_curso5.php con todos los datos.// 
        header("Location: alta_curso_admin5.php?id=$id&edad=$edad&tipo_curso=$tipo_curso&tipo_contenido=$tipo_contenido&nombre=$nombre&desc=$desc");
    }
}