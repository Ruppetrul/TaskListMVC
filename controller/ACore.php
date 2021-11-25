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

    public function login($login, $password) {
        return $this->m->loginUser($login, $password);
    }

    public function userCheck($login) {
        return $this->m->userCheck($login);
    }

    public function register($login, $password) {
        $this->m->registerUser($login, $password);
    }

    public function removeTask($id) {
        $this->m>$this->removeTask($id);
    }

    public function alterTaskStatus($id) {
        $this->m->alterTaskStatus($id);
    }

    public function addTask($user_id,$description) {
        $this->m->addTask($user_id, $description);
    }

    public function removeAllTasks($user_id) {
        $this->m->removeAllTasks($user_id);
    }

    public function alterTasksStatus($task_id) {
        $this->m->alterTaskStatus($task_id);
    }

    abstract function get_content();
}