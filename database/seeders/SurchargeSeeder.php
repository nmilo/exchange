<?php

namespace Database\Seeders;

use App\Enums\CurrencyEnum;
use App\Models\Surcharge;
use Illuminate\Database\Seeder;

class SurchargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Surcharge::insert([
            [
                'currency_id' => CurrencyEnum::JPY,
                'percentage' => '0.075',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'currency_id' => CurrencyEnum::GBP,
                'percentage' => '0.05',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'currency_id' => CurrencyEnum::EUR,
                'percentage' => '0.05',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
