<?php


include_once '../config/core.php';
include_once 'user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate user object
$user = new User($db);

// check email existence here

// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$user->usuario = $data->codusuario;



$usuario_exists = $user->usuarioExists();

   // generate jwt will be here
// generate json web token
use \Firebase\JWT\JWT;     

// check if email exists and if password is correct
if($usuario_exists){

 $token = array(
  "iat" => $issued_at,
  "exp" => $expiration_time,
  "iss" => $issuer,
  "data" => array(
   "id_usuario" => $user->id_usuario,
   "nombre" => $user->nombre,
   "tipo" => $user->tipo,
   //"jwt"=>""
  )
);

   
    $password =  $data->codclave;
  
   if ($user->clave ==  $password ) {
    // set response code
    http_response_code(200);

    // generate jwt
    $jwt = JWT::encode($token, $key);
    
    echo json_encode(
            array(
                "status" => true,
                "jwt" =>  $jwt,
                "id_usuario" => $user->id_usuario,
                "nombre" => $user->nombre,
                "tipo" => $user->tipo
                
            )
        );
    }else{
        // set response code
        http_response_code(200);
                
        // show error message
            $json = array(
            'status' 	=> false,
            'errCode' 	=> '00',
            'msg' 		=> 'Usuario o clave no registrados'
            );
        echo json_encode($json);	

    }
 
}
 
// login failed will be here
// login failed
else{
 
    // set response code
    http_response_code(200);
		 
    // show error message
        $json = array(
        'status' 	=> false,
        'errCode' 	=> '00',
        'msg' 		=> 'Usuario o clave no registrados'
        );
       echo json_encode($json);	
}
?>