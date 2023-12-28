<?php

class datos {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getDB();
    }

    public function procesarArchivoCSVDiario($rutaArchivo, $tipoVariable) {
        
        // Aquí puedes implementar la lógica para procesar el archivo CSV
        // Por ejemplo, podrías abrir el archivo, leer cada línea, y guardar cada línea en un array
        $file = fopen($rutaArchivo, 'r');
        $datos = [];
        // Verificar si el archivo se abrió correctamente
        if ($file) {

            // Leer la primera línea para obtener las cabeceras
            $cabeceras = fgetcsv($file, 0, ';');
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
            
                    $fecha = $data[0] ;
                    
                    $precipitacion = $data[1];
                    $temperatura_maxima = $data[2];
                    $temperatura_minima = $data[3];
                    
                    $datos[] = [
                        'fecha' => $fecha,
                        'precipitacion' => $precipitacion,
                        'temperatura_maxima' => $temperatura_maxima,
                        'temperatura_minima' => $temperatura_minima
                    ];
                }
            
            }
        
            usort($datos, function ($a, $b) {
                return strtotime($a['fecha']) - strtotime($b['fecha']);
            });

            // Recorrer todas las fechas en el array
            for ($i = 0; $i < count($datos) - 1; $i++) {
                // Obtener la fecha actual y la siguiente
                $fechaActual = new DateTime($datos[$i]['fecha']);
                $fechaSiguiente = new DateTime($datos[$i + 1]['fecha']);

                // Verificar si la fecha siguiente es el día siguiente
                $fechaActual->modify('+1 day');
                if ($fechaActual != $fechaSiguiente) {
                    // Si no lo es, insertar una nueva entrada en el array
                    array_splice($datos, $i + 1, 0, [['fecha' => $fechaActual->format('Y-m-d'), 'precipitacion' => '-99']]);
                }
            }
            // Cerrar el archivo
            fclose($file);
        } else {
            echo 'No se pudo abrir el archivo.';
        }

        return $datos;
    }

    public function procesarArchivoCSVHorario($rutaArchivo, $tipoVariable){
        $file = fopen($rutaArchivo, 'r');
        $datos = [];

        if($file){
            // Leer la primera línea para obtener las cabeceras
            $cabeceras = fgetcsv($file, 0, ';');
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
            
                    $fecha = $data[0] ;
                    
                    $precipitacion = $data[1];
                    $temperatura_maxima = $data[2];
                    $temperatura_minima = $data[3];
                    
                    $datos[] = [
                        'fecha' => $fecha,
                        'precipitacion' => $precipitacion,
                        'temperatura_maxima' => $temperatura_maxima,
                        'temperatura_minima' => $temperatura_minima
                    ];
                }
            
            }
        
            usort($datos, function ($a, $b) {
                return strtotime($a['fecha']) - strtotime($b['fecha']);
            });

            // Recorrer todas las fechas en el array
            for ($i = 0; $i < count($datos) - 1; $i++) {
                // Obtener la fecha actual y la siguiente
                $fechaActual = new DateTime($datos[$i]['fecha']);
                $fechaSiguiente = new DateTime($datos[$i + 1]['fecha']);

                // Verificar si la fecha siguiente es el día siguiente
                $fechaActual->modify('+1 day');
                if ($fechaActual != $fechaSiguiente) {
                    // Si no lo es, insertar una nueva entrada en el array
                    array_splice($datos, $i + 1, 0, [['fecha' => $fechaActual->format('Y-m-d'), 'precipitacion' => '-99']]);
                }
            }
            // Cerrar el archivo
            fclose($file);
        }else{
            echo 'No se pudo abrir el archivo.';
        }

        return $datos;
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

    public function getEstacionesOrgResp($idOrgResp) {
        // Ejecutar la consulta SQL
        $stmt = $this->db->prepare("SELECT IDESTACION FROM ESTACION WHERE IDORGRESP = ?");
        $stmt->bind_param("i", $idOrgResp);
        $stmt->execute();
        // Obtener los resultados
        $result = $stmt->get_result();

        $estaciones = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $estaciones[] = $row;
            }
        }
        return $estaciones;
    }
    
}