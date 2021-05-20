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
        <p class="display-4 lead">Que curso quieres quitar?</p>
        <br>
        <br>

        <p class="display-7 lead">Lista de todos los cursos:</p>

    </div>
    <br>
    <br>



    <div class=container>
        <?php
        $link = conectarse();
        $datos = "SELECT * FROM cursos";
        $sql = mysqli_query($link, $datos);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Codigo del curso</th>
                    <th scope="col">Tipo del curso</th>
                    <th scope="col">Nombre del curso</th>
                    <th scope="col">Tipo de contenido</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Id del creador</th>
                </tr>
            </thead>
            <tbody>
                <?php
            while ($filas = mysqli_fetch_array($sql)) {
                ?>
                <tr>
                    <th scope="row"><?php echo $codigoCu= $filas['codigoCu']; ?></th>
                    <td><?php echo $filas['tipo_curso']; ?></td>
                    <td><?php echo $filas['nombre_curso']; ?></td>
                    <td><?php echo $filas['tipo_contenido']; ?></td>
                    <td><?php echo $filas['descripcion']; ?></td>
                    <td><?php echo $filas['id_doc']; ?></td>
                    <td>
                        <form
                            action='baja_curso_admin_confirmado.php?codigoCu=<?php echo $filas['codigoCu'];  ?>&tipo_curso=<?php echo $filas['tipo_curso'];  ?>&tipo_contenido=<?php echo $filas['tipo_contenido'];  ?>'
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