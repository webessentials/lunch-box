<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodScheduleTable extends Migration
{
    public function up()
    {
        Schema::create('food_schedule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date');
            $table->integer('user_id'); /*Who schedules the foods.*/
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('food_schedule');
    }
}
