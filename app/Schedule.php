<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
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

    /**
     * Get the food that added to this date.
     */
    public function food()
    {
        return $this->belongsTo('App\Food');
    }

    /**
     * Get the user that owns this schedule.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
