<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <?php if (!isset($_SESSION)): ?>
        <?php header('Location: ./login.php') ?>
    <?php endif; ?>

    <h1>Bienvenido/a, <?= htmlspecialchars($_SESSION['nombre']) ?></h1>
    <a href="./logout.php"><button>Cerrar Sesión</button></a>
</body>

</html>