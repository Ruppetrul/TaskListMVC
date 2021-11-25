<?php

session_start();
require_once "ACore.php";
spl_autoload_register('autoload');

function autoload($c) {
    if (file_exists("controller/".$c.".php")) {
        require_once "controller/".$c.".php";
    }
    elseif (file_exists("model/".$c.".php")) {
        require_once "model/".$c.".php";
    }
}

$class = 'main'

class main extends ACore {

    public function __construct()
    {
        $this->get_content();
    }

    public function get_content() {
        $result = $this -> get_body();
        return $result;
    }
}
?>


