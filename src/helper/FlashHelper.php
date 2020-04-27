<?php


namespace helper;


class FlashHelper
{
    const ERROR_TYPE = 'danger';
    const WARNING_TYPE = 'warning';
    const INFO_TYPE = 'info';

    private static $key = 'flash';

    public static function add(string $message, string $type = self::INFO_TYPE)
    {
        $messages = SessionHelper::get(self::$key);

        if (!is_array($messages)) {
            $messages = [];
        }

        array_push($messages, [
            'type' => $type,
            'message' => $message
        ]);

        SessionHelper::set(self::$key, $messages);
    }

    /**
     * @return array [['type' => '', 'message' => '']]
     */
    public static function get(): array
    {
        $messages = SessionHelper::get(self::$key);

        if (!is_array($messages)) {
            $messages = [];
        }

        SessionHelper::delete(self::$key);

        return $messages;
    }
}
