<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <?php mostrarMensajeReserva();
    $defecto = recogerDatosReserva();
    dump($defecto['fecha']);
    ?>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <!-- Nombre -->
        <div>
            <label for="nombre">Nombre:</label>
            <input value="<?php echo $defecto['nombre'] ?>" type="text" id="nombre" name="nombre" required minlength="2" maxlength="60" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+" title="Debe contener entre 2 y 60 caracteres. Solo se admiten letras, tildes y ñ.">
        </div>
        <br>

        <!-- Email -->
        <div>
            <label for="email">Email:</label>
            <input value="<?php echo $defecto['email'] ?>" type="email" id="email" name="email" required>
        </div>
        <br>

        <!-- Pista -->
        <div>
            <label for="pista">Pista:</label>
            <select id="pista" name="pista" required>
                <option value="">Selecciona una pista...</option>
                <option value="Padel 1" <?= (isset($defecto['pista']) && $defecto['pista'] === 'Padel 1') ? 'selected' : '' ?>>Padel 1</option>
                <option value="Padel 2" <?= (isset($defecto['pista']) && $defecto['pista'] === 'Padel 2') ? 'selected' : '' ?>>Padel 2</option>
                <option value="Tenis" <?= (isset($defecto['pista']) && $defecto['pista'] === 'Tenis') ? 'selected' : '' ?>>Tenis</option>
                <option value="Baloncesto" <?= (isset($defecto['pista']) && $defecto['pista'] === 'Baloncesto') ? 'selected' : '' ?>>Baloncesto</option>
            </select>
        </div>
        <br>

        <!-- Fecha -->
        <div>
            <label for="fecha">Fecha:</label>
            <input value="<?php echo $defecto['fecha'] ?>" type="date" id="fecha" name="fecha" required>
        </div>
        <br>

        <!-- Hora -->
        <div>
            <label>Hora:</label><br>
            <input type="radio" id="h16" name="hora" value="16:00" <?= (isset($defecto['hora']) && $defecto['hora'] === '16:00') ? 'checked' : '' ?> required> <label for="h16">16:00</label><br>
            <input type="radio" id="h17" name="hora" value="17:00" <?= (isset($defecto['hora']) && $defecto['hora'] === '17:00') ? 'checked' : '' ?>> <label for="h17">17:00</label><br>
            <input type="radio" id="h18" name="hora" value="18:00" <?= (isset($defecto['hora']) && $defecto['hora'] === '18:00') ? 'checked' : '' ?>> <label for="h18">18:00</label><br>
            <input type="radio" id="h19" name="hora" value="19:00" <?= (isset($defecto['hora']) && $defecto['hora'] === '19:00') ? 'checked' : '' ?>> <label for="h19">19:00</label><br>
            <input type="radio" id="h20" name="hora" value="20:00" <?= (isset($defecto['hora']) && $defecto['hora'] === '20:00') ? 'checked' : '' ?>> <label for="h20">20:00</label><br>
            <input type="radio" id="h21" name="hora" value="21:00" <?= (isset($defecto['hora']) && $defecto['hora'] === '21:00') ? 'checked' : '' ?>> <label for="h21">21:00</label><br>
        </div>
        <br>

        <!-- Material -->
        <div>
            <label>Material (opcional):</label><br>
            <input type="checkbox" id="mat_raquetas" name="material[]" value="raquetas" <?= (isset($defecto['material']) && in_array('raquetas', $defecto['material']) ? 'checked' : '') ?>> <label for="mat_raquetas">Raquetas</label><br>
            <input type="checkbox" id="mat_balon" name="material[]" value="balon" <?= (isset($defecto['material']) && in_array('balon', $defecto['material']) ? 'checked' : '') ?>> <label for="mat_balon">Balón</label><br>
            <input type="checkbox" id="mat_petos" name="material[]" value="petos" <?= (isset($defecto['material']) && in_array('petos', $defecto['material']) ? 'checked' : '') ?>> <label for="mat_petos">Petos</label><br>
        </div>
        <br>

        <!-- Normas -->
        <div>
            <input type="checkbox" id="normas" name="normas" <?= (isset($defecto['hora']) && $defecto['normas'] === 'on') ? 'checked' : '' ?> required>
            <label for="normas">Acepto las normas</label>
        </div>
        <br>

        <!-- Enviar -->
        <div>
            <button type="submit">Enviar</button>
        </div>
    </form>
    <a href="index.php"><button><- Volver</button></a>
</body>

</html>