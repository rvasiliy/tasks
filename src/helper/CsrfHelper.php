<?php


namespace helper;


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
        $tokenFromSession = SessionHelper::get(self::TOKEN_KEY);

        SessionHelper::delete(self::TOKEN_KEY);

        return $token === $tokenFromSession;
    }

    private static function createToken(): string
    {
        $token = SessionHelper::get(self::TOKEN_KEY);

        if (!$token) {
            $token = bin2hex(openssl_random_pseudo_bytes(24));
            SessionHelper::set(self::TOKEN_KEY, $token);
        }

        return $token;
    }
}
