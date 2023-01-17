<?php

namespace Database\Seeders;

use App\Enums\CurrencyEnum;
use App\Models\ExchangeRate;
use Illuminate\Database\Seeder;

class ExchangeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExchangeRate::insert([
            [
                'base_currency_id' => CurrencyEnum::USD,
                'quote_currency_id' => CurrencyEnum::JPY,
                'exchange_rate' => '107.17',
                'effective_date' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'base_currency_id' => CurrencyEnum::USD,
                'quote_currency_id' => CurrencyEnum::GBP,
                'exchange_rate' => '0.711178',
                'effective_date' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'base_currency_id' => CurrencyEnum::USD,
                'quote_currency_id' => CurrencyEnum::EUR,
                'exchange_rate' => '0.884872',
                'effective_date' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
