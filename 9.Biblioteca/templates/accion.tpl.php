<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accion</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <?php $accion = validarAccion($_POST) ?>
    <?php if ($accion != 0): ?>
        <?php if (cambiarDisponible(conectarBaseDeDatos(), $accion['id'], $accion['accion']) > 0): ?>
            <?= '<h1>Estado cambiado correctamente</h1><a href="./index.php"><button>Volver a la lista de libros</button></a>' ?>
        <?php else: ?>
            <?= '<h1>NO se ha podido cambiar el estado</h1><a href="./index.php"><button>Volver a la lista de libros</button></a>' ?>
        <?php endif; ?>
    <?php else: ?>
        <?= '<h1>NO se ha podido cambiar el estado</h1><a href="./index.php"><button>Volver a la lista de libros</button></a>' ?>
    <?php endif; ?>
</body>

</html>