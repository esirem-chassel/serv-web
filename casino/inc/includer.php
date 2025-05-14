<?php
    spl_autoload_register(function($clsName) {
        $clsName = preg_replace('`[^a-zA-Z0-9]`', '', trim($clsName));
        $fn = __DIR__.'/'.$clsName.'.php';
        if(file_exists($fn)) {
            require_once $fn;
        }
    });
