<?php

class MySQLDataBase implements Crud
{
    private string $dbHost = DB_HOST;
    private string $dbUser = DB_USER;
    private string $dbPass = DB_PASS;
    private string $dbName = DB_NAME;

    private mysqli $dbHandler;
    private string $error;


    public function __construct() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $this->dbHandler = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
        } catch (mysqli_sql_exception $e) {
            $this->error = $e->getMessage();
        }
    }

    public function add(array $params): bool
    {
        return true;
    }

    public function deleteByID(string $id): bool
    {
        return true;
    }

    public function updateByID(string $id): bool
    {
        return true;
    }

    public function search(string $query):array {
        return [];
    }

}