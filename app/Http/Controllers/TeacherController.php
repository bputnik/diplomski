<?php

namespace App\Http\Controllers;

use App\Group;
use App\Language;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Facade\FlareClient\Stacktrace\File;

class TeacherController extends Controller
{

    public function create(){

        //$languages = Language::pluck('name', 'id');

        return view('admin.teachers.create', //compact('languages')
             [
            'languages' => Language::all()
        ]);
    }



    public static function generatePassword(){

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

        $password = substr(str_shuffle($permitted_chars), 0, 10);
        return $password;

    }

    public function store(Request $request){
        //dd(request()->all());

        $request->name = Str::ucfirst(request('name'));
        $request->surname = Str::ucfirst(request('surname'));

            $request->validate([
            'name' => 'required | min:3',
            'surname' => 'required | min:3',
            'jmbg' => 'required | unique:teachers| min:13 | max:13',
            'email' => 'required | unique:teachers',
            'password' => 'required | min:6 | max:20',
            'address' => 'required',
            'phone' => 'required',
            'dob' => 'nullable | date',
            'bank-account' => 'nullable',
            'start-work' => 'required',
            'language' => 'required'
        ]);



        $inputTeacher = [
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'jmbg'=>$request->get('jmbg'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'address' => $request->get('address'),
            'phone'=> $request->get('phone'),
            'dob' => $request->get('dob'),
            'bank_account_number' => $request->get('bank-account'),
            'start_work' => $request->get('start-work'),
        ];

        //snimanje u fajl
        $data = json_encode(['email'=>$request->get('email'), 'password'=>$request->get('password')]);
        $file = 'podaci'.time() .'_file.json';
        $destinationPath=public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
        return response()->download($destinationPath.$file);




         Teacher::create($inputTeacher);


        $teacherId = DB::table('teachers')->where('email',$request->get('email'))->value('id');

        $teacher = Teacher::findOrFail($teacherId);
        $teacher->languages()->attach($request->language);

        session()->flash('teacher-created', 'Profesor ' . Str::ucfirst(request('name') . ' ' . Str::ucfirst(request('surname')) . ' je dodat u bazu!'));

        return redirect()->route('admin.teachers.show');
    }

    public function show(){


        return view('admin.teachers.show', [
            'teachers'=>Teacher::all(),
        ]);
    }


    public function edit(Teacher $teacher){

        return view('admin.teachers.edit', [
            'teacher' => $teacher,
            'languages' => Language::all()
        ]);

    }

    public function destroy(Teacher $teacher){

        $teacher->delete();
        session()->flash('teacher-deleted', 'Profesor ' . Str::ucfirst(request('name') . ' ' . Str::ucfirst(request('surname')) . ' je obrisan iz baze!'));
        return back();
    }

    public function attach_language(Teacher $teacher){
        $teacher->languages()->attach(request('language'));
        session()->flash('language-attached', 'Profesoru je dodat jezik: ' .  Language::findOrFail(request('language'))->name);
        return back();

    }

    public function detach_language(Teacher $teacher){
        $teacher->languages()->detach(request('language'));
        session()->flash('language-detached', 'Profesor više ne predaje: ' . Language::findOrFail(request('language'))->name);
        return back();
    }

    public function update(Teacher $teacher) {


        $teacher->name = Str::ucfirst(request('name'));
        $teacher->surname = Str::ucfirst(request('surname'));

        if($teacher->isDirty('name', 'surname', 'jmbg', 'dob', 'email', 'phone', 'address',
                                      'bank-account', 'start-work'))
        {
            session()->flash('teacher-updated', 'Podaci su uspešno izmenjeni.');
            $teacher->save();
            return back();

        } else {
            session()->flash('teacher-not-updated', 'Nema izmena');
            return back();
        }
    }

    public function index(){

        $teacherID = Auth::id();
        $groups = Group::where('teacher_id','=', $teacherID )->get();



//        dd($groups_students);

        return view('teacher.index',[
            'groups'=>$groups,

            ]);
    }



}
