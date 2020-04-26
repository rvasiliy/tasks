<?php


use helper\CsrfHelper;

class Model
{
    /**
     * @var string
     */
    protected $csrfToken;

    protected $validators = [];

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
            return false;
        }

        foreach ($this->validators as $property => $validator) {
            if (!$validator::check($this->$property)) {
                return false;
            }
        }

        return true;
    }
}
