<?php
class MateriaXMaestro
{
    private $conn;
    private $materiaxmaestro = "materiaxmaestro";
    public $idmaestro;
    public $idmateria;
    public $idperiodo;
    public $anio;
    public $cuatrimestre;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getAll()
    {
        $sqlQuery = "SELECT idmaestro, idmateria, idperiodo, anio, cuatrimestre FROM $this->materiaxmaestro";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // GET ONE
    public function getOne()
    {
        $sqlQuery = "SELECT idmaestro, idmateria, idperiodo, anio, cuatrimestre FROM $this->materiaxmaestro
           WHERE idmaestro = :idmaestro";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(':idmaestro', $this->idmaestro);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function create()
    {
        try {
            $query = "INSERT INTO $this->materiaxmaestro (idmaestro, idmateria, idperiodo, anio, cuatrimestre) 
              VALUES (:idmaestro, :idmateria, :idperiodo, :anio, :cuatrimestre)";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':idmaestro', $this->idmaestro);
            $stmt->bindParam(':idmateria', $this->idmateria);
            $stmt->bindParam(':idperiodo', $this->idperiodo);
            $stmt->bindParam(':anio', $this->anio);
            $stmt->bindParam(':cuatrimestre', $this->cuatrimestre);

            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $exception) {
            // Manejar excepción
            return false;
        }

        return false;
    }

    // UPDATE
    public function update()
    {
        try {
            $query = "UPDATE $this->materiaxmaestro
      SET 
      idmateria=:idmateria,
      idperiodo=:idperiodo,
      anio=:anio,
      cuatrimestre=:cuatrimestre
      WHERE idmaestro = :idmaestro";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':idmaestro', $this->idmaestro);
            $stmt->bindParam(':idmateria', $this->idmateria);
            $stmt->bindParam(':idperiodo', $this->idperiodo);
            $stmt->bindParam(':anio', $this->anio);
            $stmt->bindParam(':cuatrimestre', $this->cuatrimestre);

            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $exception) {
            // Manejar excepción
            return false;
        }

        return false;
    }
}
?>
