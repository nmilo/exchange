<?php

namespace App\Services\PostOrderStrategies;

use App\Interfaces\PostOrderStrategy;
use App\Models\Order;

/**
 * This Concrete Strategy class implementes PostOrderStrategy
 */
class JPYStrategy implements PostOrderStrategy
{
    public function performAction(Order $order)
    {
        // No action
    }
}
