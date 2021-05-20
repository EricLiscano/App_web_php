<?php
// Este documento recibe los campos editables y realiza un UPDATE  en DB en la tabla que 
// corresponde 
include_once "../../../functions/conex_academia.php";
include_once "../../../functions/dis_errors.php";
$link = conectarse();
$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {
    $update_field = '';
    if (isset($input['nombre'])) {
        $update_field .= "nombre='" . $input['nombre'] . "'";
    } else if (isset($input['apellido'])) {
        $update_field .= "apellido='" . $input['apellido'] . "'";
    } else if (isset($input['fechanac'])) {
        $update_field .= "fechanac='" . $input['fechanac'] . "'";
    } else if (isset($input['documento'])) {
        $update_field .= "documento='" . $input['documento'] . "'";
    } else if (isset($input['pais'])) {
        $update_field .= "pais='" . $input['pais'] . "'";
    } else if (isset($input['telefono'])) {
        $update_field .= "telefono='" . $input['telefono'] . "'";
    } else if (isset($input['direccion'])) {
        $update_field .= "direccion='" . $input['direccion'] . "'";
    }
    if ($update_field && $input['id']) {
        $sql_query = "UPDATE Alumno SET $update_field WHERE id='" . $input['id'] . "'";
        mysqli_query($link, $sql_query) or die("database error:" . mysqli_error($link));
    }
}
