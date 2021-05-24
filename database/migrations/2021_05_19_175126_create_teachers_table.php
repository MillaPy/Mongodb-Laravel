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
            $table->increments('teacher_id');
            $table->string('fullname');
            $table->string('email');
            $table->string('phone');
            $table->string('gender');
            $table->string('address');
            $table->date('date_of_birth');
            $table->string('degree');
            $table->string('speciality');
            $table->integer('awards_amount');
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
