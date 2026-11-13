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

    <?php if (isset($flash)): ?>
        <?= '<h3>' . $flash . '</h3>' ?>
    <?php endif; ?>

    <?php if (isset($login) && $login === false): ?>
        <?php echo '<h3>Email o contraseña incorrectos</h3>' ?>
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