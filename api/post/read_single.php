<?php
// Headers Rest
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once('../../config/database.php');
require_once('../../models/post.php');

// Instanciar el objeto DB y conectar
 $database = new database();
 $db = $database->conecta();

// Instanciar el objeto Post
$post = new post($db);

// Obtener id de la URL
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// Activar método
$post->verUnPost();

// Crear array
$post_arr = [
    'id' => $post->id,
    'titulo' => $post->titulo,
    'cuerpo' => $post->cuerpo,
    'autor' => $post->autor,
    'publicado' => $post->publicado,
    'fecha_creacion' => $post->fecha_creacion,
];

// Convertir a JSON
print_r(json_encode($post_arr));
?>