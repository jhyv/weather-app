<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function getPlaces(Request $request)
    {
        $input = $request->all();

        $http = new \GuzzleHttp\Client(['http_errors' => true]);
        $response = $http->get(env('FOUR_SQUARE_URL'), [
            'query' => [ 
                'query' => $input['keywords'],
                'll' => '36.17,138.11',
                'radius' => '100000'
            ],
            'headers' => [
                'Accept'     => 'application/json',
                'Authorization' => env('FOUR_SQUARE_KEY')
            ]
        ]);

        return response()->json(json_decode($response->getBody(),true));
    }
}
