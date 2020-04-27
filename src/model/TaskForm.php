<?php


namespace model;


use Model;
use validator\EmailValidator;
use validator\RequiredValidator;

class TaskForm extends Model
{
    public $name;
    public $email;
    public $description;

    protected $validators = [
        'name' => RequiredValidator::class,
        'email' => EmailValidator::class,
        'description' => RequiredValidator::class,
    ];

    public function clear(): void {
        $this->name = '';
        $this->email = '';
        $this->description = '';
    }
}
