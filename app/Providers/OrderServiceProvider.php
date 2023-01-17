<?php

namespace App\Providers;

use App\Interfaces\OrderBuilderInterface;
use App\Services\Order\OrderBuilder;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OrderBuilderInterface::class, OrderBuilder::class);
    }
}
