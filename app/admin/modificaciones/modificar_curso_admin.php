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

                    <th>Codigo del curso</th>
                    <th>Tipo de curso</th>
                    <th>Nombre del curso</th>
                    <th>Tipo de contenido</th>
                    <th>Descripcion</th>
                    <th>Id del creador</th>
                </tr>
            </thead>
            <tbody>
                <?php
        $sql_query = "SELECT codigoCu,tipo_curso,nombre_curso,  tipo_contenido, descripcion, id_doc FROM cursos LIMIT 100";
        $resultset = mysqli_query($link, $sql_query) or die("database error:" . mysqli_error($link));
        while ($filas = mysqli_fetch_assoc($resultset)) {
            ?>
                <tr id="<?php echo $filas['codigoCu']; ?>">
                    <td><?php echo $filas['codigoCu']; ?></td>
                    <td><?php echo $filas['tipo_curso']; ?></td>
                    <td><?php echo $filas['nombre_curso']; ?></td>
                    <td><?php echo $filas['tipo_contenido']; ?></td>
                    <td><?php echo $filas['descripcion']; ?></td>
                    <td><?php echo $filas['id_doc']; ?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="./js/jquery.tabledit.js"></script>
    <script type="text/javascript" src="./js/custom_table_edit.js"></script>
    <!--  <script src="./js/reorient.js"></script> -->
</body>

</html>