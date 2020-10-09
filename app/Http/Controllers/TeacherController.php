<?php

namespace App\Http\Controllers;

use App\Group;
use App\Language;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


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

            TeacherController::downloadCredential($request);

//        //snimanje u fajl
//        $data = json_encode(['name' => $request->get('name'),'surname' => $request->get('surname'),'email'=>$request->get('email'), 'password'=>$request->get('password')]);
//        $file = $request->get('name') .'_'. $request->get('surname') .'_file.json';   //bila je dodata u ime i time() funkcija
//        $destinationPath = public_path()."/upload/";
//        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
//        File::put($destinationPath.$file, $data);
//        //   return response()->download($destinationPath.$file);
//        // ...

        Teacher::create($inputTeacher);

        $teacherId = DB::table('teachers')->where('email',$request->get('email'))->value('id');

        $teacher = Teacher::findOrFail($teacherId);
        $teacher->languages()->attach($request->language);

        session()->flash('teacher-created', 'Profesor ' . Str::ucfirst(request('name') . ' ' . Str::ucfirst(request('surname')) . ' je dodat u bazu!'));

        return redirect()->route('admin.teachers.show');
    }

    public function show(){
        return view('admin.teachers.show', [
            'teachers'=>Teacher::all()->sortBy('name'),
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

    public function downloadCredential(Request $request) {
       // dd($request);
        $data = json_encode(['name' => $request->get('name'),'surname' => $request->get('surname'),'email'=>$request->get('email'), 'password'=>$request->get('password')]);
        $file = $request->get('name') .'_'. $request->get('surname') .'_file.json';   //bila je dodata u ime i time() funkcija
        $destinationPath = public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file, $data);
        return response()->download($destinationPath.$file);
    }

    public function showProfile(Teacher $teacher){

        return view('teacher.teacher-profile', [
            'teacher'=>$teacher
        ]);
    }

    public function updateProfile(Teacher $teacher){

        $inputs = request()->validate([
            'name'=> ['required', 'string', 'max:30', 'alpha-dash'],
            'surname'=> ['required', 'string', 'max:30', 'alpha-dash'],
            'email'=>['required', 'email', 'max:255'],
            'avatar' => ['image:jpg, png, jpeg'],
        ]);

        if(request('avatar')) {
            $inputs['avatar'] = request('avatar')->store('images');
        }

        if(request('password') && request('confirm-password')){
            request()->validate([
                'password' => 'min:6|max:255',
                'confirm-password' => 'min:6|max:255',
            ]);
            if(request('password') == request('confirm-password')) {
                $inputs['password'] = bcrypt(request('password'));
                session()->flash('password-changed', 'Lozinka je promenjena!');
            } else
            {
                session()->flash('password-not-confirmed', 'Unete lozinke se ne podudaraju!');
                return back();
            }
        }

        $teacher->update($inputs);
        return back();
    }

//--------------------------------------- za Tecaher account
//
    public function index(){

        $teacherID = Auth::id();
        $groups = Group::where('teacher_id','=', $teacherID )->get();

        $numberOfStudents=[];

        foreach ($groups as $group) {
            $new = DB::select('select * from group_student where group_id=?', [$group->id]);
            array_push($numberOfStudents, $new);
        }

        return view('teacher.index',[
            'groups'=>$groups,
            'number_of_students'=>$numberOfStudents
        ]);
    }


}
