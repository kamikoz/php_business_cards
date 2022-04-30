<?php
declare(strict_types=1);

require_once(__DIR__ . "/BusinessCardConsts.php");

class BusinessCardPOSTValidator
{
    private array $dataPost;

    /**
     * @param array $dataPost
     */
    public function __construct(array $dataPost)
    {
        $this->dataPost = $dataPost;
    }

    /**
     * @throws Exception
     */
    public function validatePOSTData(bool $isSearchingMode): array
    {
        $businessCardValues = [
            NAME_FIELD => "",
            SURNAME_FIELD => "",
            EMAIL_FIELD => "",
            PHONE_NUMBER_FIELD => "",
            COMPANY_FIELD => "",
            POSITION_FIELD => "",
            HIRED_FIELD => 0,
        ];

        foreach ($businessCardValues as $fieldName => $fieldValue) {
            $data = $this->dataPost[$fieldName] ?? "";

            if ($fieldName !== HIRED_FIELD) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
            } else {
                if ($data === "true") {
                    $data = true;
                }
            }

            if (!$isSearchingMode && ($fieldName !== HIRED_FIELD && strlen($data) == 0)) {
                throw new Exception("No field can be empty during adding a new business card!", FORM_ERROR_EMPTY_FIELD);
            }

            if ($fieldName === EMAIL_FIELD) {
                $data = filter_var($data, FILTER_VALIDATE_EMAIL);
                if ($data === false && $isSearchingMode && $this->dataPost[EMAIL_FIELD] === "") {
                    $data = "";
                } else if ($data === false) {
                    throw new Exception("This is not valid e-mail!", FORM_ERROR_NO_VALID_EMAIL);
                }
            }

            $businessCardValues[$fieldName] = $data;
        }

        $businessCardValues = $this->removeEmptyValuesFromArray($businessCardValues);
        if (empty($businessCardValues)) {
            throw new Exception("All fields cannot be empty during searching a business cards!", FORM_ERROR_EMPTY_FIELD);
        }

       return $businessCardValues;
    }

    /**
     * @param array $array
     * @return array
     */
    private function removeEmptyValuesFromArray(array $array): array
    {
        foreach ($array as $key => $value) {
            if ($value === "") {
                unset($array[$key]);
            }
        }
        return $array;
    }
}