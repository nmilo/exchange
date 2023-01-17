<?php

namespace App\Services\PostOrderStrategies;

use App\Interfaces\PostOrderStrategy;
use App\Models\Order;
use App\Repositories\DiscountRepository;

/**
 * This Concrete Strategy class implementes PostOrderStrategy
 */
class EURStrategy implements PostOrderStrategy
{
    protected $discountRepository;

    public function __construct(DiscountRepository $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    /**
     * @param Order $order
     */
    public function performAction(Order $order)
    {
        $discount = $this->discountRepository->getDiscount($order->purchased_currency_id);

        $this->applyDiscount($order, $discount);
    }

    /**
     * @param $order
     * @param $discount
     *
     * @return Order
     */
    private function applyDiscount($order, $discount)
    {
        if ($discount)
        {
            $discountAmount = $order->final_paid_amount*$discount->percentage;

            $order->update([
                'discount_amount' => $discountAmount,
                'discount_percentage' => $discount->percentage,
                'final_paid_amount' => $order->final_paid_amount - $discountAmount
            ]);
        }

        return $order;
    }
}
