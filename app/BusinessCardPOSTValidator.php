<?php
declare(strict_types=1);

require_once(__DIR__ . "/BusinessCardConsts.php");

class BusinessCardPOSTValidator
{
    private array $POST_DATA;
    private array $businessCardValues = [
        NAME_FIELD => "",
        SURNAME_FIELD => "",
        EMAIL_FIELD => "",
        PHONE_NUMBER_FIELD => "",
        COMPANY_FIELD => "",
        POSITION_FIELD => "",
        HIRED_FIELD => 0,
    ];

    /**
     * @param array $POST_DATA
     */
    public function __construct(array $POST_DATA)
    {
        $this->POST_DATA = $POST_DATA;
    }

    /**
     * @throws Exception
     */
    public function validatePOSTData(bool $isSearchingMode): array
    {
        foreach ($this->businessCardValues as $fieldName => $fieldValue) {
            if ($fieldName == EMAIL_FIELD) {
                $filter = FILTER_VALIDATE_EMAIL;
            } else {
                $filter = FILTER_DEFAULT;
            }

            $data = $this->POST_DATA[$fieldName] ?? "";
            $data = filter_var($data, $filter);
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            if ($fieldName === HIRED_FIELD ) {
                $data = $data==="true"? 1:0;
            }

            if (!$isSearchingMode && ($fieldName !== HIRED_FIELD && strlen($data) == 0)) {
                throw new Exception("No field can be empty during adding a new business card!", SEARCHING_ERROR_EMPTY_FIELD);
            }

            $this->businessCardValues[$fieldName] = $data;
        }


        if ($isSearchingMode && $this->checkIfAllArrayKeysHaveEmptyValues($this->businessCardValues)) {
            throw new Exception("All fields cannot be empty during searching a business cards!", SEARCHING_ERROR_EMPTY_FIELD);
        }

        return $this->businessCardValues;
    }

    /**
     * @param array $array
     * @return bool
     */

    private function checkIfAllArrayKeysHaveEmptyValues(array $array): bool
    {
        foreach ($array as $value) {
            if ($value !== "") {
                return false;
            }
        }
        return true;
    }
}