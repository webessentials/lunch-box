<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Order;
use App\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function ordered() {
        $order = Order::where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::now()->format('y-m-d'))
            ->first();
        if ($order != null) {
            $orderDetail = OrderDetail::where('order_id', $order->id)->get();
            $order['order_details'] = $orderDetail;
        }
        return  $order;
    }
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
        $validator = Validator::make($request->all(), Order::$rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $order = Order::where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::now()->format('y-m-d'))
            ->first();

        $data['user_id'] = Auth::id();
        $data['amount'] = $request->amount;
        $data['note'] = $request->note;
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

        $orderDetail['quantity'] = $request->quantity;
        $orderDetail['pack_quantity'] = $request->pack_quantity;
        $orderDetail['unit_price'] = $request->unit_price;

        if($detail == null) {
            OrderDetail::create($orderDetail);
        }else {
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
        $validator = Validator::make($request->all(), Order::$rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data['amount'] = $request->amount;
        $data['note'] = $request->note;
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

        $orderDetail['quantity'] = $request->quantity;
        $orderDetail['pack_quantity'] = $request->pack_quantity;
        $orderDetail['unit_price'] = $request->unit_price;

        if($detail == null) {
            OrderDetail::create($orderDetail);
        }else {
            OrderDetail::where(['id' => $detail->id])->update($orderDetail);
        }

        return $order;
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
