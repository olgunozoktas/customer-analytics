<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('pages.weather');
    }

    /**
     * @param $day
     * @return object
     */
    public function show($day = null)
    {
        $requestedTimeAsTimestamp = $day ? Carbon::now()->subDays($day)->timestamp : Carbon::now()->timestamp;

        $apiURL = "https://api.openweathermap.org/data/2.5/onecall/timemachine";
        $apiResponse = Http::get($apiURL,[
            'lat' => '51.509865',
            'lon' => '-0.118092',
            'dt' => $requestedTimeAsTimestamp,
            'lang' => 'tr',
            'units' => 'imperial',
            'appid' => config('open_weather.app_id')
        ])->object();

        foreach($apiResponse->hourly as $key => $hour) {
            $apiResponse->hourly[$key]->date = Carbon::parse($hour->dt)->format('d-m-Y');
            $apiResponse->hourly[$key]->hour = Carbon::parse($hour->dt)->format('H:i');
            $apiResponse->hourly[$key]->full_time = Carbon::parse($hour->dt)->format('d-m-Y H:i:s');
        }

        return $apiResponse;
    }
}
