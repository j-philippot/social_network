<?php
if(isset($_GET['id'])){
	require_once('../config/Database.php');
	require_once('../models/post.php');

	// Instanciar el objeto DB y conectar

	$database = new database();
	$db = $database->conecta();

	// Instanciar el objeto Post

	$post = new post($db);

	// Obtener los datos insertados
	$deleted_post_id = $_GET['id'];

	// Obtener el id a actualizar

	$post->id = $deleted_post_id;

	// Borrar post
	if($post->delete()){
	    // Enviar a home con mensaje de éxito
	    header('Location: ../home.php');
	}else{
	    // Enviar a home con mensaje de error
	    header('Location: ../home.php');
	}
}
?>