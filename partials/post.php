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
    	<i class="far fa-heart" title="Me gusta"></i>
    	<i class="far fa-share-square" title="Compartir"></i>
    	<?php
    	if($single_post->username == $usuario->username){
    	?>
    	<i class="far fa-edit" title="Editar"></i>
    	<i class="far fa-trash-alt" title="Eliminar"></i>
    	<?php
    	}
    	?>
    </div>
    <div class="commentPost"></div>
</div>