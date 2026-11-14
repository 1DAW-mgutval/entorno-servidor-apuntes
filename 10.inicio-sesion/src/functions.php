<?php

use function PHPSTORM_META\type;

function dump($dump)
{
    echo '<pre>';
    print_r($dump, false);
    echo '</pre>';
}

function conectDB()
{
    try {
        $pdo = new PDO(
            'mysql:host=172.22.69.11;dbname=login_dwes',
            'root',
            'root',
            [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false,
            ]
        );
        return $pdo;
    } catch (PDOException $th) {
        return null;
    }
}

function validarRegistro()
{
    return [
        'email' => validarEmailSession(),
        'nombre' => validarNombreSession(),
        'password' => validarPasswordSession()
    ];
}

function validarEmailSession()
{
    if (isset($_POST['email'])) {
        $email =  filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        return [
            'valid' => (is_string($email)) ? true : false,
            'value' => $_POST['email']
        ];
    }
    return [
        'valid' => null,
        'value' => ''
    ];
}

function validarNombreSession()
{
    if (isset($_POST['nombre'])) {
        return [
            'valid' => (strlen($_POST['nombre']) > 1 && strlen($_POST['nombre']) < 100) ? true : false,
            'value' => $_POST['nombre']
        ];
    }
    return [
        'valid' => null,
        'value' => ''
    ];
}

function validarPasswordSession()
{
    if (isset($_POST['password'])) {
        return [
            'valid' => (strlen($_POST['password']) > 1 && strlen($_POST['password']) < 100) ? true : false,
            'value' => $_POST['password']
        ];
    }
    return [
        'valid' => null,
        'value' => ''
    ];
}

function registrarUsuario($usuario)
{
    try {
        $pdo = conectDB();
        $statment = $pdo->prepare('INSERT INTO usuarios(email, nombre, contrasena) VALUES(?,?,?)');
        $statment->execute([$usuario['email']['value'], $usuario['nombre']['value'], password_hash($usuario['password']['value'], PASSWORD_DEFAULT)]);
        return $statment->rowCount();
    } catch (PDOException $th) {
        return 0;
    }
}

function validarLogin()
{
    return [
        'email' => validarEmailSession(),
        'password' => validarPasswordSession()
    ];
}

function intentarLogin($usuario)
{
    foreach ($usuario as $value) {
        if ($value['valid'] === null) {
            return null;
        } elseif ($value['valid'] === false) {
            return false;
        }
    }
    try {
        $pdo = conectDB();
        $statment = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
        $statment->execute([$usuario['email']['value']]);
        $statment = $statment->fetch();
        if (isset($statment['contrasena']) && !empty($statment['contrasena'])) {
            if (password_verify($usuario['password']['value'], $statment['contrasena'])) {
                return $statment;
            }
        }
        return false;
    } catch (PDOException $th) {
        return false;
    }
}

function obtenerPreguntasAleatorias() {
    try {
        $pdo = conectDB();
        $pdo = $pdo->query('SELECT id FROM preguntas');
        $pdo = $pdo->fetchAll();
        shuffle($pdo);
        $res = [];
        foreach ($pdo as $value) {
            $res[] = $value['id'];
        }
        return array_slice($res, 0, 5);
    } catch (PDOException $th) {
        return null;
    }
}

function obtenerPregunta($idPregunta) {
    try {
        $pdo = conectDB();
        $statment = $pdo->prepare('SELECT enunciado, opcion_a, opcion_b, opcion_c, opcion_d, correcta FROM preguntas WHERE id = ?');
        $statment->execute([$idPregunta]);
        return $statment->fetch();
    } catch (PDOException $th) {
        return null;
    }
}