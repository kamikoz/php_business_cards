<?php

class BusinessCard
{
    private int $id;
    private string $name;
    private string $surname;
    private string $email;
    private string $phoneNumber;
    private string $company;
    private string $position;
    private bool $hired;
    private DateTime $dateTime;

    public function __construct()
    {
        $this->name = "";
        $this->surname = "";
        $this->email = "";
        $this->phoneNumber = "";
        $this->company = "";
        $this->position = "";
        $this->hired = "";
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
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @return bool
     */
    public function isHired(): bool
    {
        return $this->hired;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @param string $company
     */
    public function setCompany(string $company): void
    {
        $this->company = $company;
    }

    /**
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    /**
     * @param bool $hired
     */
    public function setHired(bool $hired): void
    {
        $this->hired = $hired;
    }


}