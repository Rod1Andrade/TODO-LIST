<?php
/**
 * AUTOCARREGAMENTO DAS CLASSES
 */

define("BASEDIR", __DIR__.'/..');

function configLoader($class)
{
    $class = str_replace('\\','/', $class);
    $extension = spl_autoload_extensions(".class.php");

    include_once BASEDIR.'/'.$class.$extension;
}

spl_autoload_register("configLoader");