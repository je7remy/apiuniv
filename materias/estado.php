<?php

include_once '../config/core.php';
include_once 'materias.php'; // Assuming the file is named materias.php for handling the materias table

// get database connection
$database = new Database();
$db = $database->getConnection();
use \Firebase\JWT\JWT;

// instantiate object
$materia = new materias($db); // Assuming the class is named Materia for handling the materias table

// retrieve given jwt here
// get posted data
$data = json_decode(file_get_contents("php://input"));

// get jwt
$jwt = isset($data->jwt) ? $data->jwt : "";

// decode jwt here
// if jwt is not empty
if ($jwt) {
    // if decode succeeds, show materia details
    try {
        // set materia property values
        $materia->idmateria = $data->idmateria; // Assuming idmateria is part of the data payload
        $materia->estado = $data->estado;

        // update estado in materia
        $result = $materia->updateEstado();

        // update the materia record
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
                "msg"     => "Error al actualizar estado de la materia"
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

    // tell the materia access denied
    $json = array(
        "status"  => false,
        "errCode" => "00",
        "msg"     => "Acceso denegado"
    );

    echo json_encode($json);
}
?>
