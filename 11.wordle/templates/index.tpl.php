<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wordle</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <style>
        .palabra {
            display: flex;
            gap: 20px;
            justify-content: center;
            align-items: center;
            input,
            p {
                width: 100px;
            }

            margin-top: 20px;
        }

        .noValid {
            background-color: red;
        }

        .valid {
            background-color: green;
        }

        .exist {
            background-color: yellow;
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['intentosAnteriores'])): ?>
        <?php foreach ($_SESSION['intentosAnteriores'] as $intentoActual): ?>
            <div class="palabra">
                <?php foreach ($intentoActual as $letraActual): ?>
                    <?php if ($letraActual['valid'] == 1): ?>
                        <p class="valid"><?= $letraActual['letra'] ?></p>
                    <?php elseif ($letraActual['valid'] == 0): ?>
                        <p class="exist"><?= $letraActual['letra'] ?></p>
                    <?php elseif ($letraActual['valid'] == -1): ?>
                        <p class="noValid"><?= $letraActual['letra'] ?></p>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="palabra">
        <?php foreach (str_split($_SESSION['palabra']) as $key => $value): ?>
            <input type="text" name="letras[<?= $key ?>]">
        <?php endforeach; ?>
        <input type="submit" value="Adivinar">
    </form>
</body>

</html>