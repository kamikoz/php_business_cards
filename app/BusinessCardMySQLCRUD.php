<?php

require_once (__DIR__ . '/../config/config.local.php');
require_once (__DIR__ . '/BusinessCard.php');

class BusinessCardMySQLCRUD
{
    private string $dbHost = DB_HOST;
    private string $dbUser = DB_USER;
    private string $dbPass = DB_PASS;
    private string $dbName = DB_NAME;

    private mysqli $dbHandler;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $this->dbHandler = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Cannot connect to MySQL DataBase:" . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function add(BusinessCard $businessCard): bool
    {
        try {
            $sql = sprintf(
                "INSERT INTO %s (name, surname, email, phone_number, company, position, hired) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', %d)",
                BusinessCard::getTableName(),
                $businessCard->getName(),
                $businessCard->getSurname(),
                $businessCard->getEmail(),
                $businessCard->getPhoneNumber(),
                $businessCard->getCompany(),
                $businessCard->getPosition(),
                $businessCard->isHired()
            );

            $this->dbHandler->query($sql);
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Cannot add record to MySQL table:" . $e->getMessage());
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function searchByFields(array $fields): array
    {
        $result = [];

        if (empty($fields)){
            return $result;
        }

        try {
            $sql = sprintf("SELECT * FROM %s WHERE ", BusinessCard::getTableName());
            foreach ($fields as $field =>$value) {
                if (strlen($value) > 0) {
                    if ($field == "hired") {
                        $sql .= sprintf(" %s = %d AND", $field, $value);
                    } else {
                        $sql .= sprintf(" %s = '%s' AND", $field, $value);
                    }
                }
            }

            $sql = rtrim($sql," AND");
            $queryResult = $this->dbHandler->query($sql);
            if ($queryResult->num_rows > 0) {
                while($row = $queryResult->fetch_assoc()) {
                    $result[] = $row;
                }
            }
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Cannot find the record in MySQL table:" . $e->getMessage());
        }

        return $result;
    }

    /**
     * @throws Exception
     */
    public function searchAll(): array
    {
        $result = [];
        try {
            $sql = sprintf("SELECT * FROM %s ORDER BY created_at DESC;",
                BusinessCard::getTableName(),
            );
            $queryResult = $this->dbHandler->query($sql);
            if ($queryResult->num_rows > 0) {
                while($row = $queryResult->fetch_assoc()) {
                    $result[] = $row;
                }
            }
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Cannot find the record in MySQL table:" . $e->getMessage());
        }

        return $result;
    }


}