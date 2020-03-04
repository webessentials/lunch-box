<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * @var array
     *
     */
    public static $rules = [
        'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        'note' => 'string',
        'food_id' => 'required|integer',
        'pack_quantity' => 'required|integer',
        'quantity' => 'required|integer',
        'unit_price' => 'required|regex:/^\d+(\.\d{1,2})?$/'
    ];

    public static $rule_payment = [
       'order_id' => 'required|integer',
       'paid' => 'required'
    ];


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the comments for the blog post.
     */
    public function orderDetails()
    {
        return $this->hasMany('App\OrderDetail');
    }

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
