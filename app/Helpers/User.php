<?php

namespace App\Helpers;

class User
{
    /**
     * Get message from message_file, params is optional
     *
     * @param string $key
     * @param array $paramArray
     * @return mixed|null
     */
    public static function getMessage($key, $paramArray = [])
    {
        $message = config($key);

        if ($message && is_string($message)) {
            foreach ($paramArray as $param => $value) {
                $message = str_replace(sprintf('<%d>', $param), $value, $message);
            }
        }

        return $message;
    }
}
