<?php

class user_controller extends User_core {

    function login() {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);

            $isUser = $this->m->userCheck($login);

            if ($isUser) {

                $isLogin = $this->m->loginUser($login, $password);

                if (isset($isLogin['id'])) {
                    session_start();
                    $_SESSION['user_id'] = $isLogin['id'];
                    $_SESSION['login'] = $isLogin['login'];
                    // header("Location: /main.php");
                    header("Location: /index.php?controller=task_controller&method=getContent");
                } else {
                    header("Location: /index.php?controller=user_controller&method=getContent&error=wrong login or password");
                }

            } else {
                $this->register_request($login, $password);
                $isLogin = $this->login_request($login, $password);

                if (isset($isLogin['id'])) {
                    session_start();
                    $_SESSION['user_id'] = $isLogin['id'];
                    $_SESSION['login'] = $isLogin['login'];
                    header("Location: /index.php?controller=task_controller&method=getContent");
                } else {
                    echo 'ошибка регистрации';
                }
            }
        }
        else {
            header("Location: /index.php?controller=user_controller&method=getContent&error=wrong login or password");
        }
    }

    function logout() {
        session_destroy();
        header("Location: index.php");
    }
}