<?php

namespace App\Http\Controllers;

use App\Course;
use App\Group;
use App\Student;
use App\Teacher;
use App\TeachingType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GroupController extends Controller
{

    public function show(){

        return view('admin.groups.show',[
           'groups'=>Group::all()
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



}
