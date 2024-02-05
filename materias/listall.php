<?php

include_once '../config/core.php';
include_once 'materias.php';

$database = new Database();
$db = $database->getConnection();
use \Firebase\JWT\JWT;

$datosObj = new materias($db);

$data = json_decode(file_get_contents("php://input"));
$jwt = isset($data->jwt) ? $data->jwt : "";

if ($jwt) {
    try {
        // Verificar y decodificar el JWT
        // ...

        // Obtener todos los datos
        $stmt = $datosObj->getAll();
        $itemCount = $stmt->rowCount();

        if ($itemCount > 0) {
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Establecer el código de respuesta
            http_response_code(200);

            $json = array(
                "status"  => true,
                "errcode" => "01",
                "msg"     => "Datos procesados",
                "data"    => $datos
            );

            // Respuesta en formato JSON
            echo json_encode($json);
        } else {
            // Establecer el código de respuesta
            http_response_code(200);

            // Mostrar mensaje de error
            $json = array(
                "status"  => true,
                "errCode" => "00",
                "msg"     => "No existen datos"
            );

            echo json_encode($json);
        }
    } catch (Exception $e) {
        // Imprimir o registrar el mensaje de la excepción para depuración
        // ...

        // Establecer el código de respuesta
        http_response_code(200);

        $json = array(
            "status"  => false,
            "errCode" => "05",
            "msg"     => "Error interno del servidor"
        );

        echo json_encode($json);
    }
} else {
    // Establecer el código de respuesta
    http_response_code(200);

    // Indicar acceso no autorizado
    $json = array(
        "status"  => false,
        "errCode" => "00",
        "msg"     => "Acceso no autorizado"
    );

    echo json_encode($json);
}
?>
