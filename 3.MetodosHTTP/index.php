<?php
function dump($dump)
{
    echo "<pre>" . $dump . "</pre>";
}

dump(print_r($_GET, true));