<?php 
    class usuario{
        
        // database connection and table name
        private $conn;
        private $table_name = "usuario";
       public $id_usuario;
       public $nombre;
       public $usuario;
       public $clave;
       public $tipo;
       public $estado;
 
     

     // constructor
    public function __construct($db){
     $this->conn = $db;
     }
     
     
     // GET ALL
     function getAll(){
            $sqlQuery = "SELECT id_usuario, nombre, usuario, clave, tipo, estado FROM usuario ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // GET ONE
        function getOne(){
           $sqlQuery = "SELECT id_usuario, nombre, usuario, clave, tipo, estado FROM usuario
           WHERE id_usuario = ". $this->id_usuario ;
           $stmt = $this->conn->prepare($sqlQuery);
           $stmt->execute();
           return $stmt;
       }
    

       // create new  record
       function create(){
           try{
           // insert query
              $query = "INSERT INTO usuario( nombre, usuario, clave, tipo, estado) 
              VALUES (:nombre, :usuario, :clave, :tipo, :estado)";
              
              
           // prepare the query
           $stmt = $this->conn->prepare($query);
       
           // sanitize
           
       $this->nombre=htmlspecialchars(strip_tags($this->nombre));
       $this->usuario=htmlspecialchars(strip_tags($this->usuario));
       $this->clave=htmlspecialchars(strip_tags($this->clave));
       $this->tipo=htmlspecialchars(strip_tags($this->tipo));
       $this->estado=htmlspecialchars(strip_tags($this->estado));


       $stmt->bindParam(':nombre', $this->nombre);
       $stmt->bindParam(':usuario', $this->usuario);
       $stmt->bindParam(':clave', $this->clave);
       $stmt->bindParam(':tipo', $this->tipo);
       $stmt->bindParam(':estado', $this->estado);
           
           // execute the query, also check if query was successful
           if($stmt->execute()){
            
               return true;
           }
           
       }catch(PDOException $exception){
           wh_log( date("y-m-d H:i:s"). " - ".   "Error al insertar datos usuario 5 " .  $this->usuario);
           wh_log( $exception   );
           
           
           return false;
       }
       
           return false;
       } 
   // update() method will be here
   // update a  record
   public function update(){
    
       try{
        
       $query = "UPDATE usuario
       SET 
      nombre=:nombre,
      usuario=:usuario,
      clave=:clave,
      tipo=:tipo,
      estado=:estado
      WHERE id_usuario = :id_usuario";
                  
       // prepare the query
       $stmt = $this->conn->prepare($query);
       
      
       $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
       $this->nombre=htmlspecialchars(strip_tags($this->nombre));
       $this->usuario=htmlspecialchars(strip_tags($this->usuario));
       $this->clave=htmlspecialchars(strip_tags($this->clave));
       $this->tipo=htmlspecialchars(strip_tags($this->tipo));
       $this->estado=htmlspecialchars(strip_tags($this->estado));


       // bind the values
      
       $stmt->bindParam(':id_usuario', $this->id_usuario);
       $stmt->bindParam(':nombre', $this->nombre);
       $stmt->bindParam(':usuario', $this->usuario);
       $stmt->bindParam(':clave', $this->clave);
       $stmt->bindParam(':tipo', $this->tipo);
       $stmt->bindParam(':estado', $this->estado);
       // execute the query
       if($stmt->execute()){
           return true;
       }
       
   }catch(PDOException $exception){
       wh_log( date("y-m-d H:i:s"). " - ".   "Error al insertar datos usuario 5 " );
       wh_log( $exception   );
       
       
       return false;
   }
       return false;
   }
   
   
   
public function updateestado(){
  
  
  $query = "UPDATE usuario
  SET 
 estado=:estado
 WHERE id_usuario = :id_usuario"; 
          
  // prepare the query 
  $stmt = $this->conn->prepare($query); 
  
  // sanitize 
  $this-> estado=htmlspecialchars(strip_tags($this->estado)); 
   
  
  // bind the values 
  $stmt->bindParam(':estado', $this->estado); 
  // unique ID of record to be edited 
  $stmt->bindParam(':id_usuario', $this->id_usuario); 
  
  // execute the query 
  if($stmt->execute()){ 
      return true; 
  } 
  
  return false; 
} 
} 
?> 
 
   