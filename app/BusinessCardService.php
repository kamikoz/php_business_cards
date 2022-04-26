<?php
require_once(__DIR__ . '/BusinessCardMySQLCRUD.php');
require_once(__DIR__ . '/../config/config.local.php');

class BusinessCardService
{
    const NAME_FIELD = "name";
    const SURNAME_FIELD = "surname";
    const EMAIL_FIELD = "email";
    const PHONE_NUMBER_FIELD = "phone_number";
    const COMPANY_FIELD = "company";
    const POSITION_FIELD = "position";
    const HIRED_FIELD = "hired";
    const SEARCHING_METHOD_FORM = "form-search";

    const SEARCHING_ERROR_EMPTY_FIELD = 875;
    private BusinessCardMySQLCRUD $crud;

    /**
     * @param BusinessCardMySQLCRUD $crud
     */
    public function __construct(BusinessCardMySQLCRUD $crud)
    {
        $this->crud = $crud;
    }

    /**
     * @throws Exception
     */
    public function saveBusinessCardFromPOST(): int
    {
        $businessCardValues = $this->createBusinessCardValueArrayFromPOST();

        foreach ($businessCardValues as $businessCardField => $businessCardValue) {
            if ($businessCardField !== self::HIRED_FIELD && strlen($businessCardValue) == 0) {
                throw new Exception("No field can be empty during adding a new business card!", self::SEARCHING_ERROR_EMPTY_FIELD);
            }
        }

        $businessCard = new BusinessCard(
            $businessCardValues[self::NAME_FIELD] ?? "",
            $businessCardValues[self::SURNAME_FIELD] ?? "",
            $businessCardValues[self::EMAIL_FIELD] ?? "",
            $businessCardValues[self::PHONE_NUMBER_FIELD] ?? "",
            $businessCardValues[self::COMPANY_FIELD] ?? "",
            $businessCardValues[self::POSITION_FIELD] ?? "",
            $businessCardValues[self::HIRED_FIELD] ?? false,
        );

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
    public function searchBusinessCardsByFieldsFromPOST(): array
    {
        $businessCardValues = $this->createBusinessCardValueArrayFromPOST();

        if ($this->checkIfAllArrayKeysHaveEmptyValues($businessCardValues)){
            throw new Exception("All fields cannot be empty during searching a business cards!", self::SEARCHING_ERROR_EMPTY_FIELD);
        }

        return $this->crud->searchByFields($businessCardValues);
    }

    /**
     * @throws Exception
     */
    public function getAllBusinessCards(): array
    {
        return $this->crud->searchAll();
    }

    /**
     * @return array
     */

    private function createBusinessCardValueArrayFromPOST(): array
    {
        $businessCardValues = array(
            BusinessCardService::NAME_FIELD => "",
            BusinessCardService::SURNAME_FIELD => "",
            BusinessCardService::EMAIL_FIELD => "",
            BusinessCardService::PHONE_NUMBER_FIELD => "",
            BusinessCardService::COMPANY_FIELD => "",
            BusinessCardService::POSITION_FIELD => "",
            BusinessCardService::HIRED_FIELD => 0,
        );

        foreach ($businessCardValues as $fieldName => $fieldValue) {
            $filter = FILTER_DEFAULT;
            if ($fieldName == self::EMAIL_FIELD) {
                $filter = FILTER_VALIDATE_EMAIL;
            }
            $input = filter_input(INPUT_POST, $fieldName, $filter);
            $input = $this->validateInput($input);
            $businessCardValues[$fieldName] = $input;
        }

        if (($businessCardValues[self::HIRED_FIELD]) === "true") {
            $businessCardValues[self::HIRED_FIELD] = 1;
        }

        return $businessCardValues;
    }

    private function validateInput($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    private function checkIfAllArrayKeysHaveEmptyValues(array $array): bool {
        foreach ($array as $value){
            if ($value !== "") {
                return false;
            }
        }
        return true;
    }
}