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
            if (!empty($_GET['pista'])) {
                if (!in_array($_GET['pista'], ['Padel 1', 'Padel 2', 'Baloncesto', 'Tenis'])) {
                    unset($_GET['pista']);
                }
            } else {
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

// Recoge los datos del formulario del usuario:
function recogerDatosReserva()
{
    return [
        'id' => '',
        'nombre'   => validarNombre(),
        'email'    => validarEmail(),
        'pista'    => validarPista(),
        'fecha'    => validarFecha(),
        'hora'     => validarHora(),
        'material' => validarMaterial(),
        'normas_aceptadas'   => validarNormas_Aceptadas()
    ];
}

function validarEmail()
{
    if ($email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
        return [
            'valido' => true,
            'value' => $email
        ];
    }
    return [
        'valido' => false,
        'mensaje' => 'La reserva debe tener un email válido',
        'value' => isset($_POST['email']) ? $_POST['email'] : ''
    ];
}

function validarNombre()
{

    if ($nombre = filter_input(INPUT_POST, 'nombre')) {
        if (strlen($nombre) < 3) {
            return [
                'valido' => false,
                'mensaje' => 'El nombre debe tener más de 2 caracteres',
                'value' => $nombre
            ];
        }
        if (strlen($nombre) > 60) {
            return [
                'valido' => false,
                'mensaje' => 'El nombre debe tener como máximo 60 caracteres',
                'value' => $nombre
            ];
        }
        return [
            'valido' => true,
            'value' => $nombre
        ];
    }
    return [
        'valido' => false,
        'mensaje' => 'La reserva debe tener un nombre válido',
        'value' => $nombre
    ];
}

function validarPista()
{

    if ($pista = filter_input(INPUT_POST, 'pista')) {
        if (in_array($pista, ['Padel 1', 'Padel 2', 'Baloncesto', 'Tenis'])) {
            return [
                'valido' => true,
                'value' => $pista
            ];
        }
    }
    return [
        'valido' => false,
        'mensaje' => 'Debe seleccionar una pista válida',
        'value' => $pista
    ];
}

function validarFecha()
{

    if ($fecha = filter_input(INPUT_POST, 'fecha')) {
        if (checkdate(substr($fecha, 5, 2), substr($fecha, 8, 2), substr($fecha, 0, 4))) {
            return [
                'valido' => true,
                'value' => $fecha
            ];
        }
    }
    return [
        'valido' => false,
        'mensaje' => 'Debe seleccionar una fecha válida',
        'value' => $fecha
    ];
}

// aRREGLARRRR
function validarMaterial()
{
    dump($_POST);
    if ($materiales = filter_input(INPUT_POST, 'material')) {
        foreach ($materiales as $key => $materialActual) {
            if (!in_array($materialActual, ['balon', 'petos', 'raqueta'])) {
                return [
                    'valido' => false,
                    'mensaje' => 'Debe seleccionar materiales validos',
                    'value' => []
                ];
            }
        }
        return [
            'valido' => true,
            'value' => $materiales
        ];
    }
    return [
        'valido' => false,
        'mensaje' => 'Debe seleccionar materiales validos',
        'value' => []
    ];
}

function validarHora()
{
    if ($hora = filter_input(INPUT_POST, 'hora')) {
        if (in_array($hora, ['16:00', '17:00', '18:00', '19:00', '20:00', '21:00'])) {
            return [
                'valido' => true,
                'value' => $hora
            ];
        }
    }
    return [
        'valido' => false,
        'mensaje' => 'Debe seleccionar una hora válida',
        'value' => $hora
    ];
}

function validarNormas_Aceptadas()
{
    if ($normas_aceptadas = filter_input(INPUT_POST, 'normas_aceptadas')) {
        if ($normas_aceptadas) {
            return [
                'valido' => true,
                'value' => $normas_aceptadas
            ];
        }
    }
    return [
        'valido' => false,
        'mensaje' => 'Debe aceptar las normas',
        'value' => $normas_aceptadas
    ];
}
