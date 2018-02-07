<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('period_request', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('request_id')->unsigned();
            $table->integer('period_id')->unsigned();
        });

        Schema::table('period_request', function (Blueprint $table) {
            $table->foreign('request_id')->references('id')->on('requests');
            $table->foreign('period_id')->references('id')->on('periods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('period_request');
    }
}
