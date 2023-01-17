<?php

namespace App\Services;

use App\Contracts\ExchangeRatesGateway;
use App\Models\ExchangeRate;
use App\Repositories\CurrencyRepository;

class ExchangeRateUpdaterService {

    /**
     * @var ExchangeRatesGateway
     */
    public $exchangeRatesGateway;

    /**
     * @var CurrencyRepository
     */
    public $currencyRepository;

    /**
     * @param ExchangeRatesGateway $exchangeRatesGateway
     * @param CurrencyRepository $currencyRepository
     */
    public function __construct(ExchangeRatesGateway $exchangeRatesGateway, CurrencyRepository $currencyRepository)
    {
        $this->exchangeRatesGateway = $exchangeRatesGateway;
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * @return bool
     */
    public function updateRates(): bool
    {
        $newRates = $this->exchangeRatesGateway->fetchRatesFromAPI();

        $this->storeRates($newRates);

        return true;
    }

    /**
     * @param $rates
     *
     * @return void
     */
    private function storeRates($rates)
    {
        $currencies = $this->currencyRepository->getAllCurrencies()->pluck('id', 'code')->toArray();

        foreach ($rates as $currencyPair => $exchangeRate)
        {
            $baseCode = substr($currencyPair, 0, 3);
            $quoteCode = substr($currencyPair, 3, 3);

            ExchangeRate::updateOrCreate([
                'base_currency_id' => $currencies[$baseCode],
                'quote_currency_id' => $currencies[$quoteCode],
                'effective_date' => date('Y-m-d')
            ], [
                'exchange_rate' => $exchangeRate
            ]);
        }
    }
}
