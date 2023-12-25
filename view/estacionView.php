<!DOCTYPE html>
<html lang="es">
<head>
    <title>Estaciones Meteorologicas</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/estacion.css">
    <link rel="stylesheet" type="text/css" href="../css/inicio.css">
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
    <h1>Estaciones Meteorologicas</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Estacion</th>
                <th>Pais</th>
                <th></th>
                <!-- Agrega más columnas según tus necesidades -->
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($estaciones as $estacion) {
                echo "<tr>";
                echo "<td>{$estacion['IDESTACION']}</td>";
                echo "<td>{$estacion['NOMBREESTACION']}</td>";
                echo "<td>{$estacion['PAISNOMB']}</td>";
                ?>
                <td colspan="3">
                <a class="ver-detalle" href="index.php?c=estacion&a=verDetalle&id=<?php echo $estacion['IDESTACION'];?>">Ver Detalle</a>
                </td>
                <?php
                // Agrega más columnas según tus necesidades
                echo "</tr>";
            }
            ?>
            
        </tbody>
    </table>
    
</body>
</html>