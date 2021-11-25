<?php

session_start();
require_once "ACore.php";
spl_autoload_register('autoload');

function autoload($c) {
    if (file_exists("controller/".$c.".php")) {
        require_once "controller/".$c.".php";
    }
    elseif (file_exists("model/".$c.".php")) {
        require_once "model/".$c.".php";
    }
}

$main = new main();

$main -> get_body();