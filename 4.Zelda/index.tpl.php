<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zelda</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php /** @var Array $link */ ?>
<style>
    .link {
        background-image: url(tiles/link.png);
        background-repeat: no-repeat;
        background-size: 16px;
        position: absolute;
        left: <?= $link['x'] . 'rem' ?>;
        top: <?= $link['y'] . 'rem' ?>;
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
        <a href="?link_pos_x=<?= $link['x']; ?>&link_pos_y=<?= $link['y']-1; ?>">Arriba</a>
        <a href="?link_pos_x=<?= $link['x']; ?>&link_pos_y=<?= $link['y']+1; ?>">Abajo</a>
        <a href="?link_pos_x=<?= $link['x']-1; ?>&link_pos_y=<?= $link['y']; ?>">Izquierda</a>
        <a href="?link_pos_x=<?= $link['x']+1; ?>&link_pos_y=<?= $link['y']; ?>">Derecha</a>
    </div>

</body>

</html>
<!-- ?link_pos_x=4&link_pos_y=7 -->