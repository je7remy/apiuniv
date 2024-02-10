<?php

include_once '../config/core.php';
include_once 'materias.php';

$database = new Database();
$db = $database->getConnection();
use \Firebase\JWT\JWT;

$datos = new materias($db);

$data = json_decode(file_get_contents("php://input"));
$jwt = isset($data->jwt) ? $data->jwt : "";

if ($jwt) {
    try {
      
        $datos->idmateria = $data->idmateria;
        $datos->descripcion = $data->descripcion;
        $datos->codigomateria = $data->codigomateria;
        $datos->horario = $data->horario;
        $datos->estado = $data->estado;
        $datos->aula = $data->aula;

        // Llamar al método update para actualizar el registro
        $dat = $datos->update();

        if ($dat) {
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