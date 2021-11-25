<?php

function autoload($c) {
    if (file_exists("controller/".$c.".php")) {
        require_once "controller/".$c.".php";
    }
    elseif (file_exists("model/".$c.".php")) {
        require_once "model/".$c.".php";
    }
}

spl_autoload_register('autoload');

require_once "ACore.php";

class index extends ACore {
    public function get_content() {
        $this -> get_index_body();
        new index_controller();
    }
}

if (isset($_GET['error'])) {}
else {
    $main = new index;
    $main -> get_content();
}

new index_controller;
