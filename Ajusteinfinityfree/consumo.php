<?php
class Consumo {
    private $conn;
    private $table_name = "consumo";

    public $id;
    public $bairro;
    public $hora;
    public $consumo;
    public $residencias;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ler todos os registros
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Criar novo registro
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET bairro=:bairro, hora=:hora, consumo_kwh=:consumo, num_residencia=:residencias";
        
        $stmt = $this->conn->prepare($query);

        // Limpar dados
        $this->bairro = htmlspecialchars(strip_tags($this->bairro));
        $this->hora = htmlspecialchars(strip_tags($this->hora));
        $this->consumo = htmlspecialchars(strip_tags($this->consumo));
        $this->residencias = htmlspecialchars(strip_tags($this->residencias));

        // Vincular valores
        $stmt->bindParam(":bairro", $this->bairro);
        $stmt->bindParam(":hora", $this->hora);
        $stmt->bindParam(":consumo", $this->consumo);
        $stmt->bindParam(":residencias", $this->residencias);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Atualizar registro
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                 SET bairro=:bairro, hora=:hora, consumo_kwh=:consumo, num_residencia=:residencias 
                 WHERE id=:id";
        
        $stmt = $this->conn->prepare($query);

        // Limpar dados
        $this->bairro = htmlspecialchars(strip_tags($this->bairro));
        $this->hora = htmlspecialchars(strip_tags($this->hora));
        $this->consumo = htmlspecialchars(strip_tags($this->consumo));
        $this->residencias = htmlspecialchars(strip_tags($this->residencias));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Vincular valores
        $stmt->bindParam(":bairro", $this->bairro);
        $stmt->bindParam(":hora", $this->hora);
        $stmt->bindParam(":consumo", $this->consumo);
        $stmt->bindParam(":residencias", $this->residencias);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Deletar registro
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>