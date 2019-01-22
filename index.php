<?php
//Arrancamos la sesión y comprobamos si el usuario está logueado:
session_start();
if (isset($_SESSION['logged_in'])) {
	$usuario = $_SESSION['nombre'];
	header("Location: home.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/estilolog.css">
		<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
		<script src="js/carga.js"></script>
	</head>
	<body>
		<div class="caja-total">
			<header>
				<div>
					<img id="logo" src="img/logo.png">
				</div>
				
				<form method="POST" action="models/login.php">
					<div>
						<input type="text" name="usu-existe" placeholder="Nombre de usuario" id="usu-existe" class="campo-iniciar" required="required">
						<input type="password" name="contra-usu-existe" placeholder="Contraseña" id="contra-usu-existe" class="campo-iniciar" required="required">
						<input type="submit" name="boton-iniciar" value="Entrar" id="boton-iniciar">
					</div>
				</form>
			</header>
			<section>
				<div id="seccion-izqda">
					<div class="filtro">
						<img src="img/logo.png">
					</div>
				</div>
				<form id="registro" method="POST" action="models/signup.php">
					<h1>Regístrate</h1>
					<div>
						<input type="text" name="nombre-usu" placeholder="Nombre" id="nombre-usu" required="required" class="cuadro-mitad" value="<?php echo isset($_POST["nombre-usu"]) ? $_POST["nombre-usu"] : ''; ?>">
						<input type="text" name="apellido-usu" placeholder="Apellido" id="apellido-usu" required="required" class="cuadro-mitad" value="<?php echo isset($_POST["apellido-usu"]) ? $_POST["apellido-usu"] : ''; ?>">
					</div>
					<div>
						<input type="text" name="nickname" placeholder="Nombre de usuario" id="nickname" required="required" class="cuadro-texto" value="<?php echo isset($_POST["nickname"]) ? $_POST["nickname"] : ''; ?>">
					</div>
					<div>
						<input type="email" name="correo-usu" placeholder="Correo electrónico" id="correo-usu" required="required" class="cuadro-texto" value="<?php echo isset($_POST["correo-usu"]) ? $_POST["correo-usu"] : ''; ?>">
					</div>
					<div>
						<input type="password" name="contra-usu-1" placeholder="Escribe tu contraseña" id="contra-usu-1" required="required" class="cuadro-texto">
					</div>
					<div>
						<input type="password" name="contra-usu-2" placeholder="Vuelve a escribir tu contraseña" id="contra-usu-2" required="required" class="cuadro-texto">
					</div>
					<div>
						<input type="submit" name="boton-enviar" value="Regístrate" id="boton-enviar">
					</div>
				</form>
			</section>
			<footer>Jacobo Philippot | &copy2019</footer>
		</div>
		<div id="caja-carga">
			<div class="lds-ellipsis">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
	</body>
</html>