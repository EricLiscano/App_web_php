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


$link = conectarse();
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
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

    <div class="container">

        <!-- Editable table -->
        <table id="data_table" class="table table-striped">
            <thead>
                <tr>

                    <th>Id Alumno</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de nacimiento</th>
                    <th>Documento</th>
                    <th>Pais</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                </tr>
            </thead>
            <tbody>
                <?php
        $sql_query = "SELECT id,nombre,apellido,  fechanac, documento, pais, telefono,direccion FROM Alumno LIMIT 100";
        $resultset = mysqli_query($link, $sql_query) or die("database error:" . mysqli_error($link));
        while ($filas = mysqli_fetch_assoc($resultset)) {
            ?>
                <tr id="<?php echo $filas['id']; ?>">
                    <td><?php echo $filas['id']; ?></td>
                    <td><?php echo $filas['nombre']; ?></td>
                    <td><?php echo $filas['apellido']; ?></td>
                    <td><?php echo $filas['fechanac']; ?></td>
                    <td><?php echo $filas['documento']; ?></td>
                    <td><?php echo $filas['pais']; ?></td>
                    <td><?php echo $filas['telefono']; ?></td>
                    <td><?php echo $filas['direccion']; ?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="./js/jquery.tabledit.js"></script>
    <script type="text/javascript" src="./js/custom_table_edit_alumno.js"></script>
    <!-- <script src="./js/reorient.js"></script> -->
</body>

</html>