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
        'unit_price' => 'required'
    ];

    public static $update_rules = [
        'quantity' => 'required|integer',
        'pack_quantity' => 'required|integer',
        'unit_price' => 'required'
    ];

    /**
     * Get the post that owns the comment.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    /**
     * Get the post that owns the comment.
     */
    public function food()
    {
        return $this->belongsTo('App\Food');
    }
}
