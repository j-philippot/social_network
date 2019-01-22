<?php

class user
{
    private $conn;

    public $id;
    public $email;
    public $username;
    public $fName;
    public $lName;
    public $profImg;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    /* Ver todos los posts (GET)
    public function verPosts()
    {
        $consulta = "SELECT * FROM posts ORDER BY fecha_creacion";
        $stmt = $this->conn->prepare($consulta);
        $stmt->execute();
        return $stmt;
    }
	*/
    // Ver un sólo post (GET)

    public function userData()
    {
        $consulta = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($consulta);
        $stmt->bindParam(1, $this->username);
        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $fila['id'];
        $this->email = $fila['email'];
        $this->username = $fila['username'];
        $this->fName = $fila['first_name'];
        $this->lName = $fila['last_name'];
        $this->profImg = $fila['prof_img'];
    }

    /* Crear un post (POST)

    public function create()
    {
        $consulta = "INSERT INTO posts SET titulo = :titulo, cuerpo = :cuerpo, autor = :autor";
        $stmt = $this->conn->prepare($consulta);
        // Limpiar datos para prevenir ataques
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->cuerpo = htmlspecialchars(strip_tags($this->cuerpo));
        $this->autor = htmlspecialchars(strip_tags($this->autor));
        // Bind
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':cuerpo', $this->cuerpo);
        $stmt->bindParam(':autor', $this->autor);
        // Ejecutar
        if ($stmt->execute()) {
            return true;
        }
        // Imprimir error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Modificar un post (PUT)

    public function update()
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