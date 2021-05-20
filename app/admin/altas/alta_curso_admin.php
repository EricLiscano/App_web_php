<?php
/* Este script devuelve una html con opciones para crear un curso de forma detallada. */

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../../index.php");
   echo "SESSION NO INICIADA";
}


$tipo = $_POST['tipo'];
$nombre = $_POST['nombre'];
$desc = $_POST['desc'];
$tipo_contenido = $_POST['tipo_contenido'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['nombre'])) {
        echo 'Nombre del curso completar' . '<br>';
        echo '<a href="alta_curso_admin.php">vuelve atras e intentalo de nuevo</a>';
    } else if (empty($_POST['desc'])) {
        echo 'Descripcion del curso sin completar' . '<br>';
        echo '<a href="alta_curso_admin.php">vuelve atras e intentalo de nuevo</a>';
    } 
    else{
      header("Location: procesar_curso_admin.php?tipo=$tipo&nombre=$nombre&desc=$desc&tipo_contenido=$tipo_contenido");
    }
}



?>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
body {
    background-image: url("./img/admin.jpg");

}

div {
    margin-left: auto;
    margin-right: auto;
}
</style>

<body>
    <div class="container">
        <div class="w-75 p-3" style="background-color: #eee;">
            <h1 class="display-7">Crea un curso</h1>
        </div>
    </div>
    <div class="container">
        <div class="w-75 p-3" style="background-color: #eee;">
            <form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                <div class="form-group">
                    <label for="tipo">Tipo de curso</label>
                    <select name="tipo" id="">
                        <option value="programacion">Programacion</option>
                        <option value="basededatos">Base de datos</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre del curso</label>
                    <input type="text" class="form-control" name='nombre' id="nombre">
                </div>
                <div class="form-group">
                    <label for="tipo_contenido">Tipo de contenido</label>
                    <select name="tipo_contenido" id="tipo">
                        <option value="Pdf">Pdf</option>
                        <option value="Videos">Videos</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea id="" cols="15" rows="5" name="desc" placeholder="Que contiene tu curso?"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Crear curso</button>
            </form>
        </div>
    </div>
</body>

</html>