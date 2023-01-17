<?php

namespace App\Services;

use App\Repositories\ExchangeRateRepository;

/**
 * Converts money from one currency to another based on active exchange rate
 */
class CurrencyConverterService
{
    /**
     * @var ExchangeRateRepository
     */
    public $exchangeRateRepository;

    /**
     * @param ExchangeRateRepository $exchangeRateRepository
     *
     * @return void
     */
    public function __construct(ExchangeRateRepository $exchangeRateRepository)
    {
        $this->exchangeRateRepository = $exchangeRateRepository;
    }

    /**
     * @param $amount
     * @param $exchangeRate
     *
     * @return float
     */
    public function convert($amount, $exchangeRate): float
    {
        return $amount/$exchangeRate->exchange_rate;
    }

}
