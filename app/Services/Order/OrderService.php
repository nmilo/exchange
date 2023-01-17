<?php

namespace App\Services\Order;

use App\Factories\PostOrderStrategyFactory;
use App\Interfaces\OrderBuilderInterface;
use App\Models\Order;
use App\Services\Order\OrderBuilder;

class OrderService
{
    /**
     * @var OrderBuilder
     */
    protected $orderBuilder;

    /**
     * @var PostOrderStrategyFactory
     */
    protected $postOrderStrategyFactory;

    /**
     * OrderService constructor.
     *
     * @param OrderBuilderInterface $orderBuilder
     * @param PostOrderStrategyFactory $postOrderStrategyFactory
     */
    public function __construct(
        OrderBuilderInterface $orderBuilder,
        PostOrderStrategyFactory $postOrderStrategyFactory
    )
    {
        $this->orderBuilder = $orderBuilder;
        $this->postOrderStrategyFactory = $postOrderStrategyFactory;
    }

    /**
     * @param $orderDTO
     *
     * @return void
     *
     * @throws \Exception
     */
    public function openOrder($orderDTO)
    {
        $order = $this->orderBuilder->buildOrderBase($orderDTO)->applySurcharge()->applyAnotherTypeOfCommission()->applyAnotherTypeOfDiscount();

        $orderModel = $this->storeOrder($order->orderArray);

        $strategy = $this->postOrderStrategyFactory->getPostOrderStrategy($orderModel->purchased_currency_id);

        $strategy->performAction($orderModel);
    }

    /**
     * @param $orderObject
     *
     * @return Order
     */
    private function storeOrder($orderObject): Order
    {
        return Order::create($orderObject);
    }
}
