<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Group;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{

    public function store(Request $request){
    }


    public function saveAttendance(Request $request){

       $inputs = [
            'group_id'=>$request->group_id,
            'lesson_id'=>$request->lesson,
            'student_id'=>$request->student_id,
            'attendance'=>1
        ];

        Attendance::create($inputs);

        return response('Učenik je prisutan na času.');
    }

    public function saveAbsence(Request $request){

        $inputs = [
            'group_id'=>$request->group_id,
            'lesson_id'=>$request->lesson,
            'student_id'=>$request->student_id,
            'attendance'=>0
        ];

        Attendance::create($inputs);

        return response('Učenik je odsutan sa časa.');
    }


    public function studentPresence(Group $group){

        $attendances = Attendance::where('group_id', $group->id)->get();

        $studentsIds = DB::select('select student_id from group_student where group_id=?', [$group->id]);

        $dates = DB::select('select distinct lesson_date from lessons where id in (select lesson_id from attendances where group_id=?)', [$group->id]);

        return view('teacher.group.student-presence', [
            'group'=>$group,
            'attendances'=>$attendances,
            'dates'=>$dates,
            'studentsIds'=>$studentsIds,
            'students'=>Student::all()
        ]);
    }

}
