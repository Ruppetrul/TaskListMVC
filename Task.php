<?php

class Task {
    public $id;
    public $user_id;
    public $description;
    public $created_at;
    public $status;

    public function __construct($task) {
        $this->id = $task['id'];
        $this->user_id = $task['user_id'];
        $this->description = $task['description'];
        $this->created_at = $task['created_at'];
        $this->status = $task['status'];
    }
}