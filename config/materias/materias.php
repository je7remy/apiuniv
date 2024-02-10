<?php

class materias
{
    private $conn;
    private $materias = "materias";
    public $idmateria;
    public $descripcion;
    public $codigomateria;
    public $horario;
    public $estado;
    public $aula;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        try {
            $query = "SELECT * FROM " . $this->materias;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $exception) {
            // Handle errors
            return false;
        }
    }

    // retrieve one record by id
    public function getOne()
    {
        try {
            $query = "SELECT * FROM " . $this->materias . " WHERE idmateria = :idmateria";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':idmateria', $this->idmateria);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $exception) {
            // Handle errors
            return false;
        }
    }

    // create new record
    function create()
    {
        try {
            // Insert query
            $query = "INSERT INTO " . $this->materias . "(descripcion, codigomateria, horario, estado, aula) 
                      VALUES (:descripcion, :codigomateria, :horario, :estado, :aula)";

            // Prepare the query
            $stmt = $this->conn->prepare($query);

            // Sanitize and bind values
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $this->codigomateria = htmlspecialchars(strip_tags($this->codigomateria));
            $this->horario = htmlspecialchars(strip_tags($this->horario));
            $this->estado = htmlspecialchars(strip_tags($this->estado));
            $this->aula = htmlspecialchars(strip_tags($this->aula));

            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':codigomateria', $this->codigomateria);
            $stmt->bindParam(':horario', $this->horario);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':aula', $this->aula);

            // Execute the query, also check if the query was successful
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $exception) {
            // Handle errors
            return false;
        }

        return false;
    }

    // update() method will be here
    // update a record
    public function update()
    {
        try {
            $query = "UPDATE " . $this->materias . "
                     SET 
                     descripcion=:descripcion,
                     codigomateria=:codigomateria,
                     horario=:horario,
                     estado=:estado,
                     aula=:aula
                     WHERE idmateria = :idmateria";

            // Prepare the query
            $stmt = $this->conn->prepare($query);

            // Sanitize and bind values
            $this->idmateria = htmlspecialchars(strip_tags($this->idmateria));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $this->codigomateria = htmlspecialchars(strip_tags($this->codigomateria));
            $this->horario = htmlspecialchars(strip_tags($this->horario));
            $this->estado = htmlspecialchars(strip_tags($this->estado));
            $this->aula = htmlspecialchars(strip_tags($this->aula));

            // Bind the values
            $stmt->bindParam(':idmateria', $this->idmateria);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':codigomateria', $this->codigomateria);
            $stmt->bindParam(':horario', $this->horario);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':aula', $this->aula);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $exception) {
            // Handle errors
            return false;
        }

        return false;
    }
    public function updateEstado()
{
    try {
        $query = "UPDATE " . $this->materias . "
                 SET 
                 estado=:estado
                 WHERE idmateria = :idmateria";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize and bind values
        $this->idmateria = htmlspecialchars(strip_tags($this->idmateria));
        $this->estado = htmlspecialchars(strip_tags($this->estado));

        // Bind the values
        $stmt->bindParam(':idmateria', $this->idmateria);
        $stmt->bindParam(':estado', $this->estado);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }
    } catch (PDOException $exception) {
        // Handle errors
        return false;
    }

    return false;
}

}

?>
