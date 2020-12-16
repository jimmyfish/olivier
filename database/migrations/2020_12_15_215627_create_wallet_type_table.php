<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_type', function (Blueprint $table) {
            $table->id();
            $table->string('symbol');
            $table->timestamps();
        });

        Schema::table('wallet', function (Blueprint $table) {
            $table->foreignId('wallet_type_id')->after('user_id')->references('id')->on('wallet_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_type');
        Schema::table('wallet', function (Blueprint $table) {
            $table->dropForeign('wallet_type_wallet_type_id_foreign');
        });
    }
}
