<?php

session_start();

if (isset($_SESSION['id'])|| isset($_SESSION['login'])){
    function autoload($c) {
        if (file_exists("controller/".$c.".php")) {
            require_once "controller/".$c.".php";
        }
        elseif (file_exists("model/".$c.".php")) {
            require_once "model/".$c.".php";
        }
    }
    spl_autoload_register('autoload');

    if (isset($_GET['error'])) {}
    else {
        $main = new main;
        $main -> get_content();
    }

} else {
    session_destroy();
    header("Location: index.php");
}