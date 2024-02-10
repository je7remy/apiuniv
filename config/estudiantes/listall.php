<?php

include_once '../config/core.php';
include_once 'estudiantes.php'; // Assuming the file is named estudiantes.php for handling the estudiantes table

$database = new Database();
$db = $database->getConnection();
use \Firebase\JWT\JWT;

$datosObj = new Estudiantes($db); // Adjust the class name to match the updated Estudiantes class

$data = json_decode(file_get_contents("php://input"));
$jwt = isset($data->jwt) ? $data->jwt : "";

if ($jwt) {
    try {
        // Verify and decode the JWT
        // ...

        // Get all data
        $stmt = $datosObj->getAll();
        $itemCount = $stmt->rowCount();

        if ($itemCount > 0) {
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Set the response code
            http_response_code(200);

            $json = array(
                "status"  => true,
                "errcode" => "01",
                "msg"     => "Datos procesados",
                "data"    => $datos
            );

            // Response in JSON format
            echo json_encode($json);
        } else {
            // Set the response code
            http_response_code(200);

            // Show error message
            $json = array(
                "status"  => true,
                "errCode" => "00",
                "msg"     => "No existen datos"
            );

            echo json_encode($json);
        }
    } catch (Exception $e) {
        // Print or log the exception message for debugging
        // ...

        // Set the response code
        http_response_code(200);

        $json = array(
            "status"  => false,
            "errCode" => "05",
            "msg"     => "Error interno del servidor"
        );

        echo json_encode($json);
    }
} else {
    // Set the response code
    http_response_code(200);

    // Indicate unauthorized access
    $json = array(
        "status"  => false,
        "errCode" => "00",
        "msg"     => "Acceso no autorizado"
    );

    echo json_encode($json);
}
?>
