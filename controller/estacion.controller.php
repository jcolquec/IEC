<?php
    require_once '../model/estacion.php';

    class estacionController {
        private $model;

        public function __CONSTRUCT(){
            $this->model = new estacion();
        }
        public function index() {
            
            // Instancia el modelo y obtiene los datos.
            
            $data = $this->model->mostrarEstacion();

            // Llama a la vista para renderizar la página.
            include('../view/estacionView.php');
            
        }


        public function mostrarEstacion() {
            session_start();
            $model = new estacion();

            $idpersona = $_SESSION['IDPERSONA'];
            $idorgresp = $_SESSION['IDORGRESP'];
            $estaciones = $model->obtenerEstacion($idpersona, $idorgresp);
            

            include '../view/estacionView.php'; // Incluye la vista y pasa los datos
        }

        public function verDetalle() {
            
            session_start();
            if (isset($_GET['id'])) {
                
                $estacionId = $_GET['id'];
                // Instanciar el modelo
                $model = new estacion();
                
                // Debes incluir el código para obtener los detalles de la estación desde el modelo.
                // Reemplaza esto con tu lógica de modelo real.
                
                $detalles = $model->obtenerDetalleEstacion($estacionId);
                // Renderiza una vista para mostrar los detalles.
                include ('../view/detalleEstacionView.php');
            }
        }

        public function mostrarMapa() {
            session_start();

            $idpersona = $_SESSION['IDPERSONA'];
            $idorgresp = $_SESSION['IDORGRESP'];
            $estacionModel = new estacion();
            $estaciones = $estacionModel->obtenerUbicacionEstaciones($idpersona, $idorgresp);
    
            // Llama a la vista y pasa los datos de las estaciones.
            include '../view/mapaView.php';
        }
    }