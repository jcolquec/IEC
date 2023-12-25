<!DOCTYPE html>
<html>
<head>
    <title>Mapa de Estaciones Meteorológicas</title>
    <link rel="stylesheet" type="text/css" href="../css/mapa.css">
    <link rel="stylesheet" type="text/css" href="../css/inicio.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
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
    <h1>Mapa de Estaciones Meteorológicas</h1>
    
        <select name="select-location" id="select-location" class="styled-select">
            <option value="-1">Seleccione un lugar:</option>
            <?php
            $nombresAgregados = array();
            foreach ($estaciones as $estacion) {
                $latitud = $estacion['LATITUD'];
                $longitud = $estacion['LONGITUD'];
                $nombre = $estacion['NOMBREESTACION'];
                if (!in_array($nombre, $nombresAgregados)) {
                    echo "<option value='$latitud,$longitud'>$nombre</option>";

                    // Agrega el nombre al array.
                    $nombresAgregados[] = $nombre;
                }
            }
            ?>	
        </select>

    <div id="map" style="width: 100%; height: 528px; margin-top: 45px;"></div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    
    <script>
        
        // Convierte los datos de las estaciones de PHP a una variable JavaScript
        var estaciones = <?php echo json_encode($estaciones); ?>;
        console.log(estaciones[0]);

        // Crea un mapa centrado en una ubicación inicial
        var map = L.map('map').setView([-20.24, -70.14],13); // Ajusta el centro y el nivel de zoom según tus necesidades

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
    


</body>
</html>
