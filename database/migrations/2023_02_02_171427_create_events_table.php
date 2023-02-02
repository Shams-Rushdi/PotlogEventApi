<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('event_type');
            $table->string('event_name');
            $table->string('event_address');
            $table->string('event_PhoneNumber');
            $table->string('event_city');
            $table->string('event_state');
            $table->date('event_date');
            $table->date('event_start');
            $table->date('event_end');
            $table->string('zip_code');
            $table->string('latitude');
            $table->string('longitude');
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
        Schema::dropIfExists('events');
    }
};
