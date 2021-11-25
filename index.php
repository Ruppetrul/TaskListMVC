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

$controller = new index_controller;

if (isset($_POST['send'])) {

    if (isset($_POST['login']) && isset($_POST["password"])) {

        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);

        $isUser = $controller->userCheck($login);

        if ($isUser) {

            $isLogin = $controller->login($login, $password);

            if (isset($isLogin['id'])) {
                session_start();
                $_SESSION['id'] = $isLogin['id'];
                $_SESSION['login'] = $isLogin['login'];
                header("Location: main.php");
            } else {
                $_POST['error'] = "Wrong login or password";
            }
        } else {
            $controller->register($login, $password);
            $isLogin = $controller->login($login, $password);

            if (isset($isLogin['id'])) {
                session_start();
                $_SESSION['id'] = $isLogin['id'];
                $_SESSION['login'] = $isLogin['login'];
                header("Location: main.php");
            } else {}
        }
    }
}

if (isset($_GET['error'])) {}
else {
    $controller -> get_content();
}
