<?php
function dump($text)
{
    echo '<pre>';
    var_dump($text);
    echo '</pre>';
}

function conectarBaseDeDatos()
{
    try {
        $pdo = new PDO(
            'mysql:host=localhost;dbname=biblioteca;charset=utf8mb4',
            'root',
            'abc123.'
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        return $pdo;
    } catch (PDOException $err) {
        dump('No se puede conectar con la base de datos');
        return null;
    }
}

function contarDisponibles(PDO $pdo)
{
    $statement = $pdo->prepare("SELECT COUNT(*) FROM libros");
    return $statement->execute();
    return $statement->fetchColumn();
}
