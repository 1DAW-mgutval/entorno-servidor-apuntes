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
    } catch (PDOException $th) {
        return null;
    }
}

function validarRegistro()
{
    if (isset($_POST) && !empty($_POST)) {
        return [
            'email' => validarEmailSession(),
            'nombre' => validarNombreSession(),
            'password' => validarPasswordSession()
        ];
    }
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
        'valid' => false,
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
        'valid' => false,
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
        'valid' => false,
        'value' => ''
    ];
}
