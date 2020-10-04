<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Course;
use App\Group;
use App\Student;
use App\Trustee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'password'=>bcrypt($request->get('password')),
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

        //$registeredGroup = DB::select('select group_id from group_student where student_id=?', [$student->id]);

        $notInGroup = DB::select('select * from `groups` where id not in (select group_id from group_student where student_id=?)',[$student->id]);

        //dd($notInGroup);

        return view('admin.students.edit', [
            'student'=>$student,
            'groups'=>Group::all(),
            'notInGroup'=>$notInGroup

        ]);
    }


    public function detach_group(Student $student){
        $student->groups()->detach(request('group'));
        session()->flash('group-detached', 'Polaznik je uklonjen iz grupe '. Group::findOrFail(request('group'))->name );
        return redirect()->route('admin.students.edit',[
            'student'=>$student
        ]);
    }


    public function attach_group(Student $student){

        request()->validate([
            'group'=> 'required',
            'contract_number'=>'required|unique:group_student',
            'discount'=>'nullable'
        ]);

        //dd($inputs);
        $student->groups()->attach(request('group'), ['contract_number'=>request('contract_number'), 'discount'=>request('discount')]);
        session()->flash('group-attached', 'Polaznik je upisan u grupu '. Group::findOrFail(request('group'))->name );
        return redirect()->route('admin.students.edit',[
                'student'=>$student,
                'groups'=>Group::all()
        ]);

    }


    public function update(){}

//    ------------------------------- za auth -> student -------------------

    public function studentIndexPage(){


        $studentID = Auth::id();
        $student = Student::find($studentID);
        //dd($student);

        //$groups = Group::where('id', 'group_id')->students()->where('id', $studentID)->get();
        //$groups = DB::select('select * from `groups` where id in (select group_id from group_student where student_id=?)', [$studentID]);

        return view('student.index', [
            'student'=>$student,
        ]);
    }

    public function showProfile(Student $student){

        return view('student.student-profile', [
            'student'=>$student
        ]);

    }


    public function updateProfile(Student $student){

        //dd($student);
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

        $student->update($inputs);
        return back();
    }


    public function groupDetails(Group $group){

        $studentId = Auth::id();


        $number_of_lessons = DB::select('select max(lesson_number) as number_of_lessons from lessons where group_id=?', [$group->id]);

//        foreach ($studentsIds as $studentsId) {
//           // dd($studentsId);
//            $student = DB::select('select * from students where id=?', [$studentsId->student_id]);
//            array_push($students, $student);
//        }

        $attendances = Attendance::where('group_id', $group->id)->get();


        return view('student.group.group-details', [
            'studentId'=>$studentId,
            'group'=>$group,
            'number_of_lessons'=>$number_of_lessons[0]->number_of_lessons,
            'attendances'=>$attendances
        ]);
    }


}
