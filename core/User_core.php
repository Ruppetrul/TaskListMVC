<?php

class User_core extends Core {
    public function __construct()
    {
        $this->m = new user();
    }

    function getContent()
    {


        $this->get_login_body();
    }

    public function login_request($login, $password) {
        return $this->m->loginUser($login, $password);
    }

    public function register_request($login, $password) {
        $this->m->registerUser($login, $password);
    }

    public function userCheck($login) {
        return $this->m->userCheck($login);
    }
}