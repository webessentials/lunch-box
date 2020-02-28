<?php

namespace App\Http\Controllers\API;

use App\Food;
use App\FoodSchedule;
use App\FoodScheduleDetail;
use App\Http\Resources\FoodScheduleDetailResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FoodScheduleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FoodScheduleDetailResource::collection(FoodScheduleDetail::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), FoodScheduleDetail::$rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data['food_schedule_id'] = $request->food_schedule_id;
        $data['food_id'] = $request->food_id;
        $scheduleDetail = FoodScheduleDetail::where($data)->first();

        if($scheduleDetail == null){
            $scheduleDetail = FoodScheduleDetail::create($data);
        }
        return $scheduleDetail;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return FoodScheduleDetail::where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FoodScheduleDetail  $foodScheduleDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FoodScheduleDetail $foodScheduleDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FoodScheduleDetail  $foodScheduleDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodScheduleDetail $foodScheduleDetail)
    {
        $foodScheduleDetail->delete();
        if(FoodScheduleDetail::where('food_schedule_id',$foodScheduleDetail->food_schedule_id)->count() == 0){
            FoodSchedule::where('id',$foodScheduleDetail->food_schedule_id)->delete();
        }
        return response($foodScheduleDetail, 204);
    }
}
