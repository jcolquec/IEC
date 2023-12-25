<?php
require_once('../controller/indicador.controller.php');
// Ejemplo de cómo usar el controlador para calcular indicadores.
$indicadoresController = new indicadorController();
$indicadoresController->calcularIndicadores();