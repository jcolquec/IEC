<!DOCTYPE html>
<html>
<head>
    <title>Detalle de la Estación</title>
    <link rel="stylesheet" type="text/css" href="../css/inicio.css">
    <link rel="stylesheet" type="text/css" href="../css/detalleEstacion.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <meta charset="UTF-8">
</head>
<body>
    <div id="menu-container">
        <ul>
        <li><a href="index.php">Inicio</a></li>
            <li><a href="index.php?c=estacion&a=mostrarEstacion">Datos</a></li>
            <li><a href="index.php?c=grafico&a=index">Gráficas</a></li>
            <li><a href="index.php?c=estacion&a=mostrarMapa">Mapa</a></li>
            <li><a href="index.php?c=datos&a=index">Subir Datos</a></li>
            <li><a href="index.php?c=usuario&a=login">Iniciar Sesión</a></li>
        </ul>
    </div>
    
        <div class="column">
            <h1>Detalle de la Estación</h1>
            <table>
                <tr>
                    <th>Nombre</th>
                    <th>Dato</th>
                </tr>
                <?php
                if (isset($detalles) && !empty($detalles)) {
                // Supongamos que tienes un array de datos llamado $datos en tu modelo.
                    foreach ($detalles as $detalle) {
                        echo '<tr>';
                        echo '<td>' . 'ID' . '</td>';
                        echo "<td>{$detalle['IDESTACION']}</td>";
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>' . 'NOMBRE DE LA ESTACION' . '</td>';
                        echo "<td>{$detalle['NOMBREESTACION']}</td>";
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>' . 'NRO DE SERIE' . '</td>';
                        echo "<td>{$detalle['NROSERIE']}</td>";
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>' . 'CODIGO DE LA ESTACION' . '</td>';
                        echo "<td>{$detalle['CODIGOESTACION']}</td>";
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>' . 'NOMBRE LOCAL' . '</td>';
                        echo "<td>{$detalle['NOMBRELOCAL']}</td>";
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>' . 'ESTADO' . '</td>';
                        echo "<td>{$detalle['ESTADOESTACION']}</td>";
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>' . 'FECHA DE INICIO DE ACTIVIDADES' . '</td>';
                        echo "<td>{$detalle['FECHAINIACT']}</td>";
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>' . 'FECHA DE TERMINO DE ACTIVIDADES' . '</td>';
                        echo "<td>{$detalle['FECHATERMINOACT']}</td>";
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>' . 'COMENTARIO' . '</td>';
                        echo "<td>{$detalle['COMENTARIO']}</td>";
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>' . 'HUSO HORARIO' . '</td>';
                        echo "<td>{$detalle['HUSOHORARIO']}</td>";
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>' . 'NOMBRE DEL RIO' . '</td>';
                        echo "<td>{$detalle['RIONOMB']}</td>";
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>' . 'NOMBRE DE LA CUENCA' . '</td>';
                        echo "<td>{$detalle['CUENCANOMB']}</td>";
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>' . 'TIPO DE DATOS' . '</td>';
                        echo "<td>{$detalle['TIPODATOS']}</td>";
                        echo '</tr>';
                    }
                } else {
                    // Manejo para cuando no se encuentran detalles.
                    echo '<p>No se encontraron detalles de la estación.</p>';
                }
                ?>
            </table>
        </div>  
        <div class="column">  
            <div id="map" style="height: 400px;">
            
                <script>
                    
                    //Convierte los datos de las estaciones de PHP a una variable JavaScript
                    var estacion = <?php echo json_encode($detalles); ?>;
                    //estacion[0][LATITUD], estacion[0][LONGITUD]
                    var latitud = estacion[0]['LATITUD'];
                    var longitud = estacion[0]['LONGITUD'];
                    
                    // Crea un mapa centrado en una ubicación inicial
                    var map = L.map('map').setView([latitud, longitud],19); // Ajusta el centro y el nivel de zoom según tus necesidades

                    // Agrega una capa de mapa (por ejemplo, OpenStreetMap)
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                    }).addTo(map);
                    
                    // Recorre las estaciones y agrega marcadores
                    estaciones.forEach(function(estaciones) {
                        var latitud = estaciones.LATITUD;
                        var longitud = estaciones.LONGITUD;
                        var nombre = estaciones.NOMBREESTACION;
                        var estado = estaciones.ESTADOESTACION;
                        var codigo = estaciones.CODIGOESTACION;
                        var fecha_inicio_actividades = new Date(estaciones.FECHAINIACT);
                        var huso_horario = estaciones.HUSOHORARIO;
                        var nro_serie = estaciones.NROSERIE;
                        var altitud = estaciones.ALTITUD;

                        var contenidoPopup = `
                                            <h3>Nombre Estación: ${nombre}</h3>
                                            <p>Número de Serie: ${nro_serie}</p>
                                            <p>Código de Estación: ${codigo}</p>
                                            <p>Fecha Inicio de Actividades: ${fecha_inicio_actividades.toLocaleDateString()}</p>
                                            <p>Huso Horario: ${huso_horario}</p>
                                            <p>Latitud: ${latitud}</p>
                                            <p>Longitud: ${longitud}</p>
                                            <p>Altitud: ${altitud}</p>
                                            `;

                        var marcador = L.marker([latitud, longitud]).bindPopup(contenidoPopup) // Contenido del popup
                                        .addTo(map);
                    });
                    
                    
                </script>
            </div>
        </div>    
    
</body>
</html>