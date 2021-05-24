<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $courses_counter = Course::all()->count();
        $students_counter = Student::all()->count();
        $teachers_counter = Teacher::all()->count();

        return view('layouts.dashboard')->with([
            'courses_counter' => $courses_counter,
            'students_counter' => $students_counter,
            'teachers_counter' => $teachers_counter
        ]);

        //return view('layouts.dashboard');
    }
}
