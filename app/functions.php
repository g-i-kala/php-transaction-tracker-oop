<?php

function dd($variable): never
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    die();
}
