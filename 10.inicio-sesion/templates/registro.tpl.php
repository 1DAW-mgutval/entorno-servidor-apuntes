<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <h1>Crea tu usuario:</h1>

    <?php if (isset($registro) && isset($registrado) && $registrado < 1): ?>
        <?= '<h2>Este usuario ya existe</h2>' ?>
    <?php elseif (isset($registro)): ?>
        <?php foreach ($registro as $clave => $campo): ?>
            <?php if ($campo['valid'] === false): ?>
                <?= '<h1>' . $clave . ' NO ES VÁLIDO</h1>' ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>


    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="email">Correo:</label>
        <input type="text" name="email" value="<?= isset($registro) ? htmlspecialchars($registro['email']['value']) : '' ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?= isset($registro) ? htmlspecialchars($registro['nombre']['value']) : '' ?>">

        <label for="password">Contraseña:</label>
        <input type="password" name="password"><br>

        <input type="submit" value="Enviar">
    </form>

    <a href="./login.php"><button>Iniciar Sesión</button></a>
</body>

</html>