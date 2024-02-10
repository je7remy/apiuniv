<?php

include_once '../config/core.php';
include_once 'estudiantes.php'; // Assuming the file is named estudiantes.php for handling the estudiantes table

// get database connection
$database = new Database();
$db = $database->getConnection();
use \Firebase\JWT\JWT;

// instantiate object
$estudiantes = new Estudiantes($db); // Assuming the class is named Estudiantes for handling the estudiantes table

// retrieve given jwt here
// get posted data
$data = json_decode(file_get_contents("php://input"));

// get jwt
$jwt = isset($data->jwt) ? $data->jwt : "";

// decode jwt here
// if jwt is not empty
if ($jwt) {

    // if decode succeeds, show datos details
    try {
        // Set the idestudiante property
        $estudiantes->idestudiante = $data->idestudiante;

        // Get data based on idestudiante
        $stmt = $estudiantes->getOne();
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
