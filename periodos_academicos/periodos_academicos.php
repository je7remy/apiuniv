<?php
class PeriodoAcademico {
    
    private $conn;
    private $periodos_academicos = "periodos_academicos";
    public $idperiodo;
    public $descripcion;
    public $estado;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los periodos académicos
    public function getAll() {
       
        $sqlQuery = "SELECT idperiodo, descripcion, estado FROM " . $this->periodos_academicos;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // Obtener un periodo académico por su ID
    public function getOne() {
        $sqlQuery = "SELECT idperiodo, descripcion, estado FROM " . $this->periodos_academicos . " WHERE idperiodo = :idperiodo";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(':idperiodo', $this->idperiodo);
        $stmt->execute();
        return $stmt;
    }
    // Crear un nuevo periodo académico
    public function create() {
        $query = "INSERT INTO " . $this->periodos_academicos . "(descripcion, estado) VALUES (:descripcion, :estado)";
        $stmt = $this->conn->prepare($query);
        
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->estado = htmlspecialchars(strip_tags($this->estado));

        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':estado', $this->estado);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Actualizar información de un periodo académico
    public function update() {
        $query = "UPDATE " . $this->periodos_academicos . " SET descripcion = :descripcion, estado = :estado WHERE idperiodo = :idperiodo";
        $stmt = $this->conn->prepare($query);

        $this->idperiodo = htmlspecialchars(strip_tags($this->idperiodo));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->estado = htmlspecialchars(strip_tags($this->estado));

        $stmt->bindParam(':idperiodo', $this->idperiodo);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':estado', $this->estado);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function updateestado() {
        $query = "UPDATE " . $this->periodos_academicos . " SET estado = :estado WHERE idperiodo = :idperiodo";
        $stmt = $this->conn->prepare($query);

        $this->idperiodo = htmlspecialchars(strip_tags($this->idperiodo));
        $this->estado = htmlspecialchars(strip_tags($this->estado));

        $stmt->bindParam(':idperiodo', $this->idperiodo);
        $stmt->bindParam(':estado', $this->estado);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


}
?>

