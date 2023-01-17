<?php

namespace App\Services;

use App\Enums\CurrencyEnum;
use App\Repositories\DiscountRepository;
use App\Repositories\ExchangeRateRepository;
use App\Repositories\SurchargeRepository;
use App\Services\CurrencyConverterService;

class PriceCalculatorService
{
    /**
     * @var ExchangeRateRepository $exchangeRateRepository
     */
    protected $exchangeRateRepository;

    /**
     * @var CurrencyConverterService $currencyConverterService
     */
    protected $currencyConverterService;

    /**
     * @var SurchargeRepository $surchargeRepository
     */
    protected $surchargeRepository;

    /**
     * @var DiscountRepository $discountRepository
     */
    protected $discountRepository;

    /**
     * PriceCalculatorService constructor.
     *
     * @param ExchangeRateRepository $exchangeRateRepository
     * @param CurrencyConverterService $currencyConverterService
     * @param SurchargeRepository $surchargeRepository
     * @param DiscountRepository $discountRepository
     */
    public function __construct(
        ExchangeRateRepository $exchangeRateRepository,
        CurrencyConverterService $currencyConverterService,
        SurchargeRepository $surchargeRepository,
        DiscountRepository $discountRepository
    )
    {
        $this->exchangeRateRepository = $exchangeRateRepository;
        $this->currencyConverterService = $currencyConverterService;
        $this->surchargeRepository = $surchargeRepository;
        $this->discountRepository = $discountRepository;
    }

    /**
     * @var $purchasedCurrencyId
     * @param $soldCurrencyId
     * @param $purchasedAmount
     *
     * @return float
     */
    public function calculateFinalPrice($purchasedCurrencyId, $soldCurrencyId, $purchasedAmount): float
    {
        $exchangeRate = $this->exchangeRateRepository->getTodaysExchangeRate($soldCurrencyId, $purchasedCurrencyId);

        $soldAmount = $this->currencyConverterService->convert($purchasedAmount, $exchangeRate);
        $surcharge = $this->surchargeRepository->getSurcharge($purchasedCurrencyId);

        $soldAmount = $soldAmount + ($soldAmount * $surcharge->percentage);

        if ($purchasedCurrencyId === CurrencyEnum::EUR){
            $discount = $this->discountRepository->getDiscount($purchasedCurrencyId);
            $soldAmount = $soldAmount - ($soldAmount * $discount->percentage);
        }

        return round($soldAmount, 6);
    }
}