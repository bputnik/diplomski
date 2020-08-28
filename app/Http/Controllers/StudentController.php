<?php

namespace App\Http\Controllers;

use App\Course;
use App\Group;
use App\Student;
use App\Trustee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request){        // AKO ucenik ima email, salje se pass na taj, ako je null, salje se na roditeljski

        $request->validate([
            'parent-select'=>['nullable'],
            'name'=>['required','min:2', 'max:20'],
            'surname'=>['required','min:2', 'max:20'],
            'email'=>['nullable', 'unique:students'],
            'password'=>['required'],
            'address'=>['nullable'],
            'phone'=>['nullable'],
            'dob'=>['nullable'],
            'group'=>['required'],
            'contract_number'=>['required'],
            'discount'=>['nullable']
        ]);

        $inputStudent = [
            'trustee_id'=>$request->get('parent-select'),
            'name'=>$request->get('name'),
            'surname'=>$request->get('surname'),
            'email'=>$request->get('email'),
            'password'=>$request->get('password'),
            'address'=>$request->get('address'),
            'phone'=>$request->get('phone'),
            'dob'=>$request->get('dob'),
        ];

        $inputPivotStudentGroup = [
            'group'=>$request->get('group'),
            'contract_number'=>$request->get('contract_number'),
            'discount'=>$request->get('discount')
        ];

//        if($request->get('parent-select') == '') {
//            $request->validate([
//            'email'=>['required','email','unique:students'],]);
//
//            $inputStudent +=[
//                'email'=>$request->get('email'),
//            ];
//        } else {
//            $trusteeId = DB::table('trustees')->where('id',$request->get('parent-select'))->value('id');
//
//            $trustee = Trustee::findOrFail($trusteeId);
//
//            $inputStudent += [
//                'email'=>$trustee->email,
//            ];
//        }


        Student::create($inputStudent);
        $studentId=Student::max('id');

        $group = Group::find($request->get('group'));
        $group->students()->attach($studentId,  ['contract_number'=>$request->get('contract_number'), 'discount'=>$request->get('discount') ]);



//        $student = Student::whereId($studentId);
//
//        $student->group()->attach($request->get('group'));
//        $student->groups()->attach($student, ['contract_number'=>$request->get('contract_number'), 'discount'=>$request->get('discount') ]);

        session()->flash('student-added', 'Student je spešno dodat u bazu i upisan u grupu!');
        return redirect()->route('admin.students.show');
    }

    public function edit(Student $student){
        return view('admin.students.edit', [
            'student'=>$student,
        ]);

    }

    public function update(){}


}
