<?php

abstract class Core {

    protected $m;

    public function get_task_body($tasks) {
        include "tpl/main_tpl.php";
    }

    public function get_login_body() {
        include "tpl/index_tpl.php";
    }

    abstract function getContent();
}