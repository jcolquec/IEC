<?php

// FILEPATH: /c:/wamp64/www/IEC/controller/datos.controller.php
include('../model/datos.php');

class datosController {
    
    private $model;

    public function __construct() {
        $this->model = new datos();
    }

    public function index() {
        session_start();
        // Aquí, cargarás la vista principal que incluye el menú.
        include('../view/datosView.php');
    }
    public function subirArchivoCSV() {
        session_start();

        $idOrgResp = $_SESSION['IDORGRESP'];
        $idPersona = $_SESSION['IDPERSONA'];
        
        // Verificar si se ha subido un archivo
        if (isset($_FILES['archivo']['tmp_name']) && !empty($_FILES['archivo']['tmp_name'])) {
            // Obtener la ruta temporal del archivo
            $rutaTemporal = $_FILES['archivo']['tmp_name'];
            
            // Verificar si es un archivo CSV
            if (pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION) === 'csv') { 
                // Procesar el archivo CSV
                $datos = $this->model->procesarArchivoCSV($rutaTemporal);
                // Obtener la idEstacion
                //$idEstacion = $this->model->obtenerIdEstacion($idPersona, $idOrgResp);
                // Guardar los datos en la base de datos utilizando el modelo
                $this->model->guardarDatos($datos);

                // Retornar una respuesta exitosa
                return 'Archivo CSV subido y procesado correctamente.';
            } else {
                // Retornar un mensaje de error si el archivo no es un CSV
                return 'El archivo debe ser de tipo CSV.';
            }
        } else {
            // Retornar un mensaje de error si no se ha subido ningún archivo
            return 'No se ha subido ningún archivo.';
        }
    }

}

?>
