<?php

namespace App\Repositories;

use App\Models\ExchangeRate;
use Illuminate\Database\Eloquent\Collection;

/**
 * Responsible for exchange rates retrival from local database
 */
class ExchangeRateRepository
{
    /**
     * @return Collection
     */
    public function getTodaysExchangeRates(): Collection
    {
        return ExchangeRate::where('effective_date', date('Y-m-d'))->get();
    }

    /**
     * @param $baseCurrency
     * @param $quoteCurrency
     *
     * @return ExchangeRate
     */
    public function getTodaysExchangeRate($baseCurrency, $quoteCurrency): ExchangeRate
    {
        return ExchangeRate::select('exchange_rate')
            ->where([
                'base_currency_id' => $baseCurrency,
                'quote_currency_id' => $quoteCurrency,
                'effective_date' => date('Y-m-d')
            ])
            ->firstOrFail();
    }

    /**
     * @return ExchangeRate
     */
    public function getExchangeRate(): ExchangeRate
    {
        return ExchangeRate::where('quote_currency_id', 1 /* OVDE MORA DA SE NAPISE ISPRAVNA VREDNOST*/)->first();
    }
}
