<?php

include_once '../config/core.php';
include_once 'materiaxestudiante.php';

$database = new Database();
$db = $database->getConnection();
use \Firebase\JWT\JWT;

$datos = new materiaxestudiante($db);

$data = json_decode(file_get_contents("php://input"));
$jwt = isset($data->jwt) ? $data->jwt : "";

if ($jwt) {
    try {
        // Asignar valores desde el JSON
       
        $datos->idmateria = $data->idmateria;
        $datos->idmaestro = $data->idmaestro;
        $datos->idperiodo = $data->idperiodo;

        // Llamar al método create para insertar el nuevo registro
        $dat = $datos->create();

        if ($dat) {
            http_response_code(200);

            $json = array(
                "status"  => true,
                "errcode" => "01",
                "msg"     => "Datos insertados correctamente"
            );

            echo json_encode($json);
        } else {
            http_response_code(200);

            $json = array(
                "status"  => true,
                "errCode" => "00",
                "msg"     => "Error al insertar datos en la nueva tabla"
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
