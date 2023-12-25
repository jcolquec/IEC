<?php
// Ruta del archivo CSV
$filePath = './sampledataindcal.csv';

// Abrir el archivo en modo lectura
$file = fopen($filePath, 'r');
$columnas = [];
$datos = [];
// Verificar si el archivo se abrió correctamente
if ($file) {
    $firstLine = true;
    $contar = 0;
    // Leer cada línea del archivo
    while (($data = fgetcsv($file)) !== false) {

        
        if ($firstLine) {
            $columnas = $data;
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

        $contar++;
        if ($contar >= 1) {
            break;
        }
    }


    // Cerrar el archivo
    fclose($file);
    //insertarDatos($datos);

} else {
    echo 'No se pudo abrir el archivo.';
}

function insertarDatos($datos) {
    // Conexión a la base de datos
    $db = new mysqli('localhost', 'root', '', 'starer');

    if ($db->connect_error) {
        die('Error de Conexión (' . $db->connect_errno . ') '. $db->connect_error);
    }

    // Valores para idestacion, idvarmeteorologica, hora y tipodatotemporal
    $idestacion = 1;
    $hora = '00:00:00';
    $tipodatotemporal = 'Diario';

    foreach ($datos as $dato) {
        $fecha = $dato['fecha'];
        $precipitacion = $dato['precipitacion'];
        $tempMax = $dato['temperatura_maxima'];
        $tempMin = $dato['temperatura_minima'];
        $idvarmeteorologica = 1;

        // Insertar los datos en la base de datos
        $db->query("INSERT INTO estacion_registra_variable 
        (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA,VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL) VALUES
        ('$idestacion', '$idvarmeteorologica', '$fecha', '$hora', '$precipitacion', 'milimetros', '$tipodatotemporal')");
        $idvarmeteorologica = 2;
        $db->query("INSERT INTO estacion_registra_variable
        (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL) VALUES
        ('$idestacion', '$idvarmeteorologica', '$fecha', '$hora', '$tempMax', 'Celsius', '$tipodatotemporal')");
        $idvarmeteorologica = 3;
        $db->query("INSERT INTO estacion_registra_variable 
        (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, VALORVARIABLE, UNIDMEDIDA, TIPODATOTEMPORAL) VALUES 
        ('$idestacion', '$idvarmeteorologica', '$fecha', '$hora', '$tempMin', 'Celsius', '$tipodatotemporal')");
    }

    $db->close();
}
?>
