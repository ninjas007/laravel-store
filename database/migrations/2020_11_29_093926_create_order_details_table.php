<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->date('date_order');
            $table->string('code_order', 100);
            $table->string('name');
            $table->text('address');
            $table->string('city', 50);
            $table->string('postal_code', 10);
            $table->string('province', 50);
            $table->string('phone', 20);
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->unsigned();
            $table->foreignId('payment_id')
                    ->constrained('payments')
                    ->unsigned();
            $table->foreignId('shipping_id')
                    ->constrained('shippings')
                    ->unsigned();
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
        Schema::dropIfExists('order_details');
    }
}
