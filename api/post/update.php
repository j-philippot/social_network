<?php
// Headers Rest
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../config/database.php');
require_once('../../models/post.php');

// Instanciar el objeto DB y conectar

 $database = new database();
 $db = $database->conecta();

// Instanciar el objeto Post

$post = new post($db);

// Obtener los datos insertados
$data = json_decode(file_get_contents("php://input"));

// Obtener el id a actualizar

$post->id = $data->id;

$post->titulo = $data->titulo;
$post->cuerpo = $data->cuerpo;
$post->autor = $data->autor;

// Modificar post
if($post->update()){
    echo json_encode(['mensaje' => 'Post modificado']);
}else{
    echo json_encode(['mensaje' => 'Post no modificado']);
}
?>