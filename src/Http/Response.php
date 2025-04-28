<?php

namespace App\Http;

class Response
{
    /**
     * Send a JSON success response.
     *
     * @param mixed $data
     * @param int $statusCode
     * @return void
     */
    public static function json(mixed $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Send a JSON error response.
     *
     * @param string $message
     * @param int $statusCode
     * @return void
     */
    public static function jsonError(string $message, int $statusCode = 400): void
    {
        self::json([
            'error' => [
                'message' => $message,
                'code' => $statusCode
            ]
        ], $statusCode);
    }
}
