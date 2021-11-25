<?php

require_once "ACore.php";

class main extends ACore {
    public function get_content() {
        $this -> get_body($this -> m);
        $connect = $this->m;
        new main_controller($connect);
    }
}