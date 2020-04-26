<?php


namespace helper;


class CsrfHelper
{
    const TOKEN_KEY = 'csrfToken';

    public static function createFormField()
    {
        $token = SessionHelper::get(CsrfHelper::TOKEN_KEY);

        echo '<input type="hidden" name="' . CsrfHelper::TOKEN_KEY . '" value="' . $token . '">';
    }

    public static function validateToken(string $token): bool
    {
        $tokenFromSession = SessionHelper::get(self::TOKEN_KEY);

        SessionHelper::delete(self::TOKEN_KEY);

        return $token === $tokenFromSession;
    }

    public static function generateToken(): void
    {
        if (!SessionHelper::get(self::TOKEN_KEY)) {
            $token = bin2hex(openssl_random_pseudo_bytes(24));
            SessionHelper::set(self::TOKEN_KEY, $token);
        }
    }
}
