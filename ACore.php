<?php

abstract class ACore {

    protected $m;

    public function __construct() {
        $this -> m = new model();
    }

    protected function get_user_panel() {
        return include "Views/user_panel.php";
    }

    public function get_body() {
        echo '<div style="padding: 10px; position: fixed;
            border: 4px solid black; left: 40%; top: 10%;">';
        /*require 'Views/user_panel.php';

        require 'Views/create.form.html';
        require 'Views/tools.form.html';

        $tasks = $model -> getTasks($_SESSION['id']);

        require 'Views/main.show.php';*/

        include "tpl/main_tpl.php";
        echo '</div>';

    }

    abstract function get_content();
}