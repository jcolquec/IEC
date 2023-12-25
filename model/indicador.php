<?php
class indicador {

    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getDB();
    }
    public function obtenerDatosDiarios() {
        // Código para obtener los datos diarios (por ejemplo, consulta a la base de datos).
        // ...
        $datosDiarios = array();

        // Realiza una consulta SQL para obtener los datos necesarios.
        $sql = "SELECT FECHA, TMED, TMIN, TMAX, PP
                FROM VARIABLE_METEOROLOGICA 
                GROUP BY FECHA;";

        // Ejecutar la consulta y obtener los resultados en un arreglo
        $result = $this->db->query($sql);
        $data = array();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $datosDiarios[] = $row;
            }
        }        

        return $datosDiarios;
    }
    // Función para calcular los indicadores climáticos.
    public function calcularIndicadoresClimaticos($datosDiarios) {


        $datosPorAno = array();

        foreach ($datosDiarios as $dato) {
            $ano = date('Y', strtotime($dato['FECHA']));

            if (!isset($datosPorAno[$ano])) {
                $datosPorAno[$ano] = array(
                    'ano' => $ano,
                    'FD' => 0, // Inicializa FD a 0 para cada nuevo año.
                    'SU' => 0, // Inicializa SU a 0 para cada nuevo año.
                    'ID' => 0,
                    'TR' => 0,
                    'GSL' => 0,
                    'TXX' => 0,
                    'TNX' => -INF,
                    'TXN' => INF,
                    'TNN' => INF,
                );
            }

            $datosPorAno[$ano]['datos'][] = array(
                'TMED' => $dato['TMED'],
                'TMAX' => $dato['TMAX'],
                'TMIN' => $dato['TMIN'],
                'PP' => $dato['PP'],
                // Agrega otras variables meteorológicas según sea necesario.
            );

            // Lógica específica para calcular los indicadores (usando tu ejemplo FD y SU).
            $datoAnual = end($datosPorAno[$ano]['datos']); // Obtiene el último dato añadido para el año actual.

            if ($dato['TMIN'] < 0) {
                $datosPorAno[$ano]['FD']++;
            }

            if ($dato['TMAX'] > 25) {
                $datosPorAno[$ano]['SU']++;
            }

            if ($dato['TMAX'] < 0) {
                $datosPorAno[$ano]['ID']++;
            }

            if ($dato['TMIN'] > 20) {
                $datosPorAno[$ano]['TR']++;
            }
            $datosPorAno[$ano]['TXX'] = max($datosPorAno[$ano]['TXX'] ,$dato['TMAX']);
            $datosPorAno[$ano]['TNX'] = max($datosPorAno[$ano]['TNX'] ,$dato['TMIN']);
            $datosPorAno[$ano]['TXN'] = min($datosPorAno[$ano]['TXN'] ,$dato['TMAX']);
            $datosPorAno[$ano]['TNN'] = min($datosPorAno[$ano]['TNN'] ,$dato['TMIN']);
        }
        
        $datosPorAno[$ano]['TNX'] !== -INF ? $datosPorAno[$ano]['TNX'] : null;

        // Al final, tendrás una lista que contiene el año y los indicadores de ese año.
        $resultadosIndicadorAnual = array_values($datosPorAno);
        
        echo var_dump($resultadosIndicadorAnual);
        return $resultadosIndicadorAnual;
    }

    // Función para guardar los resultados en la base de datos.
    public function guardarResultadosIndicadores($resultadosIndicadores) {
        // Código para guardar los resultados en la base de datos u otro sistema de almacenamiento.
        // ...
        /*
        foreach ($resultadosIndicadores as $resultado) {
            $ano = $resultado['ano'];
            $FD = $resultado['FD'];
            $SU = $resultado['SU'];
    
            // Prepara la consulta.
            $stmt = $this->db->prepare("INSERT INTO HECHO_IEC (IDESTACION, IDPROCESO, IDANIO, FD, SU) VALUES (1, 1, ?, ?, ?)");
    
            if (!$stmt) {
                die("Error en la preparación de la consulta: " . $this->db->error);
            }
    
            // Vincula los parámetros.
            $stmt->bind_param("iii", $ano, $FD, $SU);
    
            // Ejecuta la consulta.
            $stmt->execute();
    
            // Cierra la consulta.
            $stmt->close();
        }
        */
        
    }
}