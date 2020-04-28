<?php


use helper\CsrfHelper;
use helper\FlashHelper;

class Model
{
    /**
     * @var string
     */
    protected $csrfToken = '';

    protected $validators = [];

    protected $errors = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $name => $value) {
            if ($name === CsrfHelper::TOKEN_KEY) {
                $this->csrfToken = $value;

                continue;
            }

            if (property_exists($this, $name)) {
                $this->$name = $value;
            }
        }
    }

    public function isValid(): bool
    {
        if (!CsrfHelper::validateToken($this->csrfToken)) {
            FlashHelper::add('Invalid csrf token', FlashHelper::ERROR_TYPE);
            return false;
        }

        foreach ($this->validators as $property => $validator) {
            if (!$validator::check($this->$property)) {
                $this->errors[$property] = $validator::getErrorMessage();
            }
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
