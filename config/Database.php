<?php

class database
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "social";
    private $conn;

    public function conecta()
    {
        $this->conn = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
            $this->conn = new PDO($dsn, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error en la conexión" . $e->getMessage();
        }
        return $this->conn;
    }
}

?>