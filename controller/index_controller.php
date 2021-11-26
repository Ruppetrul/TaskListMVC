<?php

class index_controller extends ACore {
    function get_content()
    {
        $this->get_index_body();
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
                    $_POST['error'] = "Wrong login or password";
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