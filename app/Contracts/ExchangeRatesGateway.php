<?php

namespace App\Contracts;

interface ExchangeRatesGateway
{
    /**
     * Get new rates from API
     *
     * @return bool
     */
    public function fetchRatesFromAPI();
}
