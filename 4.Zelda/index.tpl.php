<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zelda</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>The Legend of Zelda: A link to PHP</h1>
    <div class="fondo">
        <?php /** @var String $mapa */ ?>
        <?php echo pintarMapa($mapa) ?>
    </div>
    
</body>

</html>