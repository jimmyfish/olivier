<?php

namespace App\Console\Commands;

use App\Models\HitBTCTicker;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class KeepDataOnlyLastHundredsCommand extends Command
{
    protected $signature = 'data:keep';
    protected $description = 'Keep data for 100 only';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        
    }
}
