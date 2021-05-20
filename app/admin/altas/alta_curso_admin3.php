<?php
// Este documento es para cuando el ADMINISTRADOR elige crear un curso de programacion con Pdf solamente //
include "../../../functions/functions.php";
include "../../../functions/dis_errors.php";
include "../../../functions/conex_academia.php";
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../../index.php");
}
$id = $_GET['id'];

$tipo_curso = $_GET['tipo_curso'];
$nombre = $_GET['nombre'];
$desc = $_GET['desc'];
$tipo_contenido = $_GET['tipo_contenido'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $link = conectarse();
    $m_pdf = $_POST['pdf'];

    // Enviadas hacia si mismo por hidden //
    $m_id = 28;
    $m_tipo = $_POST['m_tipo'];
    $m_nombre = $_POST['m_nombre'];
    $m_desc = $_POST['m_desc'];
    $m_tipo_contenido = $_POST['m_tipo_contenido'];

    $guardar_curso = "INSERT INTO cursos (tipo_curso, nombre_curso, tipo_contenido , descripcion , id_doc) VALUES ('$m_tipo' , '$m_nombre', '$m_tipo_contenido', '$m_desc', $m_id)";
    $save = mysqli_query($link, $guardar_curso);
    if ($save) {
        echo 'Curso guardado';
    } else {
        echo 'Error al guardar curso ' . $guardar_curso;
    }

    // OBTENER EL ULTIMO ID //
    $ultimo_id_curso = "SELECT MAX(codigoCu) AS codigoCu FROM cursos"; // OBTENGO EL ULTIMO ID DE CURSOS //
    $pedir_ultimo_id = mysqli_query($link, $ultimo_id_curso); // LO SOLICITO
    while ($filas = mysqli_fetch_array($pedir_ultimo_id)) { // OBTENGO UN ARRAY Y ASIGNO EN $ACTUALCODIGO el codigo de curso
        $ultimo_curso = $filas['codigoCu'];
    }
    $m_ultimo_curso = $ultimo_curso;
    // guardar en tabla  programacion //
    $nEdad = 0;
    $sql = "INSERT INTO Programacion (CodigoCu ,Edad_p) VALUES ($m_ultimo_curso , $nEdad);";
    $guardar_programacion = mysqli_query($link, $sql);
    if ($guardar_programacion) {
        echo 'Tabla programacion guardada';
    } else {
        echo "Error: " . $sql . " Tiene errores";
    }
    $sql_pdf = "INSERT INTO pdf (CodigoCu ,archivo) VALUES ($m_ultimo_curso , '$m_pdf');";
    $guardar_pdf = mysqli_query($link, $sql_pdf);
    if($guardar_pdf){
        echo "pdf guardado";
    }else{
        echo "Error: ". $sql_pdf . " revisar sintax";
    }
    header("Location: ../admin.php");
}


?>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    body {
        background-image: url("./img/admin.jpg");

    }

    div {
        margin-left: auto;
        margin-right: auto;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="display-7">Ultimos pasos..</h1>
        <div class="container">
            <div class="w-75 p-3" style="background-color: #eee;">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <input type="hidden" name="m_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="m_edad" value="<?php echo $edad; ?>">
                    <input type="hidden" name="m_tipo" value="<?php echo $tipo_curso; ?>">
                    <input type="hidden" name="m_nombre" value="<?php echo $nombre; ?>">
                    <input type="hidden" name="m_desc" value="<?php echo $desc; ?>">
                    <input type="hidden" name="m_tipo_contenido" value="<?php echo $tipo_contenido; ?>">
                    <div class="form-group">
                        <label for="pdf"></label>
                        <input type="file" name="pdf" accept=".pdf">
                    </div>
                    <button type="submit" class="btn btn-success">Crear curso</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>