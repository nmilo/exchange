<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('purchased_currency_id');
            $table->decimal('purchased_amount', 19, 6);

            $table->decimal('exchange_rate', 15, 6);

            $table->unsignedBigInteger('sold_currency_id');
            $table->decimal('sold_amount', 19, 6);

            $table->decimal('surcharge_percentage', 5, 4);
            $table->decimal('surcharge_amount', 19, 6);

            $table->decimal('discount_percentage', 5, 4)->nullable();
            $table->decimal('discount_amount', 19, 6)->nullable();

            $table->decimal('final_paid_amount', 19, 6);

            $table->foreign('purchased_currency_id')->references('id')->on('currencies')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('sold_currency_id')->references('id')->on('currencies')
            ->onUpdate('cascade')->onDelete('restrict');

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
        Schema::dropIfExists('orders');
    }
}
