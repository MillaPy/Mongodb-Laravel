<?php
/*
composer install
npm install && npm run dev
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
 */
use App\Http\Controllers\FullTextSearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return redirect('/login');});
Auth::routes();

Route::group(['middleware' => 'auth'], function (){
    Route::resource('/students', \App\Http\Controllers\StudentController::class);
    Route::get('/students/filter_gender_ma/{gender}', [\App\Http\Controllers\StudentController::class, 'filter_gender_male'])->
    name('students.filter_gender_male');
    Route::get('/students/filter_gender_fe/{gender}', [\App\Http\Controllers\StudentController::class, 'filter_gender_female'])->
    name('students.filter_gender_female');
    Route::get('/students/filter_gender_oth/{gender}', [\App\Http\Controllers\StudentController::class, 'filter_gender_other'])->
    name('students.filter_gender_other');

    Route::resource('/teachers', \App\Http\Controllers\TeacherController::class);
    Route::get('/teachers/filter_doctors/{degree}', [\App\Http\Controllers\TeacherController::class, 'filter_doc'])
        ->name('teachers.filter_doctors');
    Route::get('/teachers/filter_bachelors/{degree}', [\App\Http\Controllers\TeacherController::class, 'filter_bach'])
        ->name('teachers.filter_bachelors');
    Route::get('/teachers/filter_masters/{degree}', [\App\Http\Controllers\TeacherController::class, 'filter_master'])
        ->name('teachers.filter_masters');
    Route::get('/teachers/filter_others/{degree}', [\App\Http\Controllers\TeacherController::class, 'filter_ass'])
        ->name('teachers.filter_others');

    Route::resource('/courses', \App\Http\Controllers\CourseController::class);
    Route::get('/courses/findmore/{ects}', [\App\Http\Controllers\CourseController::class, 'findmore'])
        ->name('courses.find_more');
    Route::get('/courses/findless/{ects}', [\App\Http\Controllers\CourseController::class, 'findless'])
        ->name('courses.find_less');
    Route::get('/courses/search', [\App\Http\Controllers\CourseController::class, 'search'])
    ->name('courses.search');
});


