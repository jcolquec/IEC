<!DOCTYPE html>
<html>
<head>
    <title>Subir archivo CSV</title>
    <link rel="stylesheet" type="text/css" href="../css/inicio.css">
    <link rel="stylesheet" type="text/css" href="../css/datosView.css">
    
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
    
    <form id="form-subir-datos" action="../public/index.php?c=datos&a=subirArchivoCSV" method="post" enctype="multipart/form-data">
        <h2>Subir datos de precipitación</h2>
        <label for="archivo">Selecciona un archivo CSV:</label>
        <input type="file" id="archivo" name="archivo" accept=".csv">
        <input type="submit" value="Subir archivo" name="submit">
    </form>

    <form id="form-subir-datos" action="../public/index.php?c=datos&a=subirArchivoCSV" method="post" enctype="multipart/form-data">
        <h2>Subir datos de temperatura</h2>
        <label for="archivo">Selecciona un archivo CSV:</label>
        <input type="file" id="archivo" name="archivo" accept=".csv">
        <input type="submit" value="Subir archivo" name="submit">
    </form>

    <form id="form-subir-datos" action="../public/index.php?c=datos&a=subirArchivoCSV" method="post" enctype="multipart/form-data">
        <h2>Subir archivo de temperatura y precipitación</h2>
        <label for="archivo">Selecciona un archivo CSV:</label>
        <input type="file" id="archivo" name="archivo" accept=".csv">
        <input type="submit" value="Subir archivo" name="submit">
    </form>
</body>
</html>