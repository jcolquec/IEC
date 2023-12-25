<?php

class datos {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getDB();
    }

    public function procesarArchivoCSV($rutaArchivo) {
        // Aquí puedes implementar la lógica para procesar el archivo CSV
        // Por ejemplo, podrías abrir el archivo, leer cada línea, y guardar cada línea en un array
        $file = fopen($rutaArchivo, 'r');
        $datos = [];
        // Verificar si el archivo se abrió correctamente
        if ($file) {
            $firstLine = true;
            // Leer cada línea del archivo
            while (($data = fgetcsv($file)) !== false) {
        
                if ($firstLine) {
                    $firstLine = false;
                    continue;
                }
        
                // Obtener cada dato por separado
                // Obtener la fecha
                $fecha = $data[0] . '-' . str_pad($data[1], 2, '0', STR_PAD_LEFT) . '-' . str_pad($data[2], 2, '0', STR_PAD_LEFT);
                
                $dato4 = $data[3];
                $dato5 = $data[4];
                $dato6 = $data[5];
                
                $datos[] = [
                    'fecha' => $fecha,
                    'precipitacion' => $dato4,
                    'temperatura_maxima' => $dato5,
                    'temperatura_minima' => $dato6
                ];
                // Imprimir los datos
                echo "Fecha: $fecha<br>";
                echo "Precipitacion: $dato4<br>";
                echo "Temperatura Maxima: $dato5<br>";
                echo "Temperatura Minima: $dato6<br>";
                echo "<br>";
            }
        
        
            // Cerrar el archivo
            fclose($file);
        } else {
            echo 'No se pudo abrir el archivo.';
        }

        return $datos;
    }

    public function guardarDatos($datos) {
        // Aquí puedes implementar la lógica para guardar los datos en la base de datos
        // Por ejemplo, podrías recorrer los datos y insertar cada fila en la base de datos

        foreach ($datos as $fila) {

            $fecha = $dato['fecha'];
            $precipitacion = $dato['precipitacion'];
            $tempMax = $dato['temperatura_maxima'];
            $tempMin = $dato['temperatura_minima'];
            $idvarmeteorologica = 1;
            // Preparar la consulta SQL
            $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
            (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA,VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL) VALUES
            ('$idestacion', '$idvarmeteorologica', '$fecha', '$hora', '$precipitacion', 'milimetros', '$tipodatotemporal')");

            // Vincular los parámetros a la consulta SQL
            //$stmt->bind_param("ss...", $fila[0], $fila[1], ...);

            // Ejecutar la consulta SQL
            $stmt->execute();
        }

        // Cerrar la conexión a la base de datos cuando hayas terminado
        $this->db->closeDB();
    }
    
}