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
        $stmt = $materiaXMaestro->getAll();
        $itemCount = $stmt->rowCount();

        if ($itemCount > 0) {
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            http_response_code(200);

            $json = array(
                "status" => true,
                "errcode" => "01",
                "msg" => "Datos procesados",
                "data" => $datos
            );

            echo json_encode($json);
        } else {
            http_response_code(200);
            $json = array(
                "status" => true,
                "errCode" => "00",
                "msg" => "No existen datos"
            );

            echo json_encode($json);
        }
    } catch (Exception $e) {
        http_response_code(200);
        $json = array(
            "status" => false,
            "errCode" => "05",
            "msg" => "Acceso denegado"
        );

        echo json_encode($json);
    }
} else {
    http_response_code(200);
    $json = array(
        "status" => false,
        "errCode" => "00",
        "msg" => "Acceso denegado"
    );

    echo json_encode($json);
}
?>
