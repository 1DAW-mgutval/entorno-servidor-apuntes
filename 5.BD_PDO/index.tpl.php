<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<body>
    <ul>
    <?php /** @var array $familia */ ?>
    <?php foreach ($familia as $key => $value) {
        echo '<ul><li>';
        foreach ($value as $clave => $valor) {
            echo $valor.' ';
        }
        echo '</li></ul>';
    } 
    ?>
    </ul>
</body>

</html>