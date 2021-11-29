<?php

class user_controller extends Core {

    public function __construct()
    {
        $this->m = new user();
    }

    function login() {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);

            $isUser = $this->userCheck($login);

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
                $isRegister = $this->register_request($login, $password);
                if ($isRegister) {
                    $isLogin = $this->login_request($login, $password);
                    if (isset($isLogin['id'])) {
                        session_start();
                        $_SESSION['user_id'] = $isLogin['id'];
                        $_SESSION['login'] = $isLogin['login'];
                        header("Location: /index.php?controller=task_controller&method=getContent");
                    } echo 'Login error';
                }
                else {
                    echo 'Registration error';
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

    function getContent() {
        $this->get_login_body();
    }

    private function login_request($login, $password) {
        return $this->m->loginUser($login, $password);
    }

    private function register_request($login, $password) {
        return $this->m->registerUser($login, $password);
    }

    private function userCheck($login) {
        return $this->m->userCheck($login);
    }
}