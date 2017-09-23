<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleAndOwnerColumnToBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('balances', function(Blueprint $table){
            $table->string('title')->nullable()->after('id');
            $table->dropColumn('amount');
            $table->integer('owner_id')->unsigned()->default('1');
            $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('balances', function(Blueprint $table){
            $table->dropColumn('title');
            $table->integer('amount')->default(0);
            $table->dropForeign('owner_id');
        });
    }
}
