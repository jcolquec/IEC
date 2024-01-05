<?php
require_once('../model/indicador.php');

class indicadorController {
    private $indicadoresModel;

    public function __construct() {
        $this->indicadoresModel = new indicador();
    }

    // Función para manejar la solicitud de cálculo de indicadores.
    public function calcularIndicadores($estacion, $tipoVariableMeteorologica) {
        // Obtén datos diarios automáticamente.
        $datosDiarios = $this->indicadoresModel->obtenerDatosDiarios($estacion, $tipoVariableMeteorologica);
        
        // Calcula los indicadores automáticamente.
        $resultadosIndicadores = $this->indicadoresModel->calcularIndicadoresClimaticos($datosDiarios);

        // Guarda o actualiza los resultados en la base de datos.
        //$this->indicadoresModel->guardarResultadosIndicadores($resultadosIndicadores);

        // Puedes redirigir a una vista específica o realizar otras acciones según tus necesidades.
        // header('Location: vista.php');
    }
}