    <?php

    include_once '../config/core.php';
    include_once 'periodos_academicos.php';
   
    
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
    use \Firebase\JWT\JWT;
    // instantiate object
    $periodo_academico = new PeriodoAcademico($db);
    
    // retrieve given jwt here
    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // get jwt
    $jwt = isset($data->jwt) ? $data->jwt : "";
    
    // decode jwt here
    // if jwt is not empty
    if ($jwt) {
        // if decode succeed, show periodo_academico details
        try {
            // set periodo_academico property values
            $periodo_academico->idperiodo = $data->idperiodo;
            $periodo_academico->estado = $data->estado;
    
            // update estado in periodo_academico
            $dat = $periodo_academico->updateestado();
    
            // update the periodo_academico record
            if ($dat) {
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
                    "msg"     => "Error al actualizar estado del periodo académico"
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
    
        // tell the periodo_academico access denied
        $json = array(
            "status"  => false,
            "errCode" => "00",
            "msg"     => "Acceso denegado"
        );
    
        echo json_encode($json);
    }
    ?>
    