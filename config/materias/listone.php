<?php

include_once '../config/core.php';
include_once 'materias.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
use \Firebase\JWT\JWT;

// instantiate object
$materias = new materias($db);

// retrieve given jwt here
// get posted data
$data = json_decode(file_get_contents("php://input"));

// get jwt
$jwt = isset($data->jwt) ? $data->jwt : "";

// decode jwt here
// if jwt is not empty
if ($jwt) {

    // if decode succeed, show datos details
    try {
        // Set the idmateria property
        $materias->idmateria = $data->idmateria;

        // Get data based on idmateria
        $stmt = $materias->getOne();
        $itemCount = $stmt->rowCount();

        if ($itemCount > 0) {
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // set response code
            http_response_code(200);

            $json = array(
                "status"  => true,
                "errcode" => "01",
                "msg"     => "Datos procesados",
                "data"    => $datos
            );

            // response in json format
            echo json_encode($json);
        } else {
            // set response code
            http_response_code(200);

            // show error message
            $json = array(
                "status"  => true,
                "errCode" => "00",
                "msg"     => "No Existen datos"
            );

            echo json_encode($json);
        }
    }

    // if decode fails, it means jwt is invalid
    catch (Exception $e) {

        // set response code
        http_response_code(200);

        $json = array(
            "status"  => false,
            "errCode" => "05",
            "msg"     => "Acceso denegado"
        );

        echo json_encode($json);
    }
}

// show error message if jwt is empty
else {

    // set response code
    http_response_code(200);

    // tell the datos access denied
    $json = array(
        "status"  => false,
        "errCode" => "00",
        "msg"     => "Acceso denegado"
    );

    echo json_encode($json);
}
?>
