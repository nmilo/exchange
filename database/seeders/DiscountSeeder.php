<?php

namespace Database\Seeders;

use App\Enums\CurrencyEnum;
use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discount::insert([[
            'currency_id' => CurrencyEnum::EUR,
            'percentage' => '0.02',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]]);
    }
}
