<?php
//Arrancamos la sesión:
session_start();
//Comprobamos existencia de sesión:
if (!$_SESSION['logged_in']) {
    header("Location: ../index.php");
    exit();
}

/* Establecer tiempo de vida de la sesión en segundos:
$inactividad = 1800;
// Comprobar si $_SESSION["timeout"] está establecida:
if (isset($_SESSION["timeout"])) {
    // Calcular el tiempo de vida de la sesión (TTL = Time To Live):
    $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactividad) {
        header("Location: ../models/logout.php");
        exit();
    }
}
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Página de perfil</title>
</head>
<body>
    <p>Perfil de <?php echo $_SESSION['nombre']; ?></p>
    <a href="../models/logout.php">Log out</a>
</body>
</html>