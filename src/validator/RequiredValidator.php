<?php


namespace validator;


use Validator;

class RequiredValidator extends Validator
{
    public static function check($value): bool
    {
        return isset($value) && $value !== '';
    }

    public static function getErrorMessage(): string
    {
        return 'Required';
    }
}
