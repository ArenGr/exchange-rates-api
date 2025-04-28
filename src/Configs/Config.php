<?php

namespace App\Configs;

class Config
{
    private static array $config = [];

    /**
     * Recursively retrieves a value from the configuration array using a "dot" key.
     *
     * @param string $key
     * @return array|null|string
     */
    private static function handle(string $key): array|string|null
    {
        $keys = explode('.', $key);
        $value = self::$config;

        foreach ($keys as $key) {
            if (array_key_exists($key, $value)) {
                $value = $value[$key];
            } else {
                return null;
            }
        }

        return $value;
    }

    /**
     * Retrieves a value from the configuration by key.
     *
     * @param string $key
     * @return array|string
     */
    public static function get(string $key): array|string
    {
        if (empty(self::$config)) {
            self::$config = require_once(__DIR__ . '/configs.php');
        }

        return self::handle($key);
    }
}
