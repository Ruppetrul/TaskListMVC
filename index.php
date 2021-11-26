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


if (isset($_POST['send'])) {

    if (isset($_POST['login']) && isset($_POST["password"])) {

        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        session_start();
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;

        header("Location: index.php?controller=index_controller&method=login");
    }
}

if (isset($_GET['controller'])) {

    $class = htmlspecialchars($_GET['controller']);
    $method = htmlspecialchars($_GET['method']);

    if(class_exists($class)) {
        $obj = new $class;

        if (method_exists($obj, $method)) {
            switch ($method) {
                case "getContent": {
                    $obj->$method();
                    break;
                }
                case "getContentAndError": {
                    if (isset($_GET['error'])) {
                        $obj->$method($_GET['error']);
                    }
                    break;
                }
                case "login": {

                    session_start();
                    var_dump($_POST);
                    var_dump($_GET);
                    var_dump($_SESSION);

                    if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
                        if ($obj->$method($_SESSION['login'], $_SESSION['password'])) {

                        }

                        break;
                    }
                    else {
                        echo 'login error';
                        break;
                    }
                }
            }
        } else {
            header("Location: index.php?controller=index_controller&method=getContentAndError&error=Method error");
        }
    } else {
        header("Location: index.php?controller=index_controller&method=getContentAndError&error=Controller not found");
    }
}
else {
    session_destroy();
    header("Location: index.php?controller=index_controller&method=getContent");
}
