<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Jenssegers\Mongodb\Collection;
use Jenssegers\Mongodb\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::orderBy('id', 'desc')->paginate(10)->setpath('students');
        return view('students.index', compact('students'));
    }

    public function filter_match(Student $student)
    {
        /*
         * db.student.aggregate([{"$addFields":{"slugcount":{"$let":{"vars":{"mslug":{"$filter":{"input":"$rewards","cond":
         * {"$eq":["$$this.slug","example_slug"]}}}},
        "in":{"$sum":"$$mslug.quantity"}}}}}, {"$match":{"slugcount":{"$gt":X}}}, {"$sort":{"slugcount":-1}}, {"$project":{"slugcount":0}}])
         * */
        $students = Student::raw(function ($collection) {
            return $collection->aggregate([
                ['$match' => ['expired' => ['$gte' => \Carbon\Carbon::now()->toDateTimeString()]]],
                ['$gender' => [
                    'slugcount',
                    ['$let' => [
                        'vars' => [
                            'mslug' => [
                                '$filter' => [
                                    'input' => '$gender',
                                    'cond' => ['$eq' => ['$$this.slug','example_slug']]
                                ]
                            ]
                        ],
                        'in' => ['$sum' => '$$mslug.quantity']
                    ]]
                ]],
                ['$match' => ['slugcount'=> ['$gt' => X]]],
                ['$sort' => ['slugcount' => -1]],
                ['$project' => ['slugcount' => 0]]]); });
        return view('students.index', compact('student'))->with('students', $students);
    }

    //filter data by parameters
    public function filter_gender_male(Student $student){
        //query filter by gender parameters
        //db.students.find({ gender: {$eq: "male"}}).count()
        $students = Student::orderBy('id', 'desc')->where('gender', 'male')->paginate(10);
        $genders = DB::collection('students')->where('gender', $students)->paginate(10);
        return view('students.index', compact('student'))->
        with('genders', $genders)->with('students', $students);
    }

    public function filter_gender_female(Student $student){
        //query filter by gender parameters
        //db.students.find({ gender: {$eq: "female"}}).count()
        $students = Student::orderBy('id', 'desc')->where('gender', 'female')->paginate(10);
        $genders = DB::collection('students')->where('gender', $students)->paginate(10);
        return view('students.index', compact('student'))->
        with('genders', $genders)->with('students', $students);
    }

    public function filter_gender_other(Student $student){
        //query filter by gender parameters
        //db.students.find({ gender: {$eq: "other"}}).count()
        $students = Student::orderBy('id', 'desc')->where('gender', 'other')->paginate(10);
        $genders = DB::collection('students')->where('gender', $students)->paginate(10);
        return view('students.index', compact('student'))->
        with('genders', $genders)->with('students', $students);
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $students = new Student();
        $students->student_id = $request->input('student_id');
        $students->fullname = $request->input('fullname');
        $students->email = $request->input('email');
        $students->phone = $request->input('phone');
        $students->address = $request->input('address');
        $students->gender = $request->input('gender');
        $students->date_of_birth = $request->input('date_of_birth');
        $students->career = $request->input('career');


        $students->save();
        return redirect()->route('students.index')->with('success', ' The Student contact is saved and created!');

    }

    public function show(Student $student)
    {
        return view('students.details', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $student->update($request->only('student_id', 'fullname', 'email',
            'phone', 'gender', 'address', 'date_of_birth', 'career'));
        return redirect()->route('students.index')->with('success', ' The Student contact has been updated!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', ' The Student Contact has been deleted!');
    }
}
