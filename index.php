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

require "connect.php";
require "migrations/migration.php";

$connect = new connect("localhost","tasklist",
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

