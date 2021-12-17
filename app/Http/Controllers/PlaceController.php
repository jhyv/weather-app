<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function getPlaces(Request $request)
    {
        $input = $request->all();

        $http = new \GuzzleHttp\Client(['http_errors' => true]);
        $response = $http->get(env('FOUR_SQUARE_URL').'/search', [
            'query' => [ 
                'near' => $input['keywords'].',JP',
                // 'll' => $input['geolocation'],
                // 'radius' => '100000'
            ],
            'headers' => [
                'Accept'     => 'application/json',
                'Authorization' => env('FOUR_SQUARE_KEY')
            ]
        ]);

        return response()->json(json_decode($response->getBody(),true));
    }

    public function getPlacePhoto(Request $request, $fsq_id)
    {
        $input = $request->all();

        $http = new \GuzzleHttp\Client(['http_errors' => true]);
        $response = $http->get(env('FOUR_SQUARE_URL').'/'.$fsq_id.'/photos', [
            'headers' => [
                'Accept'     => 'application/json',
                'Authorization' => env('FOUR_SQUARE_KEY')
            ]
        ]);

        return response()->json(json_decode($response->getBody(),true));
    }

    public function getPlaceDetails(Request $request, $fsq_id)
    {
        $http = new \GuzzleHttp\Client(['http_errors' => true]);
        $response = $http->get(env('FOUR_SQUARE_URL').'/'.$fsq_id, [
            'headers' => [
                'Accept'     => 'application/json',
                'Authorization' => env('FOUR_SQUARE_KEY')
            ]
        ]);

        return response()->json(json_decode($response->getBody(),true));
    }

    public function placesPage(Request $request)
    {
        return view('cities');
    }

    public function viewPlacePage(Request $request)
    {
        $input = collect($request->all());

        return view('city-view',compact('input'));
    }

    public function getWeather(Request $request)
    {
        $input = $request->all();

        $http = new \GuzzleHttp\Client(['http_errors' => true]);

        $response = $http->get(env('OPEN_WEATHER_URL'), [
            'query' => [ 
                'lat' => $input['lat'],
                'lon' => $input['lng'],
                'appid' => env('OPEN_WEATHER_KEY'),
                'units' => 'metric'
            ],
            'headers' => [
                'Accept'     => 'application/json'
            ]
        ]);

        return response()->json(json_decode($response->getBody(),true));
    }
}
