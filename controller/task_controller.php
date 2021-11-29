<?php

class task_controller extends Core {

    public function __construct()
    {
        $this->m = new task();
    }

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
            if ($this->removeAllTasks($_SESSION['user_id'])) header("Location: index.php");
            else echo 'Remove all error';
        } else if(isset($_POST['ready_all'])) {
            if ($this->alterTasksStatus($_SESSION['user_id'], true)) header("Location: index.php");
            else echo 'Ready all error';
        }
    }

    function addNewTask() {
        if (isset($_POST['new_task']) && $_SESSION['user_id']) {
            if ($this->addTask($_SESSION['user_id'],htmlspecialchars($_POST['new_task']))) header("Location: index.php");
            else echo 'Add task error';
        }
    }

    function getContent()
    {
        $tasks = $this->m->getTasks($_SESSION['user_id']);
        $this->get_task_body($tasks);
    }

    private function removeTask($id) {
        return $this->m->removeTask($id);
    }

    private function alterTaskStatus($id) {
        return $this->m->alterTaskStatus($id);
    }

    private function addTask($user_id,$description) {
        if (isset($user_id) && isset($description)) {
            return $this->m->addTask($user_id, $description);
        } else {
            return null;
        }
    }

    private function removeAllTasks($user_id) {
        return $this->m->removeAllTasks($user_id);
    }

    private function alterTasksStatus($task_id) {
        return $this->m->alterTasksStatus($task_id, true);
    }
}