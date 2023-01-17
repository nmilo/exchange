<?php

namespace App\Services\PostOrderStrategies;

use App\Interfaces\PostOrderStrategy;
use App\Models\Order;
use App\Services\EmailService;

/**
 * This Concrete Strategy class implementes PostOrderStrategy
 */
class GBPStrategy implements PostOrderStrategy
{

    /**
     * @var EmailService $emailService
     */
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * @param Order $order
     */
    public function performAction(Order $order)
    {
        // Lazy load relations, since those were not needed up until now
        $order->load('purchasedCurrency', 'soldCurrency');

        $this->emailService->sendOrderConfirmationEmail($order);
    }
}
