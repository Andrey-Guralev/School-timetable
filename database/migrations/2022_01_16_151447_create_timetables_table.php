<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetable', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('lesson_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('load_id');
            $table->integer('number');
            $table->integer('weekday');
            $table->json('rooms');

            $table->timestamps();

/*
Пример json'a кабинетов:
{
  "room1": {
      "room": "3-06",
      "room_id": 1
  },
  "room2": {
      "room": "2-13",
      "room_id": 12
  }
}

*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timetable');
    }
}
