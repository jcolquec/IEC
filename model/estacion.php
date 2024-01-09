<?php
class estacion {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getDB();
    }

    public function index(){
        
    }
    public function obtenerEstacion($idpersona, $idorgresp){
        $estaciones = array();
    
        // Modifica la consulta SQL para obtener los datos relevantes desde las tablas multidimensionales
        $sql = "SELECT E.IDESTACION, E.NOMBREESTACION, P.PAISNOMB
        FROM ESTACION E
        INNER JOIN COMUNA C ON E.IDCOMUNA = C.IDCOMUNA
        INNER JOIN CIUDAD CI ON C.IDCIUDAD = CI.IDCIUDAD
        INNER JOIN REGION R ON CI.IDREGION = R.IDREGION
        INNER JOIN PAIS P ON R.IDPAIS = P.IDPAIS
        WHERE E.IDORGRESP = $idorgresp";
    
    
        $result = $this->db->query($sql);
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $estaciones[] = $row;
            }
        }
    
        // Cierra la conexión a la base de datos.
        $this->db->close();
    
        return $estaciones;
    }
    public function obtenerDetalleEstacion($estacionId){
        
        $detalles = array();

        $sql = "SELECT * FROM ESTACION E
                INNER JOIN GEOGRAFIA G ON E.IDESTACION = G.IDESTACION 
                WHERE E.IDESTACION = $estacionId";
    
    
        $result = $this->db->query($sql);
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $detalles[] = $row;
            }
        }
        // Cierra la conexión a la base de datos.
        //$this->db->close();
        return $detalles;
    }
    public function obtenerUbicacionEstaciones($idpersona, $idorgresp){
        
        $ubicacion = array();

        $sql = "SELECT A.IDANIO AS ANIO, H.FD AS DIAS_HELADOS, E.NOMBREESTACION, G.IDESTACION, G.LATITUD, G.LONGITUD, G.ALTITUD, E.ESTADOESTACION, E.NOMBREESTACION, 
                E.CODIGOESTACION, E.NROSERIE, E.FECHAINIACT, E.HUSOHORARIO
                FROM HECHO_IEC H
                LEFT JOIN ANIO A ON H.IDANIO = A.IDANIO
                LEFT JOIN ESTACION E ON H.IDESTACION = E.IDESTACION
                LEFT JOIN GEOGRAFIA G ON E.IDESTACION = G.IDESTACION
                WHERE E.IDORGRESP = $idorgresp AND E.ESTADOESTACION = 'activa'
                GROUP BY A.IDANIO
                ORDER BY A.IDANIO";
    
    
        $result = $this->db->query($sql);
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $ubicacion[] = $row;
            }
        }
    
        
        // Cierra la conexión a la base de datos.
        $this->db->close();
    
        return $ubicacion;
    }
    public function obtenerDatosVariableMeteorologica($estacionId){
        
        $datosGrafico = array();

        
        $stmt = $this->db->prepare("SELECT E.VALORVARIABLE AS VALOR, E.FECHA, E.UNIDMEDIDA AS UNIDAD, V.NOMBREVAR AS NOMBRE FROM ESTACION_REGISTRA_VARIABLE E
        INNER JOIN VARIABLE_METEOROLOGICA V ON E.IDVARMETEOROLOGICA = V.IDVARMETEOROLOGICA
        WHERE IDESTACION = ? ");
    
        $stmt->bind_param('s', $estacionId);
        
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                if (!array_key_exists($row['NOMBRE'], $datosGrafico)) {
                    $datosGrafico[$row['NOMBRE']] = array();
                }
                $datosGrafico[$row['NOMBRE']][] = $row;
            }
        }
    
        
        // Cierra la conexión a la base de datos.
        $stmt->close();
        $this->db->close();
    
        return $datosGrafico;
    }
}