<?php

class task_controller extends Task_core {

    function taskAction() {
        if (isset($_POST['change_status'])) {
            $this->alterTaskStatus(htmlspecialchars($_POST['change_status']));
        } else if (isset($_POST['delete'])) {
            $this->removeTask(htmlspecialchars($_POST['delete']));
        }
        header("Location: index.php");
    }

    function allTaskAction() {
        if (isset($_POST['remove_all'])) {
            $this->removeAllTasks($_SESSION['user_id']);
            header("Location: index.php");
        } else if(isset($_POST['ready_all'])) {
            $this->alterTasksStatus($_SESSION['user_id'], true);
            header("Location: index.php");
        }
    }

    function addNewTask() {
        if (isset($_POST['new_task']) && $_SESSION['user_id']) {
            $this->addTask($_SESSION['user_id'],htmlspecialchars($_POST['new_task']));
        }
        header("Location: index.php");
    }
}