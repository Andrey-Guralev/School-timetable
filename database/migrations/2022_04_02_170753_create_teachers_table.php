<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->json('lessons')->nullable();
            $table->unsignedBigInteger('class_id')->nullable(); // Кл. рук.
//            $table->enum('type', ['undefined'])->default('undefined');
            $table->string('type')->nullable();
            $table->string('asc_xml_id')->nullable();
            $table->string('asc_teacher_name')->nullable();

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
        Schema::dropIfExists('teachers');
    }
}
