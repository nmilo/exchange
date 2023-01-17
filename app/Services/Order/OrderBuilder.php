<?php

namespace App\Services\Order;

use App\Interfaces\OrderBuilderInterface;
use App\Repositories\DiscountRepository;
use App\Repositories\ExchangeRateRepository;
use App\Repositories\SurchargeRepository;
use App\Services\CurrencyConverterService;

/**
 * Concrete Order Builder implementation.
 * Define build steps for an order object.
 */
class OrderBuilder implements OrderBuilderInterface {

    /**
     * @var $orderArray
     */
    public $orderArray;

    /**
     * @var ExchangeRateRepository
     */
    protected $exchangeRateRepository;

    /**
     * @var CurrencyConverterService
     */
    protected $currencyConverterService;

    /**
     * @var SurchargeRepository
     */
    protected $surchargeRepository;

    /**
     * @var DiscountRepository
     */
    protected $discountRepository;

     /**
     * OrderBuilder constructor.
     *
     * @param ExchangeRateRepository $exchangeRateRepository
     * @param CurrencyConverterService $currencyConverterService
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
     * @param $orderData
     *
     * @return OrderBuilderInterface
     */
    public function buildOrderBase($orderData): OrderBuilderInterface
    {
        $exchangeRate = $this->exchangeRateRepository->getTodaysExchangeRate($orderData['sold_currency_id'], $orderData['purchased_currency_id']);
        $soldAmount = $this->currencyConverterService->convert($orderData['purchased_amount'], $exchangeRate);

        $this->orderArray['purchased_currency_id'] = $orderData['purchased_currency_id'];
        $this->orderArray['purchased_amount'] = $orderData['purchased_amount'];
        $this->orderArray['exchange_rate'] = $exchangeRate->exchange_rate;
        $this->orderArray['sold_currency_id'] = $orderData['sold_currency_id'];
        $this->orderArray['sold_amount'] = $soldAmount;

        return $this;
    }

    /**
     * @return OrderBuilderInterface
     */
    public function applySurcharge(): OrderBuilderInterface
    {
        $surcharge = $this->surchargeRepository->getSurcharge($this->orderArray['purchased_currency_id']);

        $this->orderArray['surcharge_amount'] = $this->orderArray['sold_amount']*$surcharge->percentage;
        $this->orderArray['surcharge_percentage'] = $surcharge->percentage;
        $this->orderArray['final_paid_amount'] = $this->orderArray['sold_amount'] + $this->orderArray['surcharge_amount'];

        return $this;
    }

    /**
     * @return OrderBuilderInterface
     */
    public function applyAnotherTypeOfCommission(): OrderBuilderInterface
    {
        // Proof of concept code
        return $this;
    }

    /**
     * @return OrderBuilderInterface
     */
    public function applyAnotherTypeOfDiscount(): OrderBuilderInterface
    {
        // Proof of concept code
        return $this;
    }
}