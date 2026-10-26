<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <?php $defecto = recogerDatosReserva() ?>
    <?php dump($defecto['material']) ?>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required value="<?= $defecto['nombre']['valido']? $defecto['nombre']['value']:'' ?>"><br><br>

        <label for="email">Email</label>
        <input type="text" name="email" required value="<?= $defecto['email']['valido']? $defecto['email']['value']:'' ?>"><br><br>

        <label for="pista">Pista</label>
        <select name="pista" required>
            <option value="Padel 1" <?= $defecto['pista']['valido'] && $defecto['pista']['value'] == 'Padel 1'? 'selected': '' ?>>Padel 1</option>
            <option value="Padel 2" <?= $defecto['pista']['valido'] && $defecto['pista']['value'] == 'Padel 2'? 'selected': '' ?>>Padel 2</option>
            <option value="Baloncesto" <?= $defecto['pista']['valido'] && $defecto['pista']['value'] == 'Baloncesto'? 'selected': '' ?>>Baloncesto</option>
            <option value="Tenis" <?= $defecto['pista']['valido'] && $defecto['pista']['value'] == 'Tenis'? 'selected': '' ?>>Tenis</option>
        </select><br><br>

        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" value="<?= $defecto['pista']['valido']? $defecto['fecha']['value']:'' ?>"><br><br>

        <label for="hora">Hora</label>
        <input type="radio" name="hora" value="16:00" required <?= $defecto['hora']['valido'] && $defecto['hora']['value'] == '16:00'? 'checked': '' ?>><label for="hora">16:00</label><br>
        <input type="radio" name="hora" value="17:00" <?= $defecto['hora']['valido'] && $defecto['hora']['value'] == '17:00'? 'checked': '' ?>><label for="hora">17:00</label><br>
        <input type="radio" name="hora" value="18:00" <?= $defecto['hora']['valido'] && $defecto['hora']['value'] == '18:00'? 'checked': '' ?>><label for="hora">18:00</label><br>
        <input type="radio" name="hora" value="19:00" <?= $defecto['hora']['valido'] && $defecto['hora']['value'] == '19:00'? 'checked': '' ?>><label for="hora">19:00</label><br>
        <input type="radio" name="hora" value="20:00" <?= $defecto['hora']['valido'] && $defecto['hora']['value'] == '20:00'? 'checked': '' ?>><label for="hora">20:00</label><br>
        <input type="radio" name="hora" value="21:00" <?= $defecto['hora']['valido'] && $defecto['hora']['value'] == '21:00'? 'checked': '' ?>><label for="hora">21:00</label><br><br>

        <label for="material[]">Material (Opcional)</label>
        <input type="checkbox" name="material[]" value="balon" <?= $defecto['material']['valido'] && in_array('balon', $defecto['material']['value'])? 'checked': '' ?>><label for="balon">Balon</label><br>
        <input type="checkbox" name="material[]" value="petos" <?= $defecto['material']['valido'] && in_array('petos', $defecto['material']['value'])? 'checked': '' ?>><label for="peto">Petos</label><br>
        <input type="checkbox" name="material[]" value="raqueta" <?= $defecto['material']['valido'] && in_array('raqueta', $defecto['material']['value'])? 'checked': '' ?>><label for="raqueta">Raqueta</label><br><br>

        <input type="checkbox" name="normas_aceptadas" required><label for="normas_aceptadas">Acepto las normas</label><br><br>

        <button type="submit">Enviar</button>
    </form>
    <a href="index.php"><button>Ver todas las reservas</button></a>

</body>
</html>