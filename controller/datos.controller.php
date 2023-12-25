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
    public function subirArchivoCSV($archivo) {
        // Verificar si se ha subido un archivo
        if (isset($archivo['tmp_name']) && !empty($archivo['tmp_name'])) {
            // Obtener la ruta temporal del archivo
            $rutaTemporal = $archivo['tmp_name'];

            // Verificar si es un archivo CSV
            if (pathinfo($archivo['name'], PATHINFO_EXTENSION) === 'csv') {
                // Generar un nombre de archivo único
                $nombreArchivo = pathinfo($archivo['name'], PATHINFO_FILENAME);
                $extensionArchivo = pathinfo($archivo['name'], PATHINFO_EXTENSION);
                $nombreArchivoUnico = $nombreArchivo . '_' . time() . '.' . $extensionArchivo;

                // Mover el archivo a la ubicación deseada
                $rutaDestino = '../datasets/' . $nombreArchivoUnico;
                if (!move_uploaded_file($rutaTemporal, $rutaDestino)) {
                    return 'Error al mover el archivo subido.';
                }

                // Procesar el archivo CSV
                $datos = $this->mode->procesarArchivoCSV($rutaDestino);

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
