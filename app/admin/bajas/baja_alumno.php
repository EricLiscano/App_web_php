<?php

/* Este documento busca un alumno por numero de documento y despliega datos generales para su
identificacion. Luego permite su eliminacion de la base de datos. */

include "../../../functions/functions.php";
include "../../../functions/dis_errors.php";
include "../../../functions/conex_academia.php";

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../../index.php");
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
    <div class="container">
        <p class="display-4 lead">Baja alumno</p>
        <br>
        <br>

        <p class="display-7 lead">Lista de todos los alumnos:</p>

    </div>
    <br>
    <br>



    <div class=container>
        <?php
        $link = conectarse();
        $datos = "SELECT * FROM Alumno";
        $sql = mysqli_query($link, $datos);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Id perfil</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                </tr>
            </thead>
            <tbody>
                <?php
            while ($filas = mysqli_fetch_array($sql)) {
                ?>
                <tr>
                    <th scope="row"><?php echo $filas['id']; ?></th>
                    <td><?php echo $id_perfil = $filas['id_perfil']; ?></td>
                    <td><?php echo $filas['nombre']; ?></td>
                    <td><?php echo $filas['apellido']; ?></td>
                    <td>
                        <form action='baja_alumno_confirmado.php?id_perfil=<?php echo $filas['id_perfil'];  ?>'
                            method='POST'>
                            <button type='submit' class='btn btn-success'>Dar de baja</button>

                        </form>
                    </td>

                </tr>
                <tr>
                    <?php
            }
                ?>


            </tbody>
        </table>
    </div>




</body>

</html>