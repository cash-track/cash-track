<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_balance', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('balance_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('balance_id')->references('id')->on('balances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_balance', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExist('user_balance');
    }
}
