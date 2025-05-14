<?php
require_once 'inc/includer.php';

if(Installer::getInstance()->isInstalled()) {
    echo 'ALREADY INSTALLED';
    exit;
}

if('cli' === php_sapi_name()) {
    if(!empty($argv) && (2 === $argc)) {
        Installer::getInstance()->install($argv[1]);
    } else {
        echo 'Usage : php install.php <apiKey>';
        exit;
    }
} else {
    echo 'ONLY IN CLI MODE ! use php install.php <apiKey>';
    exit;
}
