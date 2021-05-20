<?php
// Este archivo valida el registro controlando todos los campos. Valida que los campos esten completados y
// que los datos ingresados correspondan con normas de seguridad actuales.
// con las variables booleanas controlamos su validacion. Si estan todas validadas guarda el nuevo usuario
// segun tipo usuario. Sino devuelve un error.

/// CORRREGIR VARIABLES DONDE CORRESPONDA. //

/* campo no validado1
campo no validado3
campo no validado4
campo no validado5 */
include "../functions/functions.php";
include "../functions/dis_errors.php";
include "../functions/conex_academia.php";

if (isset($_POST['ingresar'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = conectarse();
        $tipo_usuario = $nombre = $apellido = $contrasenia = $cContrasenia = $msjContrasenia = $fechanac = $documento = $pais = $email = $telefono = $direccion = $politicas = "";
        $nombreCheck = $apellidoCheck = $emailCheck = $contraseniaCheck = $cContrasenia = $fechaCheck = $documentoCheck = $paisCheck = $telCheck = $direccionCheck = $politicasCheck = false;
        $cContrasenia = $_POST['cContrasenia'];
        $tipo_usuario = $_POST['tipo_usuario'];

        if (empty($_POST["nombre"])) {
            $nombre = "* Nombre es requerido";
        } else {
            $nombre = test_input($_POST["nombre"]);
            $nombreCheck = true;
            if (!preg_match("/['a-z A-Z-']/", $nombre)) {
                $nombre = "Nombre: Solo se permiten letras y espacios en blanco";
                $nnombreCheck = false;
            }
        } // fin nombre
        if (empty($_POST["apellido"])) {
            $apellido = "* Apellido es requerido";
        } else {
            $apellido = test_input($_POST["apellido"]);
            $apellidoCheck = true;
            if (!preg_match("/['a-z A-Z-']/", $apellido)) {
                $apellidoCheck = false;
                $apellido = "Apellido: Solo se permiten letras y espacios en blanco";}
        } // fin apellido //
        if (empty($_POST["contrasenia"])) {
            $contrasenia = "* contraseña es requerida";
        } else {
            $contrasenia = test_input($_POST['contrasenia']);

            if (validar_clave($contrasenia, $errorClave)) {
                $msjContrasenia = 'CONTRASEÑA CORRECTA';
                $contraseniaCheck = true;
                if ($contrasenia == $cContrasenia) {
                    $equal = "Las contraseñas son iguales";
                } else {
                    $contraseniaCheck = false;
                    $equal = "las contraseñas no coinciden";
                }
            } else {
                $contraseniaCheck = false;
                $msjContrasenia = 'contraseña insuficiente: ' . $errorClave;
            }

        }

        if (empty($_POST["pais"])) {
            $pais = "Elija una nacionalidad";
        } else {
            $pais = $_POST["pais"];
            $paisCheck = true;

        }
        //telefono no reconoce input // VER PORQUE NO PUEDO TRAER EL POST TEL //
        if (empty($_POST["tel"])) {
            $telefono = "Debe indicar un telefono";
        } else {
            $telefono = test_input($_POST["tel"]);
            $telCheck = true;
            //echo $telefono . ' ' . $telCheck;
            if (!preg_match("/['0-9']/", $telefono)) {
                $telefono = "El telefono debe contener numeros";
                $telCheck = false;
            }

        } // fin telefono

        if (empty($_POST["fechanac"])) {
            $fechanac = "Debe ingresar una fecha de nacimiento";
        } else {
            $fechanac = test_input($_POST['fechanac']);
            $fechaCheck = true;
        }
        // documento
        if (empty($_POST["doc"])) {
            $documento = "Debe indicar un documento";
        } else {
            // echo 'se ingreso algun dato';
            $documento = test_input($_POST["doc"]);
            $documentoCheck = true;
            if (!preg_match("/['0-9']/", $documento) || strlen($documento) > 8) {
                $documento = "El Documento debe contener solo numeros y no ser mayor a 8 digitos";
                $documentoCheck = false;

            }

        } // fin doc

        if (empty($_POST["email"])) {
            $email = "Debe ingresar una direccion de correo";
        } else {
            $email = test_input($_POST["email"]);
            $emailCheck = true;
            if (!preg_match("/['@']['a-z']/", $email)) {
                $email = "Ingrese una direccion de correo valida (debe contener @ y letras)";
                $emailCheck = false;
            }
        }
        if (empty($_POST['direccion'])) {
            $direccion = "Debe ingresar una direccion";
        } else {
            $direccion = test_input($_POST['direccion']);
            $direccionCheck = true;

        }

        if (empty($_POST["check"])) {
            $politicas = "No aceptadas";
        } else if ($_POST['check'] == 'on') {
            $politicasCheck = true;
            $politicas = ' Aceptadas';
        }
        $totValidados = 0;
        $validateFields = [$nombreCheck, $apellidoCheck, $emailCheck, $contraseniaCheck, $cContrasenia, $fechaCheck, $documentoCheck, $paisCheck, $telCheck, $direccionCheck, $politicasCheck];
        for ($i = 0; $i < count($validateFields); $i++) {
            if ($validateFields[$i] == true) {

                $totValidados++;
                // echo 'campo  validado'.($i) . '<br>';
            } else {
                echo ($i) . 'campo no validado' .  '<br>';
            }

        }
        if ($totValidados == 11) {
            $perfil = "INSERT INTO perfil(tipo, documento, email, contrasenia) values('$tipo_usuario', $documento, '$email' , '$contrasenia')";

            if(mysqli_query($link, $perfil)){
                echo "Perfil creado!";
            }
        
            $idUltimo = "SELECT MAX(id) AS id FROM perfil";
            $sql = mysqli_query($link, $idUltimo);
            while($filas = mysqli_fetch_array($sql)){
                $id_perfil = $filas['id'];
            }
            // echo 'TODOS LOS CAMPOS HAN SIDO VALIDADOS';
            if ($tipo_usuario == 'Alumno') {
                $datos = "INSERT INTO Alumno (id_perfil ,nombre, apellido , fechanac, documento, pais, telefono, direccion) VALUES ($id_perfil, '$nombre' , '$apellido' , '$fechanac' , $documento , '$pais'  , $telefono , '$direccion')";
                if (mysqli_query($link, $datos)) {
                    echo "Registro correcto";
                    echo '<<h1 class="display-4">Registro Correcto!</h1>';
                    echo '<p>Redirigiendo...</p>';
                    header("Location: ../index.php");
                } else {
                    echo "Error: " . $datos . "<br>" . mysqli_error($link);
                }
            }
            if ($tipo_usuario == 'Docente') {

                $datos = "INSERT INTO Docente (id_perfil,  nombre, apellido , fechanac, documento, pais, telefono, direccion) VALUES ($id_perfil, '$nombre' , '$apellido'  , '$fechanac' , '$documento' , '$pais'  , '$telefono', '$direccion')";
                if (mysqli_query($link, $datos)) {
                    echo "Registro correcto";
                    echo '<<h1 class="display-4">Registro Correcto!</h1>';
                    echo '<p>Redirigiendo...</p>';
                    header("Location: ../index.php");
                } else {
                    echo "Error: " . $datos . "<br>" . mysqli_error($link);
                }
            }
        }
        
        /* sleep(4);
        header("Location: ../index.php"); */

        mysqli_close($link);
    }
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
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <div class="abs-center"style="text-align:center">
        <div class="w-75 p-5" style="background-color: #eee;">
            <h3 class="display-7" style="text-align:center">Completa el formulario</h3><br>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
                style="text-align:center">
                <div class="form-group">
                    <label for="tipo_usuario">Elija su tipo de usuario</label>
                    <select name="tipo_usuario" id="">
                        <option>Alumno
                        <option>
                        <option>Docente
                        <option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombres</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="apellido">Apellidos</label>
                    <input type="text" class="form-control" name="apellido" id="apellido">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                        aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="contrasenia">Contraseña</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="contrasenia">
                </div>
                <div class="form-group">
                    <label for="cContrasenia">Repita la contraseña</label>
                    <input type="password" class="form-control" id="cContrasenia" name="cContrasenia">
                </div>
                <div class="form-group">
                    <label for="fechanac">Fecha de nacimiento</label>
                    <input type="date" class="form-control" id="fechanac" name="fechanac" style="text-align:center">
                </div>
                <div class="form-group">
                    <label for="doc">Documento</label>
                    <input type="text" class="form-control" id="doc" name="doc">
                </div>
                <div class="form-group">
                    <label for="pais">Pais</label>
                    <select name="pais" class="form-select">
                        <option value="AF">Afganistán</option>
                        <option value="AL">Albania</option>
                        <option value="DE">Alemania</option>
                        <option value="AD">Andorra</option>
                        <option value="AO">Angola</option>
                        <option value="AI">Anguilla</option>
                        <option value="AQ">Antártida</option>
                        <option value="AG">Antigua y Barbuda</option>
                        <option value="AN">Antillas Holandesas</option>
                        <option value="SA">Arabia Saudí</option>
                        <option value="DZ">Argelia</option>
                        <option value="AR">Argentina</option>
                        <option value="AM">Armenia</option>
                        <option value="AW">Aruba</option>
                        <option value="AU">Australia</option>
                        <option value="AT">Austria</option>
                        <option value="AZ">Azerbaiyán</option>
                        <option value="BS">Bahamas</option>
                        <option value="BH">Bahrein</option>
                        <option value="BD">Bangladesh</option>
                        <option value="BB">Barbados</option>
                        <option value="BE">Bélgica</option>
                        <option value="BZ">Belice</option>
                        <option value="BJ">Benin</option>
                        <option value="BM">Bermudas</option>
                        <option value="BY">Bielorrusia</option>
                        <option value="MM">Birmania</option>
                        <option value="BO">Bolivia</option>
                        <option value="BA">Bosnia y Herzegovina</option>
                        <option value="BW">Botswana</option>
                        <option value="BR">Brasil</option>
                        <option value="BN">Brunei</option>
                        <option value="BG">Bulgaria</option>
                        <option value="BF">Burkina Faso</option>
                        <option value="BI">Burundi</option>
                        <option value="BT">Bután</option>
                        <option value="CV">Cabo Verde</option>
                        <option value="KH">Camboya</option>
                        <option value="CM">Camerún</option>
                        <option value="CA">Canadá</option>
                        <option value="TD">Chad</option>
                        <option value="CL">Chile</option>
                        <option value="CN">China</option>
                        <option value="CY">Chipre</option>
                        <option value="VA">Ciudad del Vaticano (Santa Sede)</option>
                        <option value="CO">Colombia</option>
                        <option value="KM">Comores</option>
                        <option value="CG">Congo</option>
                        <option value="CD">Congo, República Democrática del</option>
                        <option value="KR">Corea</option>
                        <option value="KP">Corea del Norte</option>
                        <option value="CI">Costa de Marfíl</option>
                        <option value="CR">Costa Rica</option>
                        <option value="HR">Croacia (Hrvatska)</option>
                        <option value="CU">Cuba</option>
                        <option value="DK">Dinamarca</option>
                        <option value="DJ">Djibouti</option>
                        <option value="DM">Dominica</option>
                        <option value="EC">Ecuador</option>
                        <option value="EG">Egipto</option>
                        <option value="SV">El Salvador</option>
                        <option value="AE">Emiratos Árabes Unidos</option>
                        <option value="ER">Eritrea</option>
                        <option value="SI">Eslovenia</option>
                        <option value="ES" selected>España</option>
                        <option value="US">Estados Unidos</option>
                        <option value="EE">Estonia</option>
                        <option value="ET">Etiopía</option>
                        <option value="FJ">Fiji</option>
                        <option value="PH">Filipinas</option>
                        <option value="FI">Finlandia</option>
                        <option value="FR">Francia</option>
                        <option value="GA">Gabón</option>
                        <option value="GM">Gambia</option>
                        <option value="GE">Georgia</option>
                        <option value="GH">Ghana</option>
                        <option value="GI">Gibraltar</option>
                        <option value="GD">Granada</option>
                        <option value="GR">Grecia</option>
                        <option value="GL">Groenlandia</option>
                        <option value="GP">Guadalupe</option>
                        <option value="GU">Guam</option>
                        <option value="GT">Guatemala</option>
                        <option value="GY">Guayana</option>
                        <option value="GF">Guayana Francesa</option>
                        <option value="GN">Guinea</option>
                        <option value="GQ">Guinea Ecuatorial</option>
                        <option value="GW">Guinea-Bissau</option>
                        <option value="HT">Haití</option>
                        <option value="HN">Honduras</option>
                        <option value="HU">Hungría</option>
                        <option value="IN">India</option>
                        <option value="ID">Indonesia</option>
                        <option value="IQ">Irak</option>
                        <option value="IR">Irán</option>
                        <option value="IE">Irlanda</option>
                        <option value="BV">Isla Bouvet</option>
                        <option value="CX">Isla de Christmas</option>
                        <option value="IS">Islandia</option>
                        <option value="KY">Islas Caimán</option>
                        <option value="CK">Islas Cook</option>
                        <option value="CC">Islas de Cocos o Keeling</option>
                        <option value="FO">Islas Faroe</option>
                        <option value="HM">Islas Heard y McDonald</option>
                        <option value="FK">Islas Malvinas</option>
                        <option value="MP">Islas Marianas del Norte</option>
                        <option value="MH">Islas Marshall</option>
                        <option value="UM">Islas menores de Estados Unidos</option>
                        <option value="PW">Islas Palau</option>
                        <option value="SB">Islas Salomón</option>
                        <option value="SJ">Islas Svalbard y Jan Mayen</option>
                        <option value="TK">Islas Tokelau</option>
                        <option value="TC">Islas Turks y Caicos</option>
                        <option value="VI">Islas Vírgenes (EEUU)</option>
                        <option value="VG">Islas Vírgenes (Reino Unido)</option>
                        <option value="WF">Islas Wallis y Futuna</option>
                        <option value="IL">Israel</option>
                        <option value="IT">Italia</option>
                        <option value="JM">Jamaica</option>
                        <option value="JP">Japón</option>
                        <option value="JO">Jordania</option>
                        <option value="KZ">Kazajistán</option>
                        <option value="KE">Kenia</option>
                        <option value="KG">Kirguizistán</option>
                        <option value="KI">Kiribati</option>
                        <option value="KW">Kuwait</option>
                        <option value="LA">Laos</option>
                        <option value="LS">Lesotho</option>
                        <option value="LV">Letonia</option>
                        <option value="LB">Líbano</option>
                        <option value="LR">Liberia</option>
                        <option value="LY">Libia</option>
                        <option value="LI">Liechtenstein</option>
                        <option value="LT">Lituania</option>
                        <option value="LU">Luxemburgo</option>
                        <option value="MK">Macedonia, Ex-República Yugoslava de</option>
                        <option value="MG">Madagascar</option>
                        <option value="MY">Malasia</option>
                        <option value="MW">Malawi</option>
                        <option value="MV">Maldivas</option>
                        <option value="ML">Malí</option>
                        <option value="MT">Malta</option>
                        <option value="MA">Marruecos</option>
                        <option value="MQ">Martinica</option>
                        <option value="MU">Mauricio</option>
                        <option value="MR">Mauritania</option>
                        <option value="YT">Mayotte</option>
                        <option value="MX">México</option>
                        <option value="FM">Micronesia</option>
                        <option value="MD">Moldavia</option>
                        <option value="MC">Mónaco</option>
                        <option value="MN">Mongolia</option>
                        <option value="MS">Montserrat</option>
                        <option value="MZ">Mozambique</option>
                        <option value="NA">Namibia</option>
                        <option value="NR">Nauru</option>
                        <option value="NP">Nepal</option>
                        <option value="NI">Nicaragua</option>
                        <option value="NE">Níger</option>
                        <option value="NG">Nigeria</option>
                        <option value="NU">Niue</option>
                        <option value="NF">Norfolk</option>
                        <option value="NO">Noruega</option>
                        <option value="NC">Nueva Caledonia</option>
                        <option value="NZ">Nueva Zelanda</option>
                        <option value="OM">Omán</option>
                        <option value="NL">Países Bajos</option>
                        <option value="PA">Panamá</option>
                        <option value="PG">Papúa Nueva Guinea</option>
                        <option value="PK">Paquistán</option>
                        <option value="PY">Paraguay</option>
                        <option value="PE">Perú</option>
                        <option value="PN">Pitcairn</option>
                        <option value="PF">Polinesia Francesa</option>
                        <option value="PL">Polonia</option>
                        <option value="PT">Portugal</option>
                        <option value="PR">Puerto Rico</option>
                        <option value="QA">Qatar</option>
                        <option value="UK">Reino Unido</option>
                        <option value="CF">República Centroafricana</option>
                        <option value="CZ">República Checa</option>
                        <option value="ZA">República de Sudáfrica</option>
                        <option value="DO">República Dominicana</option>
                        <option value="SK">República Eslovaca</option>
                        <option value="RE">Reunión</option>
                        <option value="RW">Ruanda</option>
                        <option value="RO">Rumania</option>
                        <option value="RU">Rusia</option>
                        <option value="EH">Sahara Occidental</option>
                        <option value="KN">Saint Kitts y Nevis</option>
                        <option value="WS">Samoa</option>
                        <option value="AS">Samoa Americana</option>
                        <option value="SM">San Marino</option>
                        <option value="VC">San Vicente y Granadinas</option>
                        <option value="SH">Santa Helena</option>
                        <option value="LC">Santa Lucía</option>
                        <option value="ST">Santo Tomé y Príncipe</option>
                        <option value="SN">Senegal</option>
                        <option value="SC">Seychelles</option>
                        <option value="SL">Sierra Leona</option>
                        <option value="SG">Singapur</option>
                        <option value="SY">Siria</option>
                        <option value="SO">Somalia</option>
                        <option value="LK">Sri Lanka</option>
                        <option value="PM">St Pierre y Miquelon</option>
                        <option value="SZ">Suazilandia</option>
                        <option value="SD">Sudán</option>
                        <option value="SE">Suecia</option>
                        <option value="CH">Suiza</option>
                        <option value="SR">Surinam</option>
                        <option value="TH">Tailandia</option>
                        <option value="TW">Taiwán</option>
                        <option value="TZ">Tanzania</option>
                        <option value="TJ">Tayikistán</option>
                        <option value="TF">Territorios franceses del Sur</option>
                        <option value="TP">Timor Oriental</option>
                        <option value="TG">Togo</option>
                        <option value="TO">Tonga</option>
                        <option value="TT">Trinidad y Tobago</option>
                        <option value="TN">Túnez</option>
                        <option value="TM">Turkmenistán</option>
                        <option value="TR">Turquía</option>
                        <option value="TV">Tuvalu</option>
                        <option value="UA">Ucrania</option>
                        <option value="UG">Uganda</option>
                        <option value="UY">Uruguay</option>
                        <option value="UZ">Uzbekistán</option>
                        <option value="VU">Vanuatu</option>
                        <option value="VE">Venezuela</option>
                        <option value="VN">Vietnam</option>
                        <option value="YE">Yemen</option>
                        <option value="YU">Yugoslavia</option>
                        <option value="ZM">Zambia</option>
                        <option value="ZW">Zimbabue</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tel">Telefono</label>
                    <input type="text" class="form-control" id="tel" name="tel">
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="form-control" id="direccion" name="direccion">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check" name="check">
                    <label class="form-check-label" for="exampleCheck1">Estoy de acuerdo con las <a
                            href="https://www.google.com">politicas de privacidad <a>de Webducacion</label>
                </div>
                <button type="submit" class="btn btn-success" name="ingresar">Ingresar</button>
            </form>
        </div>

    </div>
</body>

</html>