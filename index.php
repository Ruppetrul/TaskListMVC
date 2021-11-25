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

new index_controller;

require_once 'Views/auth.form.html';