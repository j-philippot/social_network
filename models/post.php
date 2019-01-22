<?php

class post
{
    private $conn;

    public $id;
    public $userId;
    public $title;
    public $body;
    public $postImg;
    public $fecha_creacion;
    public $username;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener ID

    public function setId (){
        $consulta = "SELECT id FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($consulta);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->userId = $fila['id'];
    }
    
    // Ver todos los posts (GET)
    public function verPosts()
    {
        $consulta = "SELECT posts.*, users.username, users.first_name, users.last_name, users.prof_img FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.user_id = :user OR posts.user_id IN (SELECT friends.user_id FROM friends WHERE friends.friend_id = :user) OR posts.user_id IN (SELECT friends.friend_id FROM friends WHERE friends.user_id = :user) ORDER BY posts.updated_at DESC";
        $stmt = $this->conn->prepare($consulta);
        $stmt->bindParam(':user', $this->userId);
        $stmt->execute();
        return $stmt;
    }

    public function verAmigos() {
        $consulta = "SELECT users.id, users.username, users.first_name, users.last_name, users.prof_img FROM users WHERE users.id IN (SELECT friends.user_id FROM friends WHERE friends.friend_id = :user) OR users.id IN (SELECT friends.friend_id FROM friends WHERE friends.user_id = :user)";
        $stmt = $this->conn->prepare($consulta);
        $stmt->bindParam(':user', $this->userId);
        $stmt->execute();
        return $stmt;
    }

    /* Ver un sólo post (GET)

    public function verUnPost()
    {
        $consulta = "SELECT * FROM posts WHERE posts.user_id = :user OR posts.user_id IN (SELECT friends.user_id FROM friends WHERE friends.friend_id = :user) OR posts.user_id IN (SELECT friends.friend_id FROM friends WHERE friends.user_id = :user)";
        $stmt = $this->conn->prepare($consulta);
        $stmt->bindParam(':user', $this->userId);
        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->title = $fila['title'];
        $this->body = $fila['body'];
        $this->autor = $fila['autor'];
        $this->publicado = $fila['publicado'];
        $this->fecha_creacion = $fila['fecha_creacion'];
    }
    */

    // Crear un post (POST)

    public function create()
    {
        $consulta = "INSERT INTO posts SET title = :title, body = :body, user_id = :userId, post_img = :postImg";
        $stmt = $this->conn->prepare($consulta);
        // Limpiar datos para prevenir ataques
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        // Bind
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':userId', $this->userId);
        $stmt->bindParam(':postImg', $this->postImg);
        // Ejecutar
        if ($stmt->execute()) {
            return true;
        }
        // Imprimir error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Modificar un post (PUT)

    /*public function update()
    {
        $consulta = "UPDATE posts SET titulo = :titulo, cuerpo = :cuerpo, autor = :autor WHERE id = :id";
        $stmt = $this->conn->prepare($consulta);
        // Limpiar datos para prevenir ataques
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->cuerpo = htmlspecialchars(strip_tags($this->cuerpo));
        $this->autor = htmlspecialchars(strip_tags($this->autor));
        $this->id = htmlspecialchars(strip_tags($this->id));
        // Bind
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':cuerpo', $this->cuerpo);
        $stmt->bindParam(':autor', $this->autor);
        $stmt->bindParam(':id', $this->id);
        // Ejecutar
        if ($stmt->execute()) {
            return true;
        }
        // Imprimir error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Borrar post (DELETE)

    public function delete()
    {
        // Consulta
        $consulta = "DELETE FROM posts WHERE id = :id";
        // Prepare
        $stmt = $this->conn->prepare($consulta);
        // Limpiar
        $this->id = htmlspecialchars(strip_tags($this->id));
        // Enlazar
        $stmt->bindParam(':id', $this->id);
        if ($stmt->execute()) {
            return true;
        }
        // Imprimir error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    */
}

?>