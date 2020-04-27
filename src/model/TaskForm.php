<?php


namespace model;


use Model;
use validator\EmailValidator;
use validator\RequiredValidator;

class TaskForm extends Model
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $description;

    protected $validators = [
        'name' => RequiredValidator::class,
        'email' => EmailValidator::class,
        'description' => RequiredValidator::class,
    ];

    public function getId(): int
    {
        if ($this->id) {
            return intval($this->id);
        }

        return 0;
    }

    public function clear(): void {
        $this->id = 0;
        $this->name = '';
        $this->email = '';
        $this->description = '';
    }
}
