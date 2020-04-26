<?php


namespace helper;


class CsrfHelper
{
    const TOKEN_KEY = 'csrfToken';

    public static function createToken():string
    {
        $token = self::generateTokenValue();

        SessionHelper::set(self::TOKEN_KEY, $token);

        return $token;
    }

    public static function validateToken(string $token): bool
    {
        return $token === SessionHelper::get(self::TOKEN_KEY);
    }

    private static function generateTokenValue(): string
    {
        return bin2hex(openssl_random_pseudo_bytes(24));
    }
}
