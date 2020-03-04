<?php

namespace App\Http\Controllers\API;

use App\Food;
use App\Schedule;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function today() {
        $schedule = Schedule::whereDate('date', Carbon::now()->format('y-m-d'))->with(['food'])->get();
        return ScheduleResource::collection($schedule);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ScheduleResource::collection(Schedule::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, Schedule::$rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $data = $request->all();
        $data['user_id'] = Auth::id();
        return Schedule::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule $foodSchedule
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $foodSchedule)
    {
        return $foodSchedule;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Schedule  $foodSchedule
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $foodSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Schedule  $foodSchedule
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $foodSchedule)
    {
        FoodScheduleDetail::where(['food_schedule_id' => $foodSchedule->id])->delete();
        $foodSchedule->delete();
        return response('', 204);
    }
}
