<?php

include_once '../config/core.php';
include_once 'estudiantes.php'; // Assuming the file is named estudiantes.php for handling the estudiantes table

$database = new Database();
$db = $database->getConnection();
use \Firebase\JWT\JWT;

$datos = new Estudiantes($db); // Assuming the class is named Estudiantes for handling the estudiantes table

$data = json_decode(file_get_contents("php://input"));
$jwt = isset($data->jwt) ? $data->jwt : "";

if ($jwt) {
    try {
        $datos->matricula = $data->matricula;
        $datos->nombre = $data->nombre;
        $datos->apellidos = $data->apellidos;
        $datos->direccion = $data->direccion;
        $datos->telefono = $data->telefono;
        $datos->carrera = $data->carrera;
        $datos->estado = $data->estado;

        // Call the create method to insert a new record
        $result = $datos->create();

        if ($result) {
            http_response_code(200);

            $json = array(
                "status"  => true,
                "errcode" => "01",
                "msg"     => "Datos creados correctamente"
            );

            echo json_encode($json);
        } else {
            http_response_code(200);

            $json = array(
                "status"  => true,
                "errCode" => "00",
                "msg"     => "Error al crear datos en la nueva tabla"
            );
            echo json_encode($json);
        }
    } catch (Exception $e) {
        http_response_code(200);

        $json = array(
            "status"  => false,
            "errCode" => "05",
            "msg"     => "Acceso denegado"
        );

        echo json_encode($json);
    }
} else {
    http_response_code(200);

    $json = array(
        "status"  => false,
        "errCode" => "00",
        "msg"     => "Acceso denegado"
    );

    echo json_encode($json);
}
?>
