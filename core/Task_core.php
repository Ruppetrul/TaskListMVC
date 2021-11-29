<?php

class Task_core extends Core {
    public function __construct()
    {
        $this->m = new task();
    }

    public function getContent()
    {
        $tasks = $this->m->getTasks($_SESSION['user_id']);
        $this->get_task_body($tasks);
    }

    public function removeTask($id) {
        $this->m->removeTask($id);
    }

    public function alterTaskStatus($id) {
        $this->m->alterTaskStatus($id);
    }

    public function addTask($user_id,$description) {
        if (isset($user_id) && isset($description)) {
            return $this->m->addTask($user_id, $description);
        } else {
            return null;
        }
    }

    public function removeAllTasks($user_id) {
        $this->m->removeAllTasks($user_id);
    }

    public function alterTasksStatus($task_id) {
        $this->m->alterTasksStatus($task_id, true);
    }
}