<?php
// Este documento recibe los campos editables y realiza un UPDATE  en DB en la tabla que 
// corresponde 
include_once("../../../functions/conex_academia.php");
include_once("../../../functions/dis_errors.php");
$link = conectarse();
$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {
$update_field='';
if(isset($input['tipo_curso'])) {
$update_field.= "tipo_curso='".$input['tipo_curso']."'";
} else if(isset($input['nombre_curso'])) {
$update_field.= "nombre_curso='".$input['nombre_curso']."'";
} else if(isset($input['tipo_contenido'])) {
$update_field.= "tipo_contenido='".$input['tipo_contenido']."'";
} else if(isset($input['descripcion'])) {
$update_field.= "descripcion='".$input['descripcion']."'";
} else if(isset($input['id_doc'])) {
$update_field.= "id_doc='".$input['id_doc']."'";
}
if($update_field && $input['codigoCu']) {
$sql_query = "UPDATE cursos SET $update_field WHERE codigoCu='" . $input['codigoCu'] . "'";
mysqli_query($link, $sql_query) or die("database error:". mysqli_error($link));
}
}
?>