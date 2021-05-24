<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//use DB;

class CreateCoursesTable extends Migration
{

    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->increments('course_id');
            $table->string('title');
            $table->string('course_code');
            $table->text('description');
            $table->integer('duration');
            $table->integer('ects');
            $table->index(['title', 'description'], 'create_full_text_search');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('courses', function($table) {
            $table->dropIndex('create_full_text_search');
        });

        Schema::dropIfExists('courses');
    }
}
