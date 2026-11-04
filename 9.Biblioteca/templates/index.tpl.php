<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <h1>Libros disponibles: <?php echo htmlspecialchars(contarDisponibles(conectarBaseDeDatos())); ?></h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
        <select name="genero">
            <option value="Todos">Todos</option>
            <option value="Novela">Novela</option>
            <option value="Teatro">Teatro</option>
            <option value="Ensayo">Ensayo</option>
            <option value="Cómic">Cómic</option>
            <option value="Poesía">Poesía</option>
            <input type="submit" value="Buscar">
        </select>
    </form>

    <?php $genero = obtenerGenero(); ?>
    <?php if ($genero == 'Todos') $genero = null; ?>
    <?php $listaLibros = listarLibros(conectarBaseDeDatos(), $genero); ?>

    <?php if (empty($listaLibros)): ?>
        <?php echo '<h1>No hay libros de este género</h1>'; ?>
    <?php else: ?>
        <table>
            <?php echo '<tr>' ?>
            <?php foreach (array_keys($listaLibros[0]) as $header): ?>
                <?php echo '<th>' . htmlspecialchars($header) . '</th>'; ?>
            <?php endforeach; ?>
            <?php echo '</tr>' ?>

            <?php foreach ($listaLibros as $libroActual): ?>
                <?php echo '<tr>' ?>
                <?php foreach ($libroActual as $header => $campo): ?>
                    <?php if ($header == 'titulo'): ?>
                        <?php echo '<td><a href=ficha.php?id=' . $libroActual['id'] . '>' . htmlspecialchars($campo) . '</a></td>' ?>
                    <?php else: ?>
                        <?php echo '<td>' . htmlspecialchars($campo) . '</td>'; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php echo '</tr>' ?>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <form action="nuevo.php">
        <input type="submit" value="Añadir libro">
    </form>
</body>

</html>