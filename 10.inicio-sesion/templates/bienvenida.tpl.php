<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <h1>Bienvenido/a, <?= htmlspecialchars($_SESSION['nombre']) ?></h1>

    <?php if (isset($historial) && isset($headers)): ?>
        <table>
            <tr>
                <?php foreach ($headers as $value): ?>
                    <th><?= $value ?></th>
                <?php endforeach; ?>
            </tr>
            <?php foreach ($historial as $resultadoActual): ?>
                <tr>
                    <?php foreach ($resultadoActual as $valor): ?>
                        <td><?= $valor ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <h3>Ningún cuestionario se ha hecho aún.</h3>
    <?php endif; ?>


    <a href="./logout.php"><button>Cerrar Sesión</button></a>
    <?php if (isset($_SESSION['cuestionario'])): ?>
        <?= '<a href="./cuestionario.php"><button>Continuar Cuestionario</button></a>' ?>
    <?php else: ?>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="submit" name="empezar" value="Empezar Cuestionario">
        </form>
    <?php endif; ?>
</body>

</html>