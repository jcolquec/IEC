<?php
include('../model/grafico.php');

class graficoController {
    private $model;

    public function __CONSTRUCT(){
        $this->model = new grafico();
    }
    public function index() {

        // Instancia el modelo y obtiene los datos.
        session_start();
        $idorgresp = $_SESSION['IDORGRESP'];
        $idpersona = $_SESSION['IDPERSONA'];
        
        $data = $this->model->mostrarGrafico($idpersona, $idorgresp);
        
        // Llama a la vista para renderizar la página.
        include('../view/graficoView.php');
        
    }

    public function indexWithMenu() {
        // Aquí, cargarás la vista principal que incluye el menú.
        include('../view/mainView.php');
    }
}