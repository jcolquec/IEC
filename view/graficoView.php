<!DOCTYPE html>
<html>
<head>
    <title>Gráficos PHP con MVC</title>
    <link rel="stylesheet" type="text/css" href="../css/inicio.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
        body,html{
            background-color: #fffff;
        }

        .contenedor {
            display: flex;
            height: 100%;
        }

        .grafico {
            flex: 1;
            margin-right: 10px; /* Agregamos un margen derecho para separar el gráfico del mapa */
        }

        .contenido-derecha {
            flex: 1;
            
        }
        .mapa{
            height: 500px;
        }
        
    </style>
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
    <!--
    <div class='container'>
        <label for="year">Año:</label>
        <select id="year">
            <option value="todos">todos</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
        </select>

        <label for="month">Mes:</label>
        <select id="month">
            <option value="todos">todos</option>
            <option value="enero">Enero</option>
            <option value="febrero">Febrero</option>
            <option value="marzo">Marzo</option>
            <option value="abril">Abril</option>
            <option value="mayo">Mayo</option>
            <option value="junio">Junio</option>
            <option value="julio">Julio</option>
            <option value="agosto">Agosto</option>
            <option value="septiembre">Septiembre</option>
            <option value="octubre">Octubre</option>
            <option value="noviembre">Noviembre</option>
            <option value="diciembre">Diciembre</option>
        </select>

        <label for="day">Día:</label>
        <select id="day">
            <option value="todos">todos</option>
            <option value="lunes">Lunes</option>
            <option value="martes">Martes</option>
            <option value="miércoles">Miércoles</option>
            <option value="jueves">Jueves</option>
            <option value="viernes">Viernes</option>
        </select>  
    </div>
    -->
    <div class='contenedor'>    
        <div class='grafico'>
            <h2>Gráficas de Indicadores de Extremos Climáticos</h2>
            <canvas id="myChart"></canvas>
        </div> 
        
        <div class="contenido-derecha">
            <!-- Contenido adicional a la derecha del gráfico -->
            <!-- Puedes agregar otros elementos, texto, gráficos, etc. aquí -->
            <h2>Mapa de Estaciones Meteorológicas</h2>
            <?php// echo var_dump($data);?>
            <select name="select-location" id="select-location">
                <option value="-1">Seleccione un lugar:</option>
                <?php
                $nombresAgregados = array();
                foreach ($data as $estacion) {
                    $latitud = $estacion['LATITUD'];
                    $longitud = $estacion['LONGITUD'];
                    $nombre = $estacion['NOMBREESTACION'];
                    if (!in_array($nombre, $nombresAgregados)) {
                        echo "<option value='$latitud,$longitud'>$nombre</option>";
            
                        // Agrega el nombre al array.
                        $nombresAgregados[] = $nombre;
                    }
                }?>	
            </select>
            <div id="map" class='mapa'>
                <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

                <script>
                    // Convierte los datos de las estaciones de PHP a una variable JavaScript
                    var estaciones = <?php echo json_encode($data); ?>;
                    
                    // Crea un mapa centrado en una ubicación inicial
                    var map = L.map('map').setView([-20.23, -70.14],14); // Ajusta el centro y el nivel de zoom según tus necesidades

                    // Agrega una capa de mapa (por ejemplo, OpenStreetMap)
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                    }).addTo(map);
                    
                    document.getElementById('select-location').addEventListener('change', function(e) {
                        let coords = e.target.value.split(",");
                        let lat = parseFloat(coords[0]);
                        let lng = parseFloat(coords[1]);

                        map.flyTo([lat, lng], 17);
                    });

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
    </div>
    <script>
        // Datos obtenidos del controlador
        var chartData = <?php echo json_encode($data); ?>;
    </script>
    </script>
    
    </script>
    <script src="js/grafico.js"></script>
</body>
</html>