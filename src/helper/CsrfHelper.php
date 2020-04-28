<?php


namespace helper;


use Application;

class CsrfHelper
{
    const TOKEN_KEY = 'csrfToken';

    public static function createFormField()
    {
        $token = self::createToken();

        echo '<input type="hidden" name="' . CsrfHelper::TOKEN_KEY . '" value="' . $token . '">';
    }

    public static function validateToken(string $token): bool
    {
        $saltPosition = strrpos($token, ':');
        $salt = substr($token, $saltPosition + 1);
        $hash = substr($token, 0, strlen($token) - strlen($salt) - 1);
        $secret = Application::$config->get('secret');

        return sha1($salt . $secret) === $hash;
    }

    private static function createToken(): string
    {
        $salt = bin2hex(openssl_random_pseudo_bytes(32));
        $secret = Application::$config->get('secret');

        return sha1($salt . $secret) . ':' . $salt;
    }
}
