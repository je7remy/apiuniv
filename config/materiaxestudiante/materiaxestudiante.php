<?php
class MateriaXEstudiante
{

    private $conn;
    private $materiaxestudiante = "materiaxestudiante";
    public $matricula;
    public $idmateria;
    public $idmaestro;
    public $idperiodo;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getAll()
    {
        $sqlQuery = "SELECT matricula, idmateria, idmaestro, idperiodo FROM materiaxestudiante ";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    function getOne()
    {
        $sqlQuery = "SELECT matricula, idmateria, idmaestro, idperiodo FROM materiaxestudiante
                     WHERE matricula = " . $this->matricula;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    function create()
    {
        try {
            $query = "INSERT INTO materiaxestudiante(matricula, idmateria, idmaestro, idperiodo) 
                      VALUES (:matricula, :idmateria, :idmaestro, :idperiodo)";

            $stmt = $this->conn->prepare($query);

            $this->matricula = htmlspecialchars(strip_tags($this->matricula));
            $this->idmateria = htmlspecialchars(strip_tags($this->idmateria));
            $this->idmaestro = htmlspecialchars(strip_tags($this->idmaestro));
            $this->idperiodo = htmlspecialchars(strip_tags($this->idperiodo));

            $stmt->bindParam(':matricula', $this->matricula);
            $stmt->bindParam(':idmateria', $this->idmateria);
            $stmt->bindParam(':idmaestro', $this->idmaestro);
            $stmt->bindParam(':idperiodo', $this->idperiodo);

            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $exception) {
            wh_log(date("y-m-d H:i:s") . " - " . "Error al insertar datos materiaxestudiante " . $this->matricula);
            wh_log($exception);

            return false;
        }

        return false;
    }

    public function update()
    {
        try {
            $query = "UPDATE materiaxestudiante
                      SET 
                      idmateria=:idmateria,
                      idmaestro=:idmaestro,
                      idperiodo=:idperiodo
                      WHERE matricula = :matricula";

            $stmt = $this->conn->prepare($query);

            $this->matricula = htmlspecialchars(strip_tags($this->matricula));
            $this->idmateria = htmlspecialchars(strip_tags($this->idmateria));
            $this->idmaestro = htmlspecialchars(strip_tags($this->idmaestro));
            $this->idperiodo = htmlspecialchars(strip_tags($this->idperiodo));

            $stmt->bindParam(':matricula', $this->matricula);
            $stmt->bindParam(':idmateria', $this->idmateria);
            $stmt->bindParam(':idmaestro', $this->idmaestro);
            $stmt->bindParam(':idperiodo', $this->idperiodo);

            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $exception) {
            wh_log(date("y-m-d H:i:s") . " - " . "Error al actualizar datos materiaxestudiante " . $this->matricula);
            wh_log($exception);

            return false;
        }

        return false;
    }
}
?>
