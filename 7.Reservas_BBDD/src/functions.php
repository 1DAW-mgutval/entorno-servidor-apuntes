<?php
// Función debug
function dump($dump)
{
    echo "<pre>";
    var_dump($dump);
    echo "</pre>";
}

// Devuelve la conexión con la base de datos o null.
function conectarBD()
{
    try {
        $dbConnection = new PDO(
            'mysql:host=localhost;dbname=gestion_reservas;charset=utf8mb4', // DSN
            'mario', // usuario
            'root', // contraseña
            [ // opciones
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]

        );
        return $dbConnection;
    } catch (Exception $e) {
        return null;
    }
}

// Devuelve todas las reservas
function recogerReservas()
{
    $dbConnection = conectarBD();
    $filtro = validarFiltro();
    $queryString = 'SELECT usuarios.nombre AS usuario, pistas.nombre AS pista, reservas.fecha, reservas.hora
        FROM reservas
        JOIN usuarios
        JOIN pistas
        ON reservas.usuario_id = usuarios.id AND reservas.pista_id = pistas.id';
    if (!empty($filtro)) {
        if (array_key_exists('pista', $filtro)) {
            $queryString .= ' WHERE pistas.nombre = "' . $filtro['pista'] . '"';
        }
        if (array_key_exists('fecha', $filtro)) {
            if (count($filtro) == 2) {
                $queryString .= ' AND reservas.fecha = "' . $filtro['fecha'] . '"';
            } else {
                $queryString .= ' WHERE reservas.fecha = "' . $filtro['fecha'] . '"';
            }
        }
    }
    $queryString .= ';';
    if ($dbConnection !== null) {
        $reservas = $dbConnection->query($queryString)->fetchAll();
        return $reservas;
    }
    return null;
}

// Valido los filtros del usuario:
function validarFiltro()
{
    if (isset($_GET) && !empty($_GET)) {
        if (array_key_exists('pista', $_GET)) {
            if (empty($_GET['pista']) || !in_array($_GET['pista'], ['Padel 1', 'Padel 2', 'Tenis', 'Baloncesto'])) {
                unset($_GET['pista']);
            }
        }
        if (array_key_exists('fecha', $_GET)) {
            if (empty($_GET['fecha']) || !checkdate(substr($_GET['fecha'], 5, 2), substr($_GET['fecha'], 8, 2), substr($_GET['fecha'], 0, 4))) {
                unset($_GET['fecha']);
            }
        }
        return $_GET;
    }
    return [];
}
