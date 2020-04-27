<?php


namespace validator;


use Validator;

class EmailValidator extends Validator
{
    public static function check($value): bool
    {
        return boolval(filter_var($value, FILTER_VALIDATE_EMAIL));
    }
}
