<?php
include('src/functions.php');

if (isset($_GET) && !empty($_GET) && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    $libro = obtenerLibro(conectarBaseDeDatos(), $id);
    if (!$libro) {
        echo '<h1>Libro no disponible</h1>';
    } else {
        if ($libro['disponible'] == 0) {
            $libro['disponible'] = 'Prestado';
        } else {
            $libro['disponible'] = 'Disponible';
        }
        dump($libro);
    }
} else {
    echo '<h1>Debe especificar un libro</h1>';
}