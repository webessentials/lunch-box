<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Order;
use App\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderResource::collection(Order::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Order::$rules);

        $order = null;

        $userId = 1; //:TODO refactor when auth is implemented.

        $order = Order::where('user_id', $userId)
            ->whereDate('created_at', Carbon::now()->format('y-m-d'))
            ->first();

        $data['user_id'] = $userId;
        $data['amount'] = $request->amount;
        if ($order == null) {
            $order = Order::create($data);
        }else {
            if(Order::where('id', $order->id)->update($data) > 0){
                $order = Order::where(['id' => $order->id])->first();
            }
        }

        $orderDetail['order_id']  = $order->id;
        $orderDetail['food_id'] = $request->food_id;

        $detail = OrderDetail::where($orderDetail)->first();
        if($detail == null) {
            $orderDetail['quantity'] = $request->quantity;
            $orderDetail['pack_quantity'] = $request->pack_quantity;
            OrderDetail::create($orderDetail);
        }else {
            $orderDetail['quantity'] = $request->quantity;
            $orderDetail['pack_quantity'] = $request->pack_quantity;
            OrderDetail::where(['id' => $detail->id])->update($orderDetail);
        }
        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order = Order::where('id', $order->id)->first();
        $orderDetail = OrderDetail::where('order_id', $order->id)->get();
        $order['details'] = $orderDetail;
        return $order;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        OrderDetail::where(['order_id' => $order->id])->delete();
        $order->delete();
        return response('', 204);
    }
}
