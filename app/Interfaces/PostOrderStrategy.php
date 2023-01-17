<?php

namespace App\Interfaces;

use App\Models\Order;

interface PostOrderStrategy {

    /**
     * @param $order
     */
    public function performAction(Order $order);

}