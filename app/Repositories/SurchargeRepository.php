<?php

namespace App\Repositories;

use App\Models\Surcharge;

class SurchargeRepository
{
    /**
     * @param $currencyId
     *
     * @return Surcharge|null
     */
    public function getSurcharge($currencyId): ?Surcharge
    {
        return Surcharge::where('currency_id', $currencyId)->first();
    }
}
