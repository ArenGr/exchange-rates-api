<?php

namespace App\Http;

use Exception;

class Client
{
    /**
     * Perform a GET request and return the response body.
     *
     * @param string $url
     * @return string
     * @throws Exception
     */
    public static function get(string $url): string
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 30,
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $errorMessage = 'cURL error: ' . curl_error($ch);
            curl_close($ch);
            throw new Exception($errorMessage);
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpCode !== 200) {
            return false;
        }

        return $response;
    }
}
