<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HitBTCTicker;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class GetHitBTCTickerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticker:hitbtc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ticker HitBTC';

    private $url = "https://api.hitbtc.com/api/2";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client();

        DB::beginTransaction();

        try {
            $data = HitBTCTicker::select('id')
                ->limit(99)
                ->orderBy('created_at', 'desc')
                ->pluck('id');

            $toBeDeleted = HitBTCTicker::select('id')
                ->whereNotIn('id', $data)->pluck('id');

            $toBeDeleted->each(function ($id) {
                DB::table('hitbtc_ticker')->delete($id);
            });

            $response = $client->get("$this->url/public/ticker/BTCUSD");

            $responseData = collect(json_decode($response->getBody()->getContents()));
            $data = new HitBTCTicker();

            $responseData->except('timestamp')->each(function ($datum, $key) use (&$data) {
                $data->{Str::snake($key)} = $datum;
            });

            $data->save();

            DB::commit();
        } catch (GuzzleException $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }

        return 0;
    }
}
