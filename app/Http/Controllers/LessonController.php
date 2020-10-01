<?php

namespace App\Http\Controllers;

use App\Group;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{

        public function store(Request $request){

            //dd($request);

            $request->validate([
                'lesson_number' => 'required',
                'lesson_content'=>'required',
                'lesson_note'=>'nullable',
                'lesson_date'=>'required'
            ]);

            $inputs = [
                'teacher_id'=>Auth::id(),
                'group_id'=>$request->get('group_id'),
                'lesson_number'=>$request->get('lesson_number'),
                'lesson_content'=>$request->get('lesson_content'),
                'lesson_note'=>$request->get('lesson_note'),
                'lesson_date'=>$request->get('lesson_date')
            ];


            session()->flash('lesson-created', 'Uspešno ste upisali čas.');
            //  DB::insert('insert into languages (name) values (?)', [$name]);
            Lesson::create($inputs);



            return redirect()->route('teacher.group.new-lesson-attendance', [
                'lesson_number'=> $request->get('lesson_number'),
                'group'=>$request->get('group_id')
            ]);

        }

        public function show(Request $request){

        $lesson = Lesson::where('lesson_number', '=', $request->get('lesson_number'))->get();

        // dd($lesson);

            return view('teacher.group.new-lesson-attendance', [
                'lesson'=>$lesson[0]
            ]);
        }



}
