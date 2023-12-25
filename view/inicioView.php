<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="../css/inicio.css">
    <meta charset="UTF-8">
    <!-- Agrega otros enlaces a CSS, JavaScript o fuentes si es necesario -->
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

    <div style="width: 80%; margin: 0 auto;">
        <canvas id="myChart"></canvas>
    </div>
    
    <!-- Coloca aquí tu mapa interactivo si es necesario -->

    <script src="js/script.js"></script>
</body>
</html>