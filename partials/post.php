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
        <i class="far fa-edit" title="Editar" onclick="editar(<?php echo $single_post->id; ?>)"></i>
        <i class="far fa-trash-alt" title="Eliminar" onclick="borrar(<?php echo $single_post->id; ?>)"></i>
    	<?php
    	}
    	?>
    </div>
    <div class="commentPost"></div>
    <div class="borrar" id="borrar<?php echo $single_post->id; ?>">
        <p>¿Deseas borrar el post?</p>
        <div>
            <button type="button" class="noBorrar" id="noBorrar<?php echo $single_post->id; ?>">No</button>
            <a href="post/delete.php?id=<?php echo $single_post->id; ?>">Sí</a>
        </div>
    </div>
    <div class="modalEditar" id="editar<?php echo $single_post->id; ?>">
      <div class="cabeceraPost">Editar post</div>
      <img class="cancelar" src="img/cancel.png" title="Cancelar">
      <img class="imgMuestra" id="muestra<?php echo $single_post->id; ?>" src="<?php echo $single_post->post_img; ?>"/>
      <form class="formularioPost" id="formularioPost" method="POST" action="post/update.php?id=<?php echo $single_post->id; ?>" enctype="multipart/form-data">
        <div>
          <input type="text" name="tituloInput" value="<?php echo $single_post->title; ?>" placeholder="Título" class="tituloInput" maxlength="50">
        </div>
        <div class="escribirPost">
          <a class="postLink" href="user/profile.php?user=<?php echo $single_post->username; ?>"><img class="profPost" src="<?php echo $usuario->profImg; ?>"></a>
          <textarea name="escribirPost" placeholder="Escribe lo que quieras, <?php echo $single_post->username; ?>" maxlength="255" oninput="autoExpand(this)"><?php echo $single_post->body; ?></textarea>
        </div>
        <div class="formatosPost">
          <input type="file" class="inputfile" title="Elige un archivo para subir" value="
          <?php 
            if(is_null($single_post->post_img)) {
                echo '';
            } else {
                echo $single_post->post_img;
            }
          ?>" name="updatedFile" accept="image/*" multiple="1" id="file" onchange="loadEditedFile(<?php echo $single_post->id; ?>, event)">
          <label for="file"><i class="fas fa-image"></i>Foto</label>
        </div>
        <div class="botonPublicar">
          <button class="cerrarPost" type="button" onclick="modalOff()">Cerrar</button>
          <input type="hidden" name="autor" value="<?php echo $usuario->id; ?>">
          <input type="submit" name="publicarPost" class="publicarPost" value="Publicar">
        </div>
      </form>
    </div>
</div>