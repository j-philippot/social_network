<?php
// La vista se encarga de recopilar información del modelo (post) y mostrarla mediante plantillas (partials)
require_once('models/post.php');

$post = new post($db);
// Settear el username:
$post->username = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : die();

// Settear el id:
$post->setId();

$resultado = $post->verPosts();
$num = $resultado->rowCount();


if($num > 0){
    $posts_arr = [];

    while($fila = $resultado->fetch(PDO::FETCH_OBJ)){
        array_push($posts_arr, $fila);
    }

    foreach($posts_arr as $single_post){
        include('partials/post.php');
    }

}else{
    // No posts
    die('no hay posts');
}

?>