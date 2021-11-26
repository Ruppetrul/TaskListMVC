<?php
session_start();
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
    $_SESSION['getParams'] = $_GET;

    if(class_exists($class)) {
        $obj = new $class;

        if (method_exists($obj, $method)) {

            $obj->$method();

        } else {
            header("Location: index.php?controller=index_controller&method=getContent&error=Method error");
        }
    } else {
        header("Location: index.php?controller=index_controller&method=getContent&error=Controller not found");
    }
}
else {
    session_destroy();
    header("Location: index.php?controller=index_controller&method=getContent");
}
