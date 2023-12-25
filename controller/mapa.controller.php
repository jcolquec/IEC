<?php
include('../model/estacion.php');


class mapaController {
    private $model;

    public function __CONSTRUCT(){
        $this->model = new estacion();
    }
    public function index() {

        // Instancia el modelo y obtiene los datos.
        
        $data = $this->model->mostrarMapa();

        // Llama a la vista para renderizar la página.
        include('../view/mapaView.php');
        
    }
    

}