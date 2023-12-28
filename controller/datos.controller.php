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
        $idOrgResp = $_SESSION['IDORGRESP'];
        // Obtener las estaciones de la base de datos
        $estaciones = $this->model->getEstacionesOrgResp($idOrgResp);
        
        // Aquí, cargarás la vista principal que incluye el menú.
        include('../view/datosView.php');
    }
    public function subirArchivoCSV() {
        session_start();

        $idOrgResp = $_SESSION['IDORGRESP'];
        $idPersona = $_SESSION['IDPERSONA'];
        
        $tipoDatos = $_POST['tipo-datos'];
        $tipoVariable = $_POST['tipo-variable'];
        $estacion = $_POST['estacion'];
        // Verificar si se ha subido un archivo
        if (isset($_FILES['archivo']['tmp_name']) && !empty($_FILES['archivo']['tmp_name'])) {
            // Obtener la ruta temporal del archivo
            $rutaTemporal = $_FILES['archivo']['tmp_name'];
            
            // Verificar si es un archivo CSV
            if (pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION) === 'csv') { 
                
                if($tipoDatos == 'Diario'){
                    // Procesar el archivo CSV
                    $datos = $this->model->procesarArchivoCSVDiario($rutaTemporal, $tipoVariable);
                }else if($tipoDatos == 'Horario'){
                    // Procesar el archivo CSV
                    $datos = $this->model->procesarArchivoCSVHorario($rutaTemporal, $tipoVariable);
                }   
                
                var_dump($datos);
                // Obtener la idEstacion
                //$idEstacion = $this->model->obtenerIdEstacion($idPersona, $idOrgResp);
                //Guardar los datos en la base de datos utilizando el modelo
                $this->model->guardarDatos($datos, $estacion);

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
