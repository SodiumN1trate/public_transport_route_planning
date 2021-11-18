<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;
use App\Models\Stop;


class AdminController extends Controller
{

    private function rand_color() {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    public function upload_json(Request $request) {
        Transport::query()->delete();
        Stop::query()->delete();
        $json = json_decode($request->file('json')->get());
        foreach ($json->lines as $key) {
            $new_tranpsort = Transport::create([
                "name" => $key->name,
                "type" => $key->type,
                "color" => $this->rand_color()
            ]);
            foreach ($key->stops as $stops) {
                if (Stop::where('name', '=', $stops->name)->count() < 1) {
                    $new_stop = Stop::create([
                        "name" => $stops->name,
                    ]);
                    $new_tranpsort->stops()->attach($new_stop->id);
                } else {
                    $new_tranpsort->stops()->attach(Stop::where('name', '=', $stops->name)->first());
                }
             }
        }
        return "Fails tika veiksmīgi augšupielādēts un dati tika mainīti!";
    }
}
