<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zelda</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php /** @var Array $_SESSION */ ?>
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
    <h1>The Legend of Zelda: A link to PHP</h1>
    <div class="fondo">
        <div class="tile link"></div>
        <?php /** @var array $mapa */ ?>
        <?php echo generarMapa($mapa) ?>
    </div>

    <div class="controls">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <button type="submit" name="arriba" value="true">Arriba</button>

            <button type="submit" name="abajo" value="true">Abajo</button>

            <button type="submit" name="izquierda" value="true">Izquierda</button>

            <button type="submit" name="derecha" value="true">Derecha</button>
        </form>
        <a href="?link_pos_x=<?= $_SESSION['link-x']; ?>&link_pos_y=<?= $_SESSION['link-y'] - 1; ?>"><button>Arriba</button></a>
        <a href="?link_pos_x=<?= $_SESSION['link-x']; ?>&link_pos_y=<?= $_SESSION['link-y'] + 1; ?>"><button>Abajo</button></a>
        <a href="?link_pos_x=<?= $_SESSION['link-x'] - 1; ?>&link_pos_y=<?= $_SESSION['link-y']; ?>"><button>Izquierda</button></a>
        <a href="?link_pos_x=<?= $_SESSION['link-x'] + 1; ?>&link_pos_y=<?= $_SESSION['link-y']; ?>"><button>Derecha</button></a>
    </div>

</body>

</html>
<!-- ?link_pos_x=4&link_pos_y=7 -->