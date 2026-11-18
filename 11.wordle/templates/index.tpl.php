<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wordle</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <style>
        .palabra{
            display: flex;
            gap: 20px;
            input{
                width: 100px;
            }
            margin-top: 20px;
        }

        .noValid{
            background-color: red;
        }

        .valid{
            background-color: green;
        }

        .exist{
            background-color: yellow;
        }
    </style>
</head>

<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="palabra">
        <?php foreach (str_split($_SESSION['palabra']) as $key => $value): ?>
            <input type="text" name="letras[<?= $key ?>]">
        <?php endforeach; ?>
        <input type="submit" value="Adivinar">
    </form>
</body>

</html>