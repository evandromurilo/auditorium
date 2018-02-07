<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementVerifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirement_verifications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('requirement_id')->unsigned();
            $table->string('hash', 32);
            $table->tinyInteger('status');
        });

        Schema::table('requirement_verifications', function (Blueprint $table) {
            $table->foreign('requirement_id')->references('id')->on('requirements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requirement_verifications');
    }
}
