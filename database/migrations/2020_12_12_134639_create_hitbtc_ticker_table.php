<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHitbtcTickerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hitbtc_ticker', function (Blueprint $table) {
            $table->id();
            $table->string('symbol')->nullable(false);
            $table->decimal('ask', 30, 10);
            $table->decimal('bid', 30, 10);
            $table->decimal('last', 30, 10);
            $table->decimal('low', 30, 10);
            $table->decimal('high', 30, 10);
            $table->decimal('open', 30, 10);
            $table->decimal('volume', 30, 10);
            $table->decimal('volume_quote', 30, 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hitbtc_ticker');
    }
}
