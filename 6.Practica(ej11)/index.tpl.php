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
        <select id="pista" name="pista">
            <option value="">Selecciona una pista...</option>
            <option value="Padel 1">Padel 1</option>
            <option value="Padel 2">Padel 2</option>
            <option value="Tenis">Tenis</option>
            <option value="Baloncesto">Baloncesto</option>
        </select>
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha">
        <button type="submit">Enviar</button>
    </form>
    <a href="index.php"><button>Limpiar</button></a>
    <a href="reservar.php"><button>Reservar Pista -></button></a>

</body>

</html>