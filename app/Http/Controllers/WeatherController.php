<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use anlutro\LaravelSettings\Facade as Setting;

class WeatherController extends Controller
{
    public function index()
    {
        return view('forecast.index');
    }

    public function getweather($id)
    {
        if (request()->ajax()) {
            return response()->json(Setting::get($id));
        }
        return response()->json(['status'=>'Request is Http']);
    }
}
