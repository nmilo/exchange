<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreOrderRequest;
use App\Services\Order\OrderService;
use Exception;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    protected $orderService;

    /**
     * @param OrderService $orderService
     *
     * @return void
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Store new order.
     *
     * @param StoreOrderRequest $storeOrderRequest
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function openOrder(StoreOrderRequest $storeOrderRequest)
    {
        try {

            $this->orderService->openOrder($storeOrderRequest->validated());

        } catch (Exception $ex) {
            logger()->error($ex);

            return response()->json([
                'message' => 'Failed opening new order.'
            ], 500);
        }

        return response()->json([
            'message' => 'Successfully opened new purchase order.'
        ], 200);
    }
}
