<?php
session_start();

if (isset($_SESSION['id'])) {
    header('Location: ./bienvenida.php');
}

include('src/functions.php');

$registro = validarRegistro();
$registrado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $registrar = true;
    foreach ($registro as $value) {
        if ($value['valid'] == false) {
            $registrar = false;
        }
    }
    if ($registrar) {
        $registrado = registrarUsuario($registro);
    }

    if ($registrado > 0) {
        $_SESSION['flash'] = 'Registro completado. Ya puedes iniciar sesión';
        header('Location: ./bienvenida.php');
    }
}


include('templates/registro.tpl.php');
