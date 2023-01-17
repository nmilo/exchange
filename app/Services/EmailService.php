<?php

namespace App\Services;

use App\Mail\OrderCreated;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendOrderConfirmationEmail($order)
    {
        Mail::to('user@example.com')->send(new OrderCreated($order));
    }
}