<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesión</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <h1>Inicia Sesión:</h1>

    <?php $usuario = validarLogin(); ?>
    <?php $login = true; ?>
    <?php foreach ($usuario as $campo): ?>
        <?php if ($campo['valid'] === false): ?>
            <?php $login = false; ?>
        <?php endif; ?>

        <?php if ($campo['valid'] === null): ?>
            <?php $login = null; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if ($login): ?>
        <?php $login = intentarLogin($usuario) ?>
    <?php endif; ?>

    <?php if ($login === false): ?>
        <?php echo '<h3>Email o contraseña incorrectos</h3>' ?>
    <?php elseif($login == true): ?>
        <?php $_SESSION['id'] = $login['id']; ?>
        <?php $_SESSION['nombre'] = $login['nombre']; ?>
    <?php endif; ?>


    <form action="" method="post">
        <label for="email">Correo:</label>
        <input type="text" name="email">

        <label for="password">Contraseña:</label>
        <input type="password" name="password"><br>

        <input type="submit" value="Enviar">
    </form>

    <a href="./registro.php"><button>Registrarme</button></a>


</body>

</html>