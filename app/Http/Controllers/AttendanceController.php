<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public function store(Request $request){

    }


    public function saveAttendance(Request $request){

       // dd($request);
        $inputs = [
            'group_id'=>$request->group_id,
            'lesson_id'=>$request->lesson,
            'student_id'=>$request->student_id,
            'attendance'=>1
        ];

        Attendance::create($inputs);

        return response('snimljeno');

    }

    public function saveAbsence(Request $request){

        // dd($request);
        $inputs = [
            'group_id'=>$request->group_id,
            'lesson_id'=>$request->lesson,
            'student_id'=>$request->student_id,
            'attendance'=>0
        ];

        Attendance::create($inputs);

        return response('snimljeno');

    }

}
