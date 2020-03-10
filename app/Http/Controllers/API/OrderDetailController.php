<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\OrderResource;
use App\Order;
use App\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $food
     * @return \Illuminate\Http\Response
     */
    public function today($food)
    {
        $orderDetails = OrderDetail::where('food_id', $food)->whereDate('created_at', Carbon::now()->format('y-m-d'))->with(['order.user'])->get();
        return OrderDetailResource::collection($orderDetails);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderDetailResource::collection(OrderDetail::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), OrderDetail::$rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $orderDetail = OrderDetail::where('order_id', $request->order_id)
            ->where('food_id', $request->food_id)
            ->first();
        if ($orderDetail == null) {
            $orderDetail['order_id'] = $request->order_id;
            $orderDetail['food_id'] = $request->food_id;
            $orderDetail['quantity'] = $request->quantity;
            $orderDetail['pack_quantity'] = $request->pack_quantity;
            $orderDetail['unit_price'] = $request->unit_price;
            $orderDetail = OrderDetail::create($orderDetail);
        } else {
            if (OrderDetail::where(['id' => $orderDetail->id])
                    ->update(['quantity' => $request->quantity,
                        'pack_quantity' =>  $request->pack_quantity,
                        'unit_price' => $request->unit_price]) > 0) {
                $orderDetail = OrderDetail::where('id', $orderDetail->id)->first();
            }
        }
        return $orderDetail;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDetail $orderDetail)
    {
        return OrderDetail::where('id', $orderDetail->id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        $validator = Validator::make($request->all(), OrderDetail::$update_rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        OrderDetail::where(['id' => $orderDetail->id])
            ->update(['quantity' => $request->quantity,
                'pack_quantity' =>  $request->pack_quantity,
                'unit_price' => $request->unit_price ]);
        return OrderDetail::where('id', $orderDetail->id)->first();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetail $orderDetail)
    {
        $orderDetail->delete();
        if(OrderDetail::where('food_schedule_id', $orderDetail->order_id)->count() == 0){
            Order::where('id', $orderDetail->order_id)->delete();
        }
        return response('Deleted', 204);
    }
}
