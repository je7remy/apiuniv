<?php

include_once '../config/core.php';
include_once 'estudiantes.php'; 

$database = new Database();
$db = $database->getConnection();
use \Firebase\JWT\JWT;

$datos = new Estudiantes($db); 

$data = json_decode(file_get_contents("php://input"));
$jwt = isset($data->jwt) ? $data->jwt : "";

if ($jwt) {
    try {
        $datos->idestudiante = $data->idestudiante;
        $datos->matricula = $data->matricula;
        $datos->nombre = $data->nombre;
        $datos->apellidos = $data->apellidos;
        $datos->direccion = $data->direccion;
        $datos->telefono = $data->telefono;
        $datos->carrera = $data->carrera;
        $datos->estado = $data->estado;

        // Call the update method to update the record
        $result = $datos->update();

        if ($result) {
            http_response_code(200);

            $json = array(
                "status"  => true,
                "errcode" => "01",
                "msg"     => "Datos actualizados correctamente"
            );

            echo json_encode($json);
        } else {
            http_response_code(200);

            $json = array(
                "status"  => true,
                "errCode" => "00",
                "msg"     => "Error al actualizar datos en la nueva tabla"
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
