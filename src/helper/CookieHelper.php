<?php


namespace helper;


class CookieHelper
{
    /**
     * @param string $name
     * @return mixed|null
     */
    public static function get(string $name)
    {
        if (array_key_exists($name, $_COOKIE)) {
            return $_COOKIE[$name];
        }

        return null;
    }

    public static function set(string $name, $value = '', $expires = 0, string $path = '')
    {
        setcookie($name, $value, $expires, $path);
    }

    public static function delete(string $name)
    {
        setcookie($name, '', time() - 1);
    }
}
