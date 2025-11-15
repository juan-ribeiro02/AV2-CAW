<?php

// ---- PARTE PARA O LOGIN ----
$host = "sql210.infinityfree.com";
$db_name = "if0_40375112_av2";
$username = "if0_40375112";
$password = "Acdej2025";

$mysqli = new mysqli($host, $username, $password, $db_name);

if($mysqli->connect_error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->connect_error);
}

// ---- PARTE PARA A API ----
class Database {
    private $host = "sql210.infinityfree.com";
    private $db_name = "if0_40375112_av2";
    private $username = "if0_40375112";
    private $password = "Acdej2025";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                $this->username, 
                $this->password
            );
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>