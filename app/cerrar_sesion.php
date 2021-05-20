<?php
// hacer que cierre sesion y crear header hacia index.php
session_destroy();
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
sleep(3);

header("Location: ../index.php");


?>