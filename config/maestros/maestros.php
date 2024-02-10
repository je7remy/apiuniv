<?php

class Maestros
{
    private $conn;
    private $table = "maestros";
    public $idmaestro;
    public $nombre;
    public $apellidos;
    public $telefono;
    public $especialidad;
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
            $query = "SELECT * FROM " . $this->table . " WHERE idmaestro = :idmaestro";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':idmaestro', $this->idmaestro);
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
            $query = "INSERT INTO " . $this->table . "(nombre, apellidos, telefono, especialidad, estado) 
                      VALUES (:nombre, :apellidos, :telefono, :especialidad, :estado)";

            // Prepare the query
            $stmt = $this->conn->prepare($query);

            // Sanitize and bind values
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->apellidos = htmlspecialchars(strip_tags($this->apellidos));
            $this->telefono = htmlspecialchars(strip_tags($this->telefono));
            $this->especialidad = htmlspecialchars(strip_tags($this->especialidad));
            $this->estado = htmlspecialchars(strip_tags($this->estado));

            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellidos', $this->apellidos);
            $stmt->bindParam(':telefono', $this->telefono);
            $stmt->bindParam(':especialidad', $this->especialidad);
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
                     nombre=:nombre,
                     apellidos=:apellidos,
                     telefono=:telefono,
                     especialidad=:especialidad,
                     estado=:estado
                     WHERE idmaestro = :idmaestro";

            // Prepare the query
            $stmt = $this->conn->prepare($query);

            // Sanitize and bind values
            $this->idmaestro = htmlspecialchars(strip_tags($this->idmaestro));
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->apellidos = htmlspecialchars(strip_tags($this->apellidos));
            $this->telefono = htmlspecialchars(strip_tags($this->telefono));
            $this->especialidad = htmlspecialchars(strip_tags($this->especialidad));
            $this->estado = htmlspecialchars(strip_tags($this->estado));

            // Bind the values
            $stmt->bindParam(':idmaestro', $this->idmaestro);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellidos', $this->apellidos);
            $stmt->bindParam(':telefono', $this->telefono);
            $stmt->bindParam(':especialidad', $this->especialidad);
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
                     WHERE idmaestro = :idmaestro";

            // Prepare the query
            $stmt = $this->conn->prepare($query);

            // Sanitize and bind values
            $this->idmaestro = htmlspecialchars(strip_tags($this->idmaestro));
            $this->estado = htmlspecialchars(strip_tags($this->estado));

            // Bind the values
            $stmt->bindParam(':idmaestro', $this->idmaestro);
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
