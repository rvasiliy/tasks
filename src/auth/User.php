<?php


namespace auth;


/**
 * Current authenticated user
 *
 * @package auth
 */
class User
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var boolean
     */
    private $isAdmin;


    /**
     * @param int $id
     * @param string $name
     * @param string $email
     * @param bool $isAdmin
     */
    public function __construct(int $id, string $name, string $email, bool $isAdmin)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->isAdmin = $isAdmin;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }
}
