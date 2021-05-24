<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'course_id'=>$this->faker->unique()->numberBetween(91, 130),
            'title'=>$this->faker->sentence(2),
            'course_code'=>$this->faker->randomDigit,
            'description'=>$this->faker->sentence(5),
            'duration'=>$this->faker->numberBetween(1, 6),
            'ects'=>$this->faker->numberBetween(2, 8),
        ];
    }
}
