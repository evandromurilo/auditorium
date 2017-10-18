<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotCallMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_user', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
						$table->integer('call_id')->unsigned();
						$table->integer('user_id')->unsigned();
        });

        Schema::table('call_user', function (Blueprint $table) {
						$table->foreign('call_id')->references('id')->on('calls');
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
        Schema::dropIfExists('pivot_call_user');
    }
}
