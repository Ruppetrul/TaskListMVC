<?php

class task extends model {

    function getTasks($user_id) {
        try {
            $sql = "SELECT * FROM tasks WHERE user_id = :user_id";
            $statement = $this->db->prepare($sql);
            $statement->bindParam(":user_id", $user_id);
            $statement->execute();

            $posts = $statement->fetchAll();
            $arrayTask = array();

            foreach ($posts as $row) {
                $task = new TaskObj($row);
                $arrayTask[] = $task;
            }

            return $arrayTask;
            }
            catch (PDOException $ex) {

            return $ex;
        }
    }

    function addTask($user_id,$description) {
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