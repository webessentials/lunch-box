<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodSchedule extends Model
{
    /**
     * @var array
     *
     */
    public static $rules = [
        'date' => 'required',
        'food_id' => 'required'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
