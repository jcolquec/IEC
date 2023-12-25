<?php

include('../model/usuario.php');

class usuarioController {
    private $model;


    public function __CONSTRUCT(){
        $this->model = new usuario();
    }

    public function login() {
        // Puedes cargar la vista de la página de inicio aquí.
        // Por ejemplo:
        include('../view/loginView.php'); // Reemplaza con la vista real de inicio.
    }

    public function validarCredenciales() {
        $email = $_POST['username'];
        $password = $_POST['pass'];

        $usuario = new usuario();
        $result = $usuario->validarUsuario($email, $password);

        if($result){
            
            session_start();
            $_SESSION['IDPERSONA'] = $result['IDPERSONA'];
            $_SESSION['IDORGRESP'] = $result['IDORGRESP'];

            include('../view/inicioView.php'); // Reemplaza con la vista real de inicio.
        }else{
            
            // Puedes cargar la vista de la página de inicio aquí.
            // Por ejemplo:
            include('../view/loginView.php'); // Reemplaza con la vista real de inicio.
            
        }
    }

    public function mostrarFormRegistro() {
        // Puedes cargar la vista de la página de inicio aquí.
        // Por ejemplo:
        include('../view/registroView.php'); // Reemplaza con la vista real de inicio.
    }
    public function registrarUsuario() {
        $nombre = $_POST['nombre'];
        $email = $_POST['correo'];
        $rut = $_POST['rut'];
        $rol = $_POST['rol'];
        $direccion = $_POST['direccion'];
        $password = $_POST['clave'];
    
        $usuario = new usuario();
        $result = $usuario->crearUsuario($nombre, $email, $rut, $rol, $direccion, $password);
    
        if($result){
            echo "Usuario registrado exitosamente.";
            include('../view/loginView.php'); // Reemplaza con la vista real de inicio.
        }else{
            echo "Hubo un error al registrar el usuario.";
            include('../view/registroView.php'); // Reemplaza con la vista real de registro.
        }
    }
}
?>