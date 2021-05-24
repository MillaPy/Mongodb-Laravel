<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use DB;

class CourseController extends Controller
{
    //using indexes
    public function search(Request $request)
    {
        /*db.courses.createIndex({name:"text", description:"text"})
        db.courses.find({$text: {$search:"quis et"}},{score: {$meta:"textScore"}}).sort({score:{$meta:"textScore"}})*/
        $results = DB::connection('mongodb')->collection('courses')->
        whereRaw(['$text' => ['$search' => 'text']])->
        project(['score'=>['$meta'=>'textScore']])->
        orderBy('score', ['$meta' => "textScore"])->limit(10)->get();

        $courses = Course::whereFullText($request->get('q',''))
            ->orderBy('score',['$meta'=>'textScore'])->get();

        $max = $courses->max('score'); $min = $courses->min('score');

        $result = $courses->filter(function($q) use($max,$min){
            $temp = $q->score; $temp2 = ($max+$min)/2; return $temp > $temp2; });

        return view('courses.index', compact('result'));//->with('result', $result);
    }

    //find function with $in, $or $and
    public function findmore(Course $course)
    {
         //db.courses.find({$and:[{ $or:[ {ects:5}, {ects:6}]}, {duration: 6}]})//.count() ->somthing like this
        $courses = Course::whereIn('ects', [5, 6, 8])
            ->where('duration', '<', 6)
            ->orderBy('course_id', 'desc')
            ->paginate(7);

        $results = DB::collection('courses')->where('ects', $courses)->paginate(7);
        return view('courses.index', compact('course'))
            ->with('results', $results)->with('courses', $courses);
    }

    public function findless(Course $course)
    {
        $courses = Course::where('ects', '<', 5)
            ->where('duration', '<', 6)
            ->orderBy('course_id', 'desc')
            ->paginate(7);

        $results = DB::collection('courses')->where('ects', $courses)->paginate(7);
        return view('courses.index', compact('course'))
            ->with('results', $results)->with('courses', $courses);
    }

    public function index()
    {
        $courses = Course::orderBy('id', 'desc')->paginate(10)->setpath('courses');
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $courses = new Course();
        $courses->course_id = $request->input('course_id');
        $courses->title = $request->input('title');
        $courses->course_code = $request->input('course_code');
        $courses->description = $request->input('description');
        $courses->duration = $request->input('duration');
        $courses->ects = $request->input('ects');

        $courses->save();
        return redirect()->route('courses.index')->with('success', ' The Course is saved and created!');

    }

    public function show(Course $course)
    {
        return view('courses.details', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $course->update($request->only('course_id','title', 'course_code', 'description', 'duration', 'ects'));
        return redirect()->route('courses.index')->with('success', ' The Course has been updated!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', ' The Course has been deleted!');
    }

    public function searchlike(Course $course)
    {
        $first = 'Et';
        $titles = Course::where('title', $first)
            ->orderBy('course_id', 'desc')
            ->paginate(7);

        $descriptions = Course::where('description',  $first)
            ->orderBy('course_id', 'desc')
            ->paginate(7);

        $results = DB::collection('courses')->where('title', $titles)
            //->where('description', $descriptions)
            ->paginate(7);

        return view('courses.index', compact('course'))
            ->with('results', $results);
            //->with('titles', $titles)
            //->with('descriptions', $descriptions);
    }
}


