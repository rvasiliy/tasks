<?php


namespace helper;


class SessionHelper
{
    public static function start()
    {
        session_start();
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public static function get(string $key)
    {
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public static function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function delete(string $key)
    {
        if (array_key_exists($key, $_SESSION)) {
            unset($_SESSION[$key]);
        }
    }
}
