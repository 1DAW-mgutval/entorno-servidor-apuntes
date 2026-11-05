<?php
define('GENEROS_DISPONIBLES', ['Novela', 'Poesía', 'Teatro', 'Ensayo', 'Cómic']);

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

function obtenerLibro(PDO $pdo, int $id)
{
    $statement = $pdo->prepare("SELECT * FROM libros WHERE id = ?");
    $statement->execute([$id]);
    $statement = $statement->fetch();
    if (!empty($statement)) {
        return $statement;
    } else {
        return false;
    }
}

function listarLibros(PDO $pdo, ?string $genero = null): array
{
    if ($genero == null) {
        return $pdo->query('SELECT * FROM libros ORDER BY genero')->fetchAll();
    } else {
        $statement = $pdo->prepare('SELECT * FROM libros WHERE genero = ?');
        $statement->execute([$genero]);
        return $statement->fetchAll();
    }
}

function obtenerGenero()
{
    if (isset($_GET) && !empty($_GET) && isset($_GET['genero'])) {
        return htmlspecialchars($_GET['genero']);
    }
    return null;
}

function insertarLibro(PDO $pdo, array $datos): int
{
    try {
        foreach ($datos as $campo) {
            if (!$campo['valid']) {
                return -1;
            }
        }

        $statement = $pdo->prepare('INSERT INTO libros(isbn, titulo, autor, anio, genero, disponible) VALUES (?,?,?,?,?,1);');
        $statement = $statement->execute(array($datos['isbn']['value'], $datos['titulo']['value'], $datos['autor']['value'], $datos['anio']['value'], $datos['genero']['value']));

        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        return -2;
    }
}

function validarLIbroNuevo(array $datos)
{
    return [
        'isbn' => validarISBN($datos),
        'titulo' => validarTitulo($datos),
        'autor' => validarAutor($datos),
        'anio' => validarAnio($datos),
        'genero' => validarGenero($datos)
    ];
}

function validarISBN($datos)
{
    if (isset($datos['isbn']) && !empty($datos['isbn'])) {
        return [
            'valid' => true,
            'value' => htmlspecialchars($datos['isbn'])
        ];
    }
    return [
        'valid' => false,
        'value' => isset($datos['isbn']) ? $datos['isbn'] : '',
        'mensaje' => 'El libro debe tener un ISBN'
    ];
}

function validarTitulo($datos)
{
    if (isset($datos['titulo']) && !empty($datos['titulo'])) {
        return [
            'valid' => true,
            'value' => htmlspecialchars($datos['titulo'])
        ];
    }
    return [
        'valid' => false,
        'value' => isset($datos['titulo']) ? $datos['titulo'] : '',
        'mensaje' => 'El libro debe tener un titulo'
    ];
}

function validarAutor($datos)
{
    if (isset($datos['autor']) && !empty($datos['autor'])) {
        return [
            'valid' => true,
            'value' => htmlspecialchars($datos['autor'])
        ];
    }
    return [
        'valid' => false,
        'value' => isset($datos['autor']) ? $datos['autor'] : '',
        'mensaje' => 'El libro debe tener un autor'
    ];
}

function validarAnio($datos)
{
    if (isset($datos['isbn']) && !empty($datos['isbn'])) {
        if (is_numeric($datos['anio']) && checkdate(1, 1, (int)$datos['anio']) && $datos['anio'] <= getdate()['year']) {
            return [
                'valid' => true,
                'value' => htmlspecialchars($datos['anio'])
            ];
        }
        return [
            'valid' => false,
            'value' => $datos['anio'],
            'mensaje' => 'El libro debe tener un año válido'
        ];
    }
    return [
        'valid' => false,
        'value' => isset($datos['anio']) ? $datos['anio'] : '',
        'mensaje' => 'El libro debe tener un año'
    ];
}

function validarGenero($datos)
{
    if (isset($datos['genero']) && !empty($datos['genero'])) {
        if (in_array($datos['genero'], GENEROS_DISPONIBLES)) {
            return [
                'valid' => true,
                'value' => htmlspecialchars($datos['genero'])
            ];
        }
        return [
            'valid' => false,
            'value' => $datos['genero'],
            'mensaje' => 'El libro debe tener un genero válido'
        ];
    }
    return [
        'valid' => false,
        'value' => isset($datos['genero']) ? $datos['genero'] : '',
        'mensaje' => 'El libro debe tener un genero'
    ];
}

function cambiarDisponible(PDO $pdo, int $id, int $disponible): int {
    try {
        $contrario = 0;
        $disponible == 0 ? $contrario = 1: $contrario = 0;

        $statement = $pdo->prepare('UPDATE libros SET disponible = ? WHERE id = ? AND disponible = ? ');
        $statement->execute(array($contrario, $id, $disponible));

        return $statement->rowCount();

    } catch (\Throwable $th) {
        return 0;
    }
}

function validarAccion($array) {
    if (isset($array['id']) && !empty($array['id']) && isset($array['accion']) && !empty($array['accion'])) {
        if (is_numeric($array['id']) && in_array($array['accion'], ['devolver', 'prestar'])) {
            $array['accion'] == 'devolver' ? $array['accion'] = 0 : $array['accion'] = 1;
            return [
                'id' => htmlspecialchars($array['id']),
                'accion' => htmlspecialchars($array['accion'])
            ];
        }
    } else {
        return 0;
    }
}