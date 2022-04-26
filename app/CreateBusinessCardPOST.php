<?php
require_once(__DIR__ . '/BusinessCardMySQLCRUD.php');

session_start();

const NAME_FIELD = "name";
const SURNAME_FIELD = "surname";
const EMAIL_FIELD = "email";
const PHONE_NUMBER_FIELD = "phone_number";
const COMPANY_FIELD = "company";
const POSITION_FIELD = "position";
const HIRED_FIELD = "hired";

$businessCardValues = array(
    NAME_FIELD => "",
    SURNAME_FIELD => "",
    EMAIL_FIELD => "",
    PHONE_NUMBER_FIELD => "",
    COMPANY_FIELD => "",
    POSITION_FIELD => "",
    HIRED_FIELD => "",
);

try {
    $businessCardCrud = new BusinessCardMySQLCRUD();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach ($businessCardValues as $fieldName => $fieldValue) {
            $filter = FILTER_DEFAULT;
            if ($fieldName == EMAIL_FIELD) {
                $filter = FILTER_VALIDATE_EMAIL;
            }
            $input = filter_input(INPUT_POST, $fieldName, $filter);
            $input = validateInput($input);
            $businessCardValues[$fieldName] = $input;

            if (!isset($_SESSION['form-type'])){
                if($fieldName !== HIRED_FIELD && strlen($businessCardValues[$fieldName]) == 0) {
                    throw new Exception("No field can be empty during adding a new business card!", 875);
                }
            }
        }

        if (strlen($businessCardValues[HIRED_FIELD]) > 0) {
            $businessCardValues[HIRED_FIELD] = 1;
        }

        if (isset($_SESSION['form-type']) && $_SESSION['form-type'] == "searching") {
            $_SESSION['searching-result'] = $businessCardCrud->searchByFields($businessCardValues);
        } else {
            $businessCard = new BusinessCard(
                $businessCardCrud,
                $businessCardValues[NAME_FIELD]?? "",
                $businessCardValues[SURNAME_FIELD]?? "",
                $businessCardValues[EMAIL_FIELD]?? "",
                $businessCardValues[PHONE_NUMBER_FIELD]?? "",
                $businessCardValues[COMPANY_FIELD]?? "",
                $businessCardValues[POSITION_FIELD]?? "",
                $businessCardValues[HIRED_FIELD]?? false,
            );

            $businessCard->save();
        }

        header("Location: ../");

    }
} catch (Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
    $_SESSION['error_code'] = $e->getCode();
    header("Location: ../");
}

function validateInput($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}
