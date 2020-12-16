<?php

namespace App\Http\Controllers;

use App\Models\HitBTCTicker;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;

class HitBTCAction extends Controller
{
    private $url = "https://api.hitbtc.com/api/2";

    public function __invoke()
    {
        $client = new Client();

        try {
            $response = $client->get("$this->url/public/ticker/BTCUSD");

            $responseData = collect(json_decode($response->getBody()->getContents()));
            $data = new HitBTCTicker();

            $responseData->except('timestamp')->each(function ($datum, $key) use (&$data) {
                $data->{Str::snake($key)} = $datum;
            });

            $data->save();
        } catch (GuzzleException $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }
}
