<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('flake_id');
            $table->string('amount_paid');
            $table->longText('txn_id');
            $table->string('status')->default(0); // 0 = Unpaid Order, 1 = Paid Order , 2 = Order Shipped , 3 = Order Delivered, 4 = Order Cancelled , 5 = Order Refunded
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
