<?php

namespace App\Http\Controllers;

use App\Course;
use App\Group;
use App\Student;
use App\Trustee;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function show(){

        return view('admin.students.show',[
            'students'=>Student::all(),

        ]);
    }

    public function create(){

        return view('admin.students.create',[
            'courses'=>Course::all(),
            'groups'=>Group::all(),
            'trustees'=>Trustee::all()

        ]);
    }

    public function store(Request $request){

        $request->validate([
            'parent-select'=>['nullable'],
            'name'=>['required','min:2', 'max:20'],
            'surname'=>['required','min:2', 'max:20'],
            'email'=>['required','email','unique:students'],
            'password'=>['required'],
            'address'=>['nullable'],
            'phone'=>['nullable'],
            'dob'=>['nullable']
        ]);

        $inputs = [
            'trustee_id'=>$request->get('parent-select'),
            'name'=>$request->get('name'),
            'surname'=>$request->get('surname'),
            'email'=>$request->get('email'),
            'password'=>$request->get('password'),
            'address'=>$request->get('address'),
            'phone'=>$request->get('phone'),
            'dob'=>$request->get('dob'),
        ];


        Student::create($inputs);
        return back();
    }

    public function edit(Student $student){
        return view('admin.students.edit', [
            'student'=>$student,
        ]);

    }

    public function update(){}


}
