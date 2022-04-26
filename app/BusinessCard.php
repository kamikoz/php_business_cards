<?php

class BusinessCard
{
    private int $id;
    private string $name;
    private string $surname;
    private string $email;
    private string $phone_number;
    private string $company;
    private string $position;
    private bool $hired;

    private static BusinessCardMySQLCRUD $crud;

    /**
     * @param BusinessCardMySQLCRUD $businessCardCrud
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $phone_number
     * @param string $company
     * @param string $position
     * @param bool $hired
     */
    public function __construct(
        BusinessCardMySQLCRUD $businessCardCrud,
        string $name,
        string $surname,
        string $email,
        string $phone_number,
        string $company,
        string $position,
        bool $hired)
    {

        self::$crud = $businessCardCrud;

        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->company = $company;
        $this->position = $position;
        $this->hired = $hired;
    }


    /**
     * @return string
     */
    public static function getTableName(): string {
        return DB_TABLE_NAME;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    /**
     * @param string $phone_number
     */
    public function setPhoneNumber(string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany(string $company): void
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    /**
     * @return bool
     */
    public function isHired(): bool
    {
        return $this->hired;
    }

    /**
     * @param bool $hired
     */
    public function setHired(bool $hired): void
    {
        $this->hired = $hired;
    }

    /**
     * @throws Exception
     */
    public function save(): bool {
        try {
            self::$crud->add($this);
        } catch (Exception $e) {
            throw new Exception("Cannot save Business Card: " . $e->getMessage());
        }
        return true;
    }

}