<?php

include_once '../config/core.php';
include_once 'maestros.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
use \Firebase\JWT\JWT;

// instantiate object
$maestro = new Maestros($db);

// retrieve given jwt here
// get posted data
$data = json_decode(file_get_contents("php://input"));

// get jwt
$jwt = isset($data->jwt) ? $data->jwt : "";

// decode jwt here
// if jwt is not empty
if ($jwt) {
    // if decode succeeds, show maestro details
    try {
        // set maestro property values
        $maestro->idmaestro = $data->idmaestro; // Assuming idmaestro is part of the data payload
        $maestro->estado = $data->estado;

        // update estado in maestro
        $result = $maestro->updateEstado();

        // update the maestro record
        if ($result) {
            // set response code
            http_response_code(200);

            $json = array(
                "status"  => true,
                "errcode" => "01",
                "msg"     => "Datos procesados correctamente"
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
                "msg"     => "Error al actualizar estado del maestro"
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

    // tell the maestro access denied
    $json = array(
        "status"  => false,
        "errCode" => "00",
        "msg"     => "Acceso denegado"
    );

    echo json_encode($json);
}
?>
