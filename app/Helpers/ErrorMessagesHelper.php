<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;

class ErrorMessagesHelper
{
    /**
     * Get the value of a configuration item by key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return Config::get($key, $default);
    }

    /**
     * Set the value of a configuration item by key.
     *
     * @param string $key
     * @param mixed $value
     */
    public static function set($key, $value): void
    {
        Config::set($key, $value);
    }

    /**
     * Get the error message for a specific error code.
     *
     * @param string $errorCode
     * @param mixed ...$params
     * @return string|null
     */
    public static function getErrorMessage($errorCode, ...$params): ?string
    {
        $errorMessages = self::get('messages.code');

        if (isset($errorMessages[$errorCode])) {
            $errorMessage = $errorMessages[$errorCode];

            foreach ($params as $index => $param) {
                $placeholder = '{' . $index . '}';
                $errorMessage = str_replace($placeholder, $param, $errorMessage);
            }

            return $errorMessage;
        }

        return null;
    }
}
