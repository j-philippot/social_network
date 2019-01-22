<?php
//Arrancamos la sesión:
session_start();
//Comprobamos existencia de sesión:
if (!$_SESSION['logged_in']) {
    header("Location: index.php");
    exit();
}
//Recuperamos datos del usuario:
require_once('config/Database.php');
require_once('models/user.php');

$database = new database();
$db = $database->conecta();

$usuario = new user($db);

$usuario->username = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : die();

$datosUsuario = $usuario->userData();

/* Establecer tiempo de vida de la sesión en segundos:
$inactividad = 1800;
// Comprobar si $_SESSION["timeout"] está establecida:
if (isset($_SESSION["timeout"])) {
    // Calcular el tiempo de vida de la sesión (TTL = Time To Live):
    $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactividad) {
        header("Location: models/logout.php");
        exit();
    }
}
*/
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <link href="css/home.css" rel="stylesheet" type="text/css" />
    <link href="img/favicon.png" rel="shortcut icon" type="image/png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script type="text/javascript" src="js/home.js" defer="defer"></script>
  </head>
  <body>
      <header>
        <a class="logo" href="index.php">
            <img src="img/icono.png"/>
        </a>
        <div class="topnav">
          <div class="links">
            <a class="navLink" href="user/profile.php?user=<?php echo $usuario->username; ?>"><img src="<?php echo $usuario->profImg; ?>"><?php echo $usuario->username; ?></a>
            <a class="navLink" href="index.php">Inicio</a>
            <a class="navLink" href="models/logout.php">Salir</a>
          </div>
          <div class="search-container">
            <form action="">
              <input autocomplete="off" type="text" placeholder="Buscar" name="search">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
        </div>
      </header>
      <div class="fondoModal"></div>
      <div class="asides">
      	<div class="izqda">
         <div class="contIzqda"></div> 
        </div>
      	<div class="chat"></div>
      </div>
      <div class="main">
    		<div class="publicar">
          <div class="cabeceraPost">Crear un post</div>
          <img class="cancelar" src="img/cancel.png" title="Cancelar">
          <img class="output"/>
          <form class="formularioPost" id="formularioPost" method="POST" action="post/create.php" enctype="multipart/form-data">
            <div class="tituloPublicacion">
              <input type="text" name="tituloInput" placeholder="Título" class="tituloInput" maxlength="50">
            </div>
            <div class="escribirPost">
              <a class="postLink" href="user/profile.php?user=<?php echo $usuario->username; ?>"><img class="profPost" src="<?php echo $usuario->profImg; ?>"></a>
              <textarea name="escribirPost" placeholder="Escribe lo que quieras, <?php echo $usuario->username; ?>" maxlength="255" onfocus="modalOn()" oninput="autoExpand(this)"></textarea>
            </div>
            <div class="formatosPost">
              <input type="file" class="inputfile" title="Elige un archivo para subir" name="file" accept="image/*" multiple="1" id="file" onchange="loadFile(event)">
              <label for="file"><i class="fas fa-image"></i>Foto</label>
            </div>
            <div class="botonPublicar">
              <button class="cerrarPost" type="button" onclick="modalOff()">Cerrar</button>
              <input type="hidden" name="autor" value="<?php echo $usuario->id; ?>">
              <input type="hidden" name="nombreAutor" value="<?php echo $usuario->username; ?>">
              <input type="submit" name="publicarPost" class="publicarPost" value="Publicar">
            </div>
          </form> 
        </div>
        <?php
          require_once('post/read.php');
        ?>
      </div>
  </body>
</html>