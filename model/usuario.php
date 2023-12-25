<?php

require_once 'database.php';

class usuario{

    public function __construct(){
        $database = new Database();
        $this->db = $database->getDB();
    }

    public function validarUsuario($email, $password){
        $sql = "SELECT * FROM PERSONA_RESPONSABLE WHERE PERSONAEMAIL = ? AND PERSONACLAVE = ?";

        $stmt = $this->db->prepare($sql);
        
        if($stmt === false) {
            // Manejar error - también podría ser debido a un error de sintaxis en sql
            $error = $this->db->errno . ' ' . $this->db->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
            return false;
        }
    
        $stmt->bind_param('ss', $email, $password);
    
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        if($result->num_rows > 0){
            // Las credenciales son válidas
            $usuario = $result->fetch_assoc();

            return array(
                "IDPERSONA" => $usuario["IDPERSONA"],
                "IDORGRESP" => $usuario["IDORGRESP"]
            );
        }else{
            // Las credenciales no son válidas
            return false;
        }

        $this->db->close();
    }

    public function crearUsuario($nombre, $email, $rut, $rol, $direccion, $password){
        // Hash the password using PHP's built-in bcrypt algorithm
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Prepare the SQL statement
        $stmt = $this->db->prepare("INSERT INTO persona_responsable (PERSONANOMB, PERSONAEMAIL, PERSONARUT, PERSONAROL, PERSONADIR, PERSONACLAVE) VALUES (?, ?, ?, ?, ?, ?)");
    
        // Bind the parameters
        $stmt->bind_param("ssssss", $nombre, $email, $rut, $rol, $direccion, $hashedPassword);
    
        // Execute the SQL statement
        if($stmt->execute()){
            echo "Usuario creado exitosamente.";
        }else{
            echo "Error: " . $stmt->error;
        }
    
        // Close the statement
        $stmt->close();
    }
}