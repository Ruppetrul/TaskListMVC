<?php

abstract class ACore {

    protected $m;

    public function __construct() {
        $this->m= new model();
    }

    public function get_body() {
        $tasks = $this->m->getTasks($_SESSION['id']);
        include "tpl/main_tpl.php";
    }

    public function get_index_body() {
        include "tpl/index_tpl.php";
    }
    public function get_index_body_and_error($error) {
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

    public function addTask($user_id,$description) {

        return $this->m->addTask($user_id, $description);
    }

    public function removeAllTasks($user_id) {
        $this->m->removeAllTasks($user_id);
    }

    public function alterTasksStatus($task_id) {
        $this->m->alterTasksStatus($task_id, true);
    }

    abstract function getContent();
}