<?php

namespace App\Controllers;

use App\Configs\Config;
use App\Controllers\Controller;
use App\Http\Client;
use App\Http\Response;
use Exception;

class CurrencyController extends Controller
{

    /**
     *  Retrieves currency exchange rates from the Frankfurter API and renders the index view.
     *
     * @throws Exception
     */
    public function index(): null
    {

        $apiUrl = Config::get('urls.apis.frankfurter');
        $httpClient = new Client;
        $rates = $httpClient->get($apiUrl);
        $rates = json_decode($rates, true);

        return $this->render("index.php", $rates);
    }

    /**
     * Retrieves currency exchange rates based on the specified currency.
     *
     * @param $currency
     * @return void
     */
    public function base($currency): void
    {
        if (empty($currency)) {
            Response::jsonError('Currency not specified.', 404);
            return;
        }

        $apiUrl = Config::get('urls.apis.frankfurter');
        $baseUrl = $apiUrl . '?base=' . $currency;

        try {
            $response = Client::get($baseUrl);
            $rates = json_decode($response, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Response::jsonError('Currency not found.', 404);
                return;
            }

            if (isset($rates['error'])) {
                Response::jsonError($rates['error'], 404);
                return;
            }

            Response::json($rates);
        } catch (Exception $e) {
            Response::jsonError($e->getMessage(), 500);
        }
    }
} 
