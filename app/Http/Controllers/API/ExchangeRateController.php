<?php

namespace App\Http\Controllers\API;

use App\Repositories\ExchangeRateRepository;
use App\Services\ExchangeRateUpdaterService;
use Illuminate\Http\JsonResponse;

class ExchangeRateController extends Controller
{
    /**
     * @var ExchangeRateUpdaterService
     */
    public $exchangeRateUpdaterService;

    /**
     * @var ExchangeRateRepository
     */
    public $exchangeRateRepository;

    /**
     * @param ExchangeRateUpdaterService $exchangeRateUpdaterService
     * @param ExchangeRateRepository $exchangeRateRepository
     *
     */
    public function __construct(
        ExchangeRateUpdaterService $exchangeRateUpdaterService,
        ExchangeRateRepository $exchangeRateRepository
    )
    {
        $this->exchangeRateUpdaterService = $exchangeRateUpdaterService;
        $this->exchangeRateRepository = $exchangeRateRepository;
    }

    /**
     * Update exchange rates from third party API.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRates(): JsonResponse
    {
        $ratesUpdated = $this->exchangeRateUpdaterService->updateRates();

        if (!$ratesUpdated)
        {
            return response()->json([
                'message' => 'Error occured while trying to update exchange rates.'
            ], 500);
        }

        return response()->json([
            'message' => 'Exchange rates successfully updated.'
        ], 200);
    }

    /**
     * Get active exchange rates
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRates(): JsonResponse
    {
        $rates = $this->exchangeRateRepository->getTodaysExchangeRates();

        if ($rates->isEmpty())
        {
            return response()->json([
                'error' => 'Please define exchange rates before using the application.'
            ], 500);
        }

        return response()->json([
            'data' => $rates
        ], 200);
    }
}
