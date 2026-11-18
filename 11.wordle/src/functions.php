<?php
function dump($dump) {
    echo'<pre>';
    var_dump($dump);
    echo'</pre>';
}

function generarPalabra() {
    $palabrasValidas = [
        'JOSEDA',
        'HUGO',
        'ZELDA',
        'JASON',
        'LINUX'
    ];
    return $palabrasValidas[random_int(0, count($palabrasValidas)-1)];
}

function validarLetra($letra) {
    if (in_array(strtoupper($letra), ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z'])) {
        
    }
}