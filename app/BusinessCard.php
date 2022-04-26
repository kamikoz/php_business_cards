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

    /**
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $phone_number
     * @param string $company
     * @param string $position
     * @param bool $hired
     */
    public function __construct(
        string $name,
        string $surname,
        string $email,
        string $phone_number,
        string $company,
        string $position,
        bool $hired)
    {
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
        return $this->phone_number;
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
}