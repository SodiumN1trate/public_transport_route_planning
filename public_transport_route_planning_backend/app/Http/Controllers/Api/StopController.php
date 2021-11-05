<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StopRequest;
use App\Http\Resources\StopResource;
use App\Models\Stop;

// Set data to DB from JSON.
//$path = storage_path(). "/json/transport_lines.json";
//$json = json_decode(file_get_contents($path));
//foreach ($json->lines as $key) {
//    $new_tranpsort = Transport::create([
//        "name" => $key->name,
//        "type" => $key->type
//    ]);
//    foreach ($key->stops as $stops) {
//        if (Stop::where('name', '=', $stops->name)->count() < 1) {
//            $new_stop = Stop::create([
//                "name" => $stops->name,
//            ]);
//            $new_tranpsort->stops()->attach($new_stop->id);
//        } else {
//            $new_tranpsort->stops()->attach(Stop::where('name', '=', $stops->name)->first());
//        }
//    }
//}




class StopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StopResource::collection(Stop::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StopRequest $request)
    {
        $new_stop = Stop::create($request->validated());
        return new StopResource($new_stop);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stop $stop)
    {
        return new StopResource($stop);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StopRequest $request, Stop $stop)
    {
        $stop->update($request->validated());
        return new StopResource($stop);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stop $stop)
    {
        $stop->delete();
        return true;
    }
}
