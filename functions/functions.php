<?php

function calculaedad($fechanacimiento)
{
    list($ano, $mes, $dia) = explode("-", $fechanacimiento);
    $ano_diferencia = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0) {
        $ano_diferencia--;
    }

    return $ano_diferencia;
}

function test_input($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function validar_clave($clave, &$error_clave)
{
    if (strlen($clave) < 6) {
        $error_clave = "La clave debe tener al menos 6 caracteres";
        return false;
    }
    if (strlen($clave) > 16) {
        $error_clave = "La clave no puede tener más de 16 caracteres";
        return false;
    }
    if (!preg_match('`[a-z]`', $clave)) {
        $error_clave = "La clave debe tener al menos una letra minúscula";
        return false;
    }
    if (!preg_match('`[A-Z]`', $clave)) {
        $error_clave = "La clave debe tener al menos una letra mayúscula";
        return false;
    }
    if (!preg_match('`[0-9]`', $clave)) {
        $error_clave = "La clave debe tener al menos un caracter numérico";
        return false;
    }
    $error_clave = "";
    return true;
}

function crearInput($tipo_contenido)
{
    //$tipo_contenido = $_SESSION['tipo_contenido'];
    if ($tipo_contenido == 'Pdf') {
        $input_pdf = 'Sube tu archivo PDF: ' . '<input type="file" name="archivo"accept=".pdf"><br>';
        echo $input_pdf;
    } else if ($tipo_contenido == 'Videos') {
        $input_video = 'Sube tu link de Youtube: ' . '<input type="url" name="archivo""><br>';
        echo $input_video;
    }
}

function crearbiblio($tipo)
{

    if ($tipo == 'basededatos') {
        $input_video = 'Bibliografia: ' . '<input type="text" name="biblio"><br>';
        echo $input_video;

    }
}

function error()
{
    echo "<div class='container'>
       <h3>No se encontraron resultados</h3>

   </div>";
}

// crear una funcion para dar de alta cualquier cosa. //

function altaUsuario($target)
{

    switch ($target) {

        case 'alumno':
            header("Location: alta_alumno.php");
            break;
        case 'docente':
            header("Location: alta_docente.php");
            break;
        case 'curso':
            header("Location: alta_curso_admin.php");
            break;

    }

}

function bajaUsuario($target)
{
    switch ($target) {
        case 'alumno':
            header("Location: baja_alumno.php");
            break;
        case 'docente':
            header("Location: baja_docente.php");
            break;
        case 'curso':
            header("Location: baja_curso_admin.php");
            break;
    }
}
function modificarRegistros($target)
{
    switch ($target) {
        case 'alumno':
            header("Location: modificar_alumno.php");
            break;
        case 'docente':
            header("Location: modificar_docente.php");
            break;
        case 'curso':
            header("Location: modificar_curso_admin.php");
            break;
    }
}

function safe_session()
{
    if (!isset($_SESSION['email'])) {
        header("Location: ../../index.php");
        echo "SESSION NO INICIADA";
    }
}
