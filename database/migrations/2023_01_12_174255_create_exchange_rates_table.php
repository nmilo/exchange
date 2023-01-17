<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('base_currency_id');
            $table->unsignedBigInteger('quote_currency_id');

            $table->foreign('base_currency_id')->references('id')->on('currencies')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('quote_currency_id')->references('id')->on('currencies')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->decimal('exchange_rate', 15, 6);
            $table->date('effective_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_rates');
    }
}
