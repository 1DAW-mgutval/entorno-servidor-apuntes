<?php
include_once(__DIR__.'/src/functions.php');
session_start();

if (!isset($_SESSION['palabra'])) {
    $_SESSION['palabra'] = generarPalabra();
}

include_once(__DIR__.'/templates/index.tpl.php');