<!DOCTYPE html>
<html>
<head>
    <title>Carga de Datos</title>
    <link rel="stylesheet" type="text/css" href="../css/inicio.css">
    <link rel="stylesheet" type="text/css" href="../css/datosView.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
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
            <option value="Precipitación">Precipitación</option>
            <option value="Temperatura Media">Temperatura Media</option>
            <option value="Temperatura Máxima">Temperatura Máxima</option>
            <option value="Temperatura Mínima">Temperatura Mínima</option>
            <option value="todas">Todas</option>
        </select>

        <div class="estacion-container">
            <label for="estacion">Indique Código de la Estación :</label>
            <select id="estacion" name="estacion">
                <option value="">Seleccione</option>
                <?php foreach ($estaciones as $estacion): ?>
                    <option value="<?= $estacion['IDESTACION'] ?>"><?= $estacion['IDESTACION'] ?></option>
                <?php endforeach; ?>
            </select>
            <a id="detalle-estacion" href="#" class="btn detalle-btn">Ver Detalle</a>
        </div>

        <label for="archivo">Selecciona un archivo CSV:</label>
        <input type="file" id="archivo" name="archivo" accept=".csv">
        <input type="submit" value="Subir archivo" name="submit">
        
    </form>

    <script>
        $(document).ready(function() {
            $('#estacion').select2();

            $('#estacion').change(function() {
                var estacion = $(this).val();
                var enlace = $('#detalle-estacion');
                if (estacion) {
                    enlace.attr('href', 'index.php?c=estacion&a=verDetalle&id=' + estacion);
                } else {
                    enlace.attr('href', '#');
                }
            });
        });

        
    </script>
</body>
</html>