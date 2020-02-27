<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('paid'); /*by cash or e-cash*/
            $table->string('note');
            $table->integer('user_id');
            $table->float('amount');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order');
    }
}
