<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <?php $registro = validarRegistro(); ?>
    <?php $registrar = true; ?>

    <?php foreach ($registro as $clave => $campo): ?>
        <?php if ($campo['valid'] === false): ?>
            <?= '<h1>' . $clave . ' NO ES VÁLIDO</h1>' ?>
            <?php $registrar = false; ?>
        <?php elseif ($campo['valid'] === null): ?>
            <?php $registrar = false; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <h1>Crea tu usuario:</h1>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="email">Correo:</label>
        <input type="text" name="email" value="<?= htmlspecialchars($registro['email']['value']) ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($registro['nombre']['value']) ?>">

        <label for="password">Contraseña:</label>
        <input type="password" name="password"><br>

        <input type="submit" value="Enviar">
    </form>

    <a href="./login.php"><button>Iniciar Sesión</button></a>

    <?php if ($registrar === true): ?>
        <?php $usuarioRegistrado = registrarUsuario($registro); ?>
        <?php if ($usuarioRegistrado > 0): ?>
            <?php header('Location: ./login.php') ?>
        <?php else: ?>
            <?= '<h1>El usuario ya existe. Use otro email.</h1>' ?>
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>