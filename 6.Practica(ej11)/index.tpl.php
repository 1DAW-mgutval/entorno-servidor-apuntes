<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <table>
        <?php pintarResultado() ?>
    </table>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
        <select id="pista" name="pista" for="fecha">
            <option value="">Selecciona una pista...</option>
            <option value="padel1">Padel 1</option>
            <option value="padel2">Padel 2</option>
            <option value="tenis">Tenis</option>
            <option value="baloncesto">Baloncesto</option>
        </select>
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha">
        <button type="submit">Enviar</button>
    </form>
    <a href="index.php"><button>Limpiar</button></a>

</body>

</html>