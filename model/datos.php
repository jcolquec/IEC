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

            // Leer la primera línea para obtener las cabeceras
            $cabeceras = fgetcsv($file, 0, ';');
            var_dump($cabeceras);
            // Determinar el tipo de archivo basándose en las cabeceras
            if (in_array('precipitacion', $cabeceras)) {
                
                // Procesar archivo de precipitación
                // Leer cada línea del archivo
                while (($data = fgetcsv($file, 0, ';')) !== false) {
                    // Obtener cada dato por separado
                    $fecha = $data[0];
                    $precipitacion = $data[1];
                    
                    $datos[] = [
                        'fecha' => $fecha,
                        'precipitacion' => $precipitacion,
                    ];
                }
            } elseif (in_array('temperatura_maxima', $cabeceras) && in_array('temperatura_minima', $cabeceras)) {
                // Procesar archivo de temperatura
                // Leer cada línea del archivo
                while (($data = fgetcsv($file)) !== false) {
                    // Obtener cada dato por separado
                    $fecha = $data[0];
                    $temperatura_maxima = $data[1];
                    $temperatura_minima = $data[2];
                    
                    $datos[] = [
                        'fecha' => $fecha,
                        'temperatura_maxima' => $temperatura_maxima,
                        'temperatura_minima' => $temperatura_minima,
                    ];
                }
            } elseif (in_array('precipitacion', $cabeceras) && in_array('temperatura_maxima', $cabeceras) && in_array('temperatura_minima', $cabeceras)) {
                // Procesar archivo de temperatura y precipitación
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
            
            }
        
            var_dump($datos);
            // Cerrar el archivo
            fclose($file);
        } else {
            echo 'No se pudo abrir el archivo.';
        }

        return $datos;
    }

    public function obtenerIdEstacion($idPersona, $idOrgResp) {
        // Aquí puedes implementar la lógica para obtener la idEstacion
        // Por ejemplo, podrías consultar la base de datos para obtener la idEstacion
        $stmt = $this->db->prepare("SELECT IDESTACION FROM estacion 
        WHERE IDPERSONA = ? AND IDORGRESP = ?");
        $stmt->bind_param("ss", $idPersona, $idOrgResp);
        $stmt->execute();
        $result = $stmt->get_result();
        $idestacion = $result->fetch_assoc();
        return $idestacion;
    }

    public function guardarDatos($datos) {
        // Aquí puedes implementar la lógica para guardar los datos en la base de datos
        // Por ejemplo, podrías recorrer los datos y insertar cada fila en la base de datos
        $hora = '00:00:00';
        $idestacion = 1;
        $tipodatotemporal = 'diario';
        foreach ($datos as $dato) {
            $fecha = $dato['fecha'];
            $precipitacion = isset($dato['precipitacion']) ? $dato['precipitacion'] : null;
            $tempMax = isset($dato['temperatura_maxima']) ? $dato['temperatura_maxima'] : null;
            $tempMin = isset($dato['temperatura_minima']) ? $dato['temperatura_minima'] : null;
            
        
            // Preparar la consulta SQL
            if ($precipitacion !== null && $tempMax === null && $tempMin === null) {
                
                $idvarmeteorologica = 1;

                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL) 
                VALUES (?, ?, ?, ?, ?, 'milimetros', ?)");
                $stmt->bind_param("iissss", $idestacion, $idvarmeteorologica, $fecha, $hora, $precipitacion, $tipodatotemporal);
                $stmt->execute();
            }
        
            if ($precipitacion === null && $tempMax !== null && $tempMin !== null) {
                $idvarmeteorologica = 2;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL)
                VALUES (?, ?, ?, ?, ?, 'grados celsius', ?)");
                $stmt->bind_param("iissis", $idestacion, $idvarmeteorologica, $fecha, $hora, $tempMax, $tipodatotemporal);
                $stmt->execute();

                $idvarmeteorologica = 3;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL)
                VALUES (?, ?, ?, ?, ?, 'grados celsius', ?)");
                $stmt->bind_param("iissis", $idestacion, $idvarmeteorologica, $fecha, $hora, $tempMin, $tipodatotemporal);
                $stmt->execute();
            }

            if ($precipitacion !== null && $tempMax !== null && $tempMin !== null) {
                $idvarmeteorologica = 1;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL)
                VALUES (?, ?, ?, ?, ?, 'milimetros', ?)");
                $stmt->bind_param("ssssss", $idestacion, $idvarmeteorologica, $fecha, $hora, $precipitacion, $tipodatotemporal);
                $stmt->execute();
                
                $idvarmeteorologica = 2;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL) 
                VALUES (?, ?, ?, ?, ?, 'grados', ?)");
                $stmt->bind_param("ssssss", $idestacion, $idvarmeteorologica, $fecha, $hora, $tempMax, $tipodatotemporal);
                $stmt->execute();
        
                $idvarmeteorologica = 3;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL) 
                VALUES (?, ?, ?, ?, ?, 'grados', ?)");
                $stmt->bind_param("ssssss", $idestacion, $idvarmeteorologica, $fecha, $hora, $tempMin, $tipodatotemporal);
                $stmt->execute();
            }
        }

        // Cerrar la conexión a la base de datos cuando hayas terminado
        $this->db->close();
    }
    
}