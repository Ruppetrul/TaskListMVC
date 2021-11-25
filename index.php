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

        $connect = new model();
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);

        $isUser = $connect -> userCheck($login);

        if ($isUser) {

            $isLogin = $connect -> loginUser($login, $password);

            if (isset($isLogin['id'])) {
                session_start();
                $_SESSION['id'] = $isLogin['id'];
                $_SESSION['login'] = $isLogin['login'];
                header("Location: main_page.php");
            } else {
                $_POST['error'] = "Wrong login or password";
            }
        } else {
            $connect -> registerUser($login, $password);
            $isLogin = $connect -> loginUser($login, $password);

            if (isset($isLogin['id'])) {
                session_start();
                $_SESSION['id'] = $isLogin['id'];
                $_SESSION['login'] = $isLogin['login'];
                header("Location: main_page.php");
            } else {}
        }
    }
}

require_once 'Views/auth.form.html';