<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Jenssegers\Mongodb\Collection;
use Jenssegers\Mongodb\Query\Builder;
use DB;

class TeacherController extends Controller
{

    public function index()
    {
        $teachers = Teacher::orderBy('id', 'desc')->paginate(5)->setpath('teachers');
        return view('teachers.index', compact('teachers'));
    }

    //$match & $group, $sum aggregation methods
    public function aggregate(Teacher $teacher)
    {
        // db.teachers.aggregate([{ $match: {degree:"doctorate"}},
        //{$group: {_id:"$teacher_id", name:{"$first":"$degree"},
        //total:{$sum:"$awards_amount"}}},{$sort: {total: -1}}])

        $cursor = Teacher::whereRaw(['$match'=> ['degree'=>"doctorate", "speciality"=>"CS"],
            '$group'=>['_id'=>'$teacher_id',
            'total'=>['$sum'=>'$awards_amount']],
            '$sort'=>['total'=>-1],])->get();

        $current = $cursor;

        $d = DB::collection('teachers')->where('degree', $current)->paginate(5);

        //do{
            return view('teachers.aggregate', compact('teacher'))
            ->with('dt', $d);//}while(!($current=$cursor->next()));
    }

    public function filter_doc(Teacher $teacher)
    {

        $awards = Teacher::where('degree', 'doctorate')->sum('award_amount');
        $teachers = Teacher::where('degree', 'doctorate')
            ->orderBy($awards)
            //->groupBy('teacher_id', 'fullname', 'degree', 'speciality', 'awards_amount')
            //->get(['teacher_id', 'fullname', 'degree', 'speciality', 'awards_amount'])
            ->paginate(5);

        $doctors = DB::collection('teachers')->where('degree', $teachers)->paginate(5);
        return view('teachers.aggregate', compact('teachers'))
            ->with('doctors', $doctors)
            ->with('teachers', $teachers);
        }


    public function filter_ass(Teacher $teacher)
    {
        $awards = Teacher::where('degree', 'associate')->sum('award_amount');
        $teachers = Teacher::where('degree', 'associate')
            ->orderBy($awards)
            //>groupBy('teacher_id', 'fullname', 'degree', 'speciality', $awards)
            ->paginate(5);

        $associatives = DB::collection('teachers')->where('degree', $teachers)->paginate(5);
        return view('teachers.aggregate', compact('teachers'))
            ->with('associatives', $associatives)
            ->with('teachers', $teachers);
    }

    public function filter_bach(Teacher $teacher)
    {
        $awards = Teacher::where('degree', 'bachelor')->sum('award_amount');
        $teachers = Teacher::where('degree', 'bachelor')
            ->orderBy($awards)
            //->groupBy('teacher_id', 'fullname', 'degree', 'speciality', $awards)
            ->paginate(5);

        $bachelors = DB::collection('teachers')->where('degree', $teachers)->paginate(5);
        return view('teachers.aggregate', compact('teachers'))
            ->with('bachelors', $bachelors)
            ->with('teachers', $teachers);
    }

    public function filter_master(Teacher $teacher)
    {
        $awards = Teacher::where('degree', 'master')->sum('award_amount');
        $teachers = Teacher::where('degree', 'master')
            ->orderBy($awards)
            //->groupBy('teacher_id', 'fullname', 'degree', 'speciality', $awards)
            ->paginate(5);

        $masters = DB::collection('teachers')->where('degree', $teachers)->paginate(5);
        return view('teachers.aggregate', compact('teachers'))
            ->with('masters', $masters)
            ->with('teachers', $teachers);
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $teachers = new Teacher();
        $teachers->teacher_id = $request->input('teacher_id');
        $teachers->fullname = $request->input('fullname');
        $teachers->email = $request->input('email');
        $teachers->phone = $request->input('phone');
        $teachers->gender = $request->input('gender');
        $teachers->address = $request->input('address');
        $teachers->date_of_birth = $request->input('date_of_birth');
        $teachers->degree = $request->input('degree');
        $teachers->speciality = $request->input('speciality');
        $teachers->awards_amount = $request->input('awards_amount');

        $teachers->save();
        return redirect()->route('teachers.index')->with('success', ' The Teacher contact is saved and created!');

    }

    public function show(Teacher $teacher)
    {
        return view('teachers.details', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $teacher->update($request->only('teacher_id','fullname', 'email', 'phone', 'gender',
            'address', 'date_of_birth', 'degree', 'speciality', 'awards_amount'));
        return redirect()->route('teachers.index')->with('success', ' The Teacher contact has been updated!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', ' The Contact has been deleted!');
    }
}

