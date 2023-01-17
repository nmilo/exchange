<?php

namespace App\Providers;

use App\Contracts\ExchangeRatesGateway;
use App\Services\CurrencyLayerGateway;
use Illuminate\Support\ServiceProvider;

class ExchangeRatesServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ExchangeRatesGateway::class, CurrencyLayerGateway::class);
    }
}
