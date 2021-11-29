<?php
session_start();
function autoload($c) {
    if (file_exists("controller/".$c.".php")) {
        require_once "controller/".$c.".php";
    }
    elseif (file_exists("task/".$c.".php")) {
        require_once "task/".$c.".php";
    }
    elseif (file_exists("core/".$c.".php")) {
        require_once "core/".$c.".php";
    }
    elseif (file_exists("model/".$c.".php")) {
        require_once "model/".$c.".php";
    }
}

spl_autoload_register('autoload');

if (isset($_GET['controller'])) {

    $class = htmlspecialchars($_GET['controller']);
    $method = htmlspecialchars($_GET['method']);

    if(class_exists($class)) {
        $obj = new $class;

        if (method_exists($obj, $method)) {

            $obj->$method();

        } else {
            header("Location: index.php?controller=user_controller&method=getContent&error=Method error");
        }
    } else {
        header("Location: index.php?controller=user_controller&method=getContent&error=Controller not found");
    }
}
else {
    if (isset($_SESSION['user_id'])) {
        header("Location: index.php?controller=task_controller&method=getContent");
    } else {
        session_destroy();
        header("Location: index.php?controller=user_controller&method=getContent");
    }
}