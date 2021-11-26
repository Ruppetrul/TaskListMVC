<?php

class main_controller extends ACore {
    function getContent()
    {
        $tasks = $this->m->getTasks($_SESSION['user_id']);

        $this->get_main_body($tasks);
    }

    function addTask_() {

        $this->m->addTask($_SESSION['user_id'],$_SESSION['new_task']);
        header("Location: main.php");

    }

    function removeAllTasks_() {
        $this->m->removeAllTasks($_SESSION['user_id']);
        header("Location: main.php");
    }

    function removeTask_()
    {
        $this->m->removeTask($_SESSION['delete']);
        header("Location: main.php");
    }

    function changeStatus() {
        $this->m->alterTaskStatus($_SESSION['change_status']);
        header("Location: main.php");
    }

    function readyAll() {
        $this->m->alterTasksStatus($_SESSION['user_id'], true);
        header("Location: main.php");
    }

}


