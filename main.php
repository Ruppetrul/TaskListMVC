<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>

        div {
            position: fixed;
            border: 4px solid black;
            left: 40%; top: 10%;
        }

        .exit {
            text-align: right;
        }

    </style>
</head>


<?php
require "connect.php";
session_start();

$connect = new connect("localhost","tasklist",
    "root", "");

render($connect);

    function render($connect) {
        $username = $_SESSION['login'];

        echo '<div style="padding: 16px">';
        require 'Views/user_panel.php';

        require 'Views/create.form.html';
        require 'Views/tools.form.html';

        $tasks = $connect -> getTasks($_SESSION['id']);

        require 'Views/main.show.php';
        echo '</div>';
    }

    if(isset($_POST['delete'])){
        $connect -> removeTask(htmlspecialchars($_POST['delete']));
        header("Refresh:0");
    } else if(isset($_POST['change_status'])) {
        $connect -> alterTaskStatus(htmlspecialchars($_POST['change_status']));
        header("Refresh:0");
    } else if(isset($_POST['add_task'])){
        $connect -> addTask(htmlspecialchars($_SESSION['id']), htmlspecialchars($_POST['new_task']));
        header("Refresh:0");
    } else if (isset($_POST['REMOVE_ALL'])) {
        $connect -> removeAllTasks(htmlspecialchars($_SESSION['id']));
        header("Refresh:0");
    } else if(isset($_POST['READY_ALL'])) {
        $connect -> alterTasksStatus(htmlspecialchars($_SESSION['id']), true);
        header("Refresh:0");
    } else if(isset($_POST['EXIT'])) {
        session_destroy();
        header("Location: index.php");
    }