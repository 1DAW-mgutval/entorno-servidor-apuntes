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
            'mysql:host=db;dbname=biblioteca;charset=utf8mb4',
            'root',
            'root'
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    } catch (PDOException $err) {
        dump('No se puede conectar con la base de datos');
        return null;
    }
}

function contarDisponibles(PDO $pdo)
{
    $statement = $pdo->prepare("SELECT COUNT(*) FROM libros");
    $statement->execute();
    return $statement->fetchColumn();
}

function obtenerLibro(PDO $pdo, int $id) {
    $statement = $pdo->prepare("SELECT * FROM libros WHERE id = ?");
    $statement->execute([$id]);
    $statement = $statement->fetch();
    if (!empty($statement)) {
        return $statement;
    } else {
        return false;
    }
}
