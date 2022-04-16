<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRingSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ring_schedule', function (Blueprint $table) {
            $table->id();

            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('number')->nullable();
            $table->integer('weekday');
            $table->integer('type')->nullable();
            $table->integer('shift')->default(0);
            $table->string('asc_xml_id')->nullable();

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
        Schema::dropIfExists('ring_schedule');
    }
}
