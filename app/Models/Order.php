<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [ 'id' ];

    /**
     * Get related purchased currency
     */
    public function purchasedCurrency()
    {
        return $this->belongsTo(Currency::class, 'purchased_currency_id');
    }

    /**
     * Get related sold currency
     */
    public function soldCurrency()
    {
        return $this->belongsTo(Currency::class, 'sold_currency_id');
    }
}
