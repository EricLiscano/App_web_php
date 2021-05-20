<?php
include "../functions/conex_academia.php";
include "../functions/dis_errors.php";
$conexion = conectarse();
$usuario = $_POST['email'];
$contra = $_POST['contra'];
$seleccionar = "Select * from perfil where email='$usuario' and contrasenia='$contra'";
$result = mysqli_query($conexion, $seleccionar);
//la instruccion mysqli_num_rows($result) devuelve la cantidad de filas extraidas que van a ser 1 o 0
if (mysqli_num_rows($result) == 1) {
    //extraigo el tipo de usuario que corresponde:
    while ($row = mysqli_fetch_array($result)) {
        //aca tenes que poner en sesion al usuario
        //....
        $id = $row['id'];
        $edad = $row['fechanac'];
        $email = $row['email'];

        if ($row['tipo'] == 'alumno') {
            session_start();
            $_SESSION['email'];
            header("Location: alumno.php?id=$id&edad=$edad&email=$email");
        } 
        else if ($row['tipo'] == 'docente') {
            session_start();
            $_SESSION['email'];
            header("Location: docente.php?id=$id&edad=$edad&email=$email");
        } else if($row['tipo'] == 'administrador') {
            session_start();
            $_SESSION['email'];
            header("Location: ./admin/admin.php?id=$id&edad=$edad&email=$email");


        }
    }

} else {
    echo "usuario y contraseña no coinciden" . "<br>";
    echo "<a href='../index.php'>Volver</a>";
}
mysqli_close($conexion);
