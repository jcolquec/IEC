<?php

class datos {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getDB();
    }

    public function procesarArchivoCSVDiario($rutaArchivo, $tipoVariableMeteorologica, $estacionSeleccionada, $tipoDatoTemporal) {
        
        $file = fopen($rutaArchivo, 'r');
        $datos = [];
        
        // Verificar si el archivo se abrió correctamente
        if ($file) {

            // Leer la primera línea para obtener las cabeceras
            $cabeceras = fgetcsv($file, 0, ';');

            // Guardar la posición actual del puntero del archivo
            $posicion = ftell($file);

            // Leer la segunda línea del archivo para obtener el código de la estación
            $codigo_estacion = fgetcsv($file, 0, ';')[0];

            // Verificar si el código de la estación coincide con el seleccionado en el formulario
            if ($codigo_estacion != $estacionSeleccionada) {
                // Si no coincide, puedes mostrar un mensaje de error y detener la ejecución
                return 'codigo_no_coincide';
            }

            // Mover el puntero del archivo de vuelta al inicio de la segunda fila
            fseek($file, $posicion);

            // Determinar el tipo de archivo basándose en las cabeceras
            if (in_array('precipitacion', $cabeceras)) {
                
                // Procesar archivo de precipitación
                // Leer cada línea del archivo
                while (($data = fgetcsv($file, 0, ';')) !== false) {
                    // Obtener cada dato por separado
                    $fecha = DateTime::createFromFormat('d-m-Y', $data[1])->format('Y-m-d');
                    $precipitacion = $data[2];
                    
                    $datos[] = [
                        'fecha' => $fecha,
                        'precipitacion' => $precipitacion,
                    ];
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
            } elseif (in_array('temperatura_maxima', $cabeceras)) {
                // Procesar archivo de temperatura
                // Leer cada línea del archivo
                while (($data = fgetcsv($file, 0, ';')) !== false) {
                    // Obtener cada dato por separado
                    $fecha = DateTime::createFromFormat('d-m-Y', $data[1])->format('Y-m-d');
                    $temperatura_maxima = $data[2];
                    
                    $datos[] = [
                        'fecha' => $fecha,
                        'temperatura_maxima' => $temperatura_maxima,
                    ];
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
                        array_splice($datos, $i + 1, 0, [['fecha' => $fechaActual->format('Y-m-d'), 'temperatura_maxima' => '-99']]);
                    }
                }
            }elseif(in_array('temperatura_minima', $cabeceras)){

                while (($data = fgetcsv($file, 0, ';')) !== false) {
                    // Obtener cada dato por separado
                    $fecha = DateTime::createFromFormat('d-m-Y', $data[1])->format('Y-m-d');
                    $temperatura_minima = $data[2];
                    
                    $datos[] = [
                        'fecha' => $fecha,
                        'temperatura_minima' => $temperatura_minima,
                    ];
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
                        array_splice($datos, $i + 1, 0, [['fecha' => $fechaActual->format('Y-m-d'), 'temperatura_minima' => '-99']]);
                    }
                }
            }elseif(in_array('temperatura_media', $cabeceras)){
                
                while (($data = fgetcsv($file, 0, ';')) !== false) {
                    // Obtener cada dato por separado
                    $fecha = DateTime::createFromFormat('d-m-Y', $data[1])->format('Y-m-d');
                    $temperatura_media = $data[2];
                    
                    $datos[] = [
                        'fecha' => $fecha,
                        'temperatura_media' => $temperatura_media,
                    ];
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
                        array_splice($datos, $i + 1, 0, [['fecha' => $fechaActual->format('Y-m-d'), 'temperatura_media' => '-99']]);
                    }
                }
            
            } elseif (in_array('precipitacion', $cabeceras) && in_array('temperatura_maxima', $cabeceras) && in_array('temperatura_media', $cabeceras)) {
                // Procesar archivo de temperatura y precipitación
                $firstLine = true;
                // Leer cada línea del archivo
                while (($data = fgetcsv($file, 0, ';')) !== false) {
            
                    $fecha = DateTime::createFromFormat('d-m-Y', $data[1])->format('Y-m-d');
                    
                    $precipitacion = $data[2];
                    $temperatura_maxima = $data[3];
                    $temperatura_minima = $data[4];
                    
                    $datos[] = [
                        'fecha' => $fecha,
                        'precipitacion' => $precipitacion,
                        'temperatura_maxima' => $temperatura_maxima,
                        'temperatura_minima' => $temperatura_minima
                    ];
                }
                usort($datos, function ($a, $b) {
                    return strtotime($a['fecha']) - strtotime($b['fecha']);
                });

                for ($i = 0; $i < count($datos) - 1; $i++) {
                    // Obtener la fecha actual y la siguiente
                    $fechaActual = new DateTime($datos[$i]['fecha']);
                    $fechaSiguiente = new DateTime($datos[$i + 1]['fecha']);
                
                    // Verificar si la fecha siguiente es el día siguiente
                    $fechaActual->modify('+1 day');
                    if ($fechaActual != $fechaSiguiente) {
                        // Si no lo es, insertar una nueva entrada en el array
                        array_splice($datos, $i + 1, 0, [[
                            'fecha' => $fechaActual->format('Y-m-d'), 
                            'precipitacion' => '-99',
                            'temperatura_maxima' => '-99',
                            'temperatura_minima' => '-99'
                        ]]);
                    }
                }
            
            }            
            // Cerrar el archivo
            fclose($file);
        } else {
            echo 'No se pudo abrir el archivo.';
        }

        return $datos;
    }

    public function procesarArchivoCSVHorario($rutaArchivo, $tipoVariableMeteorologica, $estacionSeleccionada){
        $file = fopen($rutaArchivo, 'r');
        $datos = [];

        if($file){
            // Leer la primera línea para obtener las cabeceras
            $cabeceras = fgetcsv($file, 0, ';');

            // Guardar la posición actual del puntero del archivo
            $posicion = ftell($file);

            // Leer la segunda línea del archivo para obtener el código de la estación
            $codigo_estacion = fgetcsv($file, 0, ';')[0];

            // Verificar si el código de la estación coincide con el seleccionado en el formulario
            if ($codigo_estacion != $estacionSeleccionada) {
                // Si no coincide, puedes mostrar un mensaje de error y detener la ejecución
                return 'codigo_no_coincide';
            }

        // Mover el puntero del archivo de vuelta al inicio de la segunda fila
        fseek($file, $posicion);
            // Determinar el tipo de archivo basándose en las cabeceras
            if (in_array('precipitacion', $cabeceras)) {
                
                // Procesar archivo de precipitación
                // Leer cada línea del archivo
                while (($data = fgetcsv($file, 0, ';')) !== false) {
                    // Obtener cada dato por separado
                    
                    $fecha = DateTime::createFromFormat('d-m-Y', $data[1])->format('Y-m-d');
                    $hora = $data[2];
                    $precipitacion = $data[3];
                    
                    $datos[] = [
                        'fecha' => $fecha,
                        'hora' => $hora,
                        'precipitacion' => $precipitacion,
                    ];
                }
            } elseif (in_array('temperatura_maxima', $cabeceras) && in_array('temperatura_minima', $cabeceras)) {
                // Procesar archivo de temperatura
                // Leer cada línea del archivo
                while (($data = fgetcsv($file, 0, ';')) !== false) {
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
                while (($data = fgetcsv($file, 0, ';')) !== false) {
            
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
                $fechaHoraA = strtotime($a['fecha'] . ' ' . $a['hora']);
                $fechaHoraB = strtotime($b['fecha'] . ' ' . $b['hora']);
            
                return $fechaHoraA - $fechaHoraB;
            });
                    
            $cont = 0;
            $HoraActualArray = new DateTime($datos[0]['hora']);
            $datosConHorasFaltantes = [];

            
            
            // Crear un array de fechas únicas
            $fechasUnicas = array_unique(array_column($datos, 'fecha'));
            
            foreach ($fechasUnicas as $fechaUnica) {
                
                $horaInicial = '00:00:00';
                $horaFinal = '23:00:00';
                $a = new DateTime($horaInicial);
                $b = new DateTime($horaFinal); 
                $horaActual = $a;
                
                while($a <= $b){
                    

                    if (isset($datos[$cont]['hora']) && $HoraActualArray->format('H:i:s') === $horaActual->format('H:i:s')){
                        
                        $datosConHorasFaltantes[] = $datos[$cont];
                        $HoraActualArray->modify('+1 hour');
                        $cont++;
                    }else{
                        
                        $datosConHorasFaltantes[] = [
                            'fecha' => $fechaUnica,
                            'hora' => $horaActual->format('H:i:s'),
                            'precipitacion' => -99
                        ];
                    }
                    $horaActual->modify('+1 hour');
                    
                    
                }
            }
            
            
            // Cerrar el archivo
            fclose($file);
        }else{
            echo 'No se pudo abrir el archivo.';
        }

        return $datosConHorasFaltantes;
    }

    public function guardarDatosDiario($datos, $tipoVariableMeteorologica, $estacionSeleccionada, $tipoDatoTemporal) {
        // Aquí puedes implementar la lógica para guardar los datos en la base de datos
        // Por ejemplo, podrías recorrer los datos y insertar cada fila en la base de datos
        $hora = '23:59:59';
        
        foreach ($datos as $dato) {
            $fecha = $dato['fecha'];
            $precipitacion = isset($dato['precipitacion']) ? $dato['precipitacion'] : null;
            $tempMax = isset($dato['temperatura_maxima']) ? $dato['temperatura_maxima'] : null;
            $tempMin = isset($dato['temperatura_minima']) ? $dato['temperatura_minima'] : null;
            $tempMed = isset($dato['temperatura_media']) ? $dato['temperatura_media'] : null;
            
        
            // Preparar la consulta SQL
            if ($precipitacion !== null && $tempMax === null && $tempMin === null && $tempMed === null) {
                
                $idvarmeteorologica = 1;

                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL) 
                VALUES (?, ?, ?, ?, ?, 'milimetros', ?)");
                $stmt->bind_param("sissds", $estacionSeleccionada, $idvarmeteorologica, $fecha, $hora, $precipitacion, $tipoDatoTemporal);
                $stmt->execute();
            }
        
            if ($precipitacion === null && $tempMax !== null && $tempMin === null && $tempMed === null) {
                $idvarmeteorologica = 2;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL)
                VALUES (?, ?, ?, ?, ?, 'grados celsius', ?)");
                $stmt->bind_param("sissds", $estacionSeleccionada, $idvarmeteorologica, $fecha, $hora, $tempMax, $tipoDatoTemporal);
                $stmt->execute();
            }

            if ($precipitacion === null && $tempMax === null && $tempMin !== null && $tempMed === null) {

                $idvarmeteorologica = 3;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL)
                VALUES (?, ?, ?, ?, ?, 'grados celsius', ?)");
                $stmt->bind_param("sissds", $estacionSeleccionada, $idvarmeteorologica, $fecha, $hora, $tempMin, $tipoDatoTemporal);
                $stmt->execute();
            }

            if ($precipitacion === null && $tempMax === null && $tempMin === null && $tempMed !== null){
                $idvarmeteorologica = 4;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL)
                VALUES (?, ?, ?, ?, ?, 'grados celsius', ?)");
                $stmt->bind_param("sissds", $estacionSeleccionada, $idvarmeteorologica, $fecha, $hora, $tempMed, $tipoDatoTemporal);
                $stmt->execute();
            }

            if ($precipitacion !== null && $tempMax !== null && $tempMin !== null && $tempMed !== null) {
                $idvarmeteorologica = 1;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL)
                VALUES (?, ?, ?, ?, ?, 'milimetros', ?)");
                $stmt->bind_param("sissds", $estacionSeleccionada, $idvarmeteorologica, $fecha, $hora, $precipitacion, $tipoDatoTemporal);
                $stmt->execute();
                
                $idvarmeteorologica = 2;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL) 
                VALUES (?, ?, ?, ?, ?, 'grados celsius', ?)");
                $stmt->bind_param("sissds", $estacionSeleccionada, $idvarmeteorologica, $fecha, $hora, $tempMax, $tipoDatoTemporal);
                $stmt->execute();
        
                $idvarmeteorologica = 3;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL) 
                VALUES (?, ?, ?, ?, ?, 'grados celsius', ?)");
                $stmt->bind_param("sissds", $estacionSeleccionada, $idvarmeteorologica, $fecha, $hora, $tempMin, $tipoDatoTemporal);
                $stmt->execute();
            }
        }

        // Cerrar la conexión a la base de datos cuando hayas terminado
        $this->db->close();
    }

    public function guardarDatosHorario($datos, $tipoVariableMeteorologica, $estacionSeleccionada, $tipoDatoTemporal) {
        // Aquí puedes implementar la lógica para guardar los datos en la base de datos
        // Por ejemplo, podrías recorrer los datos y insertar cada fila en la base de datos
        
        
        foreach ($datos as $dato) {
            $fecha = $dato['fecha'];
            $hora = $dato['hora'];
            $precipitacion = isset($dato['precipitacion']) ? $dato['precipitacion'] : null;
            $tempMax = isset($dato['temperatura_maxima']) ? $dato['temperatura_maxima'] : null;
            $tempMin = isset($dato['temperatura_minima']) ? $dato['temperatura_minima'] : null;
            

        
            // Preparar la consulta SQL
            if ($precipitacion !== null && $tempMax === null && $tempMin === null) {
                
                $idvarmeteorologica = 1;

                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL) 
                VALUES (?, ?, ?, ?, ?, 'milimetros', ?)");
                $stmt->bind_param("sissds", $estacionSeleccionada, $idvarmeteorologica, $fecha, $hora, $precipitacion, $tipoDatoTemporal);
                $stmt->execute();
            }
        
            if ($precipitacion === null && $tempMax !== null && $tempMin === null) {
                $idvarmeteorologica = 2;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL)
                VALUES (?, ?, ?, ?, ?, 'grados celsius', ?)");
                $stmt->bind_param("sissds", $estacionSeleccionada, $idvarmeteorologica, $fecha, $hora, $tempMax, $tipoDatoTemporal);
                $stmt->execute();
            }

            if ($precipitacion === null && $tempMax === null && $tempMin !== null) {

                $idvarmeteorologica = 3;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL)
                VALUES (?, ?, ?, ?, ?, 'grados celsius', ?)");
                $stmt->bind_param("sissds", $estacionSeleccionada, $idvarmeteorologica, $fecha, $hora, $tempMin, $tipoDatoTemporal);
                $stmt->execute();
            }

            if ($precipitacion !== null && $tempMax !== null && $tempMin !== null) {
                $idvarmeteorologica = 1;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL)
                VALUES (?, ?, ?, ?, ?, 'milimetros', ?)");
                $stmt->bind_param("sissds", $estacionSeleccionada, $idvarmeteorologica, $fecha, $hora, $precipitacion, $tipoDatoTemporal);
                $stmt->execute();
                
                $idvarmeteorologica = 2;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL) 
                VALUES (?, ?, ?, ?, ?, 'grados celsius', ?)");
                $stmt->bind_param("sissds", $estacionSeleccionada, $idvarmeteorologica, $fecha, $hora, $tempMax, $tipoDatoTemporal);
                $stmt->execute();
        
                $idvarmeteorologica = 3;
                $stmt = $this->db->prepare("INSERT INTO estacion_registra_variable 
                (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL) 
                VALUES (?, ?, ?, ?, ?, 'grados celsius', ?)");
                $stmt->bind_param("sissds", $estacionSeleccionada, $idvarmeteorologica, $fecha, $hora, $tempMin, $tipoDatoTemporal);
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