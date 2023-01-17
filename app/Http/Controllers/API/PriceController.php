<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\PriceCalculationRequest;
use App\Services\PriceCalculatorService;
use Illuminate\Http\JsonResponse;

class PriceController extends Controller
{
    /**
     * @var PriceCalculatorService
     */
    public $priceCalculatorService;

    /**
     * @param PriceCalculatorService $priceCalculatorService
     *
     */
    public function __construct(
        PriceCalculatorService $priceCalculatorService
    )
    {
        $this->priceCalculatorService = $priceCalculatorService;
    }

    /**
     * Get final price information to be shown to user
     *
     * @param PriceCalculationRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPrice(PriceCalculationRequest $request): JsonResponse
    {
        $price = $this->priceCalculatorService->calculateFinalPrice(
            $request->purchased_currency_id,
            $request->sold_currency_id,
            $request->purchased_amount
        );

        if ($price)
        {
            return response()->json([
                'price' => $price
            ], 200);
        }

        return response()->json([
            'message' => 'An error occured while calculating price.'
        ], 500);
    }
}
