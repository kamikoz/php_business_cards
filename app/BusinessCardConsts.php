<?php

//database fields
const NAME_FIELD = "name";
const SURNAME_FIELD = "surname";
const EMAIL_FIELD = "email";
const PHONE_NUMBER_FIELD = "phone_number";
const COMPANY_FIELD = "company";
const POSITION_FIELD = "position";
const HIRED_FIELD = "hired";
const CREATED_AT_FIELD = "created_at";

//html fields
const SEARCHING_METHOD_FORM = "form-search";

//errors
const FORM_ERROR_EMPTY_FIELD = 801;
const FORM_ERROR_NO_VALID_EMAIL = 802;

const USER_FRIENDLY_ERRORS = [
    FORM_ERROR_EMPTY_FIELD,
    FORM_ERROR_NO_VALID_EMAIL
];
