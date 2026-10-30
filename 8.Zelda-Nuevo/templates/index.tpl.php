<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zelda</title>
    <link rel="stylesheet" href="https://unpkg.com/simpledotcss/simple.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .link {
        background-image: url(tiles/link.png);
        background-repeat: no-repeat;
        background-size: 16px;
        position: absolute;
        left: <?= $_SESSION['link-x'] . 'rem' ?>;
        top: <?= $_SESSION['link-y'] . 'rem' ?>;
    }
</style>

<body>
    <h2>The Legend of Zelda: A link to PHP</h2>
    <div class="fondo">
        <div class="tile link"></div>
        <?php echo generarMapa(leerFichero()) ?>
    </div>

    <div class="controls">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <button type="submit" name="direccion" value="arriba">Arriba</button>

            <button type="submit" name="direccion" value="abajo">Abajo</button>

            <button type="submit" name="direccion" value="izquierda">Izquierda</button>

            <button type="submit" name="direccion" value="derecha">Derecha</button>
        </form>
    </div>

</body>

</html>