<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    /**
     * @var array
     *
     */
    public static $rules = [
        'order_id' => 'required|integer',
        'food_id' => 'required|integer',
        'quantity' => 'required|integer',
        'pack_quantity' => 'required|integer',
    ];

    public static $update_rules = [
        'quantity' => 'required|integer',
        'pack_quantity' => 'required|integer',
    ];
}
