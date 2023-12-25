<?php

require_once 'database.php';

class grafico {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getDB();
    }
    public function mostrarGrafico($idpersona, $idorgresp) {
        
        
        // Realiza una consulta SQL para obtener los datos necesarios.
        $sql = "SELECT A.IDANIO AS ANIO, H.FD AS DIAS_HELADOS, E.NOMBREESTACION, E.IDORGRESP, G.IDESTACION, G.LATITUD, G.LONGITUD, 
                G.ALTITUD, E.ESTADOESTACION, E.NOMBREESTACION, 
                E.CODIGOESTACION, E.NROSERIE, E.FECHAINIACT, E.HUSOHORARIO
                FROM HECHO_IEC H
                LEFT JOIN ANIO A ON H.IDANIO = A.IDANIO
                LEFT JOIN ESTACION E ON H.IDESTACION = E.IDESTACION
                LEFT JOIN GEOGRAFIA G ON E.IDESTACION = G.IDESTACION
                WHERE E.IDORGRESP = $idorgresp AND E.ESTADOESTACION = 'activa'
                GROUP BY A.IDANIO
                ORDER BY A.IDANIO";

        // Ejecutar la consulta y obtener los resultados en un arreglo
        $result = $this->db->query($sql);
        $data = array();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        // Cierra la conexión a la base de datos.
        $this->db->close();

        return $data;
    }
    public function mostrarGraficoFiltrado($selectedYear, $selectedMonth, $selectedDay) {
        $data = array();
    
        // Modifica la consulta SQL para obtener los datos relevantes desde las tablas multidimensionales
        $sql = "SELECT a.idanio, h.monto FROM hechomonto h
                INNER JOIN dia d ON h.iddia = d.iddia
                INNER JOIN mes m ON d.idmes = m.idmes
                INNER JOIN anio a ON m.idanio = a.idanio
                WHERE a.idanio = $selectedYear";
    
        // Agrega condiciones adicionales para el mes y el día, si están seleccionados
        if ($selectedMonth !== 'todos') {
            $sql .= " AND m.idmes = $selectedMonth";
        }
        
        if ($selectedDay !== 'todos') {
            $sql .= " AND d.diannomb = '$selectedDay'";
        }
    
        $result = $this->db->query($sql);
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
    
        return $data;
    }

}