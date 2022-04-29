<?php
declare(strict_types=1);

require_once(__DIR__ . '/BusinessCardConsts.php');
require_once(__DIR__ . '/BusinessCardMySQLRepository.php');
require_once(__DIR__ . '/../config/config.local.php');

class BusinessCardService
{
    private BusinessCardRepository $crud;

    /**
     * @param BusinessCardRepository $crud
     */
    public function __construct(BusinessCardRepository $crud)
    {
        $this->crud = $crud;
    }

    /**
     * @throws Exception
     */
    public function saveBusinessCard(BusinessCard $businessCard): int
    {
        return $this->crud->add($businessCard);
    }

    /**
     * @throws Exception
     */
    public function searchBusinessCardByID(int $ID): array
    {
        return $this->crud->searchByID($ID);
    }

    /**
     * @throws Exception
     */
    public function searchBusinessCardsByFields(array $fields): array
    {
        return $this->crud->searchByFields($fields);
    }

    /**
     * @throws Exception
     */
    public function getAllBusinessCards(): array
    {
        return $this->crud->searchAll();
    }
}