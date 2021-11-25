<?php

abstract class ACore {

    protected $m;

    public function __construct() {
        $this -> m = new model();
    }

    protected function get_user_panel() {
        return include "Views/user_panel.php";
    }

    public function get_body($tpl) {
        $this->get_user_panel();
    }

    abstract function get_content();
}