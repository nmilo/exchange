<?php

namespace App\Repositories;

use App\Models\Discount;

class DiscountRepository
{
    /**
     * @param $currencyId
     *
     * @return Discount|null
     */
    public function getDiscount($currencyId): ?Discount
    {
        return Discount::where('currency_id', $currencyId)->first();
    }
}
