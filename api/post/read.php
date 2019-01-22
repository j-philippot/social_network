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

$resultado = $post->verPosts();
$num = $resultado->rowCount();

if($num > 0){
    $posts_arr = [];
    $posts_arr['data'] = [];
    
    while($fila = $resultado->fetch(PDO::FETCH_ASSOC)){
        extract($fila);
        $post_item = [
            'id' => $id,
            'titulo' => $titulo,
            'cuerpo' => html_entity_decode($cuerpo),
            'autor' => $autor,
            'publicado' => $publicado,
            'fecha_creacion' => $fecha_creacion
        ];

        array_push($posts_arr['data'], $post_item);
    }

    // Convertir a JSON
    echo json_encode($posts_arr);

}else{
    // No posts
    echo json_encode(['mensaje' => 'Posts no encontrados']);
}

?>