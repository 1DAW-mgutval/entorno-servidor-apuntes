<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <h1>Creación de nuevo libro</h1><br><br>
    <?php $default = validarLIbroNuevo($_POST); ?>
    <?php $indice = insertarLibro(conectarBaseDeDatos(), $default); ?>
    <?= ($indice == -2) ? '<h3>Ya existe un libro con ese ISBN</h3>' : '' ?>
    <?= ($indice > 0) ? '<h3>Libro añadido con un id N' . $indice . '</h3><a href="./index.php"><button>Volver al listado</button></a><br><br><br><br>' : '' ?>
    <?php if ($indice == -1): ?>
        <?= '<ul>' ?>
        <?php foreach ($default as $campo): ?>
            <?= (isset($campo['mensaje'])) ? '<li>' . $campo['mensaje'] . '</li>' : '' ?>
        <?php endforeach; ?>
        <?= '</ul>' ?>
    <?php endif; ?>


    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="isbn">ISBN</label>
        <input type="text" name="isbn" value="<?= htmlspecialchars($default['isbn']['value']); ?>">

        <label for="isbn">Titulo</label>
        <input type="text" name="titulo" value="<?= htmlspecialchars($default['titulo']['value']); ?>">

        <label for="autor">Autor</label>
        <input type="text" name="autor" value="<?= htmlspecialchars($default['autor']['value']); ?>">

        <label for="anio">Año</label>
        <input type="number" name="anio" value="<?= htmlspecialchars($default['anio']['value']); ?>">

        <label for="genero">Género</label>
        <select name="genero">
            <option value="Novela" <?= ($default['genero']['value'] == 'Novela') ? 'selected' : '' ?>>Novela</option>
            <option value="Poesía" <?= ($default['genero']['value'] == 'Poesía') ? 'selected' : '' ?>>Poesía</option>
            <option value="Teatro" <?= ($default['genero']['value'] == 'Teatro') ? 'selected' : '' ?>>Teatro</option>
            <option value="Ensayo" <?= ($default['genero']['value'] == 'Ensayo') ? 'selected' : '' ?>>Ensayo</option>
            <option value="Cómic" <?= ($default['genero']['value'] == 'Cómic') ? 'selected' : '' ?>>Cómic</option>
        </select><br>

        <input type="submit" value="Enviar">
    </form>
    <a href="./index.php"><button>Volver al listado</button>
</body>

</html>