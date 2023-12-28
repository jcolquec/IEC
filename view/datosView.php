<!DOCTYPE html>
<html>
<head>
    <title>Carga de Datos</title>
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
        <h2>Carga de Datos</h2>

        <label for="tipo-datos">Tipo de Datos Temporal:</label>
        <select id="tipo-datos" name="tipo-datos">
            <option value="">Seleccione</option>
            <option value="horario">Horario</option>
            <option value="diario">Diario</option>
        </select>

        <label for="tipo-variable">Tipo de Variable:</label>
        <select id="tipo-variable" name="tipo-variable">
            <option value="">Seleccione</option>
            <option value="precipitacion">Solo precipitación</option>
            <option value="temperatura-media">Solo temperatura media</option>
            <option value="temperatura-maxima">Solo temperatura máxima</option>
            <option value="temperatura-minima">Solo temperatura mínima</option>
            <option value="todas">Todas</option>
        </select>

        <label for="estacion">Indique el Código de la Estación donde se van a cargar los datos:</label>
        <select id="estacion" name="estacion">
            <option value="">Seleccione</option>
            <?php foreach ($estaciones as $estacion): ?>
                <option value="<?= $estacion['IDESTACION'] ?>"><?= $estacion['IDESTACION'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="archivo">Selecciona un archivo CSV:</label>
        <input type="file" id="archivo" name="archivo" accept=".csv">
        <input type="submit" value="Subir archivo" name="submit">
    </form>
    <!--
    <form id="form-subir-datos" action="../public/index.php?c=datos&a=subirArchivoCSV" method="post" enctype="multipart/form-data">
        <h2>Subir datos de precipitación</h2>
        <label for="archivo">Selecciona un archivo CSV:</label>
        <input type="file" id="archivo" name="archivo" accept=".csv">
        <input type="submit" value="Subir archivo" name="submit">
    </form>

    <form id="form-subir-datos" action="../public/index.php?c=datos&a=subirArchivoCSV" method="post" enctype="multipart/form-data">
        <h2>Subir datos de Temperatura Media</h2>
        <label for="archivo">Selecciona un archivo CSV:</label>
        <input type="file" id="archivo" name="archivo" accept=".csv">
        <input type="submit" value="Subir archivo" name="submit">
    </form>

    <form id="form-subir-datos" action="../public/index.php?c=datos&a=subirArchivoCSV" method="post" enctype="multipart/form-data">
        <h2>Subir datos de Temperatura Máxima</h2>
        <label for="archivo">Selecciona un archivo CSV:</label>
        <input type="file" id="archivo" name="archivo" accept=".csv">
        <input type="submit" value="Subir archivo" name="submit">
    </form>

    <form id="form-subir-datos" action="../public/index.php?c=datos&a=subirArchivoCSV" method="post" enctype="multipart/form-data">
        <h2>Subir datos de Temperatura Mínima</h2>
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
    -->
</body>
</html>