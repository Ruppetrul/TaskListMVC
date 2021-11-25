<?php

abstract class ACore {

    protected $m;

    public function __construct() {
        $this->m= new model();
    }

    protected function get_user_panel() {
        return include "Views/user_panel.php";
    }

    public function get_body() {
        $tasks = $this->m->getTasks($_SESSION['id']);
        include "tpl/main_tpl.php";
    }

    public function get_index_body() {
        include "tpl/index_tpl.php";
    }

    abstract function get_content();
}