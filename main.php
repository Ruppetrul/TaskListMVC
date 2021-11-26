<?php

session_start();

if (isset($_SESSION['user_id'])|| isset($_SESSION['login'])){
    function autoload($c) {
        if (file_exists("controller/".$c.".php")) {
            require_once "controller/".$c.".php";
        }
        elseif (file_exists("model/".$c.".php")) {
            require_once "model/".$c.".php";
        }
    }
    spl_autoload_register('autoload');


    if (isset($_POST['delete'])){
        $_SESSION['delete'] = $_POST['delete'];
        header("Location: main.php?controller=main_controller&method=removeTask_");
    } else if(isset($_POST['change_status'])) {
        $_SESSION['change_status'] = $_POST['change_status'];
        header("Location: main.php?controller=main_controller&method=changeStatus");
    } else if(isset($_POST['add_task'])){
        $_SESSION['new_task'] = $_POST['new_task'];
        header("Location: main.php?controller=main_controller&method=addTask_");
    } else if (isset($_POST['REMOVE_ALL'])) {
        header("Location: main.php?controller=main_controller&method=removeAllTasks_");
    } else if(isset($_POST['READY_ALL'])) {
        header("Location: main.php?controller=main_controller&method=readyAll");
    } else if(isset($_POST['EXIT'])) {
        session_destroy();
        header("Location: index.php");
    }

    if (isset($_GET['controller'])) {
        $class = htmlspecialchars($_GET['controller']);
        $method = htmlspecialchars($_GET['method']);
        if (isset($_GET))$_SESSION['getParams'] = $_GET;

        if(class_exists($class)) {
            $obj = new $class;

            if (method_exists($obj, $method)) {

                $obj->$method();

            } else {
                header("Location: main.php?controller=main_controller&method=getContentAndError&error=Method error");
            }
        } else {
            header("Location: main.php?controller=main_controller&method=getContentAndError&error=Controller not found");
        }
    }
    else {
        header("Location: main.php?controller=main_controller&method=getContent");
    }


} else {
    session_destroy();
    header("Location: index.php");
}