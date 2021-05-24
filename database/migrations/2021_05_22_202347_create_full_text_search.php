<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFullTextSearch extends Migration
{

    public function up()
    {
        Schema::connection('mongodb')->table('courses', function (Blueprint $collection) {
            $collection->createIndex(
                [
                    "title" => "text",
                    "description" => "text"
                ],
                'text_search',
                null,
                [
                    "weights" => [
                        "title" => 32,
                        "description" => 12
                    ],
                    'name' => 'text_search'
                ]
            );
        });
    }

    public function down()
    {
        Schema::connection('mongodb')->table('courses', function (Blueprint $collection) {
            $collection->dropIndex(['text_search']);
        });
    }
}
