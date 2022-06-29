<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRingScheduleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ring_schedule_types', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('shift')->default(0);
            $table->enum('type', ['regular', 'class_hour', 'event', 'saturday'])->default('regular');

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
        Schema::dropIfExists('ring_schedule_types');
    }
}
