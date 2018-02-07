<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockedDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocked_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->date('date');
            $table->string('motive', 80)->nullable();
            $table->boolean('block')->default(false);
            $table->integer('user_id')->unsigned();
        });

        Schema::table('blocked_dates', function (Blueprint $table) {
                        $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocked_dates');
    }
}
