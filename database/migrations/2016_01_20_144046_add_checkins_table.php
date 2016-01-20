<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCheckinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkins', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('equipment_id');
            $table->unsignedInteger('user_id');
            $table->dateTime('checkin');
            $table->dateTime('checkout');
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
        Schema::drop('checkins');
    }
}
