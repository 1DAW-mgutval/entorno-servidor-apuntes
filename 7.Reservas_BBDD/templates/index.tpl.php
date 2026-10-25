<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <form action="">
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
    <a href="reservar.php"><button>Reservar</button></a>
    <table>
        <?php $reservas = recogerReservas(); ?>
        <!-- Miro si hay reservas -->
        <?php if (isset($reservas) && !empty($reservas)) { ?>
            <!-- Creo la cabezera de la tabla -->
            <tr>
                <?php foreach (array_keys($reservas[0]) as $campo) { ?>
                    <th><?php echo $campo ?></th>
                <?php } ?>
            </tr>

            <?php foreach ($reservas as $reserva) { ?>
                <tr>
                    <?php foreach ($reserva as $campo => $dato) { ?>
                        <td><?php echo $dato ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>

            <!-- Si no hay reservas lanzo un mensaje de error -->
        <?php } else { ?>
            <h2> RESERVAS NO ENCONTRADAS </h2>
        <?php } ?>
    </table>
</body>

</html>