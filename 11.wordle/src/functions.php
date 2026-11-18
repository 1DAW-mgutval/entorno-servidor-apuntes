<?php
function dump($dump) {
    echo'<pre>';
    print_r($dump,true);
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