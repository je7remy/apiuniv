<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private  $table_name = "usuario";
    public   $id_usuario ;
    public   $nombre ;
    public   $tipo ;
    public   $clave;
    public    $usuario;

  
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
 
        // GET ALL
  
function usuarioExists(){
 
    // query to check if email exists
    $query = "SELECT id_usuario, nombre, usuario, clave, tipo, estado FROM usuario 
     WHERE  usuario = ? and estado = 'A'
    LIMIT 0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
   
    // sanitize
    $this->usuario=htmlspecialchars(strip_tags($this->usuario));
 
    // bind given email value
    $stmt->bindParam(1, $this->usuario);
  
    
    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num>0){
 
        // get record details / values
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // assign values to object properties
        $this->id_usuario = $row['id_usuario'];
        $this->nombre = $row['nombre'];
        $this->tipo = $row['tipo'];
         $this->clave = $row['clave'];
        
        
 
        // return true because email exists in the database
        return true;
    }
 
    // return false if email does not exist in the database
    return false;
}
 

}