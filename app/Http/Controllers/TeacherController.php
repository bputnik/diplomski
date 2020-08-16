<?php

namespace App\Http\Controllers;

use App\Language;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeacherController extends Controller
{

    public function create(){

        $languages = Language::pluck('name', 'id');

        return view('admin.teachers.create', compact('languages'));
    }



    public static function generatePassword(){

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

        $password = substr(str_shuffle($permitted_chars), 0, 10);
        return $password;

    }

    public function store(Request $request){
        //dd(request()->all());
            $request->validate([
            'name' => 'required | min:2',
            'surname' => 'required | min:2',
            'jmbg' => 'required | min:13 | max:13',
            'email' => 'required',
            'password' => 'required | min:6 | max:20',
            'address' => 'required',
            'phone' => 'required',
            'start-work' => 'required',
            'language' => 'required'
        ]);

        $inputTeacher = [
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'jmbg'=>$request->get('jmbg'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'address' => $request->get('address'),
            'phone'=> $request->get('phone'),
            'dob' => $request->get('dob'),
            'bank_account_number' => $request->get('bank-account'),
            'start_work' => $request->get('start-work'),
        ];

         Teacher::create($inputTeacher);


        $teacherId = DB::table('teachers')->where('email',$request->get('email'))->value('id');

        $teacher = Teacher::findOrFail($teacherId);
        $teacher->languages()->attach($request->language);

        session()->flash('teacher-created', 'Profesor ' . Str::ucfirst(request('name') . ' ' . Str::ucfirst(request('surname')) . ' je dodat u bazu!'));

        return redirect()->route('admin.teachers.show');
    }

    public function show(){


        return view('admin.teachers.show', [
            'teachers'=>Teacher::all()
        ]);
    }


    public function edit(Teacher $teacher){

        return view('admin.teachers.edit', [
            'teacher' => $teacher
        ]);

    }

    public function destroy(Teacher $teacher){

        $teacher->delete();
        session()->flash('teacher-deleted', 'Profesor ' . Str::ucfirst(request('name') . ' ' . Str::ucfirst(request('surname')) . ' je obrisan iz baze!'));
        return back();
    }



}
