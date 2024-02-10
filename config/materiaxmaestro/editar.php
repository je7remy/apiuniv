<?php
include_once '../config/core.php';
include_once 'materiaxmaestro.php';

$database = new Database();
$db = $database->getConnection();
use \Firebase\JWT\JWT;

$materiaXMaestro = new MateriaXMaestro($db);

$data = json_decode(file_get_contents("php://input"));
$jwt = isset($data->jwt) ? $data->jwt : "";

if ($jwt) {
    try {
        $materiaXMaestro->idmaestro = $data->idmaestro;
        $materiaXMaestro->idmateria = $data->idmateria;
        $materiaXMaestro->idperiodo = $data->idperiodo;
        $materiaXMaestro->anio = $data->anio;
        $materiaXMaestro->cuatrimestre = $data->cuatrimestre;

        $dat = $materiaXMaestro->update();

        if ($dat) {
            http_response_code(200);

            $json = array(
                "status" => true,
                "errcode" => "01",
                "msg" => "Datos procesados correctamente"
            );

            echo json_encode($json);
        } else {
            http_response_code(200);

            $json = array(
                "status" => true,
                "errCode" => "00",
                "msg" => "Error al actualizar datos MateriaXMaestro"
            );

            echo json_encode($json);
        }
    } catch (Exception $e) {
        http_response_code(200);

        $json = array(
            "status" => false,
            "errCode" => "00",
            "msg" => "Acceso denegado"
        );

        echo json_encode($json);
    }
} else {
    http_response_code(200);

    $json = array(
        "status" => false,
        "errCode" => "05",
        "msg" => "Acceso denegado"
    );

    echo json_encode($json);
}
?>
