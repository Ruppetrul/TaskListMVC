<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        form {
            position: fixed;
            padding: 10px;
            color: #fff;
            border: 4px solid black;
            left: 40%; top: 10%;
            width: 200px;
            height: 100px;
            margin: -50px 0 0 -100px;
        }
        input {
            margin-bottom: 10px;
        }

        a {
            left: 50%; top: 30%;
        }
    </style>
</head>
<body>
        <form align="center" action="" method="POST">
            <input type="text" placeholder="login" name="login" required> <br>
            <input type="text" placeholder="Password" name="password" required> <br>
            <input type="submit" name="send" value="Login"> <br>
        </form>
</body>
</html>

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

$connect = new model("localhost","tasklist",
    "root", "");

if (isset($_POST['send'])) {
    if (isset($_POST['login']) && isset($_POST["password"])) {

        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);

        $isUser = $connect -> userCheck($login);

        if ($isUser) {

            $isLogin = $connect -> loginUser($login, $password);

            if (isset($isLogin['id'])) {
                session_start();
                $_SESSION['id'] = $isLogin['id'];
                $_SESSION['login'] = $isLogin['login'];
                header("Location: main.php");
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
                header("Location: main.php");
            } else {}
        }
    }
}

?>

