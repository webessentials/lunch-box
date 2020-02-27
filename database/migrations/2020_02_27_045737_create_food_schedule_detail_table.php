<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodScheduleDetailTable extends Migration
{
    public function up()
    {
        Schema::create('food_schedule_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('food_schedule_id');
            $table->integer('food_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('food_schedule_detail');
    }
}
