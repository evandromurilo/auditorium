<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

						$table->integer('auditorium_id')->unsigned();
						$table->integer('user_id')->unsigned();
						$table->time('from_time');
						$table->time('until_time');
						$table->date('date');
						$table->string('event', 100);
						$table->text('description');
						$table->tinyInteger('status');
        });

        Schema::table('requests', function (Blueprint $table) {
						$table->foreign('auditorium_id')->references('id')->on('auditoria');
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
        Schema::dropIfExists('requests');
    }
}
