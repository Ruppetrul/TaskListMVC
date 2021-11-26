<?php

class index_controller extends ACore {

    function getContent()
    {
        $this->get_index_body();
    }

    function getContentAndError($error) {
        $this->get_index_body_and_error($error);
    }

    function login($login, $password) {

            $isUser = $this->userCheck($login);

            if ($isUser) {

                $isLogin = $this->login_request($login, $password);

                if (isset($isLogin['id'])) {
                    session_start();
                    $_SESSION['id'] = $isLogin['id'];
                    $_SESSION['login'] = $isLogin['login'];
                    header("Location: main.php");
                } else {

                }
            } else {
                $this->register_request($login, $password);
                $isLogin = $this->login_request($login, $password);

                if (isset($isLogin['id'])) {
                    session_start();
                    $_SESSION['id'] = $isLogin['id'];
                    $_SESSION['login'] = $isLogin['login'];
                    header("Location: main.php");
                } else {}
            }
    }
}