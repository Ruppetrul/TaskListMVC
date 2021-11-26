<?php

function autoload($c) {
    if (file_exists("controller/".$c.".php")) {
        require_once "controller/".$c.".php";
    }
    elseif (file_exists("model/".$c.".php")) {
        require_once "model/".$c.".php";
    }
}

spl_autoload_register('autoload');

session_start();

var_dump($_POST);


if (isset($_POST['send'])) {

    if (isset($_POST['login']) && isset($_POST["password"])) {

        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;

        header("Location: index.php?controller=index_controller&method=login");
    }
}

if (isset($_GET['controller'])) {

    $class = trim(strip_tags($_GET['controller']));
    $method = trim(strip_tags($_GET['method']));

    var_dump($method);

    if(class_exists($class)) {
        $obj = new $class;

        if (method_exists($obj, $method)) {
            switch ($method) {
                case "getContent": {
                    $obj->$method();
                    break;
                }
                case "login": {
                    if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
                        $obj->$method($_SESSION['login'], $_SESSION['password']);
                        break;
                    }
                    else {
                        echo 'login error';
                        break;
                    }
                }
            }
        }
    } else {
        echo 'Class not found';
    }
}
else {
    header("Location: index.php?controller=index_controller&method=getContent");
}
