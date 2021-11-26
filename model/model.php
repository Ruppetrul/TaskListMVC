<?php

require('Task.php');

define('DB_HOST', 'localhost');
define('DB_USER', 'myTestUser');
define('DB_PASSWORD', '1234');
define('DB_NAME', 'tasklist');
define('DB_TABLE_VERSIONS', 'versions');

class model{

    private $db;

    public function __construct()
    {
        try {
            $this->db =
                new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $exception) {
            echo $exception->getMessage();
            die;
        }
    }

    function registerUser($login, $password) {
        $sql = "INSERT INTO users (login, password) 
            VALUES (:login, :password)";

        $password_hash = password_hash($password, PASSWORD_BCRYPT);

            try {
                $statement = $this->db->prepare($sql);
                $statement->bindParam(":login", $login);
                $statement->bindParam(":password", $password_hash);

                return $statement->execute();

            } catch (PDOException $ex) {
                echo $ex;
        }
    }

    function userCheck($login) {
        try {
        $sql = "SELECT * FROM users WHERE login = :login";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(":login", $login);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

            if (isset($result['id'])) return true;
            else return false;

        } catch (PDOException $ex) {
            return $ex;
        }
    }

    function loginUser($login, $password) {
        try {
        $sql = "SELECT * FROM users WHERE login = :login";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(":login", $login);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $result["password"])) {
            return $result;
        } else {
            return false;
        }
        } catch (PDOException $ex) {
            return $ex;
        }
    }

    function getTasks($id) {

        try {
            $sql = "SELECT * FROM tasks WHERE user_id = :id";
            $statement = $this->db->prepare($sql);
            $statement->bindParam(":id", $id);
            $statement->execute();

            $posts = $statement->fetchAll();
            $arrayTask = array();

            foreach ($posts as $row) {
                $task = new Task($row);
                $arrayTask[] = $task;
            }

            return $arrayTask;
            }
            catch (PDOException $ex) {
            return $ex;
        }
    }

    function addTask($user_id, $description) {
        $sql = "INSERT INTO tasks (user_id, description) 
            VALUES (:user_id, :description)";

        try {
            $statement = $this->db->prepare($sql);
            $statement->bindParam(":user_id", $user_id);
            $statement->bindParam(":description", $description);

            return $statement -> execute();

        } catch (PDOException $ex) {
             return $ex;
        }
    }

    function removeTask($task_id) {
        try {
        $sql = "DELETE FROM tasks WHERE id = $task_id";
        $statement = $this->db->prepare($sql);
        return $statement -> execute();
        } catch (PDOException $ex) {
            return $ex;
        }
    }

    function removeAllTasks($user_id) {
        try {
            $sql = "DELETE FROM tasks WHERE user_id = $user_id";
            $statement = $this->db->prepare($sql);
            return $statement->execute();
        } catch (Exception $ex) {
            return $ex;
        }
    }

    function alterTaskStatus($task_id) {
        try {
            $taskSql = "SELECT * FROM tasks WHERE id = $task_id";
            $statement = $this->db->prepare($taskSql);
            $statement -> execute();
            $task = $statement -> fetch(PDO::FETCH_ASSOC);

            if ($task['status'] == 0) {
                $new_status = 1;
            } else {
                $new_status = 0;
            }
            $sql = "UPDATE tasks SET status = $new_status WHERE id = $task_id";
            $statement = $this->db->prepare($sql);
            return $statement -> execute();
        } catch (Exception $ex) {
            return $ex;
        }
    }

    function alterTasksStatus($user_id, $status) {
        try {
            $sql = "UPDATE tasks SET status = :status WHERE user_id = :user_id";
            $statement = $this->db->prepare($sql);
            $statement -> bindParam(":status", $status);
            $statement -> bindParam(":user_id", $user_id);
            return $statement -> execute();
        } catch (Exception $ex) {
            return $ex;
        }
    }
}