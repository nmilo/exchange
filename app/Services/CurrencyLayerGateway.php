<?php

namespace App\Services;

use App\Contracts\ExchangeRatesGateway;
use App\Enums\CurrencyEnum;
use Illuminate\Support\Facades\Http;

class CurrencyLayerGateway implements ExchangeRatesGateway
{
    /**
     * @var $baseUrl
    */
    private $baseUrl = 'https://api.apilayer.com/';

    /**
     * @return bool|mixed     *
     */
    public function fetchRatesFromAPI()
    {
        $response = Http::withHeaders([
            'apikey' => config('exchange.api_key')
        ])
        ->get($this->baseUrl.'currency_data/live', [
            'source' => config('exchange.default_base_currency'),
            'currencies' => CurrencyEnum::getSymbols()
        ]);

        if ($response->successful())
        {
            return $response->json()['quotes'];
        }
    }
}
