<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailTable extends Migration
{
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->integer('food_id');
            $table->integer('quantity');
            $table->integer('pack_quantity'); /*show the order quantity to eat outside company*/
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_detail');
    }
}
