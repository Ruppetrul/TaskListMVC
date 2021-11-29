<?php

abstract class Core {

    protected $m;

    public function get_task_body($tasks) {
        include "tpl/main_tpl.php";
    }

    public function get_login_body() {
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
        }
        include "tpl/index_tpl.php";
    }

    abstract function getContent();
}