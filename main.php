<?php

session_start();

if (isset($_SESSION['id'])|| isset($_SESSION['login'])){
    function autoload($c) {
        if (file_exists("controller/".$c.".php")) {
            require_once "controller/".$c.".php";
        }
        elseif (file_exists("model/".$c.".php")) {
            require_once "model/".$c.".php";
        }
    }
    spl_autoload_register('autoload');

    $controller = new main_controller;

    if(isset($_POST['delete'])){
        $controller -> removeTask(htmlspecialchars($_POST['delete']));
        header("Refresh:0");
    } else if(isset($_POST['change_status'])) {
        $controller -> alterTaskStatus(htmlspecialchars($_POST['change_status']));
        header("Refresh:0");
    } else if(isset($_POST['add_task'])){
        $controller -> addTask(htmlspecialchars(null), htmlspecialchars($_POST['new_task']));
        header("Refresh:0");
    } else if (isset($_POST['REMOVE_ALL'])) {
        $controller -> removeAllTasks(htmlspecialchars($_SESSION['id']));
        header("Refresh:0");
    } else if(isset($_POST['READY_ALL'])) {
        $controller -> alterTasksStatus(htmlspecialchars($_SESSION['id']), true);
        header("Refresh:0");
    } else if(isset($_POST['EXIT'])) {
        session_destroy();
        header("Location: index.php");
    }

    if (isset($_GET['error'])) {}
    else {
        $controller -> get_content();
    }

} else {
    session_destroy();
    header("Location: index.php");
}