<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{

    protected $model = Teacher::class;

    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female', 'other']);
        $degree = $this->faker->randomElement(['associate','bachelor', 'master', 'doctorate']);
        $speciality = $this->faker->randomElement(['CS','Finance', 'Law', 'Applied Science', 'Management',
            'Sociology', 'Criminology', 'Politics', 'Economics', 'Business'
        ]);
        return [
            'teacher_id'=>$this->faker->unique()->numberBetween(21, 50),
            'fullname'=>$this->faker->name,
            'email'=>$this->faker->unique()->safeEmail,
            'phone'=>$this->faker->phoneNumber,
            'gender'=>$gender,
            'address'=>$this->faker->address,
            'date_of_birth'=>$this->faker->dateTimeBetween('1990-01-01', '2021-12-31')->format('Y-m-d'),
            'degree'=>$degree,
            'speciality'=>$speciality,
            'awards_amount'=>$this->faker->numberBetween(1, 15),
        ];
    }
}
