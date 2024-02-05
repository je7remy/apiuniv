<?php

class Estudiantes
{
    private $conn;
    private $table = "estudiantes";
    public $idestudiante;
    public $matricula;
    public $nombre;
    public $apellidos;
    public $direccion;
    public $telefono;
    public $carrera;
    public $estado;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        try {
            $query = "SELECT * FROM " . $this->table;
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
            $query = "SELECT * FROM " . $this->table . " WHERE idestudiante = :idestudiante";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':idestudiante', $this->idestudiante);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $exception) {
            // Handle errors
            return false;
        }
    }

    // create new record
    public function create()
    {
        try {
            // Insert query
            $query = "INSERT INTO " . $this->table . "(matricula, nombre, apellidos, direccion, telefono, carrera, estado) 
                      VALUES (:matricula, :nombre, :apellidos, :direccion, :telefono, :carrera, :estado)";

            // Prepare the query
            $stmt = $this->conn->prepare($query);

            // Sanitize and bind values
            $this->matricula = htmlspecialchars(strip_tags($this->matricula));
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->apellidos = htmlspecialchars(strip_tags($this->apellidos));
            $this->direccion = htmlspecialchars(strip_tags($this->direccion));
            $this->telefono = htmlspecialchars(strip_tags($this->telefono));
            $this->carrera = htmlspecialchars(strip_tags($this->carrera));
            $this->estado = htmlspecialchars(strip_tags($this->estado));

            $stmt->bindParam(':matricula', $this->matricula);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellidos', $this->apellidos);
            $stmt->bindParam(':direccion', $this->direccion);
            $stmt->bindParam(':telefono', $this->telefono);
            $stmt->bindParam(':carrera', $this->carrera);
            $stmt->bindParam(':estado', $this->estado);

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

    // update a record
    public function update()
    {
        try {
            $query = "UPDATE " . $this->table . "
                     SET 
                     matricula=:matricula,
                     nombre=:nombre,
                     apellidos=:apellidos,
                     direccion=:direccion,
                     telefono=:telefono,
                     carrera=:carrera,
                     estado=:estado
                     WHERE idestudiante = :idestudiante";

            // Prepare the query
            $stmt = $this->conn->prepare($query);

            // Sanitize and bind values
            $this->idestudiante = htmlspecialchars(strip_tags($this->idestudiante));
            $this->matricula = htmlspecialchars(strip_tags($this->matricula));
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->apellidos = htmlspecialchars(strip_tags($this->apellidos));
            $this->direccion = htmlspecialchars(strip_tags($this->direccion));
            $this->telefono = htmlspecialchars(strip_tags($this->telefono));
            $this->carrera = htmlspecialchars(strip_tags($this->carrera));
            $this->estado = htmlspecialchars(strip_tags($this->estado));

            // Bind the values
            $stmt->bindParam(':idestudiante', $this->idestudiante);
            $stmt->bindParam(':matricula', $this->matricula);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellidos', $this->apellidos);
            $stmt->bindParam(':direccion', $this->direccion);
            $stmt->bindParam(':telefono', $this->telefono);
            $stmt->bindParam(':carrera', $this->carrera);
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

    // update estado
    public function updateEstado()
    {
        try {
            $query = "UPDATE " . $this->table . "
                     SET 
                     estado=:estado
                     WHERE idestudiante = :idestudiante";

            // Prepare the query
            $stmt = $this->conn->prepare($query);

            // Sanitize and bind values
            $this->idestudiante = htmlspecialchars(strip_tags($this->idestudiante));
            $this->estado = htmlspecialchars(strip_tags($this->estado));

            // Bind the values
            $stmt->bindParam(':idestudiante', $this->idestudiante);
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
