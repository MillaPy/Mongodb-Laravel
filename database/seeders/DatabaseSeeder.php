<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {

        \App\Models\User::factory(10)->create();
        \App\Models\Student::factory(22)->create();
        \App\Models\Teacher::factory(14)->create();
        \App\Models\Course::factory(8)->create();
    }
}
