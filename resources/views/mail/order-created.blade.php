Dear user,

You have succefully opened the new purchase order, with the following details:

Order number #{{$order->id}},
Purchased currency: {{$order->purchasedCurrency->code}},
Purchased amount: {{$order->purchased_amount}},
Total amount paid: {{ $order->final_paid_amount}} {{$order->soldCurrency->code}}

Exchange