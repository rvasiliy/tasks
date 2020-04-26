<?php


namespace model;


use Model;
use validator\RequiredValidator;

class LoginForm extends Model
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    protected $validators = [
        'username' => RequiredValidator::class,
        'password' => RequiredValidator::class
    ];
}
