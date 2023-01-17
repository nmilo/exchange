<?php

namespace App\Factories;

use App\Enums\CurrencyEnum;
use App\Exceptions\UnknownCurrencyException;
use App\Interfaces\PostOrderStrategy;
use App\Services\PostOrderStrategies\EURStrategy;
use App\Services\PostOrderStrategies\GBPStrategy;
use App\Services\PostOrderStrategies\JPYStrategy;

/**
 * This class helps to produce a proper strategy object for handling a post order action.
 */
class PostOrderStrategyFactory
{
    /**
     * Get a post order strategy by currency id.
     *
     * @param int $currencyId
     * @return PostOrderStrategy
     * @throws \UnknownCurrencyException
     */
    public static function getPostOrderStrategy(int $currencyId): PostOrderStrategy
    {
        switch ($currencyId) {
            case CurrencyEnum::JPY:
                return app()->make(JPYStrategy::class);
            case CurrencyEnum::EUR:
                return app()->make(EURStrategy::class);
            case CurrencyEnum::GBP:
                return app()->make(GBPStrategy::class);
            default:
                throw new UnknownCurrencyException("Unknown Currency");
        }
    }
}