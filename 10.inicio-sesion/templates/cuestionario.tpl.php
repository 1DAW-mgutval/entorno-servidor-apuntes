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
        <?= '<h1>' . htmlspecialchars($preguntaActual['enunciado']) . '</h1>' ?>

        <?php if (isset($_SESSION['flash'])): ?>
            <?= '<h3>' . htmlspecialchars($_SESSION['flash']) . '</h3>' ?>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <form action="" method="post">
            <?php foreach ($preguntaActual as $key => $value): ?>
                <?php if (str_contains($key, 'opcion')): ?>
                    <input type="radio" name="opcion" id="<?= $key ?>" value="<?= htmlspecialchars(strtoupper(substr($key, -1))) ?>" />
                    <label for="<?= htmlspecialchars($key) ?>"><?= htmlspecialchars($value) ?></label><br>
                    <input type="hidden" name="idPregunta" value="<?= htmlspecialchars($preguntaActual['id']) ?>">
                <?php endif; ?>
            <?php endforeach; ?>
            <br><input type="submit">
        </form>
    <?php endif; ?>
</body>

</html>