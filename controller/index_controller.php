<?php

class index_controller extends ACore {
    function getContent()
    {
        $this->get_index_body();
    }

    function login() {

        $login = $_SESSION['login'];
        $password = $_SESSION['password'];

            $isUser = $this->userCheck($login);

            if ($isUser) {

                $isLogin = $this->login_request($login, $password);

                if (isset($isLogin['id'])) {
                    session_start();
                    $_SESSION['user_id'] = $isLogin['id'];
                    $_SESSION['login'] = $isLogin['login'];
                    header("Location: main.php");
                } else {
                    header("Location: index.php?controller=index_controller&method=getContent&error=wrong login or password");
                }

            } else {
                $this->register_request($login, $password);
                $isLogin = $this->login_request($login, $password);

                if (isset($isLogin['id'])) {
                    session_start();
                    $_SESSION['user_id'] = $isLogin['id'];
                    $_SESSION['login'] = $isLogin['login'];
                    header("Location: main.php");
                } else {}
            }
    }
}