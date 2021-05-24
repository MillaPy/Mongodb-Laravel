<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{

    protected $model = Student::class;

    public function definition()
    {

        $gender = $this->faker->randomElement(['male', 'female', 'other']);
        return [
            'student_id'=>$this->faker->unique()->numberBetween(51, 90),
            'fullname'=>$this->faker->name,
            'email'=>$this->faker->unique()->safeEmail,
            'phone'=>$this->faker->phoneNumber,
            'gender'=>$gender,
            'address'=>$this->faker->address,
            'date_of_birth'=>$this->faker->dateTimeBetween('1990-01-01', '2021-12-31')->format('Y-m-d'),
            'career'=>$this->faker->words(3),

        ];
    }
}
