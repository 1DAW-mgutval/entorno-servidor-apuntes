<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <?php if (isset($preguntaActual)): ?>
        <?= '<h1>' . $preguntaActual['enunciado'] . '</h1>' ?>
        <form action="" method="post">
            <?php foreach ($preguntaActual as $key => $value): ?>
                <?php if (str_contains($key, 'opcion')): ?>
                    <input type="radio" name="opcion" id="<?= $key ?>" value="<?= strtoupper(substr($key, -1)) ?>" />
                    <label for="<?= $key ?>"><?= $value ?></label><br>
                <?php endif; ?>
            <?php endforeach; ?>
            <br><input type="submit" name="Enviar">
        </form>
    <?php endif; ?>
</body>

</html>