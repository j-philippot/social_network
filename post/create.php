<?php
if(isset($_POST['publicarPost'])){
	require_once('../config/Database.php');
	require_once('../models/post.php');

	// Instanciar el objeto DB y conectar

	$database = new database();
	$db = $database->conecta();

	// Instanciar el objeto Post

	$post = new post($db);

	// Almacenar la imagen en el servidor

	$name = $_FILES['file']['name'];  
    $temp_name = $_FILES['file']['tmp_name'];

    if(isset($name)){
        if(!empty($name)){
            $location = '../uploads/post/';
            $fichero = $location . basename($name);     
            if(move_uploaded_file($temp_name, $fichero)){
                $post->title = $_POST['tituloInput'];
				$post->body = $_POST['escribirPost'];
				$post->postImg = 'uploads/post/' . basename($name);
				$post->userId = $_POST['autor'];
            }
        } else {
        	// PENDIENTE: establecer condiciones más específicas para que el post no venga totalmente vacío
        	if(empty($_POST['tituloInput']) || empty($_POST['escribirPost'])){
        		die('Post vacío o incompleto');
        	}
	        $post->title = $_POST['tituloInput'];
			$post->body = $_POST['escribirPost'];
			$post->postImg = null;
			$post->userId = $_POST['autor'];
        }
    } else {
    	die('Error en la subida de archivos');
    }

	// Crear post

	if($post->create()){
		// Página de usuario con mensaje de éxito:
	    header("Location: ../home.php");
	}else{
		// Página de usuario con mensaje de error:
	    header("Location: ../home.php");
	}
} else {
	die();
}
?>