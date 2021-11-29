<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'myTestUser');
define('DB_PASSWORD', '1234');
define('DB_NAME', 'tasklist');
define('DB_TABLE_VERSIONS', 'versions');

abstract class model
{
    protected $db;

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
}