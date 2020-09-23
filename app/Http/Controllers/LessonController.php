<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{

        public function store(Request $request){

            $request->validate([
                'lesson_number' => 'required',
                'lesson_content'=>'required',
                'lesson_note'=>'required',
                'lesson_date'=>'required'
            ]);

            $inputs = [
                'lesson_number'=>$request->get('lesson_number'),
                'lesson_content'=>$request->get('lesson_content'),
                'lesson_note'=>$request->get('lesson_note'),
                'lesson_date'=>$request->get('lesson_date')
            ];



            session()->flash('lesson-created', 'Uspešno ste upisali čas.');
            //  DB::insert('insert into languages (name) values (?)', [$name]);
            Lesson::create($inputs);



            return redirect()->route('teacher.group.new-lesson-attendance', [
                'lesson'=>Lesson::where('lesson_number', $request->get('lesson_number'))
            ]);

        }

        public function show(Lesson $lesson){

            return view('teacher.group.new-lesson-attendance', [
                'lesson'=>$lesson
            ]);



        }



}