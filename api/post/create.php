<?php
require_once('../../config/database.php');
require_once('../../models/post.php');

// Instanciar el objeto DB y conectar

 $database = new database();
 $db = $database->conecta();

// Instanciar el objeto Post

$post = new post($db);

// Obtener los datos insertados
$data = json_decode(file_get_contents("php://input"));

$post->titulo = $data->tituloInput;
$post->cuerpo = $data->escribirPost;
$post->imagen = $data->file;
$post->autor = $data->autor;

// Crear post
if($post->create()){
    echo json_encode(['mensaje' => 'Post creado']);
}else{
    echo json_encode(['mensaje' => 'Post no creado']);
}
?>