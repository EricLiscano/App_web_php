<?php

/* Este despliega todos los alumnos por numero de id perfil y despliega datos generales para su
identificacion. Luego permite su eliminacion de la base de datos. */

include "../../../functions/functions.php";
include "../../../functions/dis_errors.php";
include "../../../functions/conex_academia.php";

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../../index.php");
   echo "SESSION NO INICIADA";
}

function resultados($id, $id_perfil, $nombre, $apellido)
{
    echo "<div class='container'>
        <br>
        <br>
        <table class='table'>
            <thead>
                <tr>
                <th scope='col'>ID</th>
                <th scope='col'>id Perfil</th>
                <th scope='col'>Nombre</th>
                <th scope='col'>Apellido</th>
                <th scope='col'>Documento</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope='row'>$id</th>
                    <td>$id_perfil</td>
                    <td>$nombre</td>
                    <td>$apellido</td>
                    <td>
                        <form action='baja_docente_confirmado.php?id_perfil=$id_perfil' method='POST'>
                            <button type='submit' class='btn btn-success'>Dar de baja</button>

                        </form>
                    </td>
                </tr>


            </tbody>
            </table>


        </div>";

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
        <p class="display-4 lead">Baja Docente</p>
        <br>
        <br>

        <p class="display-7 lead">Lista de todos los docentes:</p>

    </div>
    <br>
    <br>



    <div class=container>
        <?php
        $link = conectarse();
        $datos = "SELECT * FROM Docente";
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
                        <form action='baja_docente_confirmado.php?id_perfil=<?php echo $filas['id_perfil'];  ?>'
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