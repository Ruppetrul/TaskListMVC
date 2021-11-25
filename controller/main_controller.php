<?php

class main_controller {

    public function __construct($connect)
    {
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
    }

}


