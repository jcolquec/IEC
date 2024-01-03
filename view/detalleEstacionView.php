<!DOCTYPE html>
<html>
<head>
    <title>Detalle de la Estación</title>
    <link rel="stylesheet" type="text/css" href="../css/inicio.css">
    <link rel="stylesheet" type="text/css" href="../css/detalleEstacion.css">
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
    
    
</body>
</html>