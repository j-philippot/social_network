<div class="post">
    <div class="datosPost">
    <a href="user/profile.php?user=<?php echo $single_post->username; ?>"><img class="profPost" src="<?php echo $single_post->prof_img; ?>"></a>
    <a class="postLink" href="user/profile.php?user=<?php echo $single_post->username; ?>"><?php echo $single_post->username; ?></a>&nbsp; compartió un enlace.
    </div>
    <!-- Introducir la imagen en enlace al post -->
    <?php
    if(!is_null($single_post->post_img)){
    ?>
    <a href="#"><img class="imagenPost" src="<?php echo $single_post->post_img; ?>" title="Imagen" alt="Imagen del post"></img></a>
    <?php
    }
    ?>
    <?php
    if(!empty($single_post->title) && !empty($single_post->body)){
    ?>
    <div class="cuerpoPost">
        <h2><?php echo $single_post->title; ?></h2>
        <p><?php echo $single_post->body; ?></p>
    </div>
    <?php
    }
    ?>
    <div class="reactPost">
        <a href="#"><i class="far fa-heart" title="Me gusta"></i></a>
        <a href="#"><i class="far fa-share-square" title="Compartir"></i></a>
    	<?php
    	if($single_post->username == $usuario->username){
    	?>
        <a href="home.php?update_id=<?php echo $single_post->id; ?>"><i class="far fa-edit" title="Editar"></i></a>
        <i class="far fa-trash-alt" title="Eliminar" onclick="borrar()"></i>
    	<?php
    	}
    	?>
    </div>
    <div class="commentPost"></div>
    <div class="borrar">
        <p>¿Deseas borrar el post?</p>
        <div>
            <button type="button" class="noBorrar">No</button>
            <a href="post/delete.php?id=<?php echo $single_post->id; ?>">Sí</a>
        </div>
    </div>
</div>