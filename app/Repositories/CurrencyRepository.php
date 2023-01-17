<?php

namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

class CurrencyRepository
{
    /**
     * @return Collection
     */
    public function getAllSoldCurrencies(): Collection
    {
        return Currency::where('can_be_sold', true)->get();
    }

    /**
     * @param $code
     *
     * @return Collection
     */
    public function getAllBoughtCurrencies(): Collection
    {
        return Currency::where('can_be_purchased', true)->get();
    }

    /**
     * @param $code
     *
     * @return Collection
     */
    public function getCurrencyFromCode($code): Collection
    {
        return Currency::where('code', $code)->first();
    }

    /**
     * @return Collection
     */
    public function getAllCurrencyCodes(): Collection
    {
        return Currency::select('code')->where('can_be_sold', true)->get();
    }

    /**
     * @return Collection
     */
    public function getAllCurrencies(): Collection
    {
        return Currency::get();
    }
}
