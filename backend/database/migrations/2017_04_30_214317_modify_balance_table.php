<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('balances', function(Blueprint $table){
            $table->string('slug')->nullable();
            $table->boolean('is_private')->default(false);

            $table->unique(['slug', 'owner_id'], 'unique_slug_owner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('balance', function(Blueprint $table){
            $table->dropColumn(['slug', 'is_private']);
        });
    }
}
