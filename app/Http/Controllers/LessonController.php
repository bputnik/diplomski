<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Group;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{

        public function store(Request $request){

          //  dd(strtotime($request->get('lesson_date')));

            $request->validate([
                'lesson_number' => 'required',
                'lesson_content'=>'required',
                'lesson_note'=>'nullable',
                'lesson_date'=>'required'
            ]);

            $dates = DB::select('select lesson_date from lessons where group_id=?', [(int)$request->get('group_id')]);

            $dateUsed = 0;

            foreach ($dates as $date) {
                if (strtotime($date->lesson_date) == strtotime($request->get('lesson_date'))) {
                    $dateUsed = 1;
                }
            }

            //dd($dateUsed);

            if($dateUsed == 0) {

            $inputs = [
                'teacher_id'=>Auth::id(),
                'group_id'=>$request->get('group_id'),
                'lesson_number'=>$request->get('lesson_number'),
                'lesson_content'=>$request->get('lesson_content'),
                'lesson_note'=>$request->get('lesson_note'),
                'lesson_date'=>$request->get('lesson_date')
            ];


            session()->flash('lesson-created', 'Uspešno ste upisali čas.');

            Lesson::create($inputs);


            return redirect()->route('teacher.group.new-lesson-attendance', [
                'lesson_number'=> $request->get('lesson_number'),
                'group'=>$request->get('group_id')
            ]);

            } else {

                session()->flash('lesson-not-created', 'Čas je već upisan za uneti datum.');
                return back();

            }

        }

        public function show(Request $request, Group $group){

        $lesson = Lesson::where([
            ['lesson_number', $request->get('lesson_number')],
            ['group_id', $group->id]
        ])->get();
       // dd($lesson);

        $students = DB::select('select * from students where id in (select student_id from group_student where group_id=?)', [$group->id]);




            return view('teacher.group.new-lesson-attendance', [
                'lesson'=>$lesson[0],
                'lesson_number'=> $request->get('lesson_number'),
                'students'=>$students,
                'group'=>$group->id,

            ]);
        }


        public function showLessonsLearned(Group $group){


            $lessons = Lesson::where('group_id', $group->id)->orderBy('lesson_number')->get();
            //dd($lessons);

            return view('teacher.group.lessons-learned', [
                'group'=>$group,
                'lessons'=>$lessons
            ]);

        }

}
