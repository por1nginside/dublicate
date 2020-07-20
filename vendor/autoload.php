<?php

function __autoload($className)
{
    $arrayParts = array(
        '/app/',
        '/ServiceProviders/',
    );

    foreach ($arrayParts as $path) {
        $path = ROOT . $path . $className . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}