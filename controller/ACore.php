<?php

abstract class ACore {

    protected $m;

    public function __construct() {
        $this->m= new model();
    }

    public function get_main_body($tasks) {
        include "tpl/main_tpl.php";
    }

    public function get_index_body() {
        include "tpl/index_tpl.php";
    }
    public function get_index_body_and_error() {
        include "tpl/index_tpl.php";
    }

    public function login_request($login, $password) {
        return $this->m->loginUser($login, $password);
    }

    public function register_request($login, $password) {
        $this->m->registerUser($login, $password);
    }

    public function userCheck($login) {
        return $this->m->userCheck($login);
    }

    public function removeTask($id) {
        $this->m->removeTask($id);
    }

    public function alterTaskStatus($id) {
        $this->m->alterTaskStatus($id);
    }

    public function addTask() {
        if (isset($_SESSION['user_id']) && isset($_SESSION['description'])) {
            $user_id = ($_SESSION['user_id']);
            $description = ($_SESSION['description']);
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

    abstract function getContent();
}