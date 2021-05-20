<!-- Pagina principal de la aplicacion.
Su funciones son, dirigir al registro de usuario, permitir inicio de sesion, y permitir recuperar la
contraseña.
 #envia email y contraseña a ingresar.php
 # redirige a registrarse.php en caso de clickear registrarse
 # >> TODO:redirige a recuperar_contraseña en caso de clickear "Olvido su contraseña" 
 -->
<?php

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <div class="abs-center" style="text-align:center;">
        <div class="w-75 p-5" style="background-color: #eee;">
            <h3 class="display-7" style="text-align:center">Welcome to Fake Academy</h3><br>
            <form action="./app/ingresar1.php" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">No se compartiran tus datos personales con
                        nadie, nunca.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name='contra' id="exampleInputPassword1">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Ingresar</button>
                </div>
            </form>
            <form action="./app/registrarse.php" method="POST">
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary">Registrarse</button>
                </div>
            </form>
            <form action="forgot_pass.php" method="POST">
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Olvido su contraseña?</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>