<?php
    spl_autoload_register('autoload');
    function autoload($class) {
        $path = 'classes/';
        $extension = '.php';
        $fullPath = $path . $class . $extension;
        if (!include_once $fullPath) {
            throw new Exception ("Nemlétező osztály: " . $fullPath);
        }
    }