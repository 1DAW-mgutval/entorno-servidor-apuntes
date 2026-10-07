<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $dbh = new PDO(
        'mysql:host=localhost;dbname=dwes;charset=utf8mb4', // DSN
        'dwes', // usuario
        'abc123.', // contraseña
        [ // opciones
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]

    );
    // $serverVersion = $dbh->getAttribute(PDO::ATTR_SERVER_VERSION);
    // var_dump($dbh);
    // echo "<br>".$serverVersion."<br>";

    // $dbs = $dbh->query('SELECT cod, nombre, tlf FROM tienda ORDER BY nombre');
    // if ($dbs) {
    //     $data = $dbs->fetchAll();
    //     var_dump($data);
    // }

    $deseado = filter_input(INPUT_GET, 'nombre');
    $familia = $dbh->query('SELECT * FROM familia')->fetchAll();
    if ($deseado !== null) {
        $familia = $dbh->query('SELECT * FROM familia WHERE nombre = "'.$deseado.'"')->fetchAll();
    }
    var_dump($familia);
} catch (Exception $e) {
    echo 'No se ha encontrado ese nombre';
}
