<?php

// Login:
if (isset($_POST['usu-existe']) && isset($_POST['contra-usu-existe'])) {
    require_once('../config/Database.php');
    $db = new database();
    $conexion = $db->conecta();
    $Uname = htmlspecialchars(strip_tags($_POST['usu-existe']));
    $Upass = htmlspecialchars(strip_tags(sha1($_POST['contra-usu-existe'])));

    $consulta = "SELECT * FROM users WHERE username = :nombreUsu";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':nombreUsu', $Uname);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        while ($elemento = $stmt->fetchObject()) {
            if ($elemento->pass == $Upass) {
                session_start();
                $user = $elemento->username;
                $_SESSION['logged_in'] = true;
                $_SESSION['nombre'] = $user;
                // $_SESSION["timeout"] = time();
                header("Location: ../home.php");
            } else {
                // Error de contraseña
                die('Ha habido un error. Comprueba tus datos.');
            }
        }
    } else {
        // Error de usuario
        die('Ha habido un error. Comprueba tus datos.');
    }
} else {
    // Acceso sin pasar por formulario:
    header("Location: ../index.php");
    exit();
}