<?php

namespace App\Http\Controllers;

use App\Course;
use App\Group;
use App\Student;
use App\Teacher;
use App\TeachingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GroupController extends Controller
{

    public function show(){

       // $numberOfStudents = DB::table('group_student')->count();
        return view('admin.groups.show',[
           'groups'=>Group::all(),
        //    'number_of_students'=>
        ]);
    }


    public function create(){
        return view('admin.groups.create',[
            'teachingTypes'=>TeachingType::all(),
            'courses'=>Course::all(),
            'teachers'=>Teacher::all()
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'teaching_type'=>['required'],
            'course'=>['required'],
            'teacher'=>['required'],
            'name'=>['required', 'unique:groups'],
            'classroom'=>['nullable'],
            'starting_date'=>['nullable'],
            'ending_date'=>['nullable'],
        ]);

        $inputs = [
            'teaching_type_id'=>$request->get('teaching_type'),
            'course_id'=>$request->get('course'),
            'teacher_id'=>$request->get('teacher'),
            'name'=>$request->get('name'),
            'classroom'=>$request->get('classroom'),
            'starting_date'=>$request->get('starting_date'),
            'ending_date'=>$request->get('ending_date')
        ];

        Group::create($inputs);
        session()->flash('group-created', 'Grupa '. Str::upper($request->name) . ' je kreirana.');
        return redirect()->route('admin.groups.show');
    }

    public function edit(Group $group){

        return view('admin.groups.edit', [
            'group'=>$group,
            'teachingTypes'=> TeachingType::all(),
            'courses'=>Course::all(),
            'teachers'=> Teacher::all(),
            'students'=> Student::all()
        ]);
    }


    public function update(Group $group){


        $inputs= \request()->validate([
            'name'=>'required',
            'classroom'=>'nullable',
            'teaching_type'=>'required',
            'course'=>'required',
            'teacher'=>'required',
            'starting_date'=>'nullable',
            'ending_date'=>'nullable',
        ]);

        $group->name = Str::ucfirst(\request('name'));
        $group->classroom = $inputs['classroom'];
        $group->teaching_type_id = $inputs['teaching_type'];
        $group->course_id = $inputs['course'];
        $group->teacher_id = $inputs['teacher'];
        $group->starting_date = $inputs['starting_date'];
        $group->ending_date = $inputs['ending_date'];



        if($group->isDirty())
        {
            session()->flash('group-updated', 'Podaci su uspešno izmenjeni.');
            $group->save();
            return back();

        } else {
            session()->flash('group-not-updated', 'Nema izmena.');
            return back();
        }

    }



    public function detach_student(Group $group){
        $group->students()->detach(request('student'));
        session()->flash('student-detached', 'Polaznik: ' . Student::findOrFail(request('student'))->name . Student::findOrFail(request('student'))->surname . ' je uklonjen iz grupe');
        return back();
    }


    public function groupDetails(Group $group){

        return view('teacher.group.group-details', [
            'group'=>$group
        ]);


    }


}
