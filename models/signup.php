<?php

//Registro:
if (isset($_POST['nickname'], $_POST['correo-usu'], $_POST['contra-usu-1'])) {
    if ($_POST['contra-usu-1'] !== $_POST['contra-usu-2']) {
        die('Las contraseñas no coinciden');
    }
    require_once('../config/Database.php');
    $db = new database();
    $conexion = $db->conecta();
    $Ufirst = htmlspecialchars(strip_tags($_POST['nombre-usu']));
    $Ulast = htmlspecialchars(strip_tags($_POST['apellido-usu']));
    $Umail = htmlspecialchars(strip_tags($_POST['correo-usu']));
    $Uname = htmlspecialchars(strip_tags($_POST['nickname']));
    $Upass = htmlspecialchars(strip_tags(sha1($_POST['contra-usu-1'])));
    $Uimg = "img/default.jpg";

    // Comprobar si existe ese nombre:
    $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':username', $Uname);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['num'] > 0) {
        die('El nombre de usuario ya existe');
    }

        // Comprobar si existe ese correo:
    $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':email', $Umail);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['num'] > 0) {
        die('Ya hay un usuario registrado con este correo');
    }

        // Inserción del nuevo usuario en caso de que todo sea correcto:

    $sql = "INSERT INTO users (email, username, pass, first_name, last_name, prof_img) VALUES (:email, :username, :pass, :firstName, :lastName, :profImg)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':email', $Umail);
    $stmt->bindParam(':username', $Uname);
    $stmt->bindParam(':pass', $Upass);
    $stmt->bindParam(':firstName', $Ufirst);
    $stmt->bindParam(':lastName', $Ulast);
    $stmt->bindParam(':profImg', $Uimg);

    $stmt->execute();

    // Inicio de sesión (hacer página de bienvenida):
    session_start();
    $_SESSION['logged_in'] = true;
    $_SESSION['nombre'] = $Uname;
    // $_SESSION["timeout"] = time();
    header("Location: ../home.php?user=$Uname");
} else {
    // Acceso directo, sin pasar por formulario:
    header("Location: ../index.php");
    exit();
}