<?php
if(isset($_POST['modificarPost'])){
	require_once('../config/database.php');
	require_once('../models/post.php');

	// Instanciar el objeto DB y conectar

	 $database = new database();
	 $db = $database->conecta();

	// Instanciar el objeto Post

	$post = new post($db);

	// Obtener los datos insertados


	// Settear el id a actualizar

	$post->id = $data->id;

	$post->titulo = $data->titulo;
	$post->cuerpo = $data->cuerpo;
	$post->autor = $data->autor;

	// Modificar post
	if($post->update()){
	    header("Location: ../home.php");
	}else{
	    header("Location: ../home.php");
	}
}
?>