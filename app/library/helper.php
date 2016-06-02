<?php

/**
 * helper classes
 */

/** loads ini configuration file */
function config($configName)
{
    $dir = __DIR__ . '/../configs/';
    $filepath = $dir . $configName . '.ini';
    
    if (!file_exists($filepath)) {
        exit ('wrong config file name');
    }

    return parse_ini_file($filepath);
}

/** dump and die */
function dd($variable)
{
    var_dump($variable);
    die;
}