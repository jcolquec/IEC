<!DOCTYPE html>
<html>
<head>
    <title>Detalle de la Estación</title>
    <link rel="stylesheet" type="text/css" href="../css/inicio.css">
    <link rel="stylesheet" type="text/css" href="../css/detalleEstacion.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <div id="contenedor">
        <div id="tabla">
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
        <div id="mapa">  
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
                    
                    // Agrega un marcador
                    var marker = L.marker([latitud, longitud]).addTo(map);
                    
                    
                    
                </script>
            </div>
        </div> 
    

        <div id="filtro-grafico">
            <div id="filtro">
            <label for="fechaInicio">Desde:</label>
            <input type="date" id="fechaInicio">

            <label for="fechaFin">Hasta:</label>
            <input type="date" id="fechaFin">

            <button id="filtrar">Filtrar</button>
            </div>
            <div id="grafico">
            <canvas id="myChart"></canvas>
            </div>
        </div>  
    </div>  
            <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var datosGrafico = <?php echo json_encode($datosGrafico); ?>;
                    var datasets = [];

                    var colores = ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'];
                    var i = 0;

                    // Crea un conjunto de datos para cada variable
                    for (var nombreVariable in datosGrafico) {
                        var datosVariable = datosGrafico[nombreVariable];
                        datasets.push({
                            label: nombreVariable,
                            data: datosVariable.map(function(dato) { return dato.VALOR; }),
                            backgroundColor: 'rgba(0, 0, 0, 0)',
                            borderColor: colores[i % colores.length],
                            borderWidth: 1
                        });

                        i++;
                    }

                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: datosGrafico[Object.keys(datosGrafico)[0]].map(function(dato) { return dato.FECHA; }),
                            datasets: datasets
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    document.getElementById('filtrar').addEventListener('click', function() {
                        var fechaInicio = new Date(document.getElementById('fechaInicio').value);
                        var fechaFin = new Date(document.getElementById('fechaFin').value);

                        var datosGrafico = <?php echo json_encode($datosGrafico); ?>;
                        var datasets = [];
                        
                        var colores = ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'];
                        var i = 0;

                        // Filtra los datos para cada variable
                        for (var nombreVariable in datosGrafico) {
                            var datosVariable = datosGrafico[nombreVariable];
                            var datosFiltrados = datosVariable.filter(function(dato) {
                                var fechaDato = new Date(dato.FECHA);
                                return fechaDato >= fechaInicio && fechaDato <= fechaFin;
                            });

                            datasets.push({
                                label: nombreVariable,
                                data: datosFiltrados.map(function(dato) { return dato.VALOR; }),
                                backgroundColor: 'rgba(0, 0, 0, 0)',
                                borderColor: colores[i % colores.length],
                                borderWidth: 1
                            });

                            i++;
                        }

                        myChart.data.labels = datosFiltrados.map(function(dato) { return dato.FECHA; });
                        myChart.data.datasets = datasets;
                        myChart.update();
                    });
            </script>
</body>
</html>