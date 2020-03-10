<?php

namespace App\Http\Controllers\API;

use App\Food;
use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Food::class);
        return FoodResource::collection(Food::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Food::class);
        $data = $request->all();
        $validator = Validator::make($data, Food::$rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if (!empty($data['picture'])) {
            $name = time() . '_food.' . $request->file('picture')->guessExtension();
            $request->file('picture')->move(public_path("/images/food/"), $name);
            $data['picture'] = url('images/food', $name);
        }

        return Food::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {

        return response()->json($food);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food $food)
    {
        $this->authorize('update', Food::class);
        $data = $request->all();
        $validator = Validator::make($data, Food::$rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        if (!empty($data['picture']) && $data['picture'] != $food->picture) {
            $name = time() . '_food.' . $request->file('picture')->guessExtension();
            $request->file('picture')->move(public_path("/images/food/"), $name);
            $data['picture'] = url('images/food', $name);
        }
       return Food::where('id',$food->id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        $this->authorize('delete', Food::class);
        $food->delete();
        return response('', 204);
    }

    /**
     * @param string $fileData
     * @param string $prefixName
     * @return string
     */
    public function uploadImage($fileData, $prefixName = '')
    {
        @list($type, $fileData) = explode(';', $fileData);
        @list(, $fileData) = explode(',', $fileData);
        $type = explode('/', $type);
        $extension = $type[1];
        $name = $prefixName . '_' . md5(time()) . '.' . $extension;
        Storage::disk('public')->put($name, base64_decode($fileData));

        return $name;
    }
}
