<?php

class user extends model {

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
}